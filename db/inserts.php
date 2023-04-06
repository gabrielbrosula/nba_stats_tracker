
<?php 
/*
Dont run this file. Gets data from balldontlieapi into txt scripts so that I can insert into the mysql through command line
*/
function playerInserts(){
    /*CREATE TABLE Player (
      id INT(10) NOT NULL,
      first_name VARCHAR(30),
      last_name VARCHAR(30),
      position VARCHAR(5),
      height_feet INT(1),
      height_inches INT(2),
      weight_pounds INT(3),
      team INT(10),
      PRIMARY KEY (id)
  );
  */
  $file = fopen('player_inserts.txt', 'a');
  $page_num = 0;
  $total_pages= 100;
  while($page_num < $total_pages){
    $url = "https://www.balldontlie.io/api/v1/players?page=$page_num?&per_page=10";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    if ($response === false) {
        echo "Error at $page_num: " . curl_error($ch);
    } else {
        $json_data = json_decode($response, true);
        // Do something with the JSON data here

        $players = $json_data['data'];
        foreach ($players as $player){
          $id = $player["id"];
          $first_name = $player["first_name"];
          $last_name = $player["last_name"];
          $position = $player["position"];
          $team_id = $player["team"]["id"];
          $height_feet = $player["height_feet"];
          $height_inches = $player["height_inches"];
          $weight_pounds = $player["weight_pounds"];
          if($id && $first_name && $last_name && $position && $team_id && $height_feet && $height_inches && $weight_pounds){
            $sql_insert = "INSERT INTO Player (id, first_name, last_name, position, team, height_feet, height_inches, weight_pounds) VALUES ('$id', '$first_name', '$last_name', '$position', '$team_id', '$height_feet', '$height_inches', '$weight_pounds');";
            $sql_insert .= PHP_EOL;
            fwrite($file, $sql_insert);
          }
        }
        $page_num +=1;
        echo $page_num . '<br>';
    }
    curl_close($ch);
  }
  fclose($file);
}


function teamInserts(){
    /*CREATE TABLE Team (
    id INT(2) NOT NULL,
    abbreviation VARCHAR(5),
    city VARCHAR(30),
    division VARCHAR(15),
    full_name VARCHAR(30),
    name VARCHAR(30),
    PRIMARY KEY (id)
  );
  */
  $file = fopen('team_inserts.txt', 'a');
  $url = "https://www.balldontlie.io/api/v1/teams";

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  $response = curl_exec($ch);
  if ($response === false) {
    echo "Error:" . curl_error($ch);
  } else {
      $json_data = json_decode($response, true);
      $teams = $json_data['data'];
      foreach ($teams as $team) {
        $id = $team['id'];
        $abbreviation = $team['abbreviation'];
        $city = $team['city'];
        $division = $team['division'];
        $full_name = $team['full_name'];
        $name = $team['name'];
        if($id && $abbreviation && $city && $division && $full_name && $name) {
          $sql_insert = "INSERT INTO Teams (id, abbreviation, city, division, full_name, name)  VALUES ('$id', '$abbreviation','$city', '$division', '$full_name', '$name');";
          $sql_insert .= PHP_EOL;
          fwrite($file, $sql_insert);
        }
      }
      curl_close($ch);
    }
  fclose($file);
}

function getAverages($pid){
    /*
  CREATE TABLE Stat (
  player_id INT(10) NOT NULL,
  games_played INT(2),
  season INT(4),
  min VARCHAR(10),
  fgm FLOAT,
  fga FLOAT,
  fg3m FLOAT,
  fg3a FLOAT,
  ftm FLOAT,
  fta FLOAT,
  oreb FLOAT,
  dreb FLOAT,
  reb FLOAT,
  ast FLOAT,
  stl FLOAT,
  blk FLOAT,
  turnover FLOAT,
  pf FLOAT,
  pts FLOAT,
  fg_pct FLOAT,
  fg3_pct FLOAT,
  ft_pct FLOAT,
  PRIMARY KEY (player_id)
);
*/
  $file = fopen('stat_inserts.txt', 'a');
  $url = "https://www.balldontlie.io/api/v1/season_averages?season=2022&player_ids[]=$pid";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);


  if ($response === false) {
    echo "Error:" . curl_error($ch);
  } else {
      $json_data = json_decode($response, true);
      print_r( $json_data["data"]);
      $stats = $json_data['data'];
      foreach ($stats as $stat) {
        $games_played = $stat['games_played'];
        $player_id = $stat['player_id'];
        $min = $stat["min"];
        $fgm = $stat["fgm"];
        $fga = $stat["fga"];
        $fg3m = $stat["fg3m"];
        $fg3a = $stat["fg3a"];
        $ftm = $stat["ftm"];
        $fta = $stat["fta"];
        $oreb = $stat["oreb"];
        $dreb = $stat["dreb"];
        $reb = $stat["reb"];
        $ast = $stat["ast"];
        $stl = $stat["stl"];
        $blk = $stat["blk"];
        $turnover = $stat["turnover"];
        $pf = $stat["pf"];
        $pts = $stat["pts"];
        $fg_pct = $stat["fg_pct"];
        $fg3_pct = $stat["fg3_pct"];
        $ft_pct = $stat["ft_pct"];


        $sql_insert = "INSERT INTO Stats (games_played, player_id, min, fgm, fga, fg3m, fg3a, ftm, fta, oreb, dreb, reb, ast, stl, blk, turnover, pf, pts, fg_pct, fg3_pct, ft_pct) VALUES ('$games_played', '$player_id', '$min', '$fgm', '$fga', '$fg3m', '$fg3a', '$ftm', '$fta', '$oreb', '$dreb', '$reb', '$ast', '$stl', '$blk', '$turnover', '$pf', '$pts', '$fg_pct', '$fg3_pct', '$ft_pct');";
        $sql_insert .= PHP_EOL;

        fwrite($file, $sql_insert);

      }
      
      curl_close($ch);
    }
  fclose($file);
}

?>