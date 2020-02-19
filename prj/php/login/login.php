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
      $_SESSION = array();
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/form.css">
    <title>Login</title>
</head>
<body>
    <div class="container">

        <div class="form">
            <h2>Log In!</h2>
            <form class="" action="php/login.php" method="post">
            <input type="text" name="id" placeholder="username/email">
            <input type="password" name="password" placeholder="password">
            <select id="type" name="type">
            <option value="none" disabled selected>- What is thy identity? -</option>
             <option value="students">Student</option>
             <option value="teachers">Teacher</option>
            </select>
            <input type="submit" name="submit" value="Log In">
            <?php
              if(isset($_GET['error'])){
                $error = $_GET['error'];
                $file = fopen("php/includes/errors.txt","r");
                while($row = fgets($file)) {
                  list( $erNo, $type ) = explode( ",", $row );
                  if($erNo == $error){?>
                    <input type="text" name="" disabled value="<?php echo "ERROR: ".$type; ?>">
                  <?php
                    break;
                  }
                }
                fclose($file);
              }

             ?>
            </form>
        </div>
    </div>
</body>
</html>
