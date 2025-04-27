@section('pageTitle', "Assinged Tests to Patients and Their status")
@section('pageActionData')
    <a href="{{ route('caretaker.tests.index') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">All Tests</a>

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
                                        <th scope="col">Patient Name</th>
                                        <th scope="col">Test Name</th>
                                        <th scope="col">Score</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Assinged Date</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Test Taken Date</th>
                                        <th scope="col">Action</th>
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
                        url: "{{ route('caretaker.tests.assignTestIndex') }}",
                        type: 'GET',
                    },
                    columns: [
                        { data: 'id' },
                        { data: 'patient_id' },
                        { data: 'test_id' },
                        { data: 'score' },
                        { data: 'status' },
                        { data: 'assign_for_date' },
                        { data: 'due_date' },
                        { data: 'taken_date' },
                        { data: 'actions', "orderable": false, "searchable": false },
                    ],
                });
            });
        </script>
    @endpush
</x-auth-layout>