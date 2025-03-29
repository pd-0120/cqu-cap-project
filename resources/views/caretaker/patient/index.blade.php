@section('pageTitle', "Add New Patient")
@section('pageActionData')
<div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="top">
    <a href="#" class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="svg-icon svg-icon-md">

    </span>New Report</a>
    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-header font-weight-bold py-4">
                <span class="font-size-lg">Choose Option:</span>
                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
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
    
    @push('UserJS')
    @endpush
</x-auth-layout>