#!/usr/local/bin/php
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
        <title> NBA Stats Tracker </title>
        
    </head>
    <body id="home">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">NBA Stats Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
            <li class="nav-item">
                    <a class="nav-link" href="seasonStatsTable.php">View Season Stats</a>
            </li>
            </ul>
        </div>
    </nav>

    <!-- Rest of the webpage -->

    <!-- Background Image -->
    <main role="main" class="container">
        <div class="jumbotron">
            <h1 class="mb-3">Welcome to NBA Stats Tracker!</h1>
            <p class="lead">Welcome to our website, where you can access comprehensive and up-to-date statistics for a variety of basketball players! Whether you're a coach, scout, or simply a basketball enthusiast, our website is the perfect resource to help you compare players and evaluate their performances.</p>
            
            <p class="lead">In addition to comparing individual players, you can also use our website to compare teams and track their performances over time. We offer a range of graphs and charts to help you visualize the data, making it easy to identify trends and patterns.</p>
        </div>
    </main>
    
        <!-- Bootstrap 4 JS dependencies -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

</html>