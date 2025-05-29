@section('pageTitle', "All Activities")
@section('pageActionData')
@endsection

<x-auth-layout>
	@session('message.level')
	<x-alert-component />
	@endsession
	<div class="row">
		<div class="col-md-12">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body pt-7">
					<div class="row">
						<div class="col-md-12">
							<table class="table" id="datatable">
								<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Created At</th>

									<th scope="col">Description</th>
									<th scope="col">Subject</th>
									<th scope="col">Causer</th>
									<th scope="col">Properties</th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@push('UserJS')
		<script>
			$(document).ready(function () {
				var table = $('#datatable');
				table.DataTable({
					responsive: true,
					searchDelay: 500,
					processing: true,
					serverSide: true,
					ajax: {
						url: "{{ route('admin.activity-log') }}",
						type: 'GET',
					},
					columns: [
						{ data: 'id' },
						{ data: 'created_at' },
						{ data: 'description' },
						{ data: 'subject_type' },
						{ data: 'causer_id' },
						{ data: 'properties' },
					],
				});
			});
		</script>
	@endpush
</x-auth-layout>
