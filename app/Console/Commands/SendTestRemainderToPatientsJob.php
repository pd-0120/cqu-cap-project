<?php

namespace App\Console\Commands;

use App\Mail\TestReminderToPatientMail;
use App\Models\PatientTest;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Boolean;

class SendTestRemainderToPatientsJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-test-remainder-to-patients-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will run daily at 5:00AM in the morning and will send the reminder to the patients about their pending tests';

    /**
     * Execute the console command.
     */
    public function handle(): bool
    {
        $today = Carbon::today()->toDateString();

        $patientTests = PatientTest::where('due_date', ">=" , $today)->whereNot('status', 'COMPLETED')->get();

        foreach($patientTests as $test ) {
            Mail::to($test->patient->email)
                ->send(new TestReminderToPatientMail($test));
        }
        return true;
    }
}
