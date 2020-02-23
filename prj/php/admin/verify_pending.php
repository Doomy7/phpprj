<?php
  session_start();
  #FLAG CHECK
  if($_SESSION["log_flag"] != "admins"){
    header("Location: ../logout.php");
  }else{
    
  }

 ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../css/main.css">
     <title>Verifications</title>
  </head>
  <body>
     <main>
         <div class="container">
             <a href="amain.php">Back</a>
             <a href="../logout.php">Log Out</a>
         </div>
     </main>
  </body>
  </html>
