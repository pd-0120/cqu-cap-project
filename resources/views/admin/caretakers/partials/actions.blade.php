<div class="d-flex">
    @if(!$data->is_approved)
        <form action="{{ route('admin.caretakers.approve', $data->id) }}" method="POST" style="display:inline;">

            @csrf
            <button class="btn btn-success btn-sm mr-2" type="submit">Approve</button>
        </form>
    @endif

    <form action="{{ route('admin.caretakers.reject', $data->id) }}" method="POST" style="display:inline;">

        @csrf
        <button class="btn btn-danger btn-sm" type="submit">Reject</button>
    </form>
</div>
