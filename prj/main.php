<?php
  if(isset($_SESSION['log_flag'])){
    if($_SESSION['log_flag'] == "students"){
      header("Location: php/smain.php");
    }else if ($_SESSION['log_flag'] == "teachers"){
      header("Location: php/tmain.php");
    }else{
      if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]);
      }
      session_destroy();
    }
  }else{
      session_start();
      $_SESSION = array();?>
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
