<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
	     .login-form {
         width: 340px;
         margin: 50px auto;
       }
       .login-form form {
    	    margin-top: 150px;
          background: #f7f7f7;
          box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
          padding: 30px;
        }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
    <form action="loginform.php" method="post">
        <h2 class="text-center">Log in</h2>
        <div class="form-group">
            <input name="Username" type="text" class="form-control" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input name="Password" type="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
    </form>
</div>
</body>
</html>
<?php
  require 'connect.inc.php';
  session_start();
  if(isset($_POST['submit'])&&isset($_POST['Username'])&&isset($_POST['Password'])){
      if(!empty($_POST['Username'])&&!empty($_POST['Password'])){
        $username=$_POST['Username'];
        $password=$_POST['Password'];
        $query1 = "SELECT `username`,`password` FROM `users` WHERE `username`='".$username."' AND `password`='".$password."' ";
        $query1_run = mysql_query($query1);

          if(@mysql_num_rows($query1_run)==NULL){
             echo "Wrong Credidentials!";
          }
          else{
              echo "Success";
              $_SESSION['Username']=$username;

              echo "<script language='javascript' type='text/javascript'> location.href='home.php' </script>";
            }
      }
      else{
        echo "Enter all details!";
      }
    }
 ?>
