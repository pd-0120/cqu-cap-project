@component('mail::message')
# Hello {{ $patient->full_name }}

This is the reminder to take your <b>{{ $test->name }}</b>  test, it has the due date of {{ $patientTest->due_date }}

@component('mail::button', ['url' => route('patient.tests.takeTest', $test->id)])
Click Here to take test
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
