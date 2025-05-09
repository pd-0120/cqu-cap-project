@section('pageTitle', "Result for the test")
@section('pageActionData')
@endsection

<x-auth-layout>
	@session('message.level')
	<x-alert-component/>
	@endsession

	<div class="row">
		@if($responseData->has('skills'))
		<div class="col-md-6">
			<div class="card card-custom wave wave-animate-slower mb-8 mb-lg-0">
				<div class="card-body">
					<div class="d-flex align-items-center p-5">
						<div class="mr-6">
							<span class="svg-icon svg-icon-success svg-icon-4x">
								 <i class="far fa-chart-bar fa-4x" style="color: #3699FF"></i>
							</span>
						</div>
						<div class="d-flex flex-column">
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

		</div>
		@endif
		@if($responseData->has('categories'))
		<div class="col-md-6">
			<div class="card card-custom wave wave-animate-slower mb-8 mb-lg-0">
				<div class="card-body">
					<div class="d-flex align-items-center p-5">
						<div class="mr-6">
					<span class="svg-icon svg-icon-success svg-icon-4x">
						 <i class="fas fa-brain  fa-4x" style="color: #1BC5BD"></i>
					</span>
						</div>
						<div class="d-flex flex-column">
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

		</div>
		@endif
	</div>
</x-auth-layout>
