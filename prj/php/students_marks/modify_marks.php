<?php
  session_start();

  include '../includes/dbinc.php';
  if($_SESSION["log_flag"] == "students"){
    header("Location: ../../main.php");
  }else if ($_SESSION["log_flag"] != "teachers"){
    header("Location: ../../main.php");
  }
  if($_SESSION['l_flag'] == 1){
    if(!isset($_SESSION['target_lesson']) || $_SESSION['target_lesson'] != $_POST[key($_POST)]){
      $_SESSION['target_lesson'] = $_POST[key($_POST)];
      $_SESSION['lesson_id'] = key($_POST);
      $_SESSION['l_flag'] = 0;
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../../css/main.css">
   <title>Marks Modify</title>
</head>
<body>
   <main>
       <div class="container">
           <a href="students_list.php">Back</a>
           <a href="../logout.php">Log Out</a>
       </div>
       <p class="pass"><?php echo($_SESSION['student_name']);?></p></br>
       <div class="form">
         <form action="change.php" method="post">
           <p class="pass"><?php echo($_SESSION['target_lesson']);?></p>
             <input type="text" name="nmark" value="" placeholder="Enter new mark">
             <input type="submit" name="change" value="submit">
         </form>
         <?php
           if(isset($_GET['error'])){
             $error = $_GET['error'];
             $file = fopen("../includes/errors.txt","r");
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
       </div>

   </main>
</body>
</html>
