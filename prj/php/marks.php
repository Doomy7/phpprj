<?php include "includes/marks_q.php" ?>
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
       <?php
         include_once 'includes/dbinc.php';
         session_start();
         $stmt = mysqli_stmt_init($conn);

         $sqlq = "SELECT `lessons`.`name`, `mark` FROM `lessons`, `marks`
         WHERE `students`.`sid` = ? AND `lessons`.`lid` == `marks`.`lid` AND `students`.`sid` == `marks`.`sid`;";
         if(!mysqli_stmt_prepare($stmt, $sqlq)){
           echo 'SQL ERROR';
         }else{
           mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
           mysqli_stmt_execute($stmt);
           $result = mysqli_stmt_get_result($stmt);
           $row = mysqli_fetch_assoc($result);
           while($row = mysqli_fetch_assoc($result)){
             echo $row['mark']."<br />";
           }
         }
        ?>
   </main>
</body>
</html>
