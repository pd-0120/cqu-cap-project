<div class="card">
    <div class="card-body">
        @if($testStatus == "aborted")
            <div class="alert alert-danger mb-5 p-5" role="alert">
                <h4 class="alert-heading">Exam Aborted!</h4>
                <p>It looks like you exited the quiz before completion. Your progress has not been saved, and this attempt
                    will be marked as incomplete.</p>
                <div class="border-bottom border-white opacity-20 mb-5"></div>
                <p class="mb-0">If this was unintentional, please contact support or try restarting the exam when ready.</p>
            </div>
        @elseif($testStatus == "completed")
            <div class="alert alert-success mb-5 p-5" role="alert">
                <h4 class="alert-heading">Congratulations!</h4>
                <p>You have successfully completed the exam. Your responses have been submitted and recorded for evaluation.
                </p>
                <div class="border-bottom border-white opacity-20 mb-5"></div>
                <p class="mb-0">You can now review your results or return to the dashboard for more activities. Well done on finishing the exam!</p>
                <a href="{{ route('patient.tests.get-result', ['test' => $test->id]) }}" class="btn btn-primary">View Results</a>
            </div>
        @endif
    </div>
</div>