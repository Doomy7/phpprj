<?php
  session_start();
  if($_GET['login'] == "teachers"){
    header("Location: php/tmain.php?id=".$_GET['id']);
  }else if($_GET['login'] == "students"){
    header("Location: php/smain.php?id=".$_GET['id']);
  }else{
    header("Location: login.php");
  }
 ?>
