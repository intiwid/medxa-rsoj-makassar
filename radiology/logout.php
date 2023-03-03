<?php 

session_start();

unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['level']);

session_destroy();

header("location:../index.php");

?>