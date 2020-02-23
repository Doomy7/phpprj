<?php

  include "../includes/dbinc.php";

  if(isset($_POST['submit'])){
    #INIT REQUIRED VALUES
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surn = mysqli_real_escape_string($conn, $_POST['surname']);
    $un = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);
    $id = mysqli_real_escape_string($conn, $_POST['type']);
    #admin registration
    if($name == "admin" && empty($un) && empty($email)){
      #flag for enabling admin id
      if(empty($id)){
          header("Location: signup.php?admin=1");
          exit();
      }else{
        header("Location: signup.php");
        exit();
      }
      #second submission requires email and username fields for checking
    }else{
        admin_routine($conn, $email, $un);
        #admin normally will have preexisting password hashes for verification
        #header("Location: signup.php?message=please type your verification password&secret=1");
        #exit();

    }
    #IF ERROR RETURN WITH ERROR NUMBER (REUSED FOR ADMIN REGISTRATION)
    if(empty($name) || empty($surn) || empty($un) || empty($email) || empty($pass1) || empty($pass2) || $id == "none"){
      header("Location: signup.php?error=00");
      exit();
    }else if ($pass1 !== $pass2){
      header("Location: signup.php?error=01");
      exit();
    }else if(!preg_match("/^[a-zA-Z0-9]*$/", $un)){
      header("Location: signup.php?error=02");
      exit();
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: signup.php?error=03");
      exit();
    }

    if($id == "admins"){
      register_Admin($name, $surn, $email, $pass1, $un, $id, $conn);
      header("Location: signup.php?message=Admin Registered");
      exit();
    }else{
      mail_un_routine($conn, $email, $un);
      insert($name, $surn, $email, $pass1, $un, $id, $conn);
    }
  }

  function admin_routine($conn, $email, $un){
    #filtering inputs and checking other tables for user and email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: signup.php?error=03");
      exit();
    }else if(!preg_match("/^[a-zA-Z0-9]*$/", $un)){
      header("Location: signup.php?error=02");
      exit();
    }else{
      #special check for admins
      check_email("admins",$conn, $email);
      check_username("admins", $conn, $un);
      mail_un_routine($conn, $email, $un);
    }
  }

  function mail_un_routine($conn, $email, $un){
    #CHECK BOTH TABLES IF EMAIL OR USERNAME EXISTS
    check_email("students",$conn, $email);
    check_email("teachers", $conn, $email);
    check_username("students", $conn, $un);
    check_username("teachers", $conn, $un);
  }

  #EMAIL CHECK
  function check_email($type, $conn, $email){
    $sqlq = "SELECT * FROM `$type` WHERE `email` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $result_check = mysqli_stmt_num_rows($stmt);
      if($result_check>0){
        header("Location: signup.php?error=05");
        exit();
      }
    }
  }

  #USERNAME CHECK
  function check_username($type, $conn, $un){
    //userName check
    $sqlq = "SELECT * FROM `$type` WHERE `username` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "s", $un);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $result_check = mysqli_stmt_num_rows($stmt);
      if($result_check>0){
        header("Location: signup.php?error=06");
        exit();
      }
    }
  }

  #INSERT IN VERIFICATION TABLES
  # TBA : ADMINISTRATOR WILL VERIFY IF STUDENT/TEACHER AND INSERT THEM TO PRIVILIGED TABLES
  function insert($name, $surn, $email, $pass1, $un, $id, $conn){
    //insert query
    if($id == "teachers"){
      $sqlq = "INSERT INTO `teachers_verify` (`name`, `surname`, `email`, `password`, `username`, `time`) VALUES (?, ?, ?, ?, ?, ?);";
    }else if($id == "students"){
      $sqlq = "INSERT INTO `students_verify` (`name`, `surname`, `email`, `password`, `username`, `time`) VALUES (?, ?, ?, ?, ?, ?);";
    }
    $pswhash = passWord_hash($pass1, PASSWORD_DEFAULT);
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      $reg_time = date("Y/m/d") . ' ' . date("h:i:sa");
      mysqli_stmt_bind_param($stmt, "ssssss", $name, $surn, $email, $pswhash, $un, $reg_time);
      mysqli_stmt_execute($stmt);
      #VERIFICATION NOTICE
      header("Location: ../../main.php?signup=Please_wait_for_system_verification");
      exit();
    }
  }

  function register_Admin($name, $surn, $email, $pass1, $un, $id, $conn){
    $sqlq = "INSERT INTO `admins` (`name`, `surname`, `email`, `password`, `username`) VALUES (?, ?, ?, ?, ?);";
    $pswhash = passWord_hash($pass1, PASSWORD_DEFAULT);
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "sssss", $name, $surn, $email, $pswhash, $un);
      mysqli_stmt_execute($stmt);
      #VERIFICATION NOTICE
      header("Location: ../../main.php?signup=success");
      exit();
    }
  }


 ?>
