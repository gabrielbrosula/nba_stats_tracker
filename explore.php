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
        <!-- Bootstrap 4 JS dependencies -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="styles.css">
        <title> NBA Stats Tracker </title>
        <script>
            function showPlayers(id){

                console.log("showPlayers(" + id + ") called!");
                var teamid = id;
                //var output = "";
                console.log("Creating XMLHttpRequest");
                const xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    //obj = JSON.parse(this.responseText);
                    document.getElementById("players").innerHTML = this.responseText;
                }
                console.log("Opening XMLHttpRequest");
                xmlhttp.open("GET", "addPlayers.php?id=" + teamid);
                console.log("Sending XMLHttpRequest");
                xmlhttp.send(); 
                scroll();
            }
            function scroll(){
                var el = document.getElementById('fullScreen');
                el.scrollIntoView(({
                block: "end",
                inline: "center",
                behavior: "smooth",
                alignToTop: false
                }));
            }
        </script>
        <style>
            .play{
                border: 0px solid #dddddd;
                width: 100%;
                max-width: 100%;
                background-color: transparent;
            }
            .d{
                padding: 0.75rem;
                vertical-align: top;
            }
            .buttonE {
                border: none;
                color: white;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                margin: 4px 2px;
                cursor: pointer;
                background-color: transparent;
            }
            .player {
                height: 600px;
            }
        </style>
    </head>
    <body>
    <div class="bg container-fluid" style="background-image: url('images/basketball_img1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center; background-attachment: fixed;">
    <!-- TODO: Add the links to the other page -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">NBA Stats Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="search.php">Search Player</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="compare.php">Compare Players</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Explore Teams</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="seasonStatsTable.php">View Season Stats</a>
            </li>
            </ul>
        </div>
    </nav>
    <div class="container" id='fullScreen'>
        <div class="jumbotron justify-content-center">
        <form action=''>
		<?php
            $conn = new mysqli('mysql.cise.ufl.edu', 'v.torres1', '123456789abcd', 'NBASTATS');

			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
			//echo "Connected successfully";

			
			$sql = "SELECT * FROM Team";
			$result = $conn->query($sql);
            echo "<table class ='table'>";
                echo "<thead><h1 style='text-align: center;'>NBA Teams</h1></thead>";
                echo "<tbody>
                    <tr>";
                    $count = 0;
                    while($row = $result->fetch_assoc())
                    {
                        $count = $count + 1;
                        $Teamid = $row["id"];
				        $TeamName = $row["full_name"];
                        $Name = $row["name"];
                        $lowerName = strtolower($Name);
                        if($lowerName == "trail blazers")
                        {
                            echo "<td><img src='images/teamLogos/trailBlazers.png' width='138' height='100'><button class='buttonE' onclick='showPlayers($Teamid)' type='button'>$TeamName</button></td>";                            
                        }
                        else
                        {
                            echo "<td><img src='images/teamLogos/$lowerName.png' width='138' height='100'><button class='buttonE' onclick='showPlayers($Teamid)' type='button'>$TeamName</button></td>";
                        }
                            if($count%5 == 0)
                        {
                            echo "</tr>";
                        }
                    }
                    echo "</tr> </tbody>";
            echo "</table>";
            ?>
            </form>
        </div>
        <div class="player" id="players">
        </div>
    </div>
    </div>
    </body>
</html>