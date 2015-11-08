<?php include("con.php");
      session_start();
  if(isset($_POST["send_register_data"])){
    $name = mysqli_real_escape_string($con,$_POST["name"]);
    $username = mysqli_real_escape_string($con,$_POST["username"]);
    $password = mysqli_real_escape_string($con,$_POST["password"]);
    if(!mysqli_query($con,"INSERT INTO `gps_user` (`user`,`password`,`nume_prenume`) VALUES ('$username','$password','$name')")){
      echo "unexp";
    }
  }
  if(isset($_POST["send_login_data"])){
    $username = mysqli_real_escape_string($con,$_POST["username"]);
    $password = mysqli_real_escape_string($con,$_POST["password"]);
    $select_user = mysqli_query($con,"SELECT * FROM `gps_user` WHERE `user` = '$username' AND `password` = '$password'");
    $row_user = mysqli_fetch_assoc($select_user);
    if(mysqli_num_rows($select_user)){
      $_SESSION["user_id"] = $row_user["Id"];
      $_SESSION["username"] = $row_user["nume_prenume"];
    } else {
      echo "undexp";
    }
  }
  if(isset($_POST["sign_out"])){
    session_start();
    session_destroy();
  }
?>
