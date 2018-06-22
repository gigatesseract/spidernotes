<?php
session_start();
include 'mysql_connect.php';
include 'print_process.php';

 ?>



<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/welcomestyle.css">
    <title>Welcome</title>
  </head>
  <body>
<p class = "heading">Welcome to your very own notes, <?php echo $_SESSION['nick']; ?></p>

    <form class="form"  method="post" action = "welcome.php" id = "form">
      <textarea name="note" rows="8" cols="80" id = "textarea" class = "field"></textarea>
    <input type="submit" name="submit" value="Add Note" id = "addbutton" class = "addbutton">
    <input type="hidden" name="stage" value="noteprocess">
    </form>

    <form class="check" action="welcome.php" method="post" id = "check">

      <input type="text" name="check" value="" placeholder="Add" id = "checkadd" class = "checkadd">
      <input type="hidden" name="list" value="listprocess">
      <input type="submit" name="submit" value="Add List" class = "listadd">

    </form>





    <?php


    function delete_notes(){
    $conn = mysqli_connect("localhost", "username","password", "mydb");
    $id = $_GET['request'];

    $query = "DELETE FROM mydb.notestable WHERE NAME = '".$_SESSION['name']."' AND id = '".$id."'";
    mysqli_query($conn, $query);
  }

  function delete_list(){
    $conn = mysqli_connect("localhost", "username","password", "mydb");
    $id = $_GET['stringdelete'];

    $query = "DELETE FROM mydb.checktable WHERE NAME = '".$_SESSION['name']."' AND id = '".$id."'";
    mysqli_query($conn, $query);
  }


  if(isset($_GET['request'])) delete_notes();
  else if(isset($_GET['stringdelete'])) delete_list();
    printNotes();
    printList();











     ?>
  </body>
</html>
