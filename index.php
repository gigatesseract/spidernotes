<?php
   include 'mysql_connect.php';
 ?>

<html>
<head>
  <link rel="stylesheet" href="/loginstyle.css">
<title>Welcome!!!!!</title>
</head>
<body>
  <h1>
<p class = "heading">Welcome to Notes Manager. </p>
<ul class = "list" >
  You can.....
  <li>Create an account in Notes Manager</li>
  <li>Create your own notes, checklist. </li>
  <li>Save them, and log in for future reference</li>
</ul>
</h1>
<p class = "sign">Click <a href="signup.php"> here </a> to sign up.</p>

<p class = "log">Already have an account? click <a href="login.php">  here </a> to log in! </p>
<?php


if(!$conn) die('Connection failed '.mysqli_connect_error());

?>
</body>
</html>
