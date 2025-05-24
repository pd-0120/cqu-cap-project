
@section('pageTitle', "All Assigned Tests")

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
                                        <th>Test</th>
                                        <th>Patient Name</th>
                                        <th>CareTaker</th>
                                        <th>Assign Date</th>
                                        <th>Due Date</th>
                                        <th>Taken Date</th>
                                        <th>Status</th>
                                        <th>Score</th>
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
                ajax: "{{ route('admin.test.assignTests') }}",
                columns: [
                    { data: 'id' },
                    { data: 'test_id' },
                    { data: 'patient_id' },
                    { data: 'assigned_by' },
                    { data: 'assign_for_date', orderable: false, searchable: false },
                    { data: 'due_date', orderable: false, searchable: false },
                    { data: 'taken_date', orderable: false, searchable: false },
                    { data: 'status', orderable: false, searchable: false },
                    { data: 'score', orderable: false, searchable: false },
                ],
                language: {
                    emptyTable: "No caretakers found."
                }
            });
        });
    </script>
    @endpush
</x-auth-layout>
