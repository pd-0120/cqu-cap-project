@section('pageTitle', "Update $caretaker->name")
@section('pageActionData')
    <a href="{{ route('admin.caretaker.index') }}"
       class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Caretaker List</a>
@endsection

<x-auth-layout>
    @session('message.level')
        <x-alert-component />
    @endsession
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <form action="{{ route('admin.caretaker.update', $caretaker->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body pt-7">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Full Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $caretaker->name }}">
                                <x-form-error-component :label='"name"' />
                            </div>
                            <div class="col-md-6">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email" value="{{ $caretaker->email }}">
                                <x-form-error-component :label='"email"' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone:</label>
                                <input type="text" class="form-control" name="phone" value="{{ $caretaker->phone }}">
                                <x-form-error-component :label='"phone"' />
                            </div>
                            <div class="col-md-6">
                                <label>New Password (optional):</label>
                                <input type="password" class="form-control" name="password" placeholder="Leave blank to keep existing">
                                <x-form-error-component :label='"password"' />
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
