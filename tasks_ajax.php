<?php include("con.php");
  if(isset($_POST["get_tasks"])){
    $dst = $_POST["distance"];
    $user_id = $_POST["user_id"];
    $select_tasks = mysqli_query($con,"SELECT * FROM `gps_task` WHERE `id_user` = '$user_id'");
    $table = "<center><table class='table' style='font-weight: bolder; color: #0E0F0F;'>";
    $table.="<thead>";
      $table.="<th>Nr</th>";
      $table.="<th>Token</th>";
      $table.="<th>Fixed latitude</th>";
      $table.="<th>Fixed longitude</th>";
      $table.="<th>Name</th>";
      $table.="<th>Description</th>";
      $table.="<th>Action</th>";
      $table.="<th>Area</th>";
      $table.="<th>Distance to mobile device</th>";
      $table.="<th>Map</th>";
      $table.="<th></th>";
    $table.="</thead>";
    $table.="<tbody>";
      $nr_row = 1;
      while($row_task = mysqli_fetch_array($select_tasks)){
        $red = "background: #ff3019; /* Old browsers */
                background: -moz-linear-gradient(top,  #ff3019 0%, #cf0404 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ff3019), color-stop(100%,#cf0404)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  #ff3019 0%,#cf0404 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  #ff3019 0%,#cf0404 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  #ff3019 0%,#cf0404 100%); /* IE10+ */
                background: linear-gradient(to bottom,  #ff3019 0%,#cf0404 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#cf0404',GradientType=0 ); /* IE6-9 */
                ";
        $green = "background: #9dd53a; /* Old browsers */
                background: -moz-linear-gradient(top,  #9dd53a 0%, #a1d54f 50%, #80c217 100%, #7cbc0a 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#9dd53a), color-stop(50%,#a1d54f), color-stop(100%,#80c217), color-stop(100%,#7cbc0a)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 100%,#7cbc0a 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 100%,#7cbc0a 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 100%,#7cbc0a 100%); /* IE10+ */
                background: linear-gradient(to bottom,  #9dd53a 0%,#a1d54f 50%,#80c217 100%,#7cbc0a 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9dd53a', endColorstr='#7cbc0a',GradientType=0 ); /* IE6-9 */
                ";
        $color = $row_task["active"] == '1' ? $green : $red;
        $table.="<tr>";
        foreach($row_task as $key => $value) {
          if($key != "id_user" && !is_numeric($key)) {
            if($key == 'active'){
              $table.="<td style='background-color: $color;'><button id='activation$nr_row' token='".($row_task["token"])."' state='$value' onclick='activation($nr_row)' class='btn btn-warning'>".($value == '1' ? 'Deactivate' : 'Activate')."</button></td>";
            } else {
              if($key == 'area'){
                $table.="<td style='background-color: $color;'>".$value."m</td>";
              } else $table.="<td style='background-color: $color;'>".$value."</td>";
              if($key == 'area'){
                //here comes the distance.
                $table.="<td style='background-color: $color'>".$dst."</td>";
                $table.="<td style='background-color: $color'><button onclick='data_logs(".($row_task["token"]).")' class='btn btn-warning'>Data logs</button></td><td style='background-color: $color;'><div onclick='remove_task(".($row_task["token"]).")'>&#10006;</div></td>";
              } 
            }
          }
        }
        $table.="</tr>";
        $nr_row++;
      }
      $table.="</tbody>";
    $table.="</table></center>";
    echo $table; 
  }
  if(isset($_POST["save_task"])){
    $id_user = $_POST["id_user"];
    $token = $_POST["token"];
    $name = mysqli_real_escape_string($con,$_POST["name"]);
    $fix_lat = $_POST["latitude"];
    $fix_lon = $_POST["longitude"];
    $description = mysqli_real_escape_string($con,$_POST["description"]);
    $area = mysqli_real_escape_string($con,$_POST["area"]);
    mysqli_query($con,"INSERT INTO `gps_task` (`id_user`,`token`,`fix_lat`,`fix_lon`,`name`,`description`,`active`,`area`) VALUES ('$id_user','$token','$fix_lat','$fix_lon','$name','$description','$active','$area')");
  }
  if(isset($_POST["activation"])){
    $token = $_POST["token"];
    $state = $_POST["state"];
    mysqli_query($con,"UPDATE `gps_task` SET `active` = '$state' WHERE `token` = '$token'");
  }
  if(isset($_POST["remove_task"])){
    $token = $_POST["token"];
    mysqli_query($con,"DELETE FROM `gps_task` WHERE `token` = '$token'");
  }
?>
