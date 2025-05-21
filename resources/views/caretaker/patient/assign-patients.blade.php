@section('pageTitle', "All Assign Patients")
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
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Care Home Address</th>
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
                        url: "{{ route('caretaker.patients.assign-patients') }}",
                        type: 'GET',
                    },
                    columns: [
                        { data: 'id' },
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'user_detail.status' , "orderable": false, "searchable" :  false},
                        { data: 'email' },
                        { data: 'user_detail.phone', "orderable": false, "searchable" :  false},
                        { data: 'user_detail.street', "orderable": false,  "searchable" :  false},
                        { data: 'actions', "orderable": false,  "searchable" :  false},
                    ],
                });
            });
        </script>
    @endpush
</x-auth-layout>
