@section('pageTitle', "Update $patient->full_name")
@section('pageActionData')
    <a href="{{ route('caretaker.patient.index') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Patient List</a>

@endsection
<x-auth-layout>
    @session('message.level')
        <x-alert-component />
    @endsession
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <form action="{{ route('caretaker.patient.update', $patient->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_patient_id" value="{{ $patient->id }}">
                    @csrf
                    <div class="card-body pt-7">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="first_name">
                                    First Name:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter first name" name="first_name"
                                    value="{{ $patient->first_name }}" />
                                <x-form-error-component :label='"first_name"' />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="last_name">
                                    Last Name:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter last name" name="last_name"
                                    value="{{ $patient->last_name }}" />
                                <x-form-error-component :label='"last_name"' />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">
                                    Phone Number:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Phone" name="phone" value="{{ $userDetail->phone }}" />
                                <x-form-error-component :label='"phone"' />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="email">
                                    Email:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Email" name="email"
                                    value="{{ $patient->email }}" />
                                <x-form-error-component :label='"email"' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="emergency_contact">Emergency Contact Name:</label>
                                <input type="text" class="form-control" id="emergency_contact" name="emergency_contact"
                                    placeholder="Enter Contact Name" value="{{ $userDetail->emergency_contact }}">
                                <x-form-error-component :label='"emergency_contact"' />

                            </div>

                            <div class="col-md-6 form-group">
                                <label for="emergency_phone">Emergency Contact Phone:</label>
                                <input type="tel" class="form-control" id="emergency_phone" name="emergency_phone"
                                    value="{{  $userDetail->emergency_phone }}" placeholder="Enter Phone Number">
                                <x-form-error-component :label='"emergency_phone"' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="Male" @selected($userDetail->gender == "Male")>Male</option>
                                    <option value="Female" @selected($userDetail->gender == "Female")>Female</option>
                                    <option value="Other" @selected($userDetail->gender == "Other")>Other</option>
                                </select>
                                <x-form-error-component :label='"gender"' />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="medical_history">Medical History:</label>
                                <input type="text" class="form-control" id="medical_history" name="medical_history"
                                    placeholder="Enter Medical History" value="{{ $userDetail->medical_history }}">
                                <x-form-error-component :label='"medical_history"' />

                            </div>
                            <div class="form-group col-md-2">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Active" @selected($userDetail->status == "Active")>Active</option>
                                    <option value="Inactive" @selected($userDetail->status == "Inactive")>Inactive</option>
                                    <option value="Deceased" @selected($userDetail->status == "Deceased")>Deceased</option>
                                </select>
                                <x-form-error-component :label='"status"' />

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Street:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Street" name="street" value="{{ $userDetail->street }}" />
                                <x-form-error-component :label='"street"' />

                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Suburb:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Suburb" name="suburb" value="{{ $userDetail->suburb }}" />
                                <x-form-error-component :label='"suburb"' />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    State:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter State" name="state" value="{{ $userDetail->state }}" />
                                <x-form-error-component :label='"state"' />
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