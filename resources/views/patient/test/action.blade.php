@if(empty($data->taken_date))
    <a href='{{ route("patient.tests.takeTest", $data->id) }}' class='btn m-2 btn-icon btn-sm btn-light-primary' data-toggle="tooltip" data-placement="right" title="Take a Test"><i class="far fa-edit"></i>
@else
        <a href='{{ route("patient.tests.get-result", $data->id) }}' class='btn m-2 btn-light-warning btn-icon btn-sm' data-toggle="tooltip" data-placement="right" title="View Result"><i class="fas fa-eye"></i>
@endif
