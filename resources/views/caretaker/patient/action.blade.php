<form action='{{ route('caretaker.patient.destroy', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">

    <a href='{{ route("caretaker.tests.assignTest", $data->id) }}' class='btn m-2 btn-icon btn-sm btn-light-warning'  data-toggle="tooltip" data-placement="right" title="Assing Test to Patient">
        <i class="fas fa-user-tag"></i>
    </a>
    <a href='{{ route("caretaker.patient.edit", $data->id) }}' class='btn m-2 btn-icon btn-sm btn-light-primary'  data-toggle="tooltip" data-placement="right" title="Edit patient details">
        <i class="fas fa-pen"></i>
    </a>
    @csrf
    <button class='btn m-2 btn-icon btn-sm btn-light-danger' type='submit' data-toggle="tooltip" data-placement="right" title="Remove patient"><i class="fas fa-user-times"></i></button>
</form>
