<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Compare NBA Players</title>
</head>
<style>
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
            </ul>
        </div>
    </nav>

    <div class="container p-3 my-5 text-black rounded text-center position-relative">
        <div class="float-right">
            <img src="nbaLogo.png" style="width: 55px; height: 45px;">
        </div>
        <h2>Welcome to the NBA Player Comparison page.</h2>
    </div>

    <div class="container p-3 my-5 text-black rounded text-center">
        <form action="compareResults.php" class="form-vertical" method="post">
            <div class="row">
                <div class="col mx-0"> 
                    <!-- <label for="player1">Enter Player 1:</label> -->
                    <input class="form-outline w-100" type="text" placeholder="Enter Player 1's first name..." value="" name="player1">
                </div>

                <div class="col">  
                    <!-- <label for="player2">Enter Player 2:</label> -->
                    <input class="form-outline w-100" type="text" placeholder="Enter Player 2's first name..."value="" name="player2">
                </div>
            </div>
                <div class="row pt-5 justify-content-center">
                    <button type="submit" class="submit-btn">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>  
        </form>
    </div>

    <!-- Bootstrap 4 JS dependencies -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>