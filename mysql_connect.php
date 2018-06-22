<?php

$username = "username";
$servername = "localhost";
$password = "password";
$dbname = "login";
  $query = "CREATE TABLE mydb.logintable (NAME char(20) PRIMARY KEY, PASSWORD char(20), NICKNAME char(20))";
$conn = mysqli_connect($servername, $username,$password);
mysqli_query($conn, $query);


$query = "CREATE TABLE mydb.notestable (NAME char(20), NOTES char(140), id char(20), CREATED char(100), EDITED char(100))";
mysqli_query($conn, $query);

$query = "CREATE TABLE mydb.checktable (NAME char(20), CHECKLIST char(140), id char(20), CHECKSTATUS char(20), CREATED char(100), EDITED char(100))";
mysqli_query($conn, $query);

$conn = mysqli_connect($servername, $username, $password, "mydb");


 ?>
