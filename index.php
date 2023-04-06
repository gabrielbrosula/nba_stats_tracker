#!/usr/local/bin/php

<html lang="en">
    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">

        <!-- This tag allows for responsiveness -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title> NBA Stats Tracker </title>
        <!-- Bootstrap 4 JS dependencies -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            
    </head>
    <body>

    <!-- TODO: Add the links to the other page -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">NBA Stats Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Search Player</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Compare Player</a>
            </li>
            </ul>
        </div>
    </nav>


    <?php 
    $link = new mysqli('mysql.cise.ufl.edu', 'v.torres1', '123456789abcd', 'NBASTATS');

    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }else{
        echo "Connection made<br>";
    }


    function testQuery($link){
        $sql = 'SELECT s.pts, p.first_name, p.last_name, t.full_name 
                FROM Stat s JOIN Player p ON s.player_id = p.id 
                JOIN Team t ON p.team = t.id 
                WHERE t.name = "Knicks"
                ';
        $result = $link->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                print_r($row);
                echo '<br>';
            }
        }
        /*if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "Name: " . $row["first_name"] ." ". $row["last_name"] . "\tPosition: " . $row["position"] 
                ." Height, Weight:".  $row["height_feet"] ."'".$row["height_inches"] .'", '.$row["weight_pounds"]."Ibs<br>";
            }
        }else{
            echo "0 results";
        }*/
    }
    testQuery($link);
    ?>
 </body>
</html>