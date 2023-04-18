#!/usr/local/bin/php
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
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="search.php">Search Player</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="compare.php">Compare Players</a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="container pt-3 text-black rounded text-center">
        <h2>Your NBA Player Comparison are shown below.</h2>
    </div>

    <!-- pt-5 adds padding to the top; helps separate nav bar from player comparison page -->
    <div class="d-flex justify-content-center pt-5"> 
         <!-- left image -->
        <div class="col-md-2 text-center">
            <img src="playerImages/kevinDurant.png" class="img-fluid">
        </div>
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

            // echo "$p2Name[0] $p2Name[1] <br>";

            $sql = "SELECT p.first_name, p.last_name, p.id
            FROM Stat s JOIN Player p ON s.player_id = p.id 
            WHERE p.first_name = \"$p1Name[0]\" AND p.last_name = \"$p1Name[1]\"";

            $sql2 = "SELECT p.first_name, p.last_name, p.id
            FROM Stat s JOIN Player p ON s.player_id = p.id 
            WHERE p.first_name = \"$p2Name[0]\" AND p.last_name = \"$p2Name[1]\"";
            
            $result = $link->query($sql);
            $result2 = $link->query($sql2);

            if($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);  // get the player1 ID
                $row2 = mysqli_fetch_assoc($result2);  // get the player2 ID

                $player1ID = (int)$row['id'];
                $player2ID = (int)$row2['id'];

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
                    }
                } 
                if (mysqli_num_rows($result2) > 0) {  // check if any results were returned for p2
                    while($row2 = mysqli_fetch_assoc($result2)) {  // output data of each row
                        $player2_id = $row2["player_id"];
                        $p2ppg = $row2["pts"];
                        $p2Rpg = $row2["reb"];
                        $p2Apg = $row2["ast"];
                        $p2Fg = $row2["fg_pct"];
                    }
                } 
            }
        ?>
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
        <img src="playerImages/lebronJames.png" class="img-fluid">
        <!-- add nba logo to the top right of the right player image -->
        <img src="nbaLogo.png" class="position-absolute top-0 end-0" style="width: 55px; height: 45px;">
    </div>

    </div>

    <!-- Bootstrap 4 JS dependencies -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>