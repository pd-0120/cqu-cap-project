@section('pageTitle', "Update $test->name")
@section('pageActionData')
    <a href="{{ route('caretaker.tests.index') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">All Tests</a>

@endsection
<x-auth-layout>
    @session('message.level')
        <x-alert-component />
    @endsession
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <livewire:create-test-component :test="$test"/>
            </div>
        </div>
    </div>
    @push('UserJS')
    @endpush
</x-auth-layout>