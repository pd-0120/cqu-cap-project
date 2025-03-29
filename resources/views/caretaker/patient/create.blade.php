@section('pageTitle', "Add New Patient")
@section('pageActionData')
    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="top">
        <a href="#" class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="svg-icon svg-icon-md">

            </span>New Report</a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
            <!--begin::Navigation-->
            <ul class="navi navi-hover">
                <li class="navi-header font-weight-bold py-4">
                    <span class="font-size-lg">Choose Option:</span>
                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right"
                        title="Click to learn more..."></i>
                </li>
                <li class="navi-separator mb-3 opacity-70"></li>
                <li class="navi-item">
                    <a href="#" class="navi-link">
                        <span class="navi-text">
                            <span class="label label-xl label-inline label-light-primary">Orders</span>
                        </span>
                    </a>
                </li>
            </ul>
            <!--end::Navigation-->
        </div>
    </div>
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
                            <input type="text" class="form-control" placeholder="Enter first name" name="first_name" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="last_name">
                                Last Name:
                            </label>
                            <input type="text" class="form-control" placeholder="Enter last name" name="last_name" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone">
                                Phone Number:
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Phone" name="phone" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">
                                Email:
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Email" name="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="emergency_contact">Emergency Contact Name:</label>
                            <input type="text" class="form-control" id="emergency_contact" name="emergency_contact"  placeholder="Enter Contact Name" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="emergency_phone">Emergency Contact Phone:</label>
                            <input type="tel" class="form-control" id="emergency_phone" name="emergency_phone"
                                placeholder="Enter Phone Number" required pattern="[0-9]{10}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="medical_history">Medical History:</label>
                            <input type="tel" class="form-control" id="medical_history" name="medical_history"
                                placeholder="Enter Medical History" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Deceased">Deceased</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="">
                                Street:
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Street" name="street" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">
                                Suburb:
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Suburb" name="suburb" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">
                                State:
                            </label>
                            <input type="text" class="form-control" placeholder="Enter State" name="state" />
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