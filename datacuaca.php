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

<h3>Data Cuaca</h3>
<?php if($_SESSION['level']=='admin'){ ?>
<p>
	<a href="tambah.php" class="btn btn-info"><i class="icon-plus"></i> Tambah Data</a>
	<a href="import.php" class="btn btn-info"><i class="icon-plus"></i> Import dari Excel</a>
</p>
<?php } ?>

<div class="tab-content">
<table class="table table-bordered table-condensed table-hover">
	<thead>
		<tr class="nowrap">
			<th align="left">No</th>
			<th align="left">Tanggal</th>
			<th align="left">Temperatur <a href="<?php echo $base_url;?>grafik_temperatur.php" class="btn btn-info btn-mini" role="button">Grafik</a></th>
			<th align="left">Tekanan <a href="<?php echo $base_url;?>grafik_tekanan.php" class="btn btn-info btn-mini" role="button">Grafik</a></th>
			<th align="left">Kelembapan <a href="<?php echo $base_url;?>grafik_kelembapan.php" class="btn btn-info btn-mini" role="button">Grafik</a></th>
			<th align="left">Temp Max</th>
			<th align="left">Temp Min</th>
			<th align="left">Tek Max</th>
			<th align="left">Tek Min</th>
			<th align="left">Lemb Max</th>
			<th align="left">Lemb Min</th>
			<th align="left">Jml Curah Hujan</th>
			<th align="center">Action</th>
		</tr>
	</thead>


	<?php
	$batas=10;
	$halaman=$_GET['halaman'];
	$posisi=null;
	if(empty($halaman)){
		$posisi=0;
		$halaman=1;
	}else{
		$posisi=($halaman-1)* $batas;
	}
	include('koneksi.php');
	$query = mysql_query("SELECT * FROM cuaca_harian ORDER BY id DESC limit $posisi, $batas") or die(mysql_error());

	if(mysql_num_rows($query) == 0){
		echo '<tr><td colspan="5">Tidak ada data!</td></tr>';
	}else{
		$no = 1;
		while($data = mysql_fetch_assoc($query)){
			echo '<tr>';
					echo '<td><center>'.$no.'</center></td>';
					echo '<td>'.$data['tanggal'].'</td>';
					echo '<td>'.$data['temperatur'].'</td>';
					echo '<td>'.$data['tekanan'].'</td>';
					echo '<td>'.$data['kelembapan'].'</td>';
					echo '<td>'.$data['temp_max'].'</td>';
					echo '<td>'.$data['temp_min'].'</td>';
					echo '<td>'.$data['tek_max'].'</td>';
					echo '<td>'.$data['tek_min'].'</td>';
					echo '<td>'.$data['lemb_max'].'</td>';
					echo '<td>'.$data['lemb_min'].'</td>';
					echo '<td>'.$data['jumlah'].'</td>';
					echo '<td>
								<a href="hitung.php?id='.$data['id'].'" type="button" class="btn btn-success btn-mini" >Hitung</a> 
								<a href="edit.php?id='.$data['id'].'" type="button" class="btn btn-primary btn-mini">Edit</a>
							  	<a href="hapus.php?id='.$data['id'].'" onclick="return confirm(\'Yakin?\')" type="button" class="btn btn-danger btn-mini">Hapus</a>
						 </td>';
					
				echo '</tr>';
				$no++;
		}
	}
	?>
</table>
</div>

<nav aria-label="Page navigation example">
<ul class="pagination">
<h3>
<?php
$sql_paging = mysql_query("SELECT tanggal  FROM cuaca_harian");
      $jmldata = mysql_num_rows($sql_paging);
      $jumlah_halaman = ceil($jmldata / $batas);
 
	 
      echo "Halaman :";
      for($i = 1; $i <= $jumlah_halaman; $i++)
        if($i != $halaman) {
          echo "<a href=datacuaca.php?halaman=$i>  $i  </a>  |  ";
        } else {
          echo "<b> $i</b> |";
        }
	  mysql_close();
	  ?>
	  </ul>
	  </h3>
    <br>