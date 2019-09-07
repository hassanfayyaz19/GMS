<?php
// i will keep yelling this
// DON'T FORGET TO START THE SESSION !!!
session_start();

   unset($_SESSION["login_id"]);
   session_destroy();
   header("Location: index.php");
   exit();
?>
