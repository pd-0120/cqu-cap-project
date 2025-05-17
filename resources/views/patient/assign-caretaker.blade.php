@section('pageTitle', "Assign Caretaker to $patient->full_name")
<x-auth-layout>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-custom card-stretch gutter-b">
				<form action="{{ route('admin.patient.store-assign-caretaker', $patient) }}" method="POST">
					@csrf
					<div class="card-body pt-7">
						<div class="row">
							<div class="col-md-6">
								<label for="caretaker">
									Care Taker:
								</label>
								<select name="caretaker_id" id="" class="form-control" required>
									<option value="">Select
									@forelse($caretakers as $caretaker)
										<option value="{{ $caretaker->id  }}" @selected($patient->caretaker_id == $caretaker->id)>{{ $caretaker->full_name }}</option>
									@empty
									@endforelse
								</select>
								<x-form-error-component :label='"caretaker_id"' />
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<button class="btn btn-primary" type="submit">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	@push('UserJS')
	@endpush
</x-auth-layout>
