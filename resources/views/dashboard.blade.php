@section('pageTitle', "Dashboard")
@section('pageActionData')
@endsection
<x-auth-layout>
    @hasrole('CareTaker')
    <x-care-taker-dashboard-component/>
    @endhasrole
</x-auth-layout>