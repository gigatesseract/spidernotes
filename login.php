<?php
session_start();
include 'mysql_connect.php';

 ?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="/loginstyle.css">
  </head>
  <body>
<p class = "heading"> Log in</p>
    <?php

    function print_form(){
      echo '<div class = "loginform">';
    echo  '<form class="login" action="login.php" method="post">';
    echo '<p class =  "username"> Enter your username:-    </p>';
    echo   '<input type="text" name="username" value="" placeholder="Enter your username"><br>';
    echo '<p class =  "username"> Enter your password:- </p>';
      echo '<input type="password" name="password" value="">';
      echo '<input type="hidden" name="stage" value="loginprocess"><br>';
      echo '<input type = "submit" name = "submit" value = "submit">';
     echo '</form>';
     echo '</div>';
    }

    function process_form(){

       $conn = mysqli_connect("localhost", "username","password", "mydb");
      $query = "SELECT NAME, PASSWORD FROM mydb.logintable where NAME = '".$_POST['username']."'";
      if($stmt = mysqli_prepare($conn, $query)){
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $name, $password);
      while(mysqli_stmt_fetch($stmt));

      if($_POST['username']==$name && crypt($_POST['password'],'34')== $password)
      { $query = "SELECT NICKNAME FROM mydb.logintable where NAME = '".$_POST['username']."'";
        if($stmt = mysqli_prepare($conn, $query))
        {

          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt, $nick);
          mysqli_stmt_fetch($stmt);
          $_SESSION['nick'] = $nick;
          $_SESSION['name'] = $_POST['username'];
        }



        echo '<script type="text/javascript">';
      echo 'document.location.replace("/welcome.php")';
      echo '</script>';
      }
      else {
        echo '<h1>Username or password is incorrect. </h1>';
        print_form();
      }

    }
  }

    if(isset($_POST['stage']) && $_POST['stage']=='loginprocess')
    process_form();
    else print_form();

     ?>
<p class = "sign">Don't have an account? Click <a href="signup.php"> here </a> to sign up.</p>
  </body>
</html>
