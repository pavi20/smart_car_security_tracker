<?php session_start();
  if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
  }
?>
<html>
    <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous"/>
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
      <script>
      $(document).ready(function(){
          $.post("dst.php",{
            get_distance : 1,
            user_id : "<?php echo $_SESSION["user_id"]; ?>"
          },function(data,status){
            $.post("tasks_ajax.php",{
              get_tasks : 1,
              user_id : "<?php echo $_SESSION["user_id"]; ?>",
              distance : data
            },function(data,status){
              $('#result').html(data);
            });
          });
          setInterval(function(){
            $.post("dst.php",{
              get_distance : 1,
              user_id : "<?php echo $_SESSION["user_id"]; ?>"
            },function(data,status){
              $.post("tasks_ajax.php",{
                get_tasks : 1,
                user_id : "<?php echo $_SESSION["user_id"]; ?>",
                distance : data
              },function(data,status){
                $('#result').html(data);
              });
            });
          },2000);
        });
        function sign_out(){
          $.post("register_login.php",{
            sign_out : 1
          },function(data,status){
            window.location.replace("login.php");
          });
        }
        function activation(nr_row){
          var id = 'activation'+nr_row;
          var state = $("#"+id).attr('state') == '1' ? '0' : '1';
          var token = $("#"+id).attr('token');
          $.post("tasks_ajax.php",{
            activation : 1,
            state : state,
            token : token
          },function(data,status){
            window.location.reload();
          });
        }
        function data_logs(token){
          window.open("ati_maps/test_maps.php?token="+token);
        }
        function remove_task(token){
          $.post("tasks_ajax.php",{
            remove_task : 1,
            token : token
          },function(data,status){
            window.location.reload();
          });
        }
      </script>
      <style>
        #sign_out{
          float: right;
          font-size: 120%;
        }
      </style>
    </head>
    <body>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <button id="sign_out" onclick="sign_out()" class="btn btn-primary">Sign Out</button>
                        <center>
                          <img src="img/header.png" style='display:inline-block;'/>
                            <h4 style='display:inline-block;'>Welcome to the admin interface, <?php echo $_SESSION["username"];  ?></h4>
                        </center>
                    </div>
                </div>
                
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="admin_panel.php">Admin Task</a></li>
                    <li role="presentation"><a href="admin_task_panel.php">Admin Task Adder</a></li>
                    <li role="presentation"><a href="controller.php">Admin Controller Panel</a></li>
                </ul>
                <div class="panel panel-default">
                    <div class="panel-body" id="result">
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <center>
                            &copy;Junior-Web Developement Team
                        </center>
                    </div>
                </div>
            </div>

        </div>

    </body>

</html>
