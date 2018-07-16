<?php
$host = "localhost";
$user = "root";
$pass = "";
$name = "monitoringcuaca";
 
$koneksi = mysql_connect($host, $user, $pass) or die("Koneksi ke database gagal!");
mysql_select_db($name, $koneksi) or die("Tidak ada database yang dipilih!");

$pdo = new PDO('mysql:host='.$host.';dbname='.$name, $user, $pass);
?>