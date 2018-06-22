<?php
session_start();
include 'print_process.php';
include 'mysql_connect.php';

 ?>



<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="/welcomestyle.css">
  </head>
  <body>

<p class = "heading">Welcome to your very own notes, <?php echo $_SESSION['nick']; ?></p>

    <form class="form"  method="get" action = "welcome.php" id = "form">
      <textarea name="editnote" rows="8" cols="80" id = "textarea" class = "field"></textarea>
    <input type="submit" name="submit" value="Add Note" id = "addbutton" class = "addbutton">
    <?php
    if(isset($_GET['request']))
    echo '<input type="hidden" name="editid" value="'.$_GET['request'].'">';
        else echo '<input type="hidden" name="note" value="noteprocess">';


     ?>
    </form>
    <form class="check" action="welcome.php" method="get" id = "check">

      <input type="text" name="check" value="" placeholder="Add" id = "checkadd" class = "checkadd">
      <?php
      if(isset($_GET['requestcheck']))
      echo '<input type="hidden" name="listid" value="'.$_GET['requestcheck'].'">';
      else echo '<input type="hidden" name="list" value="listprocess">';

       ?>

      <input type="submit" name="submit" value="Add Checklist" id = "listbutton">

    </form>

    <?php

  // if(isset($_GET['request'])
  // edit_notes();
  // else if isset($_GET['requestcheck'])
  // edit_list();



   function edit_notes(){
     $conn = mysqli_connect("localhost", "username","password", "mydb");

      echo '<script type="text/javascript">';
        if(isset($_GET['request'])){
          echo 'document.getElementById("checkadd").value = "Cannot add checklist when editing a note";';
        echo 'document.getElementById("checkadd").disabled = "true";';
        echo 'document.getElementById("listbutton").disabled = "true";';
      }
      echo 'document.getElementById("textarea").textContent ="'.$_GET['stringnotes'].'";';
      echo 'document.getElementById("notesbutton").value = "Save Changes";';
      echo '</script>';
}


function edit_list(){
$conn = mysqli_connect("localhost", "username","password", "mydb");

     echo '<script type="text/javascript">';
       if(isset($_GET['requestcheck'])){
         echo 'document.getElementById("textarea").value = "Cannot add note when editing a checklist";';
       echo 'document.getElementById("textarea").disabled = "true";';
         echo 'document.getElementById("addbutton").disabled = "true";';


       }
     echo 'document.getElementById("checkadd").value ="'.$_GET['stringlist'].'";';
     echo 'document.getElementById("listbutton").value = "Save Changes";';
     echo '</script>';

}
  if(isset($_GET['request'])) edit_notes();
  else if (isset($_GET['requestcheck'])) edit_list();
printNotes();
printList();

     ?>


  </body>
</html>
