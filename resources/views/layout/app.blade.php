<!DOCTYPE html>
<html lang="en">

<head>
	<base href="">
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href='{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.css", ) }}' rel="stylesheet"
		type="text/css" />
	<!--end::Page Vendors Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href='{{ asset("assets/plugins/global/plugins.bundle.css") }}' rel="stylesheet" type="text/css" />
	<link href='{{ asset("assets/plugins/custom/prismjs/prismjs.bundle.css") }}' rel="stylesheet" type="text/css" />
	<link href='{{ asset("assets/css/style.bundle.css") }}' rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href='{{ asset("assets/css/themes/layout/header/base/light.css") }}' rel="stylesheet" type="text/css" />
	<link href='{{ asset("assets/css/themes/layout/header/menu/light.css") }}' rel="stylesheet" type="text/css" />
	<link href='{{ asset("assets/css/themes/layout/brand/dark.css") }}' rel="stylesheet" type="text/css" />
	<link href='{{ asset("assets/css/themes/layout/aside/dark.css") }}' rel="stylesheet" type="text/css" />
	<link href='{{ asset("assets/plugins/custom/datatables/datatables.bundle.css") }}' rel="stylesheet" type="text/css" />

	@livewireStyles
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href='{{ asset("assets/media/logos/favicon.ico") }}' />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
	class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled  aside-minimize-hoverable page-loading">

	<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
		<!--begin::Logo-->
		<a href="{{ route('dashboard') }}">
			{{-- <img alt="Logo" src="{{ asset('assets/media/logos/logo.svg') }}" width="100%" height="auto"/> --}}
		</a>
		<!--end::Logo-->
		<!--begin::Toolbar-->
		<div class="d-flex align-items-center">

			<button class="btn p-0 burger-icon ml-5" id="kt_header_mobile_toggle">
				<span></span>
			</button>
			<button class="btn btn-hover-text-primary p-0 ml-3" id="kt_header_mobile_topbar_toggle">
				<span class="svg-icon svg-icon-xl">
					<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
						height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<polygon points="0 0 24 0 24 24 0 24" />
							<path
								d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
								fill="#000000" fill-rule="nonzero" opacity="0.3" />
							<path
								d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
								fill="#000000" fill-rule="nonzero" />
						</g>
					</svg>
					<!--end::Svg Icon-->
				</span>
			</button>
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root" id="app">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">

			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<!--begin::Header-->
				@include('layout.header')
				<!--end::Header-->
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<!--begin::Subheader-->
					@include('layout.subheader')
					<div class="d-flex flex-column-fluid">
						<!--begin::Container-->
						<div class="container">
							{{ $slot }}
						</div>
						<!--end::Container-->
					</div>
					<!--end::Entry-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				@include('layout.footer')
				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Main-->
	@include('layout.user')
	<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3E97FF", "secondary": "#E5EAEE", "success": "#08D1AD", "info": "#844AFF", "warning": "#F5CE01", "danger": "#FF3D60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#DEEDFF", "secondary": "#EBEDF3", "success": "#D6FBF4", "info": "#6125E1", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>

	<script src='{{ asset("assets/plugins/global/plugins.bundle.js") }}'></script>
	<script src='{{ asset("assets/plugins/custom/prismjs/prismjs.bundle.js") }}'></script>
	<script src='{{ asset("assets/js/scripts.bundle.js") }}'></script>
	<!--end::Global Theme Bundle-->
	<!--begin::Page Vendors(used by this page)-->
	<script src='{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.js") }}'></script>
	<script src="{{ asset("assets/js/pages/widgets.js") }}"></script>
	<script src="{{ asset("assets/plugins/custom/datatables/datatables.bundle.js") }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-autocolors"></script>
	@vite(['resources/js/app.js'])
	@livewireScripts
	@stack('UserJS')
	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
