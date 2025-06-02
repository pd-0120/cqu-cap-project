<div>
	<div class="row">
		<div class="col-md-12 p-5">
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-success">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
								<div class="d-flex flex-column mr-5">
									<a href="{{ route('superadmin.admins.index') }}" class="h4 text-dark text-hover-success mb-5">
										Total Admins
									</a>
									<p class="text-dark-50 text-dark h5">
										<b>{{ $adminCount }}</b>
									</p>
								</div>
								<div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
									<a href="{{ route('superadmin.admins.index') }}" class="btn font-weight-bolder text-uppercase btn-success py-4 px-6">
										Take Me There
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
