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
										Total Tests Created
									</a>
									<p class="text-dark-50 text-dark h5">
										<b>{{ $totalTests }}</b>
									</p>
								</div>
								<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
									<a href="{{ route('caretaker.tests.index') }}" class="btn font-weight-bolder text-uppercase btn-success py-4 px-6">
										Take Me There !
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
									<a href="{{ route('caretaker.location.index') }}" class="h4 text-dark text-hover-primary mb-5">
										Total House Assigned
									</a>
									<p class="text-dark-50 text-dark h5">
										<b>{{ $totalLocations }}</b>
									</p>
								</div>
								<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
									<a href="{{ route('caretaker.location.index') }}" class="btn font-weight-bolder text-uppercase btn-primary py-4 px-6">
										Take Me There !
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
									<a href="{{ route('caretaker.patient.index') }}" class="h4 text-dark text-hover-warning mb-5">
										Total Allocated Patients
									</a>
									<p class="text-dark-50 text-dark h5">
										<b>{{ $totalAssignedPatients }}</b>
									</p>
								</div>
								<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
									<a href="{{ route('caretaker.patient.index') }}" target="_blank" class="btn font-weight-bolder text-uppercase btn-warning py-4 px-6">
										Take Me There !
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
									<a href="{{ route('caretaker.tests.assignTestIndex') }}" class="h4 text-dark text-hover-danger mb-5">
										Total Allocated Tests
									</a>
									<p class="text-dark-50 text-dark h5">
										<b>{{ $totalAssignedTests }}</b>
									</p>
								</div>
								<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
									<a href="{{ route('caretaker.tests.assignTestIndex') }}" target="_blank" class="btn font-weight-bolder text-uppercase btn-danger py-4 px-6">
										Take Me There !
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 col-sm-12">
					<div class="card card-custom gutter-b">
						<div class="card-header">
							<div class="card-title">
								<h3 class="card-label">
									Number of patients who took exam daily
								</h3>
							</div>
						</div>
						<div class="card-body">
							<x-patient-taken-test-count-chart/>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
