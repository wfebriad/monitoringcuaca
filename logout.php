<?php
session_start();
// apabila ditekan tombol logout, session username & level akan hilang 
unset($_SESSION['username']);
unset($_SESSION['nama']);
unset($_SESSION['level']);
header("location:index.php?app=login");
?>
