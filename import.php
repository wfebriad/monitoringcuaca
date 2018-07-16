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


<h3>Import Data Cuaca dari File Excel (.xls) </h3>
<a href="datacuaca.php?halaman=1.php" class="btn btn-info" role="button">Kembali</a>
<a href="<?php echo $base_url;?>asset/cuaca.xls" class="btn btn-info" role="button">Download Template</a>

</br>
</br>

<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('monitoringcuaca');
 
//memanggil file excel_reader
require "excel_reader.php";
 
//jika tombol import ditekan
if(isset($_POST['submit'])){
 
    $target = basename($_FILES['filepegawaiall']['name']) ;
    move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);
 
// tambahkan baris berikut untuk mencegah error is not readable
    chmod($_FILES['filepegawaiall']['name'],0777);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    
//    jika kosongkan data dicentang jalankan kode berikut
    $drop = isset( $_POST["drop"] ) ? $_POST["drop"] : 0 ;
    if($drop == 1){
//             kosongkan tabel pegawai
             $truncate ="TRUNCATE TABLE cuaca_harian";
             mysql_query($truncate);
    };
    
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//       membaca data (kolom ke-1 sd terakhir)
      $tanggal          = $data->val($i, 1);
      $temperatur       = $data->val($i, 2);
      $tekanan          = $data->val($i, 3);
      $kelembapan       = $data->val($i, 4);
      $temp_max         = $data->val($i, 5);
      $temp_min         = $data->val($i, 6);
      $tek_max          = $data->val($i, 7);
      $tek_min          = $data->val($i, 8);
      $lemb_max         = $data->val($i, 9);
      $lemb_min         = $data->val($i, 10);
      $jumlah           = $data->val($i, 11);

 
//      setelah data dibaca, masukkan ke tabel pegawai sql
      $query = "INSERT into cuaca_harian (tanggal,temperatur,tekanan,kelembapan,temp_max,temp_min,tek_max,tek_min,lemb_max,lemb_min,jumlah)
                values('$tanggal','$temperatur','$tekanan','$kelembapan','$temp_max','$temp_min','$tek_max','$tek_min','$lemb_max','$lemb_min','$jumlah')";
      $hasil = mysql_query($query);
    }
    
    if(!$hasil){
//          jika import gagal
          die(mysql_error());
      }else{
//          jika impor berhasil
            echo '<center><h4>Data berhasil di import! ';		
            echo '<a href="datacuaca.php?halaman=1.php">   Kembali</a></h4></center>';
            echo '</br>';
            echo '</br>';
            echo '</br>';
    }
    
//    hapus file xls yang udah dibaca
    //unlink($_FILES['filepegawaiall']['name']);
}
 
?>
 
<center> 
<div class="input-grup">
    <div class="custom-file">
        <form name="myForm" id="myForm" onSubmit="return validateForm()" action="import.php" method="post" enctype="multipart/form-data" class="custom-file-input" aria-describedby="inputGroupFileAddon04">
            <input type="file" id="filepegawaiall" name="filepegawaiall" class="form-control-file" />
            <input type="submit" name="submit" value="Import" class="btn btn-info" /><br/>
            </br>
            <label><input type="checkbox" name="drop" value="1" /> <b>Kosongkan semua data cuaca terlebih dahulu.</b> </label>
        </form>
    </div>
</div>
</center>
 
<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
 
        if(!hasExtension('filepegawaiall', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>