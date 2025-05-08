<form action='{{ route('caretaker.tests.destroy', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">

    <a href='{{ route("caretaker.tests.edit", $data->id) }}' class='btn m-2 btn-light-primary  btn-icon btn-sm' data-toggle="tooltip" data-placement="right" title="Update test details">
        <i class="far fa-edit"></i>
    </a>
    @csrf
    <button class='btn m-2 btn-light-danger btn-icon btn-sm' type='submit'><i class="fas fa-trash"></i></button>
</form>
