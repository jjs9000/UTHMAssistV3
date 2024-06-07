<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Tasks Posted and Completed Over Time</h2>
    <canvas id="taskCompletionChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var taskCompletionData = @json($taskCompletionData); // Ensure the data is JSON encoded
        
        if (taskCompletionData.length > 0) {
            var ctx = document.getElementById('taskCompletionChart').getContext('2d');
            var taskCompletionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: taskCompletionData.map(item => item.month),
                    datasets: [
                        {
                            label: 'Tasks Posted',
                            data: taskCompletionData.map(item => item.total),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Tasks Completed',
                            data: taskCompletionData.map(item => item.completed),
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        }
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