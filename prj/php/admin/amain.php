<?php
  session_start();
  #FLAG CHECK
  if($_SESSION["log_flag"] == "teachers"){
    header("Location: ../logout.php");
  }
 ?>
