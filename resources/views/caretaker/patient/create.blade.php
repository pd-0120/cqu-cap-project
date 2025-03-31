@section('pageTitle', "Add New Patient")
@section('pageActionData')
    <a href="{{ route('caretaker.patient.index') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Patient List</a>

@endsection
<x-auth-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <form action="{{ route('caretaker.patient.store') }}" method="POST">
                    @csrf
                    <div class="card-body pt-7">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="first_name">
                                    First Name:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter first name" name="first_name"
                                    value="{{ old('first_name') }}" />
                                <x-form-error-component :label='"first_name"' />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="last_name">
                                    Last Name:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter last name" name="last_name"
                                    value="{{ old('last_name') }}" />
                                <x-form-error-component :label='"last_name"' />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">
                                    Phone Number:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Phone" name="phone"
                                    value="{{ old('phone') }}" />
                                <x-form-error-component :label='"phone"' />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="email">
                                    Email:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Email" name="email"
                                    value="{{ old('email') }}" />
                                <x-form-error-component :label='"email"' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="location_id">Care House Location:</label>
                                <select class="form-control" id="location_id" name="location_id">
                                    @forelse ($locations as $location)
                                        <option value="{{ $location->id }}" @selected(old('location_id') == $location->id)>{{ $location->name }}</option>
                                    @empty
                                    @endforelse
                                </select>

                                <x-form-error-component :label='"location_id"' />
                            </div>

                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="emergency_contact">Emergency Contact Name:</label>
                                <input type="text" class="form-control" id="emergency_contact" name="emergency_contact"
                                    placeholder="Enter Contact Name" value="{{ old('emergency_contact') }}">
                                <x-form-error-component :label='"emergency_contact"' />

                            </div>

                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="emergency_phone">Emergency Contact Phone:</label>
                                <input type="tel" class="form-control" id="emergency_phone" name="emergency_phone"
                                    value="{{ old('emergency_phone') }}" placeholder="Enter Phone Number">
                                <x-form-error-component :label='"emergency_phone"' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <x-form-error-component :label='"gender"' />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="medical_history">Medical History:</label>
                                <input type="text" class="form-control" id="medical_history" name="medical_history"
                                    placeholder="Enter Medical History" value="{{ old('medical_history') }}">
                                <x-form-error-component :label='"medical_history"' />

                            </div>
                            <div class="form-group col-md-2">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Deceased">Deceased</option>
                                </select>
                                <x-form-error-component :label='"status"' />

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Street:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Street" name="street"
                                    value="{{ old('street') }}" />
                                <x-form-error-component :label='"street"' />

                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    Suburb:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Suburb" name="suburb"
                                    value="{{ old('suburb') }}" />
                                <x-form-error-component :label='"suburb"' />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">
                                    State:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter State" name="state"
                                    value="{{ old('state') }}" />
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