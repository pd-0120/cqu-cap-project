
@section('pageTitle', "All Caretakers")

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
                                        <th>Test Name</th>
                                        <th>Desc</th>
                                        <th>CogniFit Test xName</th>
                                        <th>Test Type</th>
                                        <th>Created By</th>
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
            $('#datatableCaretakers').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.test.index') }}",
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'description' },
                    { data: 'test_title', orderable: false, searchable: false },
                    { data: 'test_type', orderable: false, searchable: false },
                    { data: 'created_by', orderable: false, searchable: false },
                    { data: 'created_at', orderable: false, searchable: false },
                ],
                language: {
                    emptyTable: "No caretakers found."
                }
            });
        });
    </script>
    @endpush
</x-auth-layout>
