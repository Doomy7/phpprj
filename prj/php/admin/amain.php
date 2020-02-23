<?php
  session_start();
  #FLAG CHECK
  if($_SESSION["log_flag"] != "admins"){
    header("Location: ../logout.php");
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
           <a href="logs.php">Logs</a>
           <a href="verify_pending.php">Verifications</a>
           <a href="../logout.php">LogOut</a>
        </div>
        <p class="pass">Welcome <?php echo(" ".$_SESSION['name']); ?></p>
    </main>
 </body>
 </html>
