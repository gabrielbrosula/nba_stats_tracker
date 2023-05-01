#!/usr/local/bin/php

<?php
    session_start();
?>

<html lang="en">
    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">

        <!-- This tag allows for responsiveness -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="styles.css">

        <title> Season Statistics Table </title>
        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">NBA Stats Tracker</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Search Player</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="compare.php">Compare Players</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="explore.php">Explore Teams</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="seasonStatsTable.php">View Season Stats</a>
                </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Historical Stats Table</h1>
                </div>
            </div>
        </div>

        <br>

        <br>

        <!-- Create table -->
        
        <table id="playerTable" style="width:100%;height:100%">

            <?php

                // Get database parameters
                $db_params = parse_ini_file("../db_configs/group_project.ini");

                // Connect to the database
                $server = $db_params["server"];
                $db_user = $db_params["username"];
                $db_password = $db_params["password"];
                $db_name = $db_params["database"];

                $link = new mysqli($server, $db_user, $db_password, $db_name);

                if ($link->connect_error) {
                    die("Connection failed: " . $link->connect_error);
                }

                /* Prepared statement, stage 1: prepare */
                $stmt = $link->prepare("SELECT Stat.*, Player.first_name, Player.last_name FROM Player INNER JOIN Stat ON Player.id=Stat.player_id");
                $stmt->execute();


                /* bind variables to prepared statement */
                $stmt->bind_result($id, $games_played, $season, $min, $fgm, $fga, $fg3m, $fg3a, $ftm, $fta, $oreb, $dreb, $reb, $ast, $stl, $blk, $turnover, $pf, $pts, $fg_pct, $fg3_pct, $ft_pct, $first_name, $last_name);

                echo '
                    <thead>
                        <tr> 
                            <td> Player ID </td>
                            <td> Name </td>
                            <td> Games Played </td>
                            <td> Season </td>
                            <td> Min </td>
                            <td> FGM </td>
                            <td> FGA </td>
                            <td> FG3M </td>
                            <td> FG3A </td>
                            <td> FTM </td>
                            <td> FTA </td>
                            <td> OREB </td>
                            <td> DREB </td>
                            <td> REB </td>
                            <td> AST </td>
                            <td> STL </td>
                            <td> BLK </td>
                            <td> Turnover </td>
                            <td> PF </td>
                            <td> Points </td>
                            <td> FG % </td>
                        </tr>
                    </thead>
                    ';

                /* fetch values */
                while ($stmt->fetch()) {

                    echo '<tr> 
                        <td>'.$id.'</td> 
                        <td>'.$first_name.' '.$last_name.'</td>
                        <td>'.$games_played.'</td>
                        <td>'.$season.'</td>
                        <td>'.$min.'</td>
                        <td>'.$fgm.'</td>
                        <td>'.$fga.'</td>
                        <td>'.$fg3m.'</td>
                        <td>'.$fg3a.'</td>
                        <td>'.$ftm.'</td>
                        <td>'.$fta.'</td>
                        <td>'.$oreb.'</td>
                        <td>'.$dreb.'</td>
                        <td>'.$reb.'</td>
                        <td>'.$ast.'</td>
                        <td>'.$stl.'</td>
                        <td>'.$blk.'</td>
                        <td>'.$turnover.'</td>
                        <td>'.$pf.'</td>
                        <td>'.$pts.'</td>
                        <td>'.$fg_pct.'</td>
                    </tr>';
                }

                $link->close();
            ?>
    
        <!-- Bootstrap 4 JS dependencies -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- DataTables CSS and JavaScript 10px-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        
        <!-- Script to handle row deletion on button press -->
        <script type="text/javascript">
            $(document).ready(function() {
                
                    $("#playerTable").DataTable();
            });
        </script>
        
    </body>

</html>