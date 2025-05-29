
@section('pageTitle', "All Caretakers")

{{-- @section('pageActionData')
    <a href="{{ route('admin.caretakers.create') }}" class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">
        Add New Caretaker
    </a>
@endsection --}}

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
                            <table class="table table-bordered" id="datatableCaretakers" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody> {{-- empty, DataTables will fill --}}
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
            $('#datatableCaretakers').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.caretakers.index') }}",
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'status', orderable: false, searchable: false },
                    { data: 'phone', orderable: false, searchable: false },
                    { data: 'actions', orderable: false, searchable: false },
                ],
                language: {
                    emptyTable: "No caretakers found."
                }
            });
        });
    </script>
    @endpush
</x-auth-layout>
