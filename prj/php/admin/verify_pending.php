<?php
  session_start();
  include '../includes/dbinc.php';

  #FLAG CHECK
  if($_SESSION["log_flag"] != "admins"){
    header("Location: ../logout.php");
  }
  #initialize entries
  $_SESSION['students'] = array();
  $_SESSION['teachers'] = array();

 ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../css/main.css">
     <title>Verifications</title>
  </head>
  <body>
     <main>
         <div class="container">
             <a href="amain.php">Back</a>
             <a href="../logout.php">Log Out</a>
         </div>
         <div id="container">
           <?php
           #construct the tables for entries
           #TEACHER TABLE
           echo('<table id="log">');
           echo('<tr>');
           echo('<td colspan=7 style="text-align:center;">TEACHERS</td>');
           echo('</tr>');
           echo('<tr>');
           echo('<th>Log. No</th>');
           echo('<th>Name</th>');
           echo('<th>Surname</th>');
           echo('<th>Email</th>');
           echo('<th>Time</th>');
           echo('<td colspan=2 style="text-align:center;">ACTION</td>');
           echo('</tr>');

           $stmt = mysqli_stmt_init($conn);
           $sqlq = "SELECT * FROM `teachers_verify`;";
           if(!mysqli_stmt_prepare($stmt, $sqlq)){
             echo 'SQL ERROR';
           }else{
             mysqli_stmt_execute($stmt);
             $result = mysqli_stmt_get_result($stmt);
             while($row = mysqli_fetch_assoc($result)){
               #echo the following
               echo('<tr>');
               echo('<td>'.$row['vid'].'</td>');
               echo('<td>'.$row['name'].'</td>');
               echo('<td>'.$row['surname'].'</td>');
               echo('<td>'.$row['email'].'</td>');
               echo('<td>'.$row['time'].'</td>');
               $_SESSION['teachers'][$row['vid']] = $row;
               echo('<form action="action.php" method="post">');
               #event based on accepting/rejecting
               echo('<td><input type="submit" name=teachers_'.$row['vid'].' value="ACCEPT"></input></td>');
               echo('<td><input type="submit" name=teachers_'.$row['vid'].' value="REJECT"></input></td>');
               echo('</form>');
               echo('</tr>');
            }
            echo('</table>');
           }
         ?>
         </div>
         <div id="container">
           <?php
           echo('<table id="log">');
           echo('<tr>');
           echo('<td colspan=7 style="text-align:center;">STUDENTS</td>');
           echo('</tr>');
           echo('<tr>');
           echo('<th>Log. No</th>');
           echo('<th>Name</th>');
           echo('<th>Surname</th>');
           echo('<th>Email</th>');
           echo('<th>Time</th>');
           echo('<td colspan=2 style="text-align:center;">ACTION</td>');
           echo('</tr>');

           $stmt = mysqli_stmt_init($conn);
           $sqlq = "SELECT * FROM `students_verify`;";
           if(!mysqli_stmt_prepare($stmt, $sqlq)){
             echo 'SQL ERROR';
           }else{
             mysqli_stmt_execute($stmt);
             $result = mysqli_stmt_get_result($stmt);
             while($row = mysqli_fetch_assoc($result)){
               echo('<tr>');
               echo('<td>'.$row['vid'].'</td>');
               echo('<td>'.$row['name'].'</td>');
               echo('<td>'.$row['surname'].'</td>');
               echo('<td>'.$row['email'].'</td>');
               echo('<td>'.$row['time'].'</td>');
               $_SESSION['students'][$row['vid']] = $row;
               echo('<form action="action.php" method="post">');
               echo('<td><input type="submit" name=students_'.$row['vid'].' value="ACCEPT"></input></td>');
               echo('<td><input type="submit" name=students_'.$row['vid'].' value="REJECT"></input></td>');
               echo('</form>');
               echo('</tr>');
             }
            echo('</table>');
           }
         ?>
         </div>
     </main>
  </body>
  </html>
