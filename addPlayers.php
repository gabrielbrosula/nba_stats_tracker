#!/usr/local/bin/php
<?php
    $conn = new mysqli('mysql.cise.ufl.edu', 'v.torres1', '123456789abcd', 'NBASTATS');

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $teamid = $_GET["id"];
    $teamsql = "SELECT full_name FROM Team Where id = $teamid";
    $res = $conn->query($teamsql);
    $r = $res->fetch_assoc();
    $teamname = $r["full_name"];
    $sql = "SELECT * FROM Player Where team = $teamid";

    $result = $conn->query($sql);
    echo "<table class ='play text-white'>";
    echo "<thead><h3 style='text-align: center; color:white;'>$teamname</h3></thead>";
        echo "<tbody>
            <tr>";
            $count = 0;
            while($row = $result->fetch_assoc())
            {
                $count = $count + 1;
                $playerid = $row["id"];
                $firstName = $row["first_name"];
                $lastName = $row["last_name"];
                echo "<td class=d>$firstName $lastName</td>";
                if($count%5 == 0)
                {
                    echo "</tr>";
                }
            }
            echo "</tr> </tbody>";
    echo "</table>";
?>
