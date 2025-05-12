<div>
	<div class="row">
		<div class="col-md-12 p-5">
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-success">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
								<div class="d-flex flex-column mr-5">
									<a href="{{ route('caretaker.tests.index') }}" class="h4 text-dark text-hover-success mb-5">
										Total Tests Assigned
									</a>
									<p class="text-dark-50 text-dark h5">
										<b>{{ $totalTests }}</b>
									</p>
								</div>
								<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
									<a href="{{ route('patient.tests.index') }}" class="btn font-weight-bolder text-uppercase btn-success py-4 px-6">
										Take Me There
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12">
					<div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-primary">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
								<div class="d-flex flex-column mr-5">
									<a href="{{ route('patient.tests.index', ['status' => \App\Enum\PatientTestStatus::PENDING->name]) }}" class="h4 text-dark text-hover-primary mb-5">
										Total Pending Tests
									</a>
									<p class="text-dark-50 text-dark h5">
										<b>{{ $totalPendingTests }}</b>
									</p>
								</div>
								<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
									<a href="{{ route('patient.tests.index', ['status' => \App\Enum\PatientTestStatus::PENDING->name]) }}" class="btn font-weight-bolder text-uppercase btn-primary py-4 px-6">
										Take Me There
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12">
					<div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-warning">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
								<div class="d-flex flex-column mr-5">
									<a href="{{ route('patient.tests.index', ['status' => \App\Enum\PatientTestStatus::COMPLETED->name]) }}" class="h4 text-dark text-hover-warning mb-5">
										Total Completed Tests
									</a>
									<p class="text-dark-50 text-dark h5">
										<b>{{ $totalCompletedTests }}</b>
									</p>
								</div>
								<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
									<a href="{{ route('patient.tests.index', ['status' => \App\Enum\PatientTestStatus::COMPLETED->name]) }}" class="btn font-weight-bolder text-uppercase btn-warning py-4 px-6">
										Take Me There
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12">
					<div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-danger">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
								<div class="d-flex flex-column mr-5">
									<a href="{{ route('patient.tests.index', ['status' => \App\Enum\PatientTestStatus::STARTED->name]) }}" class="h4 text-dark text-hover-danger mb-5">
										Total Started Tests
									</a>
									<p class="text-dark-50 text-dark h5">
										<b>{{ $totalStartedTests }}</b>
									</p>
								</div>
								<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
									<a href="{{ route('patient.tests.index', ['status' => \App\Enum\PatientTestStatus::STARTED->name]) }}"  class="btn font-weight-bolder text-uppercase btn-danger py-4 px-6">
										Take Me There
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
