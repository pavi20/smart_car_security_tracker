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
        function send_form_data(){
          navigator.geolocation.getCurrentPosition(GetLocation);
          function GetLocation(location) {
            var token = $("#token").val();
            var name = $("#name").val();
            var description = $("#description").val();
            var area = $("#area").val();
            var latitude = location.coords.latitude;
            var longitude = location.coords.longitude;
            $.post("tasks_ajax.php",{
              save_task : 1,
              token : token,
              name : name,
              description : description,
              area : area,
              latitude : latitude,
              longitude : longitude,
              id_user : "<?php echo $_SESSION['user_id']; ?>"
            },function(data,status){
              var location = '<div class="input-group" style="width: 92%"><span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></span><input type="text" class="form-control" value="'+ latitude +'" aria-describedby="basic-addon1" readonly></div>';
                  location+= '<div class="input-group" style="width: 92%"><span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></span><input type="text" class="form-control" value="'+ longitude +'" aria-describedby="basic-addon1" readonly></div>';
              $("#get_location").html(location);
              //alert(data);
            });
          }
        }
        function sign_out(){
          $.post("register_login.php",{
            sign_out : 1
          },function(data,status){
            window.location.replace("login.php");
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
                    <li role="presentation" ><a href="admin_panel.php">Admin Task</a></li>
                    <li role="presentation" class="active"><a href="admin_task_panel.php">Admin Task Adder</a></li>
                                        <li role="presentation"><a href="controller.php">Admin Controller Panel</a></li>
                </ul>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <center>
                          <div class="input-group" style="width: 92%">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-screenshot" aria-hidden="true"></span></span>
                            <input id="token" type="text" class="form-control" value="<?php echo rand(100000,999999); ?>" aria-describedby="basic-addon1" readonly="">
                          </div>
                          <div id="get_location"></div>
                          <div class="input-group" style="width: 92%">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></span>
                            <input id="name" type="text" class="form-control" placeholder="Name" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group" style="width: 92%">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-text-color" aria-hidden="true"></span></span>
                            <input id="description" type="text" class="form-control" placeholder="Description" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group" style="width: 92%">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-record" aria-hidden="true"></span></span>
                            <input id="area" type="text" class="form-control" placeholder="Area" aria-describedby="basic-addon1">
                          </div>
                          <button onclick="send_form_data()" class="btn btn-success" style="margin-top: 0.5%; width: 91%;">Send</button>
                        </center>
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
