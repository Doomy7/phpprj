 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/form.css">
    <title>Sign up</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <h2>Sign up!</h2>
            <form class="" action="register.php" method="post">
              <input type="text" name="name" placeholder="name">
              <input type="text" name="surname" placeholder="surname">
              <input type="text" name="username" placeholder="username">
              <input type="text" name="email" placeholder="email">
              <input type="password" name="pass1" placeholder="password">
              <input type="password" name="pass2" placeholder="repeat password">
              <select id="type" name="type">
              <option value="none" disabled selected>- What is thy identity? -</option>
               <option value="students"<?php if(isset($_GET['admin'])){?> disabled <?php } ?>>Student</option>
               <option value="teachers"<?php if(isset($_GET['admin'])){?> disabled <?php } ?>>Teacher</option>
               <option value="admins" <?php if(!isset($_GET['admin'])){?> disabled <?php } ?>>admin</option>
              </select>
              <input type="submit" name="submit" value="Sign Up">
              <?php
                if(isset($_GET['error'])){
                  $error = $_GET['error'];
                  $file = fopen("../includes/errors.txt","r");
                  while($row = fgets($file)) {
                    list( $erNo, $type ) = explode( ",", $row );
                    if($erNo == $error){?>
                      <input type="text" name="" disabled value="<?php echo "ERROR: ".$type; ?>">
                    <?php
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
