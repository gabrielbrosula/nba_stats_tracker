#!/usr/local/bin/php
<?php
// TODO:

$conn = new mysqli('mysql.cise.ufl.edu', 'v.torres1', '123456789abcd', 'NBASTATS');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "select * from Player";
    $result = $conn->query($sql);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Group Project CSS -->
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">NBA Stats Tracker</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="search.php">Search Player<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="compare.php">Compare Players</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="explore.php">Explore Teams</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="seasonStatsTable.php">View Season Stats</a>
            </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Search Results</h1>
        <p>Search players by their firstName, LastName, or Team</p>
        <input class="form-control mb-3" id="searchInput" type="text" placeholder="Search..."><br><br>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID </th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Position </th>
                    <th scope="col">Height Feet </th>
                    <th scope="col">Height Inches </th>
                    <th scope="col">Weight Pounds </th>
                    <th scope="col">Team</th>
                    <!--Performance attribute -->
                    <th scope="col">Performance</th>
                </tr>
            </thead>
            <tbody id="playerTable">
                <?php
                $explorePlayer = $_GET["searchInput"];
                $playerFullName = $_GET["playerName"];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["first_name"] . "</td>";
                        echo "<td>" . $row["last_name"] . "</td>";
                        echo "<td>" . $row["position"] . "</td>";
                        echo "<td>" . $row["height_feet"] . "</td>";
                        echo "<td>" . $row["height_inches"] . "</td>";
                        echo "<td>" . $row["weight_pounds"] . "</td>";
                        echo "<td>" . $row["team"] . "</td>";

                        $sql2 = "SELECT * FROM Stat WHERE player_id=" . $row['id'];
                        $result2 = $conn->query($sql2);

                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                $player1_id = $row2["id"];
                                $p1ppg = $row2["pts"];
                                $p1Rpg = $row2["reb"];
                                $p1Apg = $row2["ast"];
                                $p1Fg = $row2["fg_pct"];

                            }
                        }
                        echo '<td>
    <form action="radar.php" method="post">
        <input type="hidden" name="player1_id" value="' . $player1_id . '">
        <input type="hidden" name="p1ppg" value="' . $p1ppg . '">
        <input type="hidden" name="p1Rpg" value="' . $p1Rpg . '">
        <input type="hidden" name="p1Apg" value="' . $p1Apg . '">
        <input type="hidden" name="p1Fg" value="' . $p1Fg . '">
        <input type="hidden" name="first_name" value="' . $row["first_name"] . '">
        <input type="hidden" name="last_name" value="' . $row["last_name"] . '">
        <button type="submit" class="btn btn-link">View data</button>
    </form>
</td>';

                        echo "</tr>";



                    }
                }
                ?>
            </tbody>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            if ("<?php echo $explorePlayer?>" != "")
            {
                console.log(<?php echo $explorePlayer?>);
                document.getElementById('searchInput').setAttribute('value', "<?php echo $playerFullName?>");
                let value = <?php echo $explorePlayer?>;
                $("#playerTable tr").filter(function () {
                        console.log($(this).text().toLowerCase().indexOf(value));
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) == 0)
                    });
            }
            $("#searchInput").on("keyup", function () {
                let value = $(this).val().toLowerCase();
                $("#playerTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMxrn/ITSMAChbeE9eTc"></script>
