<?php


$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$email=$_POST['email'];
$jenis_kelamin=$_POST['jenis_kelamin'];
$password=$_POST['password'];

include"db_conn.php";

$proses="INSERT into anggota(nama,alamat,email,jenis_kelamin,password)
         VALUES('$nama','$alamat','$email','$jenis_kelamin','$password')";
$hasil=mysql_query ($proses);

echo"<script>alert('DATA SUDAH DISIMPAN');document.location.href='tampil_anggota.php';</script>"
?>
