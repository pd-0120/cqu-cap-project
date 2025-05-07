<form action='{{ route('caretaker.tests.sendTestReminder', $data->id) }}' method='POST'>
    @csrf
    <button class='btn m-2 btn-success' type='submit' data-label="Send Reminder"><i class="fas fa-bell"></i></button>
</form>

<form action='{{ route('caretaker.tests.deleteAssignTest', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">
    @csrf
    <button class='btn m-2 btn-danger' type='submit'><i class='flaticon2-trash'></i></button>
</form>
