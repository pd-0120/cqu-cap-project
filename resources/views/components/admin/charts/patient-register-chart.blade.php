<div>
	<div id="patient-register-chart"></div>
</div>
@push('UserJS')
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const options = {
				chart: {
					type: 'line',
					height: 400
				},
				xaxis: {
					categories: @json($last30Days),
				},
				yaxis: {
					title: {
						text: 'Number of Patients Sign Up'
					}
				},
				series: [{
					name: 'Number of Patients',
					data: @json($data)
				}]
			};
			const chart = new ApexCharts(document.querySelector("#patient-register-chart"), options);
			chart.render();
		});
	</script>
@endpush
