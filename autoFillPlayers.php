#!/usr/local/bin/php
<?php
    $conn = mysqli_connect('mysql.cise.ufl.edu', 'v.torres1', '123456789abcd', 'NBASTATS');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // search term --> i.e., the partial name input
    $term = $_GET["term"];
    $sql = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM Player WHERE CONCAT(first_name, ' ', last_name) LIKE '%".$term."%' ORDER BY name ASC";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {
        $data[] =$row["name"];
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    ?>