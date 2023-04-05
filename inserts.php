<?php 

/*
$file = fopen('inserts.txt', 'a');
$page_num = 0;
$total_pages= 1;
while($page_num < $total_pages){
  $url = "https://www.balldontlie.io/api/v1/players?page=$page_num?&per_page=10";
  echo $url;
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  $response = curl_exec($ch);
  
  if ($response === false) {
      echo "Error at $page_num: " . curl_error($ch);
  } else {
      $json_data = json_decode($response, true);
      // Do something with the JSON data here
  
      print_r($json_data["meta"]["next_page"]) ;
      echo "<br>";
  
      print_r($json_data["meta"]["total_pages"]) ;
      echo "<br>";  
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
        
        $sql_insert = "INSERT INTO Player (id, first_name, last_name, position, team, height_feet, height_inches, weight_pounds) VALUES ('$id', '$first_name', '$last_name', '$position', '$team_id', '$height_feet', '$height_inches', '$weight_pounds');";
        $sql_insert .= PHP_EOL;
        fwrite($file, $sql_insert);
      }
      $page_num +=1;
  }
  curl_close($ch);
  fclose($file);
}*/


?>