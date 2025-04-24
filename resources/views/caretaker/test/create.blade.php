@section('pageTitle', "Create New Test For Patients")
@section('pageActionData')
    <a href="{{ route('caretaker.tests.index') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Test List</a>

@endsection
<x-auth-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <livewire:create-test-component/>
            </div>
        </div>
    </div>
</x-auth-layout>