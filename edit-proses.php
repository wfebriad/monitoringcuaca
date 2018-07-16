<?php 
session_start();

//untuk "login_multiuser" bisa diganti dan sesuaikan dengan folder project kamu
//tujuan seperti dibuat menggunakan $_SERVER['HTTP_HOST'] agar hostname berubah sendiri secara dinamis

$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/monitoringcuaca/'; 

isset ($_GET['app']) ? $app = $_GET['app'] : $app = 'home';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Monitoring Cuaca</title>
	<link href="<?php echo $base_url;?>asset/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $base_url;?>asset/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo $base_url;?>asset/css/style.css" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo $base_url;?>asset/img/logo.png">
	<script type="text/javascript" src="<?php echo $base_url;?>asset/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $base_url;?>asset/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $base_url;?>asset/js/scripts.js"></script>
</head>
<body>
<div id="container">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="page-header"><h3>Monitoring Cuaca <small> BMKG Tanjungpinang</small></h3></div>
				<ul class="nav nav-tabs">
					<li <?php echo $app=='home'?'class=""':'';?>><a href="index.php"><i class="icon-home"></i> Home</a></li>
					<?php if(isset($_SESSION['level'])){?>
					<li <?php echo $app=='profile'?'class=""':'';?>><a href="index.php?app=profile"><i class="icon-wrench"></i>Profile</a></li>
					<li <?php echo $app=='datacuaca'?'class="active"':'';?>><a href="datacuaca.php?halaman=1"><i class="icon-list-alt"></i> Data Cuaca</a></li>
					<?php }?>
					<li <?php echo $app=='download'?'class=""':'';?>><a href="index.php?app=download"><i class="icon-check"></i> Download</a></li>
					<li <?php echo $app=='about'?'class=""' :'';?>><a href="index.php?app=about"><i class="icon-thumbs-up"></i> About</a></li>
					<li class="dropdown pull-right">
						<?php if (isset($_SESSION['nama'])):?>
						<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user"></i> <?php echo $_SESSION['nama'];?> <strong class="caret"></strong></a>
						<ul class="dropdown-menu">
							<li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
							<?php else:?>
						<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user"></i> Account<strong class="caret"></strong></a>
						<ul class="dropdown-menu">
							<li><a href="index.php?app=login"><i class="icon-user"></i> Login</a></li>
							<?php endif;?>							
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
<div id="content">

<?php

if(isset($_POST['simpan'])){
    include ('koneksi.php');
    $id			= $_POST['id'];	
	$tanggal	= $_POST['tanggal'];
	$temperatur	= $_POST['temperatur'];	
    $tekanan	= $_POST['tekanan'];
    $kelembapan	= $_POST['kelembapan'];
	$temp_max		= $_POST['temp_max'];
	$temp_min		= $_POST['temp_min'];
	$tek_max		= $_POST['tek_max'];
	$tek_min		= $_POST['tek_min'];
	$lemb_max		= $_POST['lemb_max'];
	$lemb_min		= $_POST['lemb_min'];
	$jumlah			= $_POST['jumlah'];
    
    $update = mysql_query("UPDATE cuaca_harian SET tanggal='$tanggal', temperatur='$temperatur', tekanan='$tekanan', kelembapan='$kelembapan', temp_max='$temp_max', 
													temp_min='$temp_min', tek_max='$tek_max', tek_min='$tek_min', lemb_max='$lemb_max', lemb_min='$lemb_min', jumlah='$jumlah' WHERE id='$id'") or die(mysql_error());

    if($update){
		
		echo '<center><h4>Data cuaca baru berhasil di simpan! ';		
		echo '<a href="datacuaca.php?halaman=1.php">   Kembali</a></h4></center>';
		
	}else{
		
		echo '<center><h4>Gagal menyimpan data! ';
		echo '<a href="datacuaca.php?halaman=1.php">   Kembali</a></h4></center>';
		
	}
 
}else{
 
	
	echo '<script>window.history.back()</script>';
 
}
?>
