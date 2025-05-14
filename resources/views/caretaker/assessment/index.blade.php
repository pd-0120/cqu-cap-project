@section('pageTitle', "Available Assessments")
<x-auth-layout>
    @session('message.level')
        <x-alert-component />
    @endsession
    <div class="row">
        <!--begin::Col-->
        @forelse ($assessments as $assessment)
            <div class="col-xxl-3 col-xl-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::User-->
                        <div class="d-flex align-items-end py-2">
                            <!--begin::Pic-->
                            <div class="d-flex align-items-center">
                                <!--begin::Pic-->
                                <div class="d-flex flex-shrink-0 mr-5">
                                    <div class="symbol symbol-circle symbol-lg-75">
                                        <img src="{{ $assessment->image }}" alt="image">
                                    </div>
                                </div>

                                <!--end::Pic-->
                                <!--begin::Title-->
                                <div class="d-flex flex-column">
                                    <a href="javascript:void(0)"
                                        class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{ $assessment->title }}</a>
                                    <span class="text-muted font-weight-bold">{{ $assessment->type }}</span>
                                </div>
                                {{-- {{ dd($assessment) }} --}}
                                <!--end::Title-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::User-->
                        <!--begin::Desc-->
                        <p class="py-2">
                            {{  str($assessment->description)->limit(200) }}
                        </p>
                        <!--end::Desc-->
                        <!--begin::Contacts-->
                        <div class="py-2">

                            <div class="d-flex align-items-center mb-2">
                                <span class="flex-shrink-0 mr-2">
                                    <span
                                        class="svg-icon-warning svg-icon svg-icon-md">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M13,5.06189375 C12.6724058,5.02104333 12.3386603,5 12,5 C11.6613397,5 11.3275942,5.02104333 11,5.06189375 L11,4 L10,4 C9.44771525,4 9,3.55228475 9,3 C9,2.44771525 9.44771525,2 10,2 L14,2 C14.5522847,2 15,2.44771525 15,3 C15,3.55228475 14.5522847,4 14,4 L13,4 L13,5.06189375 Z"
                                                    fill="#000000" />
                                                <path
                                                    d="M16.7099142,6.53272645 L17.5355339,5.70710678 C17.9260582,5.31658249 18.5592232,5.31658249 18.9497475,5.70710678 C19.3402718,6.09763107 19.3402718,6.73079605 18.9497475,7.12132034 L18.1671361,7.90393167 C17.7407802,7.38854954 17.251061,6.92750259 16.7099142,6.53272645 Z"
                                                    fill="#000000" />
                                                <path
                                                    d="M11.9630156,7.5 L12.0369844,7.5 C12.2982526,7.5 12.5154733,7.70115317 12.5355117,7.96165175 L12.9585886,13.4616518 C12.9797677,13.7369807 12.7737386,13.9773481 12.4984096,13.9985272 C12.4856504,13.9995087 12.4728582,14 12.4600614,14 L11.5399386,14 C11.2637963,14 11.0399386,13.7761424 11.0399386,13.5 C11.0399386,13.4872031 11.0404299,13.4744109 11.0414114,13.4616518 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <a href="javascript:void(0)" class="text-muted text-hover-primary font-weight-bold">
                                        @if ($assessment->estimated_time == 0)
                                            No Time bound
                                        @else
                                        {{ $assessment->estimated_time }} Seconds
                                        @endif
                                    </a>
                            </div>
                        </div>
                        <!--end::Contacts-->
                        <!--begin::Actions-->
                        <div class="pt-2">
                            <a href="{{ route('caretaker.assessments.view-available-assessments', $assessment) }}" class="btn btn-primary font-weight-bolder mr-2">View More Details</a>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
        @empty
        @endforelse
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $assessments->links('pagination::keen') }}
        </div>
    </div>
</x-auth-layout>