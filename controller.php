<?php include("con.php");
  $select_state = mysqli_query($con,"SELECT * FROM `car_move`");
  $row_state = mysqli_fetch_assoc($select_state);
  $state = $row_state["faruri"];
?>
<html>
  <head>
    <style>
        table{
          margin-top: 6%;
        }
        button{
            width: 120px;
            height: 120px;
        }
        .green{
            background-color: green;
        }
        .red{
            background-color: red;
        }
        #gps_run_data{
          margin-top: 1.5%;
        }
    </style>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script>
      $(document).ready(function(){
        setInterval(function(){
          $.post("gps_run.php",{},function(data,status){
            $("#gps_run_data").html(data);
          });
        },500);
      });
      function run(i) {
        $.post("ajax_controller.php",{
          send_direction: 1,
          direction: i
        },function(data,status){
          $('#response').html(data);
        });
      }
      function change_headlight_state(){
        var state = $("#headlight").attr("state") == '1' ? "0" : "1";
        $.post("ajax_controller.php",{
          change_headlight_state : 1,
          state: state
        },function(data,status){
          $("#headlight").html(data);
          $("#headlight").attr("state",state);
        });
      }
    </script>
  </head>
  <body>
    <center>
      <table border='2'>
        <div id="response"></div>
        <tr>
            <td></td>
            <td><button onclick="run(1)" class="green">forward</button></td>
            <td></td>
        </tr>
        <tr>
            <td><button onclick="run(3)" class="green">left</button></td>
            <td><button onclick="run(5)" class="red">stop</button></td>
            <td><button onclick="run(4)" class="green">right</button></td>
        </tr>
        <tr>
            <td></td>
            <td><button onclick="run(2)" class="green">backwards</button></td>
            <td><button state="<?php echo $state; ?>" id="headlight" onclick="change_headlight_state()">Headlights: <?php echo $state == '1' ? 'On' : "Off"; ?></button></td>
        </tr>
    </table>
    <div id="gps_run_data"></div>
    </center>
  </body>
</html>
