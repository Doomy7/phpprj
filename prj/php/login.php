<?php
  include_once 'includes/dbinc.php';
  session_start();
  $ID = mysqli_real_escape_string($conn, $_POST['id']);
  $psw = mysqli_real_escape_string($conn, $_POST['password']);
  $type = mysqli_real_escape_string($conn, $_POST['type']);
  if(empty($ID) || empty($psw) || $type=="none"){
    header("Location: ../login.php?error=00");
    exit();
  }else{
    connect($type, $ID, $psw, $conn);
  }

  function connect($type, $ID, $psw, $conn){
    $stmt = mysqli_stmt_init($conn);
    $sqlq = "SELECT `username`, `password` FROM `$type` WHERE `username` = ? OR `email` = ?;";
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "ss", $ID, $ID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      if(is_null($row['username'])){
        header("Location: ../login.php?error=04");
        exit();
      }else{
        if(password_verify($psw, $row['password'])){
          $_SESSION['log_flag'] = $type;
          $_SESSION['name'] = $row['username'];
          header("Location: ../main.php?login=".$type);
          exit();
        }else{
          header("Location: ../login.php?error=05");
          exit();
        }
      }
    }
  }

 ?>
