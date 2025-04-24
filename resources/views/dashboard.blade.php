@section('pageTitle', "Dashboard")
@section('pageActionData')
@endsection
<x-auth-layout>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total Allocated
                                    Patients</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span
                                    class="font-weight-normal font-size-h6 text-muted pr-1"></span>{{ $totalAssingnedPatients }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total Allocated
                                    Patients</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span
                                    class="font-weight-normal font-size-h6 text-muted pr-1"></span>{{ $totalAssingnedPatients }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total House
                                    Assinned</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span
                                    class="font-weight-normal font-size-h6 text-muted pr-1"></span>15</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total Allocated
                                    Patients</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span
                                    class="font-weight-normal font-size-h6 text-muted pr-1"></span>{{ $totalAssingnedPatients }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total Allocated
                                    Patients</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span
                                    class="font-weight-normal font-size-h6 text-muted pr-1"></span>{{ $totalAssingnedPatients }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12" id="cogniFitContent">
            {{--
            <counter /> --}}
        </div>
    </div>

    @push('UserJS')
        <script>
            HTML5JS.loadMode("2025-04-10_1419_snaga", "assessmentMode", "THE_NUMBERS_TASK_ASSESSMENT", "cogniFitContent",
                {
                    "clientId": "12312d014a761b6b2d871ed2ca6ecc0a",
                    "accessToken": "XyS8LitwpNfnpqHTWdntNAPmO4b23kCBOHXBCFhJ",
                    "appType": "web"
                }
            );

            window.addEventListener('message', receiveMessage, false);

            function receiveMessage(event) {
                if (event.origin  == "https://js.cognifit.com") {
                    console.log("🚀 ~ :128 ~ receiveMessage ~ event:", event)
                }
            }
        </script>
    @endpush
</x-auth-layout>