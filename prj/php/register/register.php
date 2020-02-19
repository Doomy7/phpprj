<?php

  include_once "../includes/dbinc.php";

  if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surn = mysqli_real_escape_string($conn, $_POST['surname']);
    $un = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);
    $id = mysqli_real_escape_string($conn, $_POST['type']);

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
    }else{
      check_email("students", $id, $conn);
      check_email("teachers", $id, $conn);
      check_username("students", $id, $conn);
      check_username("teachers", $id, $conn);
      exit();
    }
    insert($name, $surn, $email, $pass1, $un, $id, $conn);
  }

  function check_email($type, $id, $conn){
    $sqlq = "SELECT * FROM `$type` WHERE `email` = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $result_check = mysqli_stmt_num_rows($stmt);
      echo($result_check);
      if($result_check>0){
        if($type == "student"){
          if($type != $id){
            header("Location: signup.php?error=3");
            exit();
          }else{
            header("Location: signup.php?error=1");
            exit();
          }
        }else if($type == "teacher"){
          if($type != $id){
            header("Location: signup.php?error=4");
            exit();
          }else{
            header("Location: signup.php?error=2");
            exit();
          }
        }
      }
    }
  }

  function check_username($type, $id, $conn){
    //userName check
    $sqlq = "SELECT * FROM `$type` WHERE `username` = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "s", $un);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $result_check = mysqli_stmt_num_rows($stmt);
      if($result_check>0){
        if($type == "student"){
          if($type != $id){
            header("Location: signup.php?error=7");
            exit();
          }else{
            header("Location: signup.php?error=5");
            exit();
          }
        }else if($type == "teacher"){
          if($type != $id){
            header("Location: signup.php?error=8");
            exit();
          }else{
            header("Location: signup.php?error=6");
            exit();
          }
        }
      }
    }
  }

  function insert($name, $surn, $email, $pass1, $un, $id, $conn){
    //insert query
    if($id == "teachers"){
      $sqlq = "INSERT INTO `teachers_verify` (`name`, `surname`, `email`, `password`, `username`) VALUES (?, ?, ?, ?, ?);";
      $message = "Please wait 24hours for an administrator to verify you are a teacher";
    }else{
      $sqlq = "INSERT INTO `students_verify` (`name`, `surname`, `email`, `password`, `username`) VALUES (?, ?, ?, ?, ?);";
      $message = "Please wait 24hours for an administrator to verify you are a student";
    }
    $pswhash = passWord_hash($pass1, PASSWORD_DEFAULT);
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "sssss", $name, $surn, $email, $pswhash, $un);
      mysqli_stmt_execute($stmt);
      header("Location: ../../main.php?signup=".$message);
      exit();
    }
  }


 ?>
