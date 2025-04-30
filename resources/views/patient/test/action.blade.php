@if(empty($data->taken_date))
<a href='{{ route("patient.tests.takeTest", $data->id) }}' class='btn m-2 btn-primary' data-toggle="tooltip" data-placement="right" title="Take a Test"><i class='flaticon2-pen'></i>
@endif