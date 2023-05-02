#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Histogram Comparison</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <canvas id="histogramChart"></canvas>
    </div>

    <script>
        function createHistogramChart(player1Name, player2Name, p1ppg, p2ppg, p1Rpg, p2Rpg, p1Apg, p2Apg, p1Fg, p2Fg) {
            const ctx = document.getElementById('histogramChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [player1Name, player2Name],
                    datasets: [
                        {
                            label: 'PPG',
                            data: [p1ppg, p2ppg],
                            backgroundColor: 'blue',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'RPG',
                            data: [p1Rpg, p2Rpg],
                            backgroundColor: 'yellow',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'APG',
                            data: [p1Apg, p2Apg],
                            backgroundColor: 'green',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'FG%',
                            data: [p1Fg, p2Fg],
                            backgroundColor: 'orange',
                            borderColor: 'rgba(255, 99, 132, 1)',
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
    </script>

<script>
    <?php
    if (
        isset($_POST['p1Name0']) && isset($_POST['p1Name1']) &&
        isset($_POST['p2Name0']) && isset($_POST['p2Name1']) &&
        isset($_POST['p1ppg']) && isset($_POST['p2ppg']) &&
        isset($_POST['p1Rpg']) && isset($_POST['p2Rpg']) &&
        isset($_POST['p1Apg']) && isset($_POST['p2Apg']) &&
        isset($_POST['p1Fg']) && isset($_POST['p2Fg'])
    ) :
    ?>

    createHistogramChart(
        "<?php echo $_POST['p1Name0'] . ' ' . $_POST['p1Name1']; ?>",
        "<?php echo $_POST['p2Name0'] . ' ' . $_POST['p2Name1']; ?>",
        <?php echo $_POST['p1ppg']; ?>,
        <?php echo $_POST['p2ppg']; ?>,
        <?php echo $_POST['p1Rpg']; ?>,
        <?php echo $_POST['p2Rpg']; ?>,
        <?php echo $_POST['p1Apg']; ?>,
        <?php echo $_POST['p2Apg']; ?>,
        <?php echo $_POST['p1Fg']; ?>,
        <?php echo $_POST['p2Fg']; ?>
    );

    <?php else : ?>
        alert("POST data not received properly.");
    <?php endif; ?>
</script>

</body>
</html>
