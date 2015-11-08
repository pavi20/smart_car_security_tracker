<?php session_start();
  if(isset($_SESSION["user_id"])){
    header("Location: admin_panel.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Register Page</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <script>
      function send_register_data(){
        var name = $("#name").val();
        var username = $("#username").val();
        var password = $("#password").val();
        $.post("register_login.php",{
          send_register_data : 1,
          name : name,
          username : username,
          password : password
        },function(data,status){
          if(!data){
            window.location.replace("login.php");
          } else window.location.reload();
        });
      }
    </script>
    <style>
      html,body{
        background: url('http://zebu.ro/media/catalog/product/cache/1/thumbnail/500x500/b38cf51ec77170b109c5e310157197eb/c/o/cool-harta-lumii-2.png') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
      #login{
        width:80%;
        height:70%;
        position:absolute;
        top:25%;
        margin-left: 10%;
      }
      #header{
        border-radius: 20px 20px 0 0;
        background: grey;
      }
      #content{
        background: yellow;
        padding-left: 4.5%;
        padding-top: 2%;
        padding-bottom: 2%;
      }
      #footer{
        padding-top: 1.5%;
        padding-bottom: 1.5%;
        background: grey;
      }
      #content input{
        display: block;
      }
      button{
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="login" class="container-fluid">
      <div id="header" class="container-fluid">
        <h1>Register</h1>
      </div>
      <div id="content" class="container-fluid">
        <div class="input-group" style="width: 92%">
          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
          <input id="name" type="text" class="form-control" placeholder="Name" aria-describedby="basic-addon1"/>
        </div>
        <div class="input-group" style="width: 92%">
          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></span>
          <input id="username" type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1"/>
        </div>
        <div class="input-group" style="width: 92%">
          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
          <input id="password" type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1"/>
        </div>
      </div>
      <div id="footer" class="container-fluid">
        <button onclick="send_register_data()" type="button" class="btn btn-default">Submit</button>
      </div>
    </div>
  </body>
</html>
