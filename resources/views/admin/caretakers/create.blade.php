@section('pageTitle', "Add New Caretaker")
@section('pageActionData')
    <a href="{{ route('admin.caretakers.index') }}"
       class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Caretaker List</a>
@endsection

<x-auth-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <form action="{{ route('admin.caretakers.store') }}" method="POST">
                    @csrf
                    <div class="card-body pt-7">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Full Name:</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old('name') }}">
                                <x-form-error-component :label='"name"' />
                            </div>
                            <div class="col-md-6">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') }}">
                                <x-form-error-component :label='"email"' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone:</label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter phone" value="{{ old('phone') }}">
                                <x-form-error-component :label='"phone"' />
                            </div>
                            <div class="col-md-6">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" placeholder="Set a password">
                                <x-form-error-component :label='"password"' />
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
