<?php include('con.php');

$select = mysqli_query($con,"SELECT * FROM `car_move` WHERE `token` = '2222'");
$row = mysqli_fetch_assoc($select);

$array = array(
  1 => (int)$row["fata"],
  2 => (int)$row["spate"],
  3 => (int)$row["stanga"],
  4 => (int)$row["dreapta"],
  5 => (int)$row["stop"],
  6 => (int)$row["faruri"],
  7 => (int)$row["far_gps"]
);

$out = array_values($array);
$json = json_encode($out);

echo $json;

?>
