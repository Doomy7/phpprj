<?php
  session_start();
  print_r($_SESSION);
  if($_SESSION["log_flag"] == "teachers"){
    header("Location: null.php");
  }else if ($_SESSION["log_flag"] != "students"){
    header("Location: ../main.php");
  }

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
           <form class="" action="marks.php" id="marks">
             <a href="javascript:void(0);" onclick="marks();">My Marks</a>
           </form>
           <form class="" action="logout.php" id="logout">
             <a href="javascript:void(0);" onclick="logout();">LogOut</a>
           </form>
       </div>

       <p class="error">ERROR</p>
   </main>
</body>
</html>

<script>
function logout() {
  document.getElementById('logout').submit();
  return true;
}

function marks() {
  document.getElementById('marks').submit();
  return true;
}
</script>
