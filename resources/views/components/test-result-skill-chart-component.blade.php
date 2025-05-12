<div>
	<div  id="test-result-skill-chart"></div>
</div>
@push('UserJS')
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const options = {
				chart: {
					type: 'bar',
					height: 400
				},
				plotOptions: {
					bar: {
						borderRadius: 5,
						horizontal: false,
						distributed: true,
						dataLabels: {
							position: 'top'
						}
					}
				},
				dataLabels: {
					enabled: true,
					offsetY: -20,
					style: {
						fontSize: '12px',
						colors: ['#333']
					}
				},
				xaxis: {
					categories: @json($data),
				},
				yaxis: {
					max: 800,
					title: {
						text: 'Score (Out of 800)'
					}
				},
				series: [{
					name: 'Score',
					data: @json($categories)
				}]
			};
			const chart = new ApexCharts(document.querySelector("#test-result-skill-chart"), options);
			chart.render();
		});
	</script>
@endpush

