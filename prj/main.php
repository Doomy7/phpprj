<?php
  #IF ACCESSED CHECKS log_flag
  if(isset($_SESSION['log_flag'])){
  #IF NOT STUDENT OR TEACHER
    if($_SESSION['log_flag'] == "students"){
      header("Location: php/smain.php");
    }else if ($_SESSION['log_flag'] == "teachers"){
      header("Location: php/tmain.php");
    }else{
      #SESSION AND COOKIES ARE DESTROYED AND REBUILT
      if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]);
      }
      session_destroy();
    }
  }else{
      #IF log_flag IS NOT SET START SESSION AND $_SESSION INIT
      session_start();
      $_SESSION = array();?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="css/form.css">
         <title>Main</title>
      </head>
        <body>
          <div class="container">
            <div class="form">
              <h2>SCHOOL !</h2>
              <!-- Login redirection -->
              <form action="php/login/login.php">
                <input type="submit" value="Login" />
              </form>
              <!-- Signup redirection -->
              <form action="php/register/signup.php">
                <input type="submit" value="Signup" />
              </form>
            </div>
          </div>
        </body>
      </html>
<?php
  }
 ?>
