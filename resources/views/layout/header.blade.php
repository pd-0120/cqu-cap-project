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
						<a href="{{ route('dashboard') }}" class="menu-link">
							<span class="menu-text">Dashboard</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					@hasrole('Patient')
					<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="menu-text">Tests</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu menu-submenu-classic menu-submenu-left">
							<ul class="menu-subnav">
								<li class="menu-item" aria-haspopup="true">
									<a href=" {{ route('patient.tests.index') }}" class="menu-link">
										<span class="menu-text">All Assign Test</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					@endhasrole

					@hasrole('CareTaker')
					<li class="menu-item  ">
						<a href="{{ route('caretaker.patients.assign-patients') }}" class="menu-link">
							<span class="menu-text">All Assign Patients</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					<li class="menu-item  ">
						<a href="{{ route('caretaker.assessments.available-assessments') }}" class="menu-link">
							<span class="menu-text">All Available Assessments</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="menu-text">Tests</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu menu-submenu-classic menu-submenu-left">
							<ul class="menu-subnav">
								<li class="menu-item" aria-haspopup="true">
									<a href=" {{ route('caretaker.tests.index') }}" class="menu-link">
										<span class="menu-text">All tests</span>
									</a>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href=" {{ route('caretaker.tests.assignTestIndex') }}" class="menu-link">
										<span class="menu-text">Assigned Tests</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					@endhasrole
					@hasrole('Admin')
					<li class="menu-item">
						<a href="{{ route('admin.activity-log') }}" class="menu-link">
							<span class="menu-text">All Activities</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					<li class="menu-item">
						<a href="{{ route('admin.patient.index') }}" class="menu-link">
							<span class="menu-text">Patients</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					<li class="menu-item  ">
						<a href="{{ route('admin.location.index') }}" class="menu-link">
							<span class="menu-text">Locations</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="menu-text">Tests</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu menu-submenu-classic menu-submenu-left">
							<ul class="menu-subnav">
								<li class="menu-item" aria-haspopup="true">
									<a href=" {{ route('admin.test.index') }}" class="menu-link">
										<span class="menu-text">All tests</span>
									</a>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href=" {{ route('admin.test.assignTests') }}" class="menu-link">
										<span class="menu-text">Assigned Tests</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="menu-item">
						<a href="{{ route('admin.caretakers.index') }}" class="menu-link">

							<span class="menu-text">Caretaker</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					@endhasrole
				</ul>
			</div>
		</div>
		<div class="topbar">
			<div class="topbar-item ml-4">
				<div class="btn btn-icon btn-light-primary h-40px w-40px p-0" id="kt_quick_user_toggle">
					<img src="{{ asset("assets/media/svg/avatars/001-boy.svg") }}" class="h-30px align-self-end"
						alt="" />
				</div>
			</div>
		</div>
	</div>
</div>
