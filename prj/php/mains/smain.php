<?php
  session_start();
  #FLAG CHECK 
  if($_SESSION["log_flag"] == "teachers"){
    header("Location: tmain.php");
  }else if ($_SESSION["log_flag"] != "students"){
    header("Location: ../../main.php");
  }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../../css/main.css">
   <title>Student Main</title>
</head>
<body>
   <main>
       <div class="container">
          <a href="../students_marks/marks.php">My Marks</a>
          <a href="../logout.php">LogOut</a>
       </div>
       <p class="pass">Welcome <?php echo(" ".$_SESSION['name']); ?></p>
   </main>
</body>
</html>
