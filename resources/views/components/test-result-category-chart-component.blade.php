<div>
	<canvas  id="test-result-category-chart"></canvas>
</div>
@push('UserJS')
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const ctx = document.getElementById('test-result-category-chart').getContext('2d');

			const cognitiveCategoriesChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: [
						'Executive Function',
						'Language',
						'Working Memory',
						'Attention',
						'Visuospatial Skills',
						'Processing Speed'
					],
					datasets: [{
						label: 'Assessment Score (%)',
						data: [88, 76, 69, 82, 74, 91],
						backgroundColor: [
							'rgba(255, 159, 64, 0.6)',   // Executive Function
							'rgba(153, 102, 255, 0.6)',  // Language
							'rgba(255, 206, 86, 0.6)',   // Working Memory
							'rgba(75, 192, 192, 0.6)',   // Attention
							'rgba(54, 162, 235, 0.6)',   // Visuospatial
							'rgba(255, 99, 132, 0.6)'    // Processing Speed
						],
						borderColor: [
							'rgba(255, 159, 64, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 99, 132, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					responsive: true,
					plugins: {
						title: {
							display: true,
							text: 'Cognitive Categories Assessment',
							font: {
								size: 18
							}
						},
						tooltip: {
							mode: 'index',
							intersect: false
						},
						legend: {
							display: false
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							max: 100,
							title: {
								display: true,
								text: 'Score (%)'
							}
						},
						x: {
							title: {
								display: true,
								text: 'Cognitive Categories'
							}
						}
					}
				}
			});
		});
	</script>
@endpush

