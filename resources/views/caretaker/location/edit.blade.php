@section('pageTitle', "Update $location->name")
@section('pageActionData')
    <a href="{{ route('caretaker.location.index') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">location List</a>

@endsection
<x-auth-layout>
    @session('message.level')
        <x-alert-component />
    @endsession
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <form action="{{ route('caretaker.location.update', $location->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <div class="card-body pt-7">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="">
                                    Care House Name:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Care House Name" name="name" value="{{ $location->name }}" />
                                <x-form-error-component :label='"name"' />
                            </div>
                            <div class="col-md-4">
                                <label for="">
                                    Care House Phone:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Care House Phone" name="phone" value="{{ $location->phone }}" />
                                <x-form-error-component :label='"phone"' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 form-group">
                                <label for="">
                                    Street:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Street" name="street"
                                    value="{{ $location->street }}" />
                                <x-form-error-component :label='"street"' />

                            </div>
                            <div class="col-md-3 col-sm-6 form-group">
                                <label for="">
                                    Suburb:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Suburb" name="suburb"
                                    value="{{ $location->suburb }}" />
                                <x-form-error-component :label='"suburb"' />
                            </div>
                            <div class="col-md-3 col-sm-6 form-group">
                                <label for="">
                                    State:
                                </label>
								<select  class="form-control" placeholder="Enter State" name="state" >
									<option value="">Select</option>
									@foreach($australianStates as $australianState)
										<option value="{{ $australianState  }}" @selected( $location->state == $australianState)>{{ $australianState  }}</option>
									@endforeach
								</select>
                                <x-form-error-component :label='"state"' />
                            </div>
                            <div class="col-md-3 col-sm-6 form-group">
                                <label for="">
                                    Pincode:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Pincode" name="pincode" value="{{ $location->pincode }}" />
                                <x-form-error-component :label='"pincode"' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('UserJS')
    @endpush
</x-auth-layout>
