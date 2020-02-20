<?php
  session_start();
  include "../includes/dbinc.php";
  if(isset($_POST['change'])){
    $new_mark = mysqli_real_escape_string($conn, $_POST['nmark']);

    if(empty($new_mark)){
      header("Location: modify_marks.php?error=08");
    }else if ($new_mark > 100 || $new_mark < 0){
      header("Location: modify_marks.php?error=07");
    }else{
      change_mark($conn, $new_mark, $_SESSION['student'], $_SESSION['lesson']);
    }
  }else if(isset($_POST['Add'])){
    echo($_SESSION['student']);
    echo("Adding new Lesson");
    exit();
  }

  function change_mark($conn, $new_mark, $sid, $lid){

    $stmt = mysqli_stmt_init($conn);
    $sqlq = "UPDATE `marks` SET `mark` = ? WHERE `sid` = ? AND `lid` = ?;";
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo("Hi");
      exit();
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "iii", $new_mark, $sid, $lid);
      mysqli_stmt_execute($stmt);
      header("Location : marks.php?change=success");
      exit();
    }
  }

  function add_lesson($type, $conn, $un){

  }

 ?>
