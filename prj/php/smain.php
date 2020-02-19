<?php
  session_start();
  if($_SESSION["log_flag"] == "teachers"){
    header("Location: null.php");
  }else if ($_SESSION["log_flag"] != "students"){
    header("Location: ../login.php");
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
           <a href="#">Menuitem1</a>
           <a href="marks.php">My Marks</a>
           <a href="logout.php">Log Out</a>
           <a href="#">Menuitem4</a>
       </div>

       <p class="error">ERROR</p>
   </main>
</body>
</html>
