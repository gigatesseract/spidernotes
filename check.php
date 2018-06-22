<?php
session_start();
include 'mysql_connect.php';
include 'print_process.php';

 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Welcome</title>
     <link rel="stylesheet" href="/welcomestyle.css">
   </head>
   <body>
     <p class = "heading">Welcome to your very own notes, <?php echo $_SESSION['nick']; ?></p>

     <form class="form"  method="post" action = "welcome.php" id = "form">
       <textarea name="note" rows="8" cols="80" id = "textarea" class = "field"></textarea>
     <input type="submit" name="submit" value="Add Note" id = "add" class = "addbutton">
     <input type="hidden" name="stage" value="noteprocess">
     </form>

     <form class="check" action="welcome.php" method="post" id = "check">

       <input type="text" name="check" value="" placeholder="Add" id = "checkadd" class = "checkadd">
       <input type="hidden" name="list" value="listprocess">
       <input type="submit" name="submit" value="Add">

     </form>


<?php

function check_notes(){

  $conn = mysqli_connect("localhost", "username","password", "mydb");
  $id = $_GET['listid'];
  $query = "SELECT CHECKSTATUS FROM mydb.checktable WHERE ID = '".$id."'";
  if($stmt = mysqli_prepare($conn, $query)){
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $status);
  mysqli_stmt_store_result($stmt);
  mysqli_stmt_fetch($stmt);
  echo $status;
  if($status=="true")
  {
    $query = "UPDATE mydb.checktable SET CHECKSTATUS = 'false' WHERE ID = '".$id."'";
    if(!mysqli_query($conn, $query)) echo mysqli_error($conn);
  }
  else if($status == 'false')
  {
    $query = "UPDATE mydb.checktable SET CHECKSTATUS = 'true' WHERE ID = '".$id."'";
    if(!mysqli_query($conn, $query)) echo mysqli_error($conn);

  }

}
}

// function uncheck_notes(){
//   $conn = mysqli_connect("localhost", "username","password", "mydb");
//   $id =$_GET['requestuncheck'];
//   $query =  "UPDATE mydb.checktable SET CHECKSTATUS = 'false' WHERE ID = '".$id."'";
//   mysqli_query($conn, $query);
// }

if(isset($_GET['listid'])) check_notes();
//else if(isset($_GET['requestuncheck'])) uncheck_notes();
printNotes();
printList();
 ?>

   </body>
 </html>
