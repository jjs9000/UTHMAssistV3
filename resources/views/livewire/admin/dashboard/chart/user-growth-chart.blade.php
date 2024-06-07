<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">User Growth Over Time</h2>
    <canvas id="userGrowthChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var userGrowthData = @json($userGrowthData);
        
        if (userGrowthData.length > 0) {
            var ctx = document.getElementById('userGrowthChart').getContext('2d');
            var userGrowthChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: userGrowthData.map(item => item.month + '/' + item.year), // Combine month and year for x-axis labels
                    datasets: [
                        {
                            label: 'Male Users',
                            data: userGrowthData.filter(item => item.gender === 'male').map(item => item.count),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Female Users',
                            data: userGrowthData.filter(item => item.gender === 'female').map(item => item.count),
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        // Add more datasets for other demographics as needed
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>
