<form action='{{ route('caretaker.location.destroy', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">

    <a href='{{ route("caretaker.location.edit", $data->id) }}' class='btn m-2 btn-primary' data-toggle="tooltip" data-placement="right" title="Edit location detains">
        <i class='flaticon2-pen'></i>
    </a>
    @csrf
    <button class='btn m-2 btn-danger' type='submit' data-toggle="tooltip" data-placement="right" title="Remove location"><i class='flaticon2-trash'></i></button>
</form>