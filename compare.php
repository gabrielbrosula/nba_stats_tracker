#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Compare NBA Players</title>
</head>
<style>
    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff; 
        border-bottom: 1px solid #d4d4d4; 
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9; 
    }

    .submit-btn {
        background-color: #FF7F50;
        color: #FFFFFF;
        border: none;
        padding: 10px 30px;
        border-radius: 5px;
    }   

    .submit-btn i {
        font-size: 30px;
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
            <li class="nav-item">
                <a class="nav-link" href="explore.php">Explore Teams</a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="container p-3 my-5 text-black rounded text-center position-relative">
        <div class="float-right">
            <img src="nbaLogo.png" style="width: 55px; height: 45px;">
        </div>
        <h2>Welcome to the NBA Player Comparison page.</h2>
    </div>
    <!-- TODO: add in some type of validation to make sure that the spelling of the name is correct. Maybe some type of prepopulation -->
    <?php
    // // Check if the user was redirected due to invalid player names
    // if (isset($_GET['error']) && $_GET['error'] == 'invalid_names') {
    //     echo "Please enter valid player names.";
    // }

    // Add the form here for the user to enter the player names
    ?>
    <script>
        $(document).ready(function(){
            $("#player-search").autocomplete({
                source: "autoFillPlayers.php",
                minLength: 2, // minimum characters before search
                select: function(event, ui) {
                    $("#player-search").val(ui.item.value);
                    return false;
                }
            });
        });
    </script>
    <div class="container p-3 my-5 text-black rounded text-center">
        <!-- <label for="player-search">Search for a player:</label>
        <input type="text" id="player-search" name="player-search"> -->
        <form action="compareResults.php" class="form-vertical ui-widget" method="post">
            <div class="row">
                <div class="col mx-0"> 
                    <!-- <input class="form-outline w-100 autocomplete" type="text" id="players" placeholder="Enter Player 1's first name..." value="" name="player1" required> -->
                    <label for="player1">Player 1: </label>
                    <input type="text" id="player1" name="player1" placeholder="Enter Player 1's name..." autocomplete="off">
                    <div id="suggestions"></div>
                </div>

                <div class="col">  
                    <!-- <input type="text" id="playerw" placeholder="Enter Player 2's first name..."value="" name="player2" required> -->
                    <label for="player2">Player 2: </label>
                    <input type="text" id="player2" name="player2" placeholder="Enter Player 2's name..."autocomplete="off">
                </div>
            </div>
                <div class="row pt-5 justify-content-center">
                    <button type="submit" class="submit-btn">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>  
        </form>
    </div>
    <script>
        $(document).ready(function() {
            // set up autocomplete for player1 field
            $("#player1").autocomplete({
                source: "autoFillPlayers.php",
                minLength: 2,
                select: function(event, ui) {
                    $("#player1").val(ui.item.value);
                    return false;
                }
            });

            // set up autocomplete for player2 field
            $("#player2").autocomplete({
                source: "autoFillPlayers.php",
                minLength: 2,
                select: function(event, ui) {
                    $("#player2").val(ui.item.value);
                    return false;
                }
            });
        });
    </script>
    <!-- TODO: add error cheecking for incorrect names entered -->

    <!-- Bootstrap 4 JS dependencies -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS-->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>