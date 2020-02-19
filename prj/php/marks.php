<?php
  include_once 'includes/dbinc.php';
  session_start();
  print_r($_SESSION);
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
           <a href="logout.php">Log Out</a>
           <a href="#">Menuitem4</a>
       </div>

       <?php
         $stmt = mysqli_stmt_init($conn);

         $sqlq = "SELECT `lessons`.`name`, `mark` FROM `lessons`, `marks` WHERE `sid` = ? AND `sid` = `marks`.`sid` AND `lessons`.`lid` = `marks`.`lid`;";
         if(!mysqli_stmt_prepare($stmt, $sqlq)){
           echo 'SQL ERROR';
         }else{
           mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);
           mysqli_stmt_execute($stmt);
           $result = mysqli_stmt_get_result($stmt);
           $row = mysqli_fetch_assoc($result);
           while($row = mysqli_fetch_assoc($result)){?>
             <p class="error"><?php echo $row['name']." : ".$row['mark']?></p></br>
          <?php
           }
         }
        ?>
   </main>
</body>
</html>
