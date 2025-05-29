<form action="{{ route('admin.caretaker.destroy', $data->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <a href="{{ route('admin.caretaker.edit', $data->id) }}"
       class="btn m-2 btn-icon btn-sm btn-light-primary"
       title="Edit Caretaker">
        <i class="far fa-edit"></i>
    </a>

    <button type="submit"
            class="btn m-2 btn-icon btn-sm btn-light-danger"
            title="Delete Caretaker"
            onclick="return confirm('Are you sure you want to delete this caretaker?')">
        <i class="fas fa-trash"></i>
    </button>
</form>
