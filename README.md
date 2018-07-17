**Jika membutuhkan databasenya bisa menghubungi email w.febriadi00@gmail.com atau WhatsApp +62819 9133 0226**

<h2>Monitoring Cuaca BMKG Tanjungpinang</h2>

Aplikasi ini dibuat dengan bahasa pemrograman <a href="http://php.net/" target="_blank">PHP</a> dan database <a href="https://en.wikipedia.org/wiki/MySQLi" target="_blank">MySQLi</a>. Sedangkan cssnya menggunakan <a href="https://www.getbootstrap.com/" target="_blank">Bootstrap CSS</a>.

Untuk melakukan perhitungan Klasifikasi Jenis Cuaca, disini penulis melakukan penghitungan manual dan mengimplementasikan algoritma K-Means pada data cuaca harian, jumlah cluster yang akan dibentuk adalah 3 *cluster* Dimana *cluster 1* (C1) dikategorikan *Ekstrem*, *cluster 2* (C2) dikategorikan *Sedang*, dan *cluster 3* (C3) dikategorikan *Rendah*. Dan dalam sebagai pusat titik awal *cluster* (*centroid*), disini penulis menggunakan nilai random. Selanjutnya penulis menghitung jarak terpendek dengan menggunakan rumus *Eulidean*  untuk menghitung jarak data dengan *Cluster 1, Cluster 2, dan Cluster 3*.


Untuk menggunakan aplikasi ini silahkan lakukan beberapa konfigurasi terlebih dahulu.

- konfigurasi database sistem : buka file **koneksi** -> **koneksi.php** lalu setting databasenya.
- konfigurasi cek login: buka file **cek_login** -> **cek_login.php** lalu setting databasenya.
- konfigurasi diagram kelembaban, diagram tekanan, dan diagram temperatur : buka file **grafik_kelembapan**, **grafik_tekanan**, **grafik_temperatur** -> **grafik_kelembapan.php**, **grafik_tekanan.php**, **grafik_temperatur.php** lalu setting databasenya.
- konfigurasi fitur import file Excel (.xls) : buka file **import** -> **import.php** lalu setting databasenya.

Fitur - fitur yang ada diaplikasi ini adalah :

- Penentuan klasifikasi jenis cuaca berdasarkan data Temperatur, Tekanan, dan Kelembapan dengan hasil dari 3 Cluster (Cuaca Ekstrem, Cuaca Rendah, atau Cuaca Sedang)
- Login *Multilevel user*
- Import data cuaca harian dengan file Excel (.xls)
- Grafik pada bagian Temperatur, Tekanan, Kelembapan pada semua tanggal


Untuk tampilan terbaik, gunakan browser Google Chrome versi terbaru.

**Wisnu Febriadi - Teknik Informatika - Universitas Maritim Raja Ali Haji**

<h2>Tampilan Aplikasi</h3>
<img src="asset/img/Monitoring Cuaca 1.png">
<img src="asset/img/Monitoring Cuaca 2.png">
<img src="asset/img/Monitoring Cuaca 3.png">
