#!/usr/local/bin/php
<?php 
if (empty($_POST['player1']) || empty($_POST['player2'])) { 
    header('Location: compare.php?error=invalid_names');
    exit; 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- This tag allows for responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Group Project CSS -->
    <link rel="stylesheet" href="styles.css">

    <title>Compare NBA Players Results</title>
</head>

<style>
    body {
        background-image: none;
    }
    td, th {
        text-align: center;
    }
    th {
        background-color: #FF7F50;
        color: white;
    }
    tr:not(:last-child) td {
        border-bottom: 1px solid black;
    }
    table {
        border-top: none;
        /* margin-top: 40px; */
    }

</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">NBA Stats Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="search.php">Search Player</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="compare.php">Compare Players</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="explore.php">Explore Teams</a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="container pt-3 text-black rounded text-center">
        <h2>Your NBA Player Comparison are shown below.</h2>
    </div>

    <!-- pt-5 adds padding to the top; helps separate nav bar from player comparison page -->
    <div class="d-flex justify-content-center pt-5"> 
        <?php
            $player1= htmlspecialchars($_POST['player1']);
            $p1Name = explode(' ', $player1); // split the first and last name by the space
    
            $player2= htmlspecialchars($_POST['player2']);
            $p2Name = explode(' ', $player2); // split the first and last name by the space
    
            $link = new mysqli('mysql.cise.ufl.edu', 'v.torres1', '123456789abcd', 'NBASTATS');
    
            if ($link->connect_error) {
                die("Connection failed: " . $link->connect_error);
            }
            foreach ($p1Name as &$name) {
                $name = ucfirst($name);
            }

            $sql = "SELECT p.first_name, p.last_name, p.id, p.team, p.position
            FROM Stat s JOIN Player p ON s.player_id = p.id 
            WHERE p.first_name = \"$p1Name[0]\" AND p.last_name = \"$p1Name[1]\"";

            $sql2 = "SELECT p.first_name, p.last_name, p.id, p.team, p.position
            FROM Stat s JOIN Player p ON s.player_id = p.id 
            WHERE p.first_name = \"$p2Name[0]\" AND p.last_name = \"$p2Name[1]\"";
            

            $result = $link->query($sql);
            $result2 = $link->query($sql2);

            if($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);  // get the player1 ID
                $row2 = mysqli_fetch_assoc($result2);  // get the player2 ID

                $player1ID = (int)$row['id'];
                $player2ID = (int)$row2['id'];

                $player1Position = $row['position'];
                $player2Position = $row2['position'];

                $p1TeamId = $row['team'];
                $p2TeamId = $row2['team'];

                $teamSelect = "SELECT t.full_name, t.name FROM Team t WHERE t.id=$p1TeamId";
                $teamSelect2 = "SELECT t.full_name, t.name FROM Team t WHERE t.id=$p2TeamId";

                $team1Result = $link->query($teamSelect);
                $team2Result = $link->query($teamSelect2);

                $teamRow = mysqli_fetch_assoc($team1Result);
                $teamRow2 = mysqli_fetch_assoc($team2Result);

                $p1TeamName = $teamRow['full_name'];
                $p2TeamName = $teamRow2['full_name'];

                $p1TeamNickName = $teamRow['name'];
                $p2TeamNickName = $teamRow2['name'];

                $sql = "SELECT * FROM Stat WHERE player_id=$player1ID";
                $sql2 = "SELECT * FROM Stat WHERE player_id=$player2ID";

                $result = $link->query($sql);
                $result2 = $link->query($sql2);

                if (mysqli_num_rows($result) > 0) {  // check if any results were returned for p1
                    while($row = mysqli_fetch_assoc($result)) {  // output data of each row
                        $player1_id = $row["player_id"];
                        $p1ppg = $row["pts"];
                        $p1Rpg = $row["reb"];
                        $p1Apg = $row["ast"];
                        $p1Fg = $row["fg_pct"];
                        $p13Pt = $row["fg3_pct"];
                        $p1Ft = $row["ft_pct"];
                    }
                } 
                if (mysqli_num_rows($result2) > 0) {  // check if any results were returned for p2
                    while($row2 = mysqli_fetch_assoc($result2)) {  // output data of each row
                        $player2_id = $row2["player_id"];
                        $p2ppg = $row2["pts"];
                        $p2Rpg = $row2["reb"];
                        $p2Apg = $row2["ast"];
                        $p2Fg = $row2["fg_pct"];
                        $p23Pt = $row2["fg3_pct"];
                        $p2Ft = $row2["ft_pct"];
                    }
                    
                } 
            }
        ?>
        <!-- left image -->
        <div class="col-md-2 text-center">
            <?php 
                $file_handle = fopen("images/nba_headshots.csv", "r");
                $tempName = strtolower($p1Name[0] . " " . $p1Name[1]);
                while (($row = fgetcsv($file_handle)) !== false) {
                    if ($row[0] == $tempName) {  // check if the name in this row matches the user input
                        $image2Src = $row[1];
                        break;
                    }
                }
                fclose($file_handle);
            ?>
            <img src="<?php echo $image2Src ?>"class="img-fluid" alt="Player 1 image">
            <h2> <?php echo "$player1Position / $p1TeamName <br>"; ?> </h2>
            <!-- <?php echo "$player1Position <br>"; ?>  -->
            <?php 
                $p1NickName = strtolower($p1TeamNickName);
                $img1Var = "images/teamLogos/$p1NickName.png";
            ?>
        <img src="<?php echo $img1Var; ?>"class="img-fluid" alt="Player 1 team image" style="width: 100px; height: 100px;">
        </div>
        <div class="col-md-6">
        <div class="container">
            <table class="table table-hover text-black ">
                <thead>
                    <tr>
                        <th></th>
                        <th><?php echo "$p1Name[0]  $p1Name[1]"; ?></th>
                        <th><?php echo "$p2Name[0] $p2Name[1]"; ?></th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>PPG</td>
                    <td><?php echo $p1ppg; ?></td>
                    <td><?php echo $p2ppg; ?></td>
                </tr>
                <tr>
                    <td>RPG</td>
                    <td><?php echo $p1Rpg; ?></td>
                    <td><?php echo $p2Rpg; ?></td>
                </tr>
                <tr>
                    <td>APG</td>
                    <td><?php echo $p1Apg; ?></td>
                    <td><?php echo $p2Apg; ?></td>
                </tr>
                <tr>
                    <td>FG%</td>
                    <td><?php echo $p1Fg * 100; ?></td>
                    <td><?php echo $p2Fg * 100; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- right image -->
    <div class="col-md-2 text-center">
        <?php 
            $file_handle = fopen("images/nba_headshots.csv", "r");
            $tempName = strtolower($p2Name[0] . " " . $p2Name[1]);
            while (($row = fgetcsv($file_handle)) !== false) {
                if ($row[0] == $tempName) {  // check if the name in this row matches the user input
                    $image2Src = $row[1];
                    break;
                }
            }
            fclose($file_handle);
        ?>
        <img src="<?php echo $image2Src ?>"class="img-fluid" alt="Player 2 image">
        <!-- add nba logo to the top right of the right player image -->
        <img src="nbaLogo.png" class="position-absolute top-0 end-0" style="width: 55px; height: 45px;">
        <h2> <?php echo "$player2Position / $p2TeamName <br>"; ?> </h2>
        <!-- <?php 
            echo "$player2Position <br>";
        ?>  -->
        <?php 
            $p2NickName = strtolower($p2TeamNickName);
            $img2Var = "images/teamLogos/$p2NickName.png";
        ?>
        <img src="<?php echo $img2Var; ?>"class="img-fluid" alt="Player 2 team image" style="width: 100px; height: 100px;">
    </div>
    </div>
    <div class="container d-flex justify-content-center pt-5">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-dark" data-bs-toggle="collapse" href="#viewStats" role="button" aria-expanded="false" aria-controls="viewStats">
                    View Players Shooting Statistics
                </a>
            </div>
        </div>
    </div>

    <div class="container pt-5">
        <div class=" row collapse bg-dark text-white rounded" id="viewStats">
            <table class="table table-hover text-black ">
                <thead>
                    <tr>
                        <th></th>
                        <th style="text-align:center">Statistics</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $p1Ft * 100; ?></td>
                        <td>FT%</td>
                        <td><?php echo $p2Ft * 100; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $p13Pt * 100; ?></td>
                        <td>3PT</td>
                        <td><?php echo $p23Pt * 100; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $p12Pt; ?></td>
                        <td>2PT</td>
                        <td><?php echo $p22Pt; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <!-- Bootstrap 4 JS dependencies -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>