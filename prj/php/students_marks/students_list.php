<?php
  session_start();
  include_once "../includes/dbinc.php";
  if($_SESSION["log_flag"] == "students"){
    header("Location: ../mains/smain.php");
  }else if ($_SESSION["log_flag"] != "teachers"){
    header("Location: ../../main.php");
  }
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>The Students</title>
 </head>
 <body>
    <main>
        <div class="container">
           <a href="../mains/tmain.php">Back</a>
           <a href="../logout.php">LogOut</a>
        </div>
        <?php
        $stmt = mysqli_stmt_init($conn);
        $sqlq = "SELECT * FROM `students`;";

        if(!mysqli_stmt_prepare($stmt, $sqlq)){
          echo 'SQL ERROR';
        }else{
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while($row = mysqli_fetch_assoc($result)){

            ?><br />
            <form class="form" action="marks.php" method="post">
              <input type="submit" name=<?php echo($row['sid']);?> value="<?php echo($row['name'].' '.$row['surname']);?>">
            </form>
            <?php
          }
        }
        ?>
    </main>
 </body>
 </html>
