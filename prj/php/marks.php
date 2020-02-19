<?php
  include 'includes/dbinc.php';
  session_start();
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
           <a href="smain.php">Back</a>
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
           $sum = 0;
           $passed = 0;
           while($row = mysqli_fetch_assoc($result)){
             if($row['mark'] >= 50){
                $sum += $row['mark'];
                $passed += 1;?>
                <p class="pass"><?php echo $row['name']." : ".$row['mark']?></p></br>
          <?php
            }else{ ?>
                <p class="error"><?php echo $row['name']." : ".$row['mark']?></p></br>
          <?php
            }
           }
           ?>

           <p class="pass"><?php echo("Mean : ".ceil($sum/$passed)."/100"); ?>
           <!-- <p class="error"><?php echo("Mean : ".ceil($sum/$result->num_rows)."/100"); ?></p> -->
          <?php
         }
        ?>
   </main>
</body>
</html>
