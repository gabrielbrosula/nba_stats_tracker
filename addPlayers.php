#!/usr/local/bin/php
<?php
    $conn = new mysqli('mysql.cise.ufl.edu', 'v.torres1', '123456789abcd', 'NBASTATS');
    //$conn = new mysqli('mysql.cise.ufl.edu', 's.mclaughlin', 'Summer2020', 'Player');

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
    echo "<div class='jumbotron justify-content-center'>";
    echo "<table class ='play text-white'>";
    echo "<thead><h2 style='text-align: center; color:white;'>$teamname</h2></thead>";
        echo "<tbody>
            <tr>";
            $count = 0;
            while($row = $result->fetch_assoc())
            {
                $count = $count + 1;
                $playerid = $row["id"];
                $playersql = "SELECT img_url FROM PlayerImage WHERE player_id = $playerid";
                $re = $conn->query($playersql);
                $resu = $re->fetch_assoc();
                $firstName = $row["first_name"];
                $lastName = $row["last_name"];
                $player = "$firstName $lastName";
                $url = $resu["img_url"];
                if($url == ""){
                    $url="images/playerImages/default.png";
                }
                echo "<td class=d><img src='$url' width='138' height='100'><a href='search.php?searchInput=$playerid&playerName=$player'>$firstName $lastName</a></td>";
                if($count%3 == 0)
                {
                    echo "</tr>";
                }
            }
            echo "</tr> </tbody>";
    echo "</table>";
    echo "</div>";
?>
