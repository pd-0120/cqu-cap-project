
@section('pageTitle', "All Admins")
@section('pageActionData')
    <a href="{{ route('superadmin.admins.create') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Add New Admin</a>

@endsection
<x-auth-layout>
    @if(session('message.level'))
        <x-alert-component />
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-body pt-7">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table " id="datatableAdmin" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Created On</th>
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
            $('#datatableAdmin').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.admins.index') }}",
                columns: [
                    { data: 'id' },
                    { data: 'first_name' },
                    { data: 'last_name' },
                    { data: 'email' },
                    { data: 'user_detail.phone', 'ordarable': false, 'searchable': false },
                    { data: 'user_detail.status', 'ordarable': false, 'searchable': false  },
                    { data: 'created_at' },
                ],
                language: {
                    emptyTable: "No caretakers found."
                }
            });
        });
    </script>
    @endpush
</x-auth-layout>
