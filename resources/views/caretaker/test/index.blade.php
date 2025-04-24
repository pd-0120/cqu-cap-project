@section('pageTitle', "All Tests")
@section('pageActionData')
    <a href="{{ route('caretaker.tests.create') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Add New Test</a>

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
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Assessment</th>
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
                        url: "{{ route('caretaker.tests.index') }}",
                        type: 'GET',
                    },
                    columns: [
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'description' },
                        { data: 'test_type' },
                        { data: 'assessment_list_id'},
                        { data: 'actions', "orderable": false,  "searchable" :  false},
                    ],
                });
            });
        </script>
    @endpush
</x-auth-layout>