<?php
  session_start();
  include '../includes/dbinc.php';
  #FLAG CHECK
  if($_SESSION["log_flag"] != "admins"){
    header("Location: ../logout.php");
  }

  if(isset($_POST[key($_POST)])){
    #SPLIT NAME OF SUBMIT BUTTON TO GET THE TABLE AND INDEX TO MANIPULATE
    $index = explode("_", key($_POST));
    if($_POST[key($_POST)] == "ACCEPT"){
      #IF ACCEPTED COPY THE ENTRY FROM THE VERIFICATION TABLE TO MAIN TABLE
      copy_query($index, $conn);
      #DELETE THE ENTRY FROM VERIFICATION
      delete($index, $conn, $_POST[key($_POST)]);
      header("Location: verify_pending.php");
      exit();

    }else if($_POST[key($_POST)] == "REJECT"){
      #ON REJECTION DELETE THE ENTRY FROM VERIFICATION
      delete($index, $conn, $_POST[key($_POST)]);
      header("Location: verify_pending.php");
      exit();
    }

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

  function delete($index, $conn, $action){
    $name = $_SESSION[$index[0]][$index[1]]['name'];
    $surname = $_SESSION[$index[0]][$index[1]]['surname'];
    $email = $_SESSION[$index[0]][$index[1]]['email'];
    $password = $_SESSION[$index[0]][$index[1]]['password'];
    $username = $_SESSION[$index[0]][$index[1]]['username'];
    $stmt = mysqli_stmt_init($conn);
    $type = $index[0]."_verify";
    $sqlq = "DELETE FROM `$type` WHERE `vid` = ?;";
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "i", $index[1]);
      mysqli_stmt_execute($stmt);
    }
    if($action == "ACCEPT"){
      $message = $name." ".$surname." ".$email." ".$username." added as ".$index[0]."!";
      $log_time = date("Y/m/d") . ' ' . date("h:i:sa");
      logit($conn, $message, $log_time);
    }else if($action == "REJECT"){
      $message = "Admin ".$_SESSION['name']." rejected ".$name." ".$surname." ".$email." ".$username." registration as ".$index[0]."!";
      $log_time = date("Y/m/d") . ' ' . date("h:i:sa");
      logit($conn, $message, $log_time);
    }

  }

  function copy_query($index, $conn){
    $name = $_SESSION[$index[0]][$index[1]]['name'];
    $surname = $_SESSION[$index[0]][$index[1]]['surname'];
    $email = $_SESSION[$index[0]][$index[1]]['email'];
    $password = $_SESSION[$index[0]][$index[1]]['password'];
    $username = $_SESSION[$index[0]][$index[1]]['username'];
    $stmt = mysqli_stmt_init($conn);
    $type = $index[0]."_verify";
    $sqlq = "INSERT INTO `$index[0]` (`name`, `surname`, `email`, `password`, `username`) SELECT `name`, `surname`, `email`, `password`, `username` from $type where `vid` = ?;";
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "i", $index[1]);
      mysqli_stmt_execute($stmt);
    }
    $message = "Admin ".$_SESSION['name']." accepted ".$name." ".$surname." ".$email." ".$username." registration as ".$index[0]."!";
    $log_time = date("Y/m/d") . ' ' . date("h:i:sa");
    logit($conn, $message, $log_time);
  }
 ?>
