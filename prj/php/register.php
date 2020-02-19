<?php


  if(isset($_POST['submit'])){

    include_once "includes/dbinc.php";
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surn = mysqli_real_escape_string($conn, $_POST['surname']);
    $un = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass1 = mysqli_real_escape_string($conn, $_POST['password']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $id = mysqli_real_escape_string($conn, $_POST['type']);

    if(empty($name) || empty($surn) || empty($un) || empty($email) || empty($pass1) || empty($pass2) || $id == "none"){
      header("Location: ../signup.php?error=0");
      exit();
    }else if ($pass1 !== $pass2){
      header("Location: register.php?error=3");
      exit();
    }else if(!preg_match("/^[a-zA-Z0-9]*$/", $un)){
      header("Location: register.php?error=5");
      exit();
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: register.php?error=4");
      exit();
    }else if(!filter_var($passrem, FILTER_SANITIZE_STRING)){
      header("Location: register.php?error=8");
      exit();
    }else{

      //email check
      $stmt1 = mysqli_stmt_init($conn);
      $sqlq1 = "SELECT * FROM `users` WHERE `email` = ?";
      if(!mysqli_stmt_prepare($stmt1, $sqlq1)){
        echo 'SQL ERROR';
      }else{
        mysqli_stmt_bind_param($stmt1, "s", $email);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_store_result($stmt1);
        $result_check = mysqli_stmt_num_rows($stmt1);
        if($result_check>0){
          header("Location: register.php?error=1");
          exit();
        }
      }

      //userName check
      $sqlq2 = "SELECT * FROM `users` WHERE `userName` = ?";
      $stmt2 = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt2, $sqlq2)){
        echo 'SQL ERROR';
      }else{
        mysqli_stmt_bind_param($stmt2, "s", $un);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_store_result($stmt2);
        $result_check = mysqli_stmt_num_rows($stmt2);
        if($result_check>0){
          header("Location: register.php?error=2");
          exit();
        }
      }

      //insert query
      $sqlq3 = "INSERT INTO `users` (`userName`, `email`, `password`) VALUES (?, ?, ?);";
      $pswhash = passWord_hash($pass1, PASSWORD_DEFAULT);
      $stmt3 = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt3, $sqlq3)){
        echo 'SQL ERROR';
      }else{
        mysqli_stmt_bind_param($stmt3, "sss", $un, $email, $pswhash);
        mysqli_stmt_execute($stmt3);
        $sqlq4 = "INSERT INTO `reminder` (`uid`, `remText`) VALUES ((SELECT `id` from `users` where `userName` = ?),?)";
        $stmt4 = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt4, $sqlq4)){
          echo 'SQL ERROR';
        }else{
          mysqli_stmt_bind_param($stmt4, "ss", $un, $passrem);
          mysqli_stmt_execute($stmt4);
          header("Location: ../Welcome.php?signup=success");
          exit();
        }
      }
    }
  }

 ?>
