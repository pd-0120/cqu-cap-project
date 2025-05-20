<div class="container">
    <h2>Admin Dashboard</h2>

    <div>
        <p><strong>Total Registered Caretakers:</strong> {{ $totalRegisteredCaretakers }}</p>
        <p><strong>Total Registered Patients:</strong> {{ $totalRegisteredPatients }}</p>
        <p><strong>Total Locations:</strong> {{ $totalLocations }}</p>
        <p><strong>Total Tests Created:</strong> {{ $totalTestCreated }}</p>
        <p><strong>Total Tests Assigned:</strong> {{ $totalTestAssinged }}</p>
        <p><strong>Total Tests Taken:</strong> {{ $totalTestTaken }}</p>
        <p><strong>Total Tests Missed:</strong> {{ $totalTestMissed }}</p>
    </div>

    <hr>

    <h3>Pending Caretaker Approvals</h3>

    @if($pendingCaretakers->isEmpty())
        <p>No caretakers pending approval.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingCaretakers as $caretaker)
                    <tr>
                        <td>{{ $caretaker->id }}</td>
                        <td>{{ $caretaker->first_name }} {{ $caretaker->last_name }}</td>
                        <td>{{ $caretaker->email }}</td>
                        <td>
                            <form style="display:inline" method="POST" action="{{ route('admin.caretakers.approve', $caretaker->id) }}">
                                @csrf
                                <button type="submit" style="background-color: green; color: white; padding: 5px 10px; border: none; cursor: pointer;">Approve</button>
                            </form>

                            <form style="display:inline" method="POST" action="{{ route('admin.caretakers.decline', $caretaker->id) }}">
                                @csrf
                                <button type="submit" style="background-color: red; color: white; padding: 5px 10px; border: none; cursor: pointer;">Decline</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
