<?php
  session_start();
  include "../includes/dbinc.php";
  if(isset($_POST['change'])){
    $new_mark = mysqli_real_escape_string($conn, $_POST['nmark']);
    #CHECK FOR NEW VALUE
    if(empty($new_mark) && strval($new_mark) != "0"){
      header("Location: modify_marks.php?error=08");
    }else if ($new_mark > 100 || $new_mark < 0){
      header("Location: modify_marks.php?error=07");
    }else if(filter_var($new_mark, FILTER_VALIDATE_INT) === "0"|| !filter_var($new_mark, FILTER_VALIDATE_INT)){
      header("Location: modify_marks.php?error=09");
    }else{
      change_mark($conn, $new_mark, $_SESSION['student'], $_SESSION['lesson_id']);
    }
  }else if(isset($_POST['Add'])){
    // TBA (?)
    echo($_SESSION['student']);
    echo("Adding new Lesson");
    exit();
  }

  function change_mark($conn, $new_mark, $sid, $lid){
    #UPDATE MARK
    $stmt = mysqli_stmt_init($conn);
    $sqlq = "UPDATE `marks` SET `mark` = ? WHERE `sid` = ? AND `lid` = ?;";
    if(!mysqli_stmt_prepare($stmt, $sqlq)){
      echo 'SQL ERROR';
    }else{
      mysqli_stmt_bind_param($stmt, "iii", $new_mark, $sid, $lid);
      mysqli_stmt_execute($stmt);
      $stmt = mysqli_stmt_init($conn);
      $sqlq = "INSERT INTO `activity_log` (`log`, `time`) VALUES (?, ?);";
      if(!mysqli_stmt_prepare($stmt, $sqlq)){
        echo 'SQL ERROR';
      }else{
        $message = "Teacher ".$_SESSION['name']." made following changes. Student: ".$_SESSION['student_name']." New mark: ".$new_mark." On Lesson: ".$_SESSION['target_lesson'];
        $log_time = date("Y/m/d") . ' ' . date("h:i:sa");
        mysqli_stmt_bind_param($stmt, "ss", $message, $log_time);
        mysqli_stmt_execute($stmt);
        header("Location: marks.php?change=success");
        exit();
      }

    }
  }


 ?>
