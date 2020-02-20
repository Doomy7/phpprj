<?php
  include '../includes/dbinc.php';
  session_start();
  if($_SESSION['s_flag'] == 1){
    if(!isset($_SESSION['student']) || $_SESSION['student'] != key($_POST)){
      $_SESSION['student'] = key($_POST);
      $_SESSION['student_name'] = $_POST[key($_POST)];
      $_SESSION['s_flag'] = 0;
    }
  }

  if(!isset($_SESSION['l_flag']) || $_SESSION['l_flag'] == 0){
    $_SESSION['l_flag'] = 1;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../../css/main.css">
   <title>Marks</title>
</head>
<body>
  <?php if ($_SESSION['log_flag'] == "students"){?>
           <main>
               <div class="container">
                   <a href="../mains/smain.php">Back</a>
                   <a href="../logout.php">Log Out</a>
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
                   $total = 0;
                   while($row = mysqli_fetch_assoc($result)){
                     $total += 1;
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
                   if ($passed == 0){?>
                     <br />
                     <p class="error">No Lessons Passed</p></br>
                     <p class="pass"><?php echo("Mean : 0/100"); ?></p>
             <?php }else{ ?>
                     <br />
                     <p class="pass"><?php echo("Mean : ".ceil($sum/$passed)."/100");?></p><br />
                     <p class="pass"><?php echo("Total : ".$passed."/".$total);?></p>
                     <!-- <p class="error"><?php echo("Mean : ".ceil($sum/$result->num_rows)."/100"); ?></p> -->
                    <?php
                   }
                 }
                ?>
           </main>
  <?php }else if($_SESSION['log_flag'] == "teachers"){?>
    <main>
        <div class="container">
          <a href="students_list.php">Back</a>
          <a href="../logout.php">Log Out</a>
        </div>
        <p class="pass"><?php echo($_SESSION['student_name']);?></p></br>
        <?php
          $stmt = mysqli_stmt_init($conn);
          $sqlq = "SELECT `lessons`.`name`, `mark`, `lessons`.`lid` FROM `lessons`, `marks` WHERE `sid` = ? AND `sid` = `marks`.`sid` AND `lessons`.`lid` = `marks`.`lid`;";
          if(!mysqli_stmt_prepare($stmt, $sqlq)){
            echo 'SQL ERROR';
          }else{
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['student']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $sum = 0;
            $passed = 0;
            while($row = mysqli_fetch_assoc($result)){
              if($row['mark'] >= 50){
                 $sum += $row['mark'];
                 $passed += 1;?>
                 <br />
                 <form class="form" action="modify_marks.php" method="post">
                   <input type="submit" name=<?php echo($row['lid']);?> value="<?php echo $row['name']." : ".$row['mark']?>">
                 </form>
           <?php
         }else{?>
                <form class="form" action="modify_marks.php" method="post">
                  <input style="color: red; background-color: rgb(211, 120, 120,.5);" type="submit" name=<?php echo($row['lid']);?> value="<?php echo $row['name']." : ".$row['mark']?>">
                </form>
              <?php }
            }
            if ($passed == 0){?>
              <br />
              <p class="error">No Lessons Passed</p></br>
              <p class="pass"><?php echo("Mean : 0/100"); ?></p>
      <?php }else{ ?>
              <br />
              <p class="pass"><?php echo("Mean : ".ceil($sum/$passed)."/100");?></p>
              <!-- <p class="error"><?php echo("Mean : ".ceil($sum/$result->num_rows)."/100"); ?></p> -->
             <?php
            }
          }?>
          <form class="form" action="change.php" method="post">
            <input type="submit" name="Add" value="Add new Lesson">
          </form>
    </main>
  <?php } ?>
</body>
</html>
