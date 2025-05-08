<div>
    @if($testStatus == "aborted")
    <div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-danger">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                <div class="d-flex flex-column mr-5">
                    <a href="#" class="h4 text-dark text-hover-danger mb-5">
                        Oh no ! You have aborted the test.
                    </a>
                    <p class="text-dark-50">It looks like you exited the quiz before completion. Your progress has not been saved, and this attempt
                        will be marked as incomplete.</p>
                    <div class="border-bottom border-white opacity-20 mb-5"></div>
                    <p class="text-dark-50 mb-0">If this was unintentional, please contact support or try restarting the exam when ready.</p>
                </div>
                <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                    <a href="{{ route('patient.tests.takeTest', ['test' => $test->id]) }}" class="btn font-weight-bolder text-uppercase btn-danger py-4 px-6">
                        Take a test Again
                    </a>
                </div>
            </div>
        </div>
    </div>
    @elseif($testStatus == "completed")
        <div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-success">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                    <div class="d-flex flex-column mr-5">
                        <a href="#" class="h4 text-dark text-hover-primary mb-5">
                            Congratulations! Test Completed Successfully
                        </a>
                        <p class="text-dark-50">
                            You have successfully completed the exam. Your responses have been submitted and recorded for evaluation.
                        </p>
                        <div class="border-bottom border-white opacity-20 mb-5"></div>
                        <p class="text-dark-50">
                            You can now review your results or return to the dashboard for more activities. Well done on finishing the exam!
                        </p>
                    </div>
                    <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                        <a href="{{ route('patient.tests.get-result', ['test' => $test->id]) }}" class="btn font-weight-bolder text-uppercase btn-success py-4 px-6">
                            View Result
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
