<form action='{{ route('caretaker.tests.destroy', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">

    <a href='{{ route("caretaker.tests.edit", $data->id) }}' class='btn m-2 btn-primary'>
        <i class='flaticon2-pen'></i>
    </a>
    @csrf
    <button class='btn m-2 btn-danger' type='submit'><i class='flaticon2-trash'></i></button>
</form>