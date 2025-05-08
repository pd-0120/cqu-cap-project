<form action='{{ route('caretaker.tests.duplicate-test', $data->id) }}' method='POST'>
    @csrf
    <button class='btn m-2 btn-light-success  btn-icon btn-sm' type='submit' data-label="Duplicate Test"><i class="far fa-copy"></i></button>
</form>
@if($data->status !== \App\Enum\PatientTestStatus::COMPLETED->name)
<form action='{{ route('caretaker.tests.sendTestReminder', $data->id) }}' method='POST'>
    @csrf
    <button class='btn m-2 btn-light-primary  btn-icon btn-sm' type='submit' data-label="Send Reminder"><i class="fas fa-bell"></i></button>
</form>
@else
    <a class='btn m-2 btn-light-warning  btn-icon btn-sm' href="{{ route('caretaker.tests.get-result',  $data->id) }}" data-label="View Result"><i class="fas fa-eye"></i></a>
@endif
<form action='{{ route('caretaker.tests.deleteAssignTest', $data->id) }}' method='POST'>
    <input type="hidden" name="_method" value="DELETE">
    @csrf
    <button class='btn m-2 btn-light-danger btn-icon btn-sm' type='submit'><i class="fas fa-trash"></i></button>
</form>
