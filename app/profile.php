<?php empty( $app ) ? header('location:../index.php') : '' ; if(isset($_SESSION['level'])){ ?>

Your Profile page here </br>
Silahkan modifikasi <b>File path : app/profile.php </b>
<?php 
}else{
echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
}
