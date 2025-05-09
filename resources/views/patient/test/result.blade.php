@section('pageTitle', "Result for the test")
@section('pageActionData')
@endsection

<x-auth-layout>
	@session('message.level')
	<x-alert-component/>
	@endsession


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
