<?php
  #CHANGE log flag AND REDIRECT TO MAIN PAGE
  $_SESSION["log_flag"] = "login";
  header("Location: ../main.php");
 ?>
