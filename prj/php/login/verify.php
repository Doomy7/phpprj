<?php
  include_once '../includes/dbinc.php';
  session_start();
  $ID = mysqli_real_escape_string($conn, $_POST['id']);
  $psw = mysqli_real_escape_string($conn, $_POST['password']);
  $type = mysqli_real_escape_string($conn, $_POST['type']);
  if(empty($ID) || empty($psw) || $type=="none"){
    header("Location: login.php?error=00");
    exit();
  }else{
    connect($type, $ID, $psw, $conn);
  }

  function connect($type, $ID, $psw, $conn){
    $stmt = mysqli_stmt_init($conn);
    if($type=="students"){
      $sqlq = "SELECT `username`, `password`, `sid` FROM `$type` WHERE `username` = ? OR `email` = ?;";
    }else if($type=="teachers"){
      $sqlq = "SELECT `username`, `password`, `tid` FROM `$type` WHERE `username` = ? OR `email` = ?;";
    }

    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "ss", $ID, $ID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      if(is_null($row['username'])){
        header("Location: login.php?error=04");
        exit();
      }else{
        if(password_verify($psw, $row['password'])){
          $_SESSION['log_flag'] = $type;
          $_SESSION['name'] = $row['username'];
          if($type=="students"){
            $_SESSION['login'] = $type;
            $_SESSION['id'] = $row['sid'];
            header("Location: ../mains/smain.php?login=success");
            exit();
          }else if ($type="teachers"){
            $_SESSION['login'] = $type;
            $_SESSION['id'] = $row['tid'];
            header("Location: ../mains/tmain.php?login=success");
            exit();
          }

        }else{
          header("Location: login.php?error=04");
          exit();
        }
      }
    }
  }

 ?>
