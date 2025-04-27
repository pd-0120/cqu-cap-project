<form action='{{ route('caretaker.tests.deleteAssignTest', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">
    @csrf
    <button class='btn m-2 btn-danger' type='submit'><i class='flaticon2-trash'></i></button>
</form>