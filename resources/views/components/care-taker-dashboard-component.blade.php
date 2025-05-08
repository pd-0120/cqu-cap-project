<div>
    <div class="row">
        <div class="col-md-6 p-5">
            <div class="row">
                <div class="col-md-6 col-sm-12 card2">
                    <a href="{{ route('caretaker.patient.index') }}">
                        <div class="card card-custom  card-stretch gutter-b">
                            <div class="card-header border-0 pt-6">
                                <h3 class="card-title">
                                    <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total Allocated Patients</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                                <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span  class="font-weight-normal font-size-h6 text-muted pr-1"></span>{{ $totalAssingnedPatients }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 card2">
                    <a href="{{ route('caretaker.tests.index') }}">
                        <div class="card card-custom  card-stretch gutter-b">
                            <div class="card-header border-0 pt-6">
                                <h3 class="card-title">
                                    <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total Tests</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span
                                    class="font-weight-normal font-size-h6 text-muted pr-1"></span>{{ $totalTests }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 card2">
                    <a href="{{ route('caretaker.location.index') }}">
                        <div class="card card-custom  card-stretch gutter-b">
                            <div class="card-header border-0 pt-6">
                                <h3 class="card-title">
                                    <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total House Assigned</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span
                                    class="font-weight-normal font-size-h6 text-muted pr-1"></span>{{ $totalLocations }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 card2">
                    <a href="{{ route('caretaker.patient.index') }}">
                        <div class="card card-custom  card-stretch gutter-b">
                            <div class="card-header border-0 pt-6">
                                <h3 class="card-title">
                                    <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total Allocated Patients</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                            <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span
                                    class="font-weight-normal font-size-h6 text-muted pr-1"></span>{{ $totalAssingnedPatients }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-5">

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 card2">
            <a href="{{ route('caretaker.patient.index') }}" >
                <div class="card card-custom  card-stretch gutter-b">
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title">
                            <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Total Allocated Patients</span>
                        </h3>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-between pt-7 flex-wrap">
                        <span class="font-weight-bolder display5 text-dark-75 py-4 pl-5 pr-5"><span  class="font-weight-normal font-size-h6 text-muted pr-1"></span>{{ $totalAssingnedPatients }}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
