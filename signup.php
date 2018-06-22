<?php
   include 'mysql_connect.php';
   ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign up!!</title>
    <link rel="stylesheet" href="/loginstyle.css">
  </head>
  <body>
<p class = "heading"> Sign UP!!!</p>
<?php


function print_form(){
  echo '<div class = "loginform">';
  echo '<form class="form" action="/signup.php" method="post">';
  echo '<p class = "username"> Enter your username here:- </p>';
  echo  '<input type="text" name="name" placeholder="enter your name here"> <br>';
  echo    '<p class = "username"> Enter your nickname:-</p>';
  echo '<input type="text" name="nick" > <br>';
  echo '<p class = "username"> Enter your password                          :-      </p>';
  echo    '<input type="password" name="password" value="">';
  echo '<input type="hidden" name="stage" value="process">';
  echo    '<input type="submit" name="submit" value="submit">';
  echo    '</form>';
  echo '</div>';


}

if(isset($_POST['stage']) && $_POST['stage']=='process')
process_form();
else print_form();

function process_form(){
  $conn = mysqli_connect("localhost", "username","password", "mydb");

  $name = $_POST['name'];
  $nick = $_POST['nick'];
  $password = crypt($_POST['password'], '34');


  $query = "INSERT INTO mydb.logintable VALUES ('".$name."','".$password."','".$nick."')";


    if(!mysqli_query($conn, $query))
    {
      echo '<h1>Name already exists</h1>';
      print_form();
    }
  else {
    echo '<script type="text/javascript">';
  echo 'document.location.replace("/login.php")';
  echo '</script>';
}
}
 ?>
 <p class = "log">Already have an account? click <a href="login.php">  here </a> to log in! </p>
  </body>
</html>
