<?php

namespace Database\Seeders;

use App\Enum\PatientTestStatus;
use App\Enum\UserRolesEnum;
use App\Enum\UserStatusEnum;
use App\Models\CognifitCognitiveAssessmentList;
use App\Models\Location;
use App\Models\PatientTest;
use App\Models\Test;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class FakeDataSeeder extends Seeder
{
    public function run(): void
    {
		$this->storeCareTakers();
		$this->storeLocations();
		$this->storePatients();
		$this->storeTests();
		$this->storePatientTests();
		$this->storePatientTestResults();
    }

	private  function storeCareTakers() {
		$faker = Faker::create();
		$password = "FakeUser@321";
		$hashPassword = Hash::make($password);
		$encryptedPassword = Crypt::encrypt($password);

		// Cache role ID to avoid querying in the loop
		$roleId = Role::where('name', UserRolesEnum::CARETAKER->value)->value('id');

		$users = [];
		$userDetails = [];
		$now = now();

		for ($i = 0; $i < 50; $i++) {
			$firstName = $faker->firstName;
			$lastName = $faker->lastName;
			$email = $faker->unique()->safeEmail;

			$users[] = [
				'first_name' => $firstName,
				'last_name' => $lastName,
				'email' => $email,
				'password' => $hashPassword,
				'email_verified_at' => $now,
				'cognifit_user_token' => null,
				'secret_password' => $encryptedPassword,
				'dob' => $faker->dateTimeBetween('-40 years', '-25 years')->format('Y-m-d'),
				'created_at' => $now,
				'updated_at' => $now,
				'is_approved' => true,
			];
		}

		// Wrap in transaction for speed & safety
		DB::transaction(function () use (&$users, $faker, $roleId, $now, &$userDetails) {
			// Insert users in bulk
			DB::table('users')->insert($users);

			// Fetch the inserted users
			$insertedUsers = User::latest('id')->take(count($users))->get();

			foreach ($insertedUsers as $user) {
				// Assign role via pivot insert (no Spatie overhead)
				DB::table('model_has_roles')->insert([
					'role_id' => $roleId,
					'model_type' => User::class,
					'model_id' => $user->id,
				]);

				// 📦 Prepare UserDetail
				$userDetails[] = [
					'user_id' => $user->id,
					'street' => $faker->streetAddress,
					'suburb' => $faker->city,
					'state' => $faker->stateAbbr,
					'phone' => $faker->numerify('04########'),
					'gender' => $faker->randomElement(['Male', 'Female', 'Other']),
					'emergency_contact' => $faker->name . ' (' . $faker->randomElement(['Spouse', 'Parent', 'Sibling']) . ')',
					'emergency_phone' => $faker->numerify('04########'),
					'cognitive_score' => $faker->numberBetween(500, 800),
					'last_exercise_date' => $faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
					'status' => UserStatusEnum::ACTIVE->value,
					'created_at' => $now,
					'updated_at' => $now,
				];
			}

			// Bulk insert details
			UserDetail::insert($userDetails);
		});
	}

	private  function storeLocations() {
		$faker = Faker::create('en_AU');
		$states = config('app.states');

		for($i = 0; $i <= 1000; $i++) {
			$createdBy = $faker->numberBetween(1, 30);
			$locations[] = [
				'name' => $faker->unique()->company . ' ' . $faker->randomElement([
						'Health',
						'Care',
						'Wellness'
					]),
				'street' => $faker->streetAddress,
				'suburb' => $faker->city,
				'state' => $faker->randomElement($states),
				'pincode' => $faker->numberBetween(2000, 9999), // Valid Australian postcode range
				'phone' => $faker->numerify('04########'),
				'created_by' => $createdBy,
				'updated_by' => $createdBy,
			];
		}
		Location::insert($locations);
	}

	/**
	 * @throws \Throwable
	 */
	private  function storePatients(): void
	{
		$descriptions = [
			"Patient occasionally forgets everyday items like keys or recent chats, but it doesn't disrupt their routine. Memory test score: 24/30 (normal range starts at 26).",
			"Struggles to concentrate on tasks longer than TV commercials. Reports 'cloudy thinking' in late afternoons, linked to inconsistent sleep schedule.",
			"Temporary 'zoning out' during stressful moments - once forgot 15 minutes of a meeting. Brain scans show no physical causes.",
			"Thinking speed slowing slightly with age - takes longer to recall names. Family notices they repeat stories more often now.",
			"COVID recovery left lingering 'brain fog' - mixes up appointments and stumbles over words when tired, 6 months after infection.",
			"Trouble finding right words in detailed discussions - vocabulary tests show 15% drop from last year's results.",
			"Gets confused in familiar places like local grocery store aisles. Brain scans didn't explain it - referred for memory tests.",
			"Makes uncharacteristic money decisions - forgot to pay bills, struggles planning tasks like meal prep. Clock-drawing test showed organization difficulties.",
			"Chemotherapy caused 'chemo brain' - forgets why they entered rooms. Now uses phone reminders for medications and appointments.",
			"Brief confusion spells (under 2 hours) where they can't recall dates. Brain wave tests normal - checking blood flow issues.",
			"Feels memory isn't sharp anymore, though standard tests look okay. Doctor suggests yearly check-ins to track changes.",
			"Difficulty learning new phone apps at job - struggles switching between tasks compared to coworkers same age.",
			"Head injury left lasting effects - can't remember new phone numbers like before. Memory tests show 30% reduction.",
			"Gets stuck repeating same approach to problems - needed 5 tries to fix microwave clock after power outage.",
			"Untreated sleep apnea caused daytime drowsiness. CPAP machine helped alertness but not forgetfulness about where they parked.",
			"Cholesterol medication caused fuzzy thinking - improved after switch to different drug, but still some afternoon fog.",
			"Knows what a toaster does but often blanks on the word 'toaster' - describes it as 'bread heater thingy'.",
			"Stress made memory worse temporarily - improved after therapy and relaxation techniques. Not true dementia.",
			"Developing trouble recognizing faces - mistook neighbor for brother last month. Brain structure appears normal.",
			"After stroke, tires quickly during puzzles or long conversations. Speech therapy helped find words faster over 6 weeks."
		];
		$password = "FakeUser@321";
		$hashPassword = Hash::make($password);
		$encryptedPassword = Crypt::encrypt($password);
		$faker = Faker::create('en_AU');

		$roleId = DB::table('roles')->where('name', UserRolesEnum::PATIENT->value)->value('id');
		$now = Carbon::now();

		$users = [];
		$userDetails = [];
		$userRolePivots = [];
		$lastUser = User::select('id')->orderByDesc('id')->first();

		DB::transaction(function () use (
			$faker, $hashPassword, $encryptedPassword, $roleId, $now,$lastUser,
			$descriptions, &$users, &$userDetails, &$userRolePivots
		) {
			for ($i = 1; $i < 500; $i++) {
				$email = $faker->unique()->safeEmail;
				$userId = $lastUser->id + $i; // simulate predictable IDs to use in pivot/details

				$users[] = [
					'id' => $userId, // important to specify if not auto-incrementing right away
					'first_name' => $faker->firstName,
					'last_name' => $faker->lastName,
					'email' => $email,
					'password' => $hashPassword,
					'email_verified_at' => $now,
					'cognifit_user_token' => env('COGNI_FIT_USER_TOKEN', null),
					'secret_password' => $encryptedPassword,
					'caretaker_id' =>  $faker->randomElement(
						array_diff(range(1, 30), [2])
					),
					'dob' => $faker->dateTimeBetween('-40 years', '-25 years')->format('Y-m-d'),
					'created_at' => $faker->dateTimeBetween('-12 months', 'now'),
				];

				$userDetails[] = [
					'user_id' => $userId,
					'street' => $faker->streetAddress,
					'suburb' => $faker->city,
					'state' => $faker->stateAbbr,
					'phone' => $faker->numerify('04########'),
					'gender' => $faker->randomElement(['Male', 'Female', 'Other']),
					'emergency_contact' => $faker->name . ' (' . $faker->randomElement(['Spouse', 'Parent', 'Sibling']) . ')',
					'emergency_phone' => $faker->numerify('04########'),
					'medical_history' => $faker->randomElement($descriptions),
					'cognitive_score' => $faker->numberBetween(500, 800),
					'last_exercise_date' => $faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
					'status' => UserStatusEnum::ACTIVE->value,
					'location_id' => $faker->numberBetween(50, 200),
				];

				$userRolePivots[] = [
					'role_id' => $roleId,
					'model_type' => \App\Models\User::class,
					'model_id' => $userId,
				];
			}

			// Bulk inserts
			DB::table('users')->insert($users);
			DB::table('user_details')->insert($userDetails);
			DB::table('model_has_roles')->insert($userRolePivots);
		});
	}

	/**
	 * @throws FileNotFoundException
	 */
	private  function storeTests() {
		$careTakersId = User::role(UserRolesEnum::CARETAKER->value)->pluck('id');
		$faker = Faker::create('en_AU');

		$path = public_path('assets/cognitive_tests.json');
		$json = File::get($path);
		$testNameNdescription = json_decode($json, true); // Convert to array
		$assessmentList = CognifitCognitiveAssessmentList::select('id', 'type')->get()->toArray();

		$testsArrayData = [];
		for($i=0; $i<=50 ; $i++) {
			foreach($testNameNdescription as $data) {
				$testsArrayData[] = [
					'name' => $data['name'],
					'description' => $data['description'],
					'test_type' => $assessmentList[random_int(1,110)]['type'],
					'assessment_list_id' => $assessmentList[random_int(1,110)]['id'],
					'created_by' => $careTakersId[random_int(1,count($careTakersId)-1)],
					'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
				];
			}
		}
		DB::table('tests')->insert($testsArrayData);
	}

	private  function storePatientTests() {
		$faker = Faker::create('en_AU');
		$patients = User::select('id', 'caretaker_id')
			->whereNotNull('caretaker_id')
			->role(UserRolesEnum::PATIENT->value)
			->get();

		$tests = Test::select('id', 'created_by')->get();

		$testsByCaretaker = $tests->groupBy('created_by');

		$patientTestData = [];

		for ($i = 0; $i < 1000; $i++) {
			$patient = $patients->random();
			$caretakerTests = $testsByCaretaker->get($patient->caretaker_id);

			// If no test is available for this caretaker, skip
			if (empty($caretakerTests)) {
				continue;
			}

			$selectedTest = $caretakerTests->random();
			$status = $faker->randomElement([
				PatientTestStatus::COMPLETED->value,
				PatientTestStatus::PENDING->value,
				PatientTestStatus::STARTED->value,
			]);

			// Generate dates once per iteration
			$createdAt = $faker->dateTimeBetween('-12 months', '-6 months');
			$assignDate = $faker->dateTimeBetween($createdAt, '-4 months');
			$dueDate = $faker->dateTimeBetween($assignDate, 'now');
			$takenDate = $status === PatientTestStatus::COMPLETED->value
				? $faker->dateTimeBetween('-2 months', 'now')
				: null;

			$patientTestData[] = [
				'patient_id' => $patient->id,
				'assigned_by' => $patient->caretaker_id,
				'test_id' => $selectedTest->id,
				'score' => $status === PatientTestStatus::COMPLETED->value ? rand(300, 800) : 0,
				'status' => $status,
				'assign_for_date' => $assignDate,
				'taken_date' => $takenDate,
				'due_date' => $dueDate,
				'created_at' => $createdAt,
			];
		}

		foreach (array_chunk($patientTestData, 500) as $chunk) {
			DB::table('patient_tests')->insert($chunk);
		}
	}

	/**
	 * @throws RandomException
	 */
	private  function storePatientTestResults() {
		$patientTests = PatientTest::select('id', 'test_id', 'taken_date') // select only needed columns from patient_tests
			->with(['test.assesmentTask' => function ($query) {
				$query->select('key'); // select only needed columns from tests
			}])
			->where('status', PatientTestStatus::COMPLETED->value)
			->get();

		$patientTestResults = [];

		foreach($patientTests as $patientTest) {
			$patientTestResults[] = [
				'patient_test_id' => $patientTest->id,
				'date' => $patientTest->taken_date,
				'type_key' => $patientTest->test->assessment ? $patientTest->test->assessment->key : null,
				'type' => $patientTest->test->test_type,
				'cognitive_age' => random_int(20,75),
				'cognitive_precision' => "EXACT",
				'score' => random_int(300, 800),
				'response' => json_encode([])
			];
		}

		DB::table('patient_test_results')->insert($patientTestResults);
	}
}
