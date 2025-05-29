<form action='{{ route('admin.patient.destroy', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">
	<a href='{{ route("admin.patient.assign-caretaker", $data->id) }}' class='btn m-2 btn-icon btn-sm btn-light-success'  data-toggle="tooltip" data-placement="right" title="Assign CaraTaker">
		<i class="fas fa-user-md"></i>
	</a>
    <a href='{{ route("admin.test.assignTests", $data->id) }}' class='btn m-2 btn-icon btn-sm btn-light-warning'  data-toggle="tooltip" data-placement="right" title="View Assign Tests">
		<i class="fas fa-poll-h"></i>
	</a>
	<a href='{{ route("admin.patient.edit", $data->id) }}' class='btn m-2 btn-icon btn-sm btn-light-primary'  data-toggle="tooltip" data-placement="right" title="Edit patient details">
        <i class="fas fa-pen"></i>
    </a>
    @csrf
    <button class='btn m-2 btn-icon btn-sm btn-light-danger' type='submit' data-toggle="tooltip" data-placement="right" title="Remove patient"><i class="fas fa-user-times"></i></button>
</form>
