<h2>Pending Caretakers</h2>

@if($caretakers->isEmpty())
    <p>No pending caretakers at the moment.</p>
@else
    @foreach($caretakers as $user)
        <div style="margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
            <strong>{{ $user->first_name }} {{ $user->last_name }}</strong> ({{ $user->email }})

            <form method="POST" action="{{ route('admin.approveCaretaker', $user->id) }}" style="display:inline;">
                @csrf
                <button type="submit" onclick="return confirm('Are you sure you want to approve this caretaker?')">Approve</button>
            </form>

            <form method="POST" action="{{ route('admin.declineCaretaker', $user->id) }}" style="display:inline; margin-left: 10px;">
                @csrf
                <button type="submit" onclick="return confirm('Are you sure you want to decline this caretaker?')">Decline</button>
            </form>
        </div>
    @endforeach
@endif
