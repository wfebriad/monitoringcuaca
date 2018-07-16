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

<h3>Tambah Cuaca</h3>

   <a href="datacuaca.php?halaman=1.php" class="btn btn-info" role="button">Kembali</a>
</br>
</br>
<form method="POST" action="tambah-proses.php" accept-charset="UTF-8">
	<table>
		<tr>	
			<td valign="top"><label>Tanggal <b>*</b></label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Tanggal" type="date" name="tanggal" required></td>
		</tr>
		<tr>	
			<td valign="top"><label>Temperatur</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Temperatur" type="text" name="temperatur" required></td>
		</tr>
        <tr>	
			<td valign="top"><label>Tekanan</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Tekanan" type="text" name="tekanan" required></td>
		</tr><tr>	
			<td valign="top"><label>Kelembapan</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Kelembapan" type="text" name="kelembapan" required></td>
		</tr>
		</tr><tr>	
			<td valign="top"><label>Temperatur Maksimal</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Temperatur Maksimal" type="text" name="temp_max" required></td>
		</tr>
		</tr><tr>	
			<td valign="top"><label>Temperatur Minimal</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Temperatur Minimal" type="text" name="temp_min" required></td>
		</tr>
		</tr><tr>	
			<td valign="top"><label>Tekanan Maksimal</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Tekanan Maksimal" type="text" name="tek_max" required></td>
		</tr>
		</tr><tr>	
			<td valign="top"><label>Tekanan Minimal</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Tekanan Minimal" type="text" name="tek_min" required></td>
		</tr>
		</tr><tr>	
			<td valign="top"><label>Kelembapan Maksimal</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Kelembapan Maksimal" type="text" name="lemb_max" required></td>
		</tr>
		</tr><tr>	
			<td valign="top"><label>Kelembapan Minimal</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Kelembapan Minimal" type="text" name="lemb_min" required></td>
		</tr>
		</tr><tr>	
			<td valign="top"><label>Jumlah Curah Hujan</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Jumlah Curah Hujan" type="text" name="jumlah" required></td>
		</tr>
		<tr>
			<td><b>* Tidak boleh ada tanggal yang sama</b></td>
		</tr>
		<tr>
			<td colspan="3" align="right"><button class="btn-info btn" type="submit" name="tambah">Tambah</button></td>
		</tr>
		
	</table>
</form>