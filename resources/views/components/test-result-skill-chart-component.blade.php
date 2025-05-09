<div >
	<canvas id="test-result-skill-chart">

	</canvas>
</div>
@push('UserJS')
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const ctx = document.getElementById('test-result-skill-chart').getContext('2d');
			const cognitiveSkillsChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Attention', 'Memory', 'Reasoning', 'Processing Speed', 'Problem-Solving'],
					datasets: [{
						label: 'Skill Score',
						data: [80, 70, 85, 60, 90],
						backgroundColor: [
							'rgba(255, 99, 132, 0.6)',     // Attention
							'rgba(54, 162, 235, 0.6)',     // Memory
							'rgba(255, 206, 86, 0.6)',     // Reasoning
							'rgba(75, 192, 192, 0.6)',     // Processing Speed
							'rgba(153, 102, 255, 0.6)'     // Problem-Solving
						],
						borderColor: [
							'rgba(255, 99, 132, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					responsive: true,
					plugins: {
						title: {
							display: true,
							text: 'Cognitive Skills Assessment',
							font: {
								size: 20
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
								text: 'Cognitive Skills'
							}
						}
					}
				}
			});
		});
	</script>
@endpush
