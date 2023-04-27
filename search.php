#!/usr/local/bin/php

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
    <link rel="stylesheet" href="styles.css">

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
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="search.php">Search Player</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="compare.php">Compare Players</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="explore.php">Explore Teams</a>
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
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Team</th>
                </tr>
            </thead>
            <tbody id="playerTable">
                <!-- Add your search results as table rows here -->
                <tr>
                    <td>LeBron</td>
                    <td>James</td>
                    <td>Los Angeles Lakers</td>
                </tr>
                <tr>
                    <td>Stephen</td>
                    <td>Curry</td>
                    <td>Golden State Warriors</td>
                </tr>
                <tr>
                    <td>Kevin</td>
                    <td>Durant</td>
                    <td>Brooklyn Nets</td>
                </tr>
                <tr>
                    <td>James</td>
                    <td>Harden</td>
                    <td>Brooklyn Nets</td>
                </tr>
                <tr>
                    <td>Damian</td>
                    <td>Lillard</td>
                    <td>Portland Trail Blazers</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <script>
        $(document).ready(function () {
            $("#searchInput").on("keyup", function () {
                let value = $(this).val().toLowerCase();
                $("#playerTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMxrn/ITSMAChbeE9eTc"></script>
        