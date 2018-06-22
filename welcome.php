
 <?php
 session_start();
   include 'mysql_connect.php';
   include 'print_process.php';
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>welcome</title>
    <link rel="stylesheet" href="/welcomestyle.css">
  </head>
  <body>
    <?php if($_SESSION['nick']==NULL){
    echo '<script type="text/javascript">';
  echo 'document.location.replace("/login.php");';
  echo '</script>';
}
   ?>
<p class = "heading">Welcome to your very own notes, <?php echo $_SESSION['nick']; ?></p>




<form class="form"  method="post" action = "welcome.php" id = "form">
  <textarea name="note" id = "textarea" class = "field"></textarea>
<input type="submit" name="submit" value="Add Note" id = "add" class = "addbutton">
<input type="hidden" name="stage" value="noteprocess">
</form>
<div class="check">


<form  action="welcome.php" method="post" id = "check">

  <input type="text" name="check" value="" placeholder="Add" id = "checkadd" class = "checkadd">
  <input type="hidden" name="list" value="listprocess">
  <input type="submit" name="submit" value="Add" class = "listadd">

</form>
</div>

<div class="adduser">
  <form class="addperson" action="welcome.php" method="post">
    <p>Add user</p>
    <input type="text" name="user" value="">
    <input type="hidden" name="addinguser" value="userprocess">
    <input type="submit" name="submit" value="submit">

  </form>

</div>

<?php

 if(isset($_POST['note']) || isset($_GET['editid']))
 process_form();

 else if(isset($_POST['list']) || isset($_GET['listid']))
 process_list();



 function process_form(){
 $time = date("Y-m-d H:i:s");

 $conn = mysqli_connect("localhost", "username","password", "mydb");

 $flag = FALSE;
   $name = $_SESSION['name'];
   if(isset($_GET['editnote'])) $note = $_GET['editnote'];
    else if(isset($_POST['stage'])) $note = $_POST['note'];

   $query = "SELECT NOTES FROM mydb.notestable WHERE NAME = '".$name."'";
   if($note == "")printf("%s", "Note must be non-empty");


   else if($stmt = mysqli_prepare($conn, $query)){
   mysqli_stmt_execute($stmt);
   mysqli_stmt_bind_result($stmt, $string);
   mysqli_stmt_store_result($stmt);



   while(mysqli_stmt_fetch($stmt)){
     if($string==$note && !$flag)
     {
       printf("%s", "<p class = 'error'>Note already exists</p>");
       $flag = TRUE;
   }

}
}



   if(isset($_GET['editid']) && !$flag){

     $query  = "UPDATE mydb.notestable SET NOTES = '".$_GET['editnote']."', EDITED = '".$time."' WHERE ID = '".$_GET['editid']."'";
     if(!mysqli_query($conn, $query)) echo mysqli_error($conn);
     $flag = TRUE;

   }
   else if(!$flag && $note!=""){
     $query = "INSERT INTO mydb.notestable VALUES ('".$name."','".$note."','-1', '".$time."', 'Not yet')";
     mysqli_query($conn, $query);
 }




}

function process_list(){


   $time = date("Y-m-d H:i:s");
  $conn = mysqli_connect("localhost", "username","password", "mydb");
$flag1 = FALSE;
  $name = $_SESSION['name'];
 if(isset($_GET['listid'])) $check = $_GET['check'];
else if(isset($_POST['list']))   $check = $_POST['check'];

  $query = "SELECT CHECKLIST FROM mydb.checktable WHERE NAME = '".$name."'";
  if($check == "")printf("%s", "Checklist individual must be non-empty");


  else if($stmt = mysqli_prepare($conn, $query)){
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $string);
  mysqli_stmt_store_result($stmt);

  while(mysqli_stmt_fetch($stmt)){
    if($string==$check && !$flag1)
    {
      printf("%s", "<p class = 'errorlist'>List already exists</p>");
      $flag1 = TRUE;
  }

}
}


if(isset($_GET['listid']) && !$flag1){

  $query = "UPDATE mydb.checktable SET CHECKLIST = '".$check."', EDITED = '".$time."' WHERE ID = '".$_GET['listid']."'";
  if(!mysqli_query($conn, $query)) echo mysqli_error($conn);
  $flag1 = TRUE;

}

  if(!$flag1 && $check!=""){
    $query = "INSERT INTO mydb.checktable VALUES ('".$name."','".$check."','-1', 'false', '".$time."','Not yet')";
    mysqli_query($conn, $query);
}







}




 printNotes();
 printList();


?>

  </body>

</html>
