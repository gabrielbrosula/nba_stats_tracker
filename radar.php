#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radar Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 720px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <canvas id="radarChart"></canvas>
    </div>

    <script>
    const player1Name = '<?php echo $_POST['first_name'] . " " . $_POST['last_name']; ?>';

    const p1ppg = '<?php echo $_POST['p1ppg']; ?>';
    const p1Rpg = '<?php echo $_POST['p1Rpg']; ?>';
    const p1Apg = '<?php echo $_POST['p1Apg']; ?>';
    const p1Fg = '<?php echo $_POST['p1Fg']; ?>';

    const data = {
        labels: ['Points per game', 'Rebounds per game', 'Assists per game', 'Field goal percentage'],
        datasets: [
            {
                label: player1Name,
                data: [p1ppg, p1Rpg, p1Apg, p1Fg],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    };

    const config = {
        type: 'radar',
        data: data,
        options: {
            aspectRatio: 1,
            scales: {
                r: {
                    min: 0,
                    max: 60,
                }
            },
        }
    };

    const radarChartElement = document.getElementById('radarChart').getContext('2d');
    const radarChart = new Chart(radarChartElement, config);
</script>

</body>
</html>
