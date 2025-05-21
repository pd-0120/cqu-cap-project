<form action='{{ route('admin.location.destroy', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">

    <a href='{{ route("admin.location.edit", $data->id) }}' class='btn m-2 btn-icon btn-sm btn-light-primary' data-toggle="tooltip" data-placement="right" title="Edit location detains">
        <i class="far fa-edit"></i>
    </a>
    @csrf
    <button class='btn m-2 btn-icon btn-sm btn-light-danger' type='submit' data-toggle="tooltip" data-placement="right" title="Remove location"><i class="fas fa-trash"></i></i></button>
</form>
