<div id="kt_header" class="header header-fixed">
	<!--begin::Container-->
	<div class="container-fluid d-flex align-items-stretch justify-content-between">
		<!--begin::Header Menu Wrapper-->
		<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
			<!--begin::Header Menu-->
			<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
				<!--begin::Header Nav-->
				<ul class="menu-nav">
					<li class="menu-item  ">
						<a href="{{ route('caretaker.patient.index') }}" class="menu-link">
							<span class="menu-text">Patients</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					<li class="menu-item  ">
						<a href="{{ route('caretaker.location.index') }}" class="menu-link">
							<span class="menu-text">Locations</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
				</ul>
				<!--end::Header Nav-->
			</div>
			<!--end::Header Menu-->
		</div>
		<!--end::Header Menu Wrapper-->
		<!--begin::Topbar-->
		<div class="topbar">
			
			<!--begin::User-->
			<div class="topbar-item ml-4">
				<div class="btn btn-icon btn-light-primary h-40px w-40px p-0" id="kt_quick_user_toggle">
					<img src="{{ asset("assets/media/svg/avatars/001-boy.svg") }}" class="h-30px align-self-end" alt="" />
				</div>
			</div>
			<!--end::User-->
		</div>
		<!--end::Topbar-->
	</div>
	<!--end::Container-->
</div>