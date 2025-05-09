@section('pageTitle', "Result for the test")
@section('pageActionData')
@endsection

<x-auth-layout>
	@session('message.level')
	<x-alert-component/>
	@endsession
	@php
	$textColour = $patientTestResult->score >= 600 ? "text-success" : (($patientTestResult->score >= 300) ? "text-primary" : "text-danger");
	@endphp
	<div class="row m-5">
		<div class="col-md-12">
			<div class="card card-custom gutter-b bg-diagonal">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
						<div class="d-flex flex-column mr-5">
							<a href="javascript:void(0)" class="h4 {{  $textColour }}  mb-5">
								Current Test Score: {{ $patientTestResult->score  }}/800
							</a>
							<p class="text-dark-50">
								Your current Cognitive Age: <b>{{ $patientTestResult['cognitive_age']  }}</b>
							</p>
						</div>
						<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
							<a href="{{ route('patient.tests.index')  }}" target="" class="btn font-weight-bolder text-uppercase btn-light-success py-4 px-6">
								View all tests
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		@if($responseData->has('skills'))
		<div class="row m-5">
			<div class="col-md-12">
				<div class="card card-custom wave wave-animate-slower mb-8 mb-lg-0">
					<div class="card-body">
						<a href="javascript:void(0)" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
							Skills Demonstration Chart
						</a>
						<div class="text-dark-75">
							<x-test-result-skill-chart-component :responseData="$responseData"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		@if($responseData->has('categories'))
		<div class="row m-5">
			<div class="col-md-12">
				<div class="card card-custom wave wave-animate-slower mb-8 mb-lg-0">
					<div class="card-body">
						<a href="javascript:void(0)" class="text-dark text-hover-success font-weight-bold font-size-h4 mb-3">
							Category Demonstration Chart
						</a>
						<div class="text-dark-75">
							<x-test-result-category-chart-component :responseData="$responseData"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
</x-auth-layout>
