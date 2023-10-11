<!DOCTYPE html>
<html>
<head>
    <title>Chart.js Pie Chart Example in PHP</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style type="text/css">
        #chart-container {
            width: 50%;
            height: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div id="chart-container">
        <canvas id="pieChart"></canvas>
    </div>

    <?php
    // Sample data
    $employees = array("John", "Mary", "Peter", "Doe", "Harry");
    $tasks = array(80, 8, 12, 4, 6);
    $statuses = array("Completed", "In Progress", "New", "Pending", "Cancelled");

    // Convert arrays to JSON
    $employees = json_encode($employees);
    $tasks = json_encode($tasks);
    $statuses = json_encode($statuses);
    ?>

    <script type="text/javascript">
        // Create pie chart
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo $employees; ?>,
                datasets: [{
                    label: 'Number of Tasks Assigned',
                    data: <?php echo $tasks; ?>,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#33FF99',
                        '#FF9933'
                    ]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Number of Tasks Assigned to Each Employee'
                },
                legend: {
                    display: true,
                    position: 'bottom'
                },
                responsive: true,
                plugins: {
                    datalabels: {
                        formatter: function(value, context) {
                            var label = context.chart.data.labels[context.dataIndex];
                            var text = label + ': ' + value + ' (' + <?php echo $statuses; ?>[context.dataIndex] + ')';
                            return text;
                        },
                        color: '#fff',
                        backgroundColor: '#333',
                        borderRadius: 5,
                        anchor: 'end',
                        align: 'start',
                        offset: 10,
                        font: {
                            size: '14'
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
