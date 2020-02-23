<?php
  session_start();
  include '../includes/dbinc.php';
  #FLAG CHECK
  if($_SESSION["log_flag"] != "admins"){
    header("Location: ../logout.php");
  }

  if(isset($_POST[key($_POST)])){

    $index = explode("_", key($_POST));
    if($_POST[key($_POST)] == "ACCEPT"){
      echo($index[0]." ".$index[1]." ACCEPTED");
      $name = $_SESSION[$index[0]][$index[1]]['name'];
      $surname = $_SESSION[$index[0]][$index[1]]['surname'];
      $email = $_SESSION[$index[0]][$index[1]]['email'];
      $password = $_SESSION[$index[0]][$index[1]]['password'];
      $username = $_SESSION[$index[0]][$index[1]]['username'];
    }else if($_POST[key($_POST)] == "REJECT"){
      echo($index[0]." ".$index[1]." REJECTED");
      $name = $_SESSION[$index[0]][$index[1]]['name'];
      $surname = $_SESSION[$index[0]][$index[1]]['surname'];
      $email = $_SESSION[$index[0]][$index[1]]['email'];
      $password = $_SESSION[$index[0]][$index[1]]['password'];
      $username = $_SESSION[$index[0]][$index[1]]['username'];
      $message = "Admin ".$_SESSION['name']." rejected ".$name." ".$surname." ".$email." ".$username." registration as ".$index[0]."!";
      $log_time = date("Y/m/d") . ' ' . date("h:i:sa");
      $stmt = mysqli_stmt_init($conn);
      $type = $index[0]."_verify";
      $sqlq = "DELETE FROM `$type` WHERE `vid` = ?;";
      if(!mysqli_stmt_prepare($stmt, $sqlq)){
        echo 'SQL ERROR';
      }else{
        mysqli_stmt_bind_param($stmt, "i", $index[1]);
        mysqli_stmt_execute($stmt);
      }
      logit($conn, $message, $log_time);
      header("Location: verify_pending.php");
      exit();
    }

    #name	surname	email	password	username
    #print_r($_SESSION[$index[0]][$index[1]]);
  }

  function logit($conn, $message, $log_time){
    $stmt = mysqli_stmt_init($conn);
    $sqlq = "INSERT INTO `activity_log` (`log`, `time`) VALUES (?, ?);";
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "ss", $message, $log_time);
      mysqli_stmt_execute($stmt);
    }
  }
 ?>
