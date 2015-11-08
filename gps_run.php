<?php include('con.php');

  $test_area_fix = 2;
  
  function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km') {
       $theta = $longitude1 - $longitude2;
       $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
       $distance = acos($distance);
       $distance = rad2deg($distance);
       $distance = $distance * 60 * 1.1515; switch($unit) {
            case 'Mi': break; case 'Km' : $distance = $distance * 1.609344;
       }
       return (round($distance,3));
  }
  
  echo "<h2>Live user data:</h2>";
  echo "<hr />";
  $select_gps_task = mysqli_query($con, "SELECT * FROM `gps_task` WHERE `active` = '1'");
  while($row_gps_task = mysqli_fetch_array($select_gps_task)){
    $select_gps_mobil = mysqli_query($con, "SELECT * FROM `gps_logs` WHERE `token` = '".$row_gps_task['token']."' ORDER BY `timestamp` DESC LIMIT 1");
    $row_gps_mobil = mysqli_fetch_assoc($select_gps_mobil);
    
    echo "GPS MOBIL ---><strong>".$row_gps_mobil['lat']." -- ".$row_gps_mobil['lon']."</strong> <br />";
    echo "GPS FIX ---><strong>".$row_gps_task['fix_lat']." -- ".$row_gps_task['fix_lon']."</strong> <br />";
    echo "The defined area by the user: <strong> ".$row_gps_task['area']." Meters </strong><br />";
    
    $distance = number_format(getDistanceBetweenPointsNew($row_gps_mobil['lat'], $row_gps_mobil['lon'], $row_gps_task['fix_lat'], $row_gps_task['fix_lon'], 'Km') * 1000, 0);
    
    echo "The distance is : <strong>".$distance."</strong> Meters<br />";
    
    if($distance > $row_gps_task['area']){
    //if($distance > $test_area_fix){
      echo "<strong>The car has been stolen!!!!!</strong><br/>";
      //mail('borzatamas00@gmail.com','Your car has been stolen !',"Your car's exact location is:".$row_gps_mobil['lat'].",".$row_gps_mobil['lon']."");
      mysqli_query($con, "UPDATE `car_move` SET `far_gps`='1' WHERE `Id` = '1'");
      mysqli_query($con, "UPDATE `car_move` SET `far_gps`='1', `fata` = '0', `spate` = '0', `dreapta` = '0', `stanga` = '0' WHERE `Id` = '1'");
      mysqli_query($con, "UPDATE `car_move` SET `far`='1' WHERE `Id` = '1'");
    }else{
      echo "<strong>Everything is ok!!</strong><br/>";
      mysqli_query($con, "UPDATE `car_move` SET `far_gps` = '0' WHERE `Id` = '1'");
    }
  }  

?>
