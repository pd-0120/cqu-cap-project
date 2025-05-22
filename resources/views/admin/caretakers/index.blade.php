@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Caretaker Approval Panel</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Is Approved</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($caretakers as $caretaker)
                <tr>
                    <td>{{ $caretaker->id }}</td>
                    <td>{{ $caretaker->first_name }} {{ $caretaker->last_name }}</td>
                    <td>{{ $caretaker->email }}</td>
                    <td>{{ $caretaker->is_approved ? 'Yes' : 'No' }}</td>
                    <td>
                        @if(!$caretaker->is_approved)
    <form action="{{ route('admin.caretakers.approve', $caretaker->id) }}" method="POST">
        @csrf
        <button type="submit">Approve</button>
    </form>
@else
    <form action="{{ route('admin.caretakers.decline', $caretaker->id) }}" method="POST">
        @csrf
        <button type="submit">Reject</button>
    </form>
@endif

                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No caretakers found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
