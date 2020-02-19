<?php
  session_start();
  if($_GET['login'] == "teachers"){
    header("Location: php/tmain.php");
  }else if($_GET['login'] == "students"){
    header("Location: php/smain.php");
  }else{
    header("Location: login.php");
  }
 ?>
