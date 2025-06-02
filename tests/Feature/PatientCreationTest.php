<?php

namespace Tests\Feature;

use App\Models\Location;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordToPatientEmail; // Assuming this is the correct Mailable
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase; // Useful for resetting DB state

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class); // Automatically refresh DB for each test

// Helper function to get base valid data
function getValidPatientData(?Location $location = null): array
{
    $location = $location ?? Location::factory()->create();
    return [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'dob' => now()->subYears(20)->format('Y-m-d'),
        'email' => 'john.doe.unique@example.com', // Ensure email is unique for each base data set if needed
        'phone' => '0412345678',
        'emergency_contact' => 'Jane Doe',
        'emergency_phone' => '0487654321',
        'medical_history' => 'Peanut allergy.',
        'street' => '123 Main St',
        'suburb' => 'Anytown',
        'state' => 'NSW',
        'location_id' => $location->id,
    ];
}

it('can create a patient successfully', function () {
    $adminUser = User::factory()->create();
    $adminUser->assignRole('Admin');

    $location = Location::factory()->create();
    $patientData = getValidPatientData($location);
    // Adjust email for this specific test to avoid conflict with validation tests if they run in parallel or affect db state
    $patientData['email'] = 'john.doe.success@example.com';


    Mail::fake();

    $response = actingAs($adminUser)
        ->post(route('admin.patient.store'), $patientData);

    assertDatabaseHas('users', [
        'first_name' => $patientData['first_name'],
        'last_name' => $patientData['last_name'],
        'email' => $patientData['email'],
        'dob' => $patientData['dob'],
    ]);

    $createdUser = User::where('email', $patientData['email'])->first();
    expect($createdUser)->not->toBeNull();
    expect($createdUser->hasRole('PATIENT'))->toBeTrue();

    assertDatabaseHas('user_details', [
        'user_id' => $createdUser->id,
        'phone' => $patientData['phone'],
        'emergency_contact' => $patientData['emergency_contact'],
        'emergency_phone' => $patientData['emergency_phone'],
        'medical_history' => $patientData['medical_history'],
        'street' => $patientData['street'],
        'suburb' => $patientData['suburb'],
        'state' => $patientData['state'],
        'location_id' => $patientData['location_id'],
    ]);

    $response->assertRedirect(route('admin.patient.index'));
    $response->assertSessionHas('message', 'Patient added successfully.');

    Mail::assertSent(SendPasswordToPatientEmail::class, function ($mail) use ($createdUser) {
        return $mail->hasTo($createdUser->email);
    });
});

// Validation Tests

dataset('validation_rules', [
    ['field' => 'first_name', 'value' => '', 'error_field' => 'first_name'],
    ['field' => 'first_name', 'value' => str_repeat('a', 26), 'error_field' => 'first_name'],
    ['field' => 'last_name', 'value' => '', 'error_field' => 'last_name'],
    ['field' => 'last_name', 'value' => str_repeat('a', 26), 'error_field' => 'last_name'],
    ['field' => 'phone', 'value' => '', 'error_field' => 'phone'],
    ['field' => 'phone', 'value' => 'invalid-phone', 'error_field' => 'phone'],
    ['field' => 'email', 'value' => '', 'error_field' => 'email'],
    ['field' => 'email', 'value' => 'not-an-email', 'error_field' => 'email'],
    ['field' => 'email', 'value' => str_repeat('a', 250) . '@example.com', 'error_field' => 'email'],
    // Unique email test requires an existing user with that email
    ['field' => 'emergency_contact', 'value' => '', 'error_field' => 'emergency_contact'],
    ['field' => 'emergency_contact', 'value' => str_repeat('a', 26), 'error_field' => 'emergency_contact'],
    ['field' => 'emergency_phone', 'value' => '', 'error_field' => 'emergency_phone'],
    ['field' => 'emergency_phone', 'value' => 'invalid-phone', 'error_field' => 'emergency_phone'],
    ['field' => 'dob', 'value' => '', 'error_field' => 'dob'],
    ['field' => 'dob', 'value' => now()->subYears(5)->format('Y-m-d'), 'error_field' => 'dob'], // Too young
    // medical_history max:200 is 'sometimes' so not a required error, but max can be tested
    ['field' => 'medical_history', 'value' => str_repeat('a', 201), 'error_field' => 'medical_history'],
]);

it('validates patient creation input', function (string $field, $value, string $error_field) {
    $adminUser = User::factory()->create();
    $adminUser->assignRole('Admin');

    $location = Location::factory()->create(); // Needed for base data
    $invalidData = getValidPatientData($location);
    $invalidData[$field] = $value;
    // Ensure the email is unique if not testing email itself, to avoid unique rule interference
    if ($field !== 'email') {
        $invalidData['email'] = "validation.test.{$field}@example.com";
    }


    $response = actingAs($adminUser)
        ->post(route('admin.patient.store'), $invalidData);

    $response->assertSessionHasErrors($error_field);

    // Assert no user or user_detail was created
    // For email, if it's invalid format, user won't be created. If it's a unique constraint violation, that's different.
    // The current check is fine as we are mostly testing presence and format.
    if ($field === 'email' && $value !== '' && $value !== 'not-an-email' && !str_starts_with($value, str_repeat('a', 250))) {
        // This case is for unique email, so a user might exist if we are not careful with test data.
        // However, our CreatePatientRequest checks unique before trying to create.
        // For this test suite, we assume the check is about the incoming data validity, not db collision for now.
    } else {
         assertDatabaseMissing('users', ['first_name' => $invalidData['first_name'], 'last_name' => $invalidData['last_name']]);
    }
     // A more robust check would be to count users before and after, or ensure no user with the attempted email/details exists.
     // For now, checking against one of the invalid data fields (if it's not the one being tested for emptiness)
     if (!empty($invalidData['email']) && $field !== 'email') {
        assertDatabaseMissing('users', ['email' => $invalidData['email']]);
     }


})->with('validation_rules');

it('validates unique email for patient creation', function () {
    $adminUser = User::factory()->create();
    $adminUser->assignRole('Admin');

    $existingUser = User::factory()->create(['email' => 'exists@example.com']);
    $location = Location::factory()->create();

    $invalidData = getValidPatientData($location);
    $invalidData['email'] = $existingUser->email; // Use existing email

    $response = actingAs($adminUser)
        ->post(route('admin.patient.store'), $invalidData);

    $response->assertSessionHasErrors('email');
    assertDatabaseMissing('users', ['first_name' => $invalidData['first_name']]);
});

?>
