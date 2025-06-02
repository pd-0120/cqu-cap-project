@section('pageTitle', "Add New Admin")
@section('pageActionData')
    <a href="{{ route('superadmin.admins.index') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Admins List</a>

@endsection
<x-auth-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <form action="{{ route('superadmin.admins.store') }}" method="POST">
                    @csrf
                    <div class="card-body pt-7">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="first_name">
                                    First Name:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter first name" name="first_name"
                                    value="{{ old('first_name') }}" />
                                <x-form-error-component :label='"first_name"' />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="last_name">
                                    Last Name:
                                </label>
                                <input type="text" class="form-control" placeholder="Enter last name" name="last_name"
                                    value="{{ old('last_name') }}" />
                                <x-form-error-component :label='"last_name"' />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="dob">
                                    Date of Birth:
                                </label>
                                <input type="text" class="form-control" id="p_dob" placeholder="Select date of birth"
                                    name="dob" readonly value="{{ old('dob') }}" />
                                <x-form-error-component :label='"dob"' />
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
                            <div class="col-md-4">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <x-form-error-component :label='"gender"' />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
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
								<select  class="form-control" placeholder="Enter State" name="state" >
									<option value="">Select</option>
									@foreach($australianStates as $australianState)
										<option value="{{ $australianState  }}" @selected(old('state') == $australianState)>{{ $australianState  }}</option>
									@endforeach
								</select>
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
        <script>
            $(document).ready(function () {
                {
                    $('#p_dob').datepicker({
                        rtl: false,
                        todayHighlight: true,
                        orientation: "bottom left",
                    });
                }
            })
        </script>
    @endpush
</x-auth-layout>
