<div>
	<div id="patient-test-chart"></div>
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
						text: 'Number of Patients given exams'
					}
				},
				series: [{
					name: 'Number of Patients',
					data: @json($data)
				}]
			};
			const chart = new ApexCharts(document.querySelector("#patient-test-chart"), options);
			chart.render();
		});
	</script>
@endpush
