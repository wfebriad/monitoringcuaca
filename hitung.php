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

<h3>Hasil Perhitungan Monitoring Cuaca per Hari</h3>
<a href="datacuaca.php?halaman=1.php" class="btn btn-info" role="button">Kembali</a>

</br>
</br>


<?php
include ('koneksi.php');

$id = $_GET['id'];
$show = mysql_query("SELECT * FROM cuaca_harian WHERE id='$id'");

if(mysql_num_rows($show) == 0){
    echo '<script>window.history.back()</script>';
}else{
    $data = mysql_fetch_assoc($show);
}
?>

<input type="hidden" name="id" value="<?php echo $id; ?>">
<center>
	<table>
		<tr>	
			<td valign="top"><label><b>Tanggal</label></td>
			<td valign="top">:</td>
			<td><input class="span2" placeholder="Tanggal" type="text" name="tanggal" value="<?php echo $data['tanggal']; ?>" readonly></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td valign="top"><label><b>Temperatur</label></td>
			<td valign="top">:</td>
			<td><input class="span2" placeholder="Temperatur" type="text" name="temperatur" value="<?php echo $data['temperatur']; ?>" readonly></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td valign="top"><label><b>Tekanan</label></td>
			<td valign="top">:</td>
			<td><input class="span2" placeholder="Tekanan" type="text" name="tekanan" value="<?php echo $data['tekanan']; ?>" readonly></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td valign="top"><label><b>Kelembapan</label></td>
			<td valign="top">:</td>
			<td><input class="span2" placeholder="Kelembapan" type="text" name="kelembapan" value="<?php echo $data['kelembapan']; ?>" readonly></td>

        </tr>
	</table>
    <table>
		<tr>
			<td><input class="span2" placeholder="Tanggal" type="hidden" name="tanggal" value="<?php echo $data['tanggal']; ?>" readonly></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
			<td><input class="span2" placeholder="Temperatur" type="hidden" name="temperatur" value="<?php echo $data['temperatur']; ?>" id="temperatur" readonly></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
			<td><input class="span2" placeholder="Tekanan" type="hidden" name="tekanan" value="<?php echo $data['tekanan']; ?>" id="tekanan" readonly></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
			<td><input class="span2" placeholder="Kelembapan" type="hidden" name="kelembapan" value="<?php echo $data['kelembapan']; ?>" id="kelembaban" readonly></td>

        </tr>
	</table>
    <center><button id="hitung" onclick="hitung()" class="btn btn-info">Hitung</button>
		<h3 id="output"> </h3></center>
    </center>


<script>
			function hitung(){
				var lembab = document.getElementById('kelembaban').value;
				var output = document.getElementById('output');
				var temperatur = document.getElementById('temperatur');
				var tekanan = document.getElementById('tekanan');
				var hasil;
				
				if(lembab==''){
				hasil='';
				}else if(lembab>=94.5){
				hasil="C1 - Cuaca Extrem";
				}else if(lembab<79){
				hasil="C3 - Cuaca Rendah";
				}else if(lembab<=94.5){
				hasil="C2 - Cuaca Sedang";
				}
				
				output.innerHTML=hasil;
				temperatur.value="";
				tekanan.value="";
				kelembaban.value="";
				
			}
		</script>


