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

    <!-- pt-5 adds padding to the top; helps separate nav bar from player comparison page -->
    <div class="d-flex justify-content-center pt-5"> 
         <!-- left image -->
        <div class="col-md-2 text-center">
            <img src="playerImages/kevinDurant.png" class="img-fluid">
        </div>

        <div class="col-md-6">
            <div class="container">
                <table class="table table-hover text-black ">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kevin Durant</th>
                            <th>Lebron James</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>PPG</td>
                        <td>29.1</td>
                        <td>28.9</td>
                    </tr>
                    <tr>
                        <td>RPG</td>
                        <td>6.7</td>
                        <td>8.3</td>
                    </tr>
                    <tr>
                        <td>APG</td>
                        <td>5.0</td>
                        <td>6.8</td>
                    </tr>
                    <tr>
                        <td>FG%</td>
                        <td>56.0%</td>
                        <td>50.0%</td>
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