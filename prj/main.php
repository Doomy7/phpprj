<?php
  if(isset($_GET['login'])){
    if($_GET['login'] == "teachers"){
      header("Location: php/tmain.php?id=".$_GET['id']);
    }else if($_GET['login'] == "students"){
      header("Location: php/smain.php?id=".$_GET['id']);
    }
  }else{
      session_start();?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="css/main.css">
         <title>Document</title>
      </head>
        <body>
          <div class="container">
          <a href="php/login/login.php">Login</a>
          <a href="php/register/signup.php">Register</a>
        </div>
        <h1>SCHOOL</h1>
        </body>
      </html>
<?php
  }
 ?>
