<?php
  session_start();
  #IF ACCESSED FROM STUDENT SESSION RETURN THEM BACK
  if($_SESSION["log_flag"] == "students"){
    header("Location: smain.php");
  #ELSE IF VIOLENT ACCESS RETURN TO MAIN
  }else if ($_SESSION["log_flag"] != "teachers"){
    header("Location: ../../main.php");
  }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../../css/main.css">
   <title>Teacher Main</title>
</head>
<body>
   <main>
       <div class="container">
           <a href="../students_marks/students_list.php">Students</a>
           <a href="../logout.php">Log Out</a>
       </div>
       <p class="pass">Welcome <?php echo(" ".$_SESSION['name']); ?></p>
   </main>
</body>
</html>
