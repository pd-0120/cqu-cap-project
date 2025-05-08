<form action='{{ route('caretaker.tests.duplicate-test', $data->id) }}' method='POST'>
    @csrf
    <button class='btn m-2 btn-light-success  btn-icon btn-sm' type='submit' data-label="Duplicate Test"><i class="far fa-copy"></i></button>
</form>

<form action='{{ route('caretaker.tests.sendTestReminder', $data->id) }}' method='POST'>
    @csrf
    <button class='btn m-2 btn-light-primary  btn-icon btn-sm' type='submit' data-label="Send Reminder"><i class="fas fa-bell"></i></button>
</form>

<form action='{{ route('caretaker.tests.deleteAssignTest', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">
    @csrf
    <button class='btn m-2 btn-light-danger btn-icon btn-sm' type='submit'><i class="fas fa-trash"></i></button>
</form>
