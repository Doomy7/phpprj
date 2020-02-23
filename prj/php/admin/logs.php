<?php
  session_start();
  include '../includes/dbinc.php';
  #FLAG CHECK
  if($_SESSION["log_flag"] != "admins"){
    header("Location: ../logout.php");
  }

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>Logs</title>
 </head>
 <body>
    <main>
        <div class="container">
            <a href="amain.php">Back</a>
            <a href="../logout.php">Log Out</a>
        </div>
        <div id="container">
          <?php
          #SIMPLE LOG PRINTING
          echo('<table id="log">');
          echo('<tr>');
          echo('<th>Log. No</th>');
          echo('<th>Log</th>');
          echo('<th>Time</th>');
          echo('</tr>');

          $stmt = mysqli_stmt_init($conn);
          $sqlq = "SELECT * FROM `activity_log`;";
          if(!mysqli_stmt_prepare($stmt, $sqlq)){
            echo 'SQL ERROR';
          }else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
              echo('<tr>');
              echo('<td>'.$row['aid'].'</td>');
              echo('<td>'.$row['log'].'</td>');
              echo('<td>'.$row['time'].'</td>');
              echo('</tr>');
            }
           echo('</table>');
          }
        ?>
        </div>
    </main>
 </body>
 </html>
