<?php
  session_start();
  #FLAG CHECK
  if($_SESSION["log_flag"] != "admins"){
    header("Location: ../logout.php");
  }
 ?>
