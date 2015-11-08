<?php include('con.php');



if(isset($_POST['token'])){
  
  $token = mysqli_real_escape_string($con, $_POST['token']);
  $lat = mysqli_real_escape_string($con, $_POST['lat']);
  $lon = mysqli_real_escape_string($con, $_POST['lon']);
  $speed = mysqli_real_escape_string($con, $_POST['speed']);
  $altitude = mysqli_real_escape_string($con, $_POST['altitude']);
  
  $eps = mysqli_real_escape_string($con, $_POST['eps']);
  $epx = mysqli_real_escape_string($con, $_POST['epx']);
  $epv = mysqli_real_escape_string($con, $_POST['epv']);
  $ept = mysqli_real_escape_string($con, $_POST['ept']);
  
  $query = "INSERT INTO `gps_logs` (`token`,`lat`,`lon`,`speed`,`altitude`,`timestamp`,`eps`,`epx`,`epv`,`ept`) 
                         VALUES ('$token','$lat','$lon','$speed','$altitude','".date('Y-m-d H:i:s')."','$eps','$epx','$epv','$ept')";
  
  if(mysqli_query($con, $query)){
    
    $select_logs = mysqli_query($con, "SELECT * FROM `gps_logs`");
    $num = mysqli_num_rows($select_logs);
  
    echo "Found $num rows in database!";
    
  }else{
    echo "Error!!!";
  }
                         
  var_dump($_POST);                       
  
  
}

mysqli_close($con);

?>
