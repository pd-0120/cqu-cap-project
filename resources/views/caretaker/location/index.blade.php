@section('pageTitle', "All Locations")
@section('pageActionData')
    <a href="{{ route('caretaker.location.create') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Add New Location</a>

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
                                        <th scope="col">Care House Name</th>
                                        <th scope="col">Street</th>
                                        <th scope="col">Suburb</th>
                                        <th scope="col">State</th>
                                        <th scope="col">Pincode</th>
                                        <th scope="col">Phone</th>
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
                        url: "{{ route('caretaker.location.index') }}",
                        type: 'GET',
                    },
                    columns: [
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'street' },
                        { data: 'suburb'},
                        { data: 'state' },
                        { data: 'pincode' },
                        { data: 'phone' },
                        { data: 'actions', "orderable": false,  "searchable" :  false},
                    ],
                });
            });
        </script>
    @endpush
</x-auth-layout>