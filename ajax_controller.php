<?php include("con.php");
  if(isset($_POST["send_direction"])){
    $token = 2222;
    $direction = $_POST["direction"];
    switch($direction){
      case "1":{
        mysqli_query($con,"UPDATE `car_move` SET `fata` = '1',`spate`='0',`stanga`='0',`dreapta`='0',`stop`='0' WHERE `token` = '$token'");
        echo "Fata !";
      } break;
      case "2":{
        mysqli_query($con,"UPDATE `car_move` SET `fata` = '0',`spate`='1',`stanga`='0',`dreapta`='0',`stop`='0' WHERE `token` = '$token'");
        echo "Spate !";
      } break;
      case "3":{
        mysqli_query($con,"UPDATE `car_move` SET `fata` = '0',`spate`='0',`stanga`='1',`dreapta`='0',`stop`='0' WHERE `token` = '$token'");
        echo "Stanga !";
      } break;
      case "4":{
        mysqli_query($con,"UPDATE `car_move` SET `fata` = '0',`spate`='0',`stanga`='0',`dreapta`='1',`stop`='0' WHERE `token` = '$token'");
        echo "Dreapta !";
      } break;
      default:{
        mysqli_query($con,"UPDATE `car_move` SET `fata` = '0',`spate`='0',`stanga`='0',`dreapta`='0',`stop`='0' WHERE `token` = '$token'");
        echo "Stop !";
      }
    }
  }
  if(isset($_POST["change_headlight_state"])){
    $state = $_POST["state"];
    if($state == "1") {
      mysqli_query($con,"UPDATE `car_move` SET `faruri` = '1' WHERE `token` = '2222'");
      echo "Headlights: On";
    } else {
      mysqli_query($con,"UPDATE `car_move` SET `faruri` = '0' WHERE `token` = '2222'");
      echo "Headlights: Off";
    }
  }
?>
