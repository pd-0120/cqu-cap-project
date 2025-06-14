@section('pageTitle', "Dashboard")
@section('pageActionData')
@endsection
<x-auth-layout>
    @session('message.level')
    <x-alert-component />
    @endsession
    @hasrole('CareTaker')
    <x-care-taker-dashboard-component/>
    @endhasrole
	@hasrole('Patient')
	<x-patient-dashboard-component/>
	@endhasrole
	@hasrole('Admin')
	<x-admin-dashboard-component/>
	@endhasrole
    @hasrole('SuperAdmin')
	<x-superadmin-dashboard-component/>
	@endhasrole
</x-auth-layout>
