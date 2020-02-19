<?php
  session_start();
  if($_SESSION["log_flag"] == "teachers"){
    header("Location: tmain.php");
  }else if ($_SESSION["log_flag"] != "students"){
    header("Location: ../main.php");
  }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../css/main.css">
   <title>Document</title>
</head>
<body>
   <main>
       <div class="container">
          <a href="marks.php">My Marks</a>
          <a href="logout.php">LogOut</a>
       </div>
       <p class="error">ERROR</p>
   </main>
</body>
</html>
