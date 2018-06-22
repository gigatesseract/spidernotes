<?php
include 'mysql_connect.php';

 ?>


 <?php

function printNotes()
{$conn = mysqli_connect("localhost", "username", "password", "mydb");
  $name = $_SESSION['name'];
  $query = "SELECT NOTES, CREATED, EDITED FROM mydb.notestable WHERE NAME = '".$name."'";
  if($stmt = mysqli_prepare($conn, $query)){
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $string, $created, $edited);
  mysqli_stmt_store_result($stmt);
  $count = mysqli_stmt_num_rows($stmt);
  $i = 1;
    echo '<div class = "div">';
  while(mysqli_stmt_fetch($stmt) && $i<=$count){

  $query = "UPDATE mydb.notestable SET id = '".$i."' WHERE NOTES = '".$string."' ";
  if(!mysqli_query($conn, $query)) printf("%s", "couldnt ");





   $str = "$i";
 echo '<div class = "notecontent">';
   echo '<p>'.$string.'</p>';
   echo '<p class = "time"> Created:- '.$created.'<br>';
   echo 'Edited:- '.$edited.'</p>';
   echo '<form id = "form'.$str.'" method = "get" action = "edit.php">';
   echo '<input type = "submit" name = "edit" id = "'.$str.'edit" value = "Edit" class = "edit" />';
   echo '<input type = "hidden" value = "'.$str.'" name = "request">';
  echo '<input type = "hidden" value = "'.$string.'" name = "stringnotes">';
   echo '</form>';


   echo '<form id = "form'.$str.'" method = "get" action = "delete.php">';
   echo  '<input type = "submit" name = "delete" id = "'.$str.'delete" value = "Delete" class = "delete"/>';
   echo '<input type = "hidden" value = "'.$str.'" name = "request">';
   echo '</form>';
      echo '</div>';
   $i++;
  }
  echo '</div>';
}

}

function printList()
{$conn = mysqli_connect("localhost", "username", "password", "mydb");
  $name = $_SESSION['name'];
  $query = "SELECT CHECKLIST, CHECKSTATUS, CREATED, EDITED FROM mydb.checktable WHERE NAME = '".$name."'";
  if($stmt = mysqli_prepare($conn, $query)){
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $string, $status, $created, $edited);
  mysqli_stmt_store_result($stmt);
  $count = mysqli_stmt_num_rows($stmt);
  $i = 1;
  echo '<div class = "check">';
  while(mysqli_stmt_fetch($stmt) && $i<=$count){

  $query = "UPDATE mydb.checktable SET id = '".$i."' WHERE CHECKLIST = '".$string."' ";
  if(!mysqli_query($conn, $query)) printf("%s", "couldnt ");





   $str = "$i";
   echo '<div class = "listcontent">';
   echo '<form action = "check.php" method = "GET">';
   echo '<input type = "radio" onclick = "this.form.submit()" name = "listid" value = "'.$str.'"';
    if($status=='true')
    echo ' checked><del>'.$string.'</del>';
   else echo '>'.$string;
   echo '</form>';
   echo '<p class = "time"> Created:- '.$created.'<br>';
   echo 'Edited:- '.$edited.'</p>';




   echo '<form id = "form'.$str.'" method = "get" action = "edit.php">';
   echo  '<input type = "submit" name = "edit id = "'.$str.'edit" value = "Edit" class = "edit"/>';
   echo '<input type = "hidden" value = "'.$str.'" name = "requestcheck">';
    echo '<input type = "hidden" value = "'.$string.'" name = "stringlist">';
   echo '</form>';

   echo '<form id = "form'.$str.'" method = "get" action = "delete.php">';
   echo  '<input type = "submit" name = "delete" id = "'.$str.'delete" value = "Delete" class = "delete" />';
   echo '<input type = "hidden" value = "'.$str.'" name = "stringdelete">';
   echo '</form>';

   // echo '<form id = "form'.$str.'" method = "get" action = "check.php">';
   // echo '<input type = "submit" name = "check" id = "'.$str.'check" value = "Check" class = "checkb"/>';
   // echo '<input type = "hidden" value = "'.$str.'" name = "requestcheck">';
   // echo '</form>';


   // echo '<form id = "form'.$str.'" method = "get" action = "check.php">';
   // echo  '<input type = "submit" name = "uncheck" id = "'.$str.'uncheck" value = "Uncheck" class = "uncheck"/>';
   // echo '<input type = "hidden" value = "'.$str.'" name = "requestuncheck">';
   // echo '</form>';




   echo '</div>';



   $i++;
  }
}
 echo '</div>';

}


 ?>
