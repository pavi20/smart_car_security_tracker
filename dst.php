<?php include("con.php");
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
  if(isset($_POST["get_distance"])){
    $user_id = $_POST["user_id"];
    $select_gps_tasks = mysqli_query($con,"SELECT * FROM `gps_task` WHERE `id_user` = '$user_id'");
    $row_task = mysqli_fetch_assoc($select_gps_tasks);
    $lat1 = $row_task["fix_lat"];
    $lon1 = $row_task["fix_lon"];
    $token = $row_task["token"];
    $select_gps_logs = mysqli_query($con,"SELECT * FROM `gps_logs` WHERE `token` = '$token' ORDER BY `Id` DESC LIMIT 1;");
    $row_gps_log = mysqli_fetch_assoc($select_gps_logs);
    $lat2 = $row_gps_log["lat"];
    $lon2 = $row_gps_log["lon"];
    echo (getDistanceBetweenPointsNew($lat1,$lon1,$lat2,$lon2)*1000)."m";
  }
?>
