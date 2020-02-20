<?php
  session_start();
  include_once "includes/dbinc.php";
  if($_SESSION["log_flag"] == "students"){
    header("Location: smain.php");
  }else if ($_SESSION["log_flag"] != "teachers"){
    header("Location: ../main.php");
  }

  print_students($conn);

  function print_students($conn){
    $stmt = mysqli_stmt_init($conn);
    $sqlq = "SELECT * FROM `students`;";

    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      while($row = mysqli_fetch_assoc($result)){
        print_r($row);
      }
    }
  }
 ?>
