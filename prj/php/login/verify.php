<?php
  include_once '../includes/dbinc.php';
  session_start();
  #GET MAIN VARIABLES
  $ID = mysqli_real_escape_string($conn, $_POST['id']);
  $psw = mysqli_real_escape_string($conn, $_POST['password']);
  $type = mysqli_real_escape_string($conn, $_POST['type']);
  #BASIC CHECK
  if($ID == "admin"){
    header("Location: login.php?admin=1");
    exit();
  }else if($type == 'admins'){
    $secret = mysqli_real_escape_string($conn, $_POST['secret']);
    if(empty($ID) || empty($psw) || $type=="none" || empty($secret)){
      header("Location: login.php?error=00");
      exit();
    }else{
      $stmt = mysqli_stmt_init($conn);
      $sqlq = "SELECT `aid`, `username`, `password`, `hash` FROM `admins`, `admin_hashes` WHERE `username` = ? OR `email` = ? AND `aid`= `hash_id`;";
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
          #IF PASSWORD CORRECT
          if(password_verify($psw, $row['password'])){
            #$_SESSION FLAGS FOR SECURITY
            if($secret == $row['hash']){
              $_SESSION['log_flag'] = $type;
              $_SESSION['name'] = $row['username'];
              #BASED ON TYPE REDIRECTED TO RESPECTED MAIN PAGES
              $_SESSION['login'] = $type;
              $_SESSION['id'] = $row['aid'];
              header("Location: ../admin/amain.php?login=success");
              exit();
            }else{
              header("Location: login.php?error=10");
            }
          #ERROR FOR MISMATCH PASSWORD
          }else{
            header("Location: login.php?error=04");
            exit();
          }
        }
      }
    }

  }else{
    if(empty($ID) || empty($psw) || $type=="none"){
      header("Location: login.php?error=00");
      exit();
    }else{
      connect($type, $ID, $psw, $conn);
    }
  }

  function connect($type, $ID, $psw, $conn){
    #BUILD QUERY BASED ON $type
    $stmt = mysqli_stmt_init($conn);
    if($type=="students"){
      $sqlq = "SELECT `username`, `password`, `sid` FROM `$type` WHERE `username` = ? OR `email` = ?;";
    }else if($type=="teachers"){
      $sqlq = "SELECT `username`, `password`, `tid` FROM `$type` WHERE `username` = ? OR `email` = ?;";
    }
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      #BIND VARIABLES
      mysqli_stmt_bind_param($stmt, "ss", $ID, $ID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      #ERROR FOR NO RESULT
      if(is_null($row['username'])){
        header("Location: login.php?error=04");
        exit();
      }else{
        #IF PASSWORD CORRECT
        if(password_verify($psw, $row['password'])){
          #$_SESSION FLAGS FOR SECURITY
          $_SESSION['log_flag'] = $type;
          $_SESSION['name'] = $row['username'];
          #BASED ON TYPE REDIRECTED TO RESPECTED MAIN PAGES
          if($type=="students"){
            #SESSION login, id
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
        #ERROR FOR MISMATCH PASSWORD
        }else{
          header("Location: login.php?error=04");
          exit();
        }
      }
    }
  }

 ?>
