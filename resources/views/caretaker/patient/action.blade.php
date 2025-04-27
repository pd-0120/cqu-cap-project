<form action='{{ route('caretaker.patient.destroy', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">

    <a href='{{ route("caretaker.tests.assignTest", $data->id) }}' class='btn m-2 btn-warning'  data-toggle="tooltip" data-placement="right" title="Assing Test to Patient">
        <i class='flaticon-attachment'></i>
    </a>
    <a href='{{ route("caretaker.patient.edit", $data->id) }}' class='btn m-2 btn-primary'  data-toggle="tooltip" data-placement="right" title="Edit patient details">
        <i class='flaticon2-pen'></i>
    </a>
    @csrf
    <button class='btn m-2 btn-danger' type='submit'><i class='flaticon2-trash'  data-toggle="tooltip" data-placement="right" title="Remove patient"></i></button>
</form>