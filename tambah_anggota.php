<?php
include "header.php";
include"right.php";
include"left.php";


if ($_POST['act']=="add")
{
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$jenis_kelamin=$_POST['jenis_kelamin'];
//$password=(md5$_POST['password']);
$password=md5($_POST['password']);



$proses="INSERT into anggota(nama,alamat,email,telephone,jenis_kelamin,password)
         VALUES('$nama','$alamat','$email','$phone','$jenis_kelamin','$password')";
$hasil=mysql_query ($proses);

echo"<script>alert('Data Anda Sudah Disimpan Terima Kasih Sudah Bergabung Dengan Kami');</script>";

}



?>
<center>
<form  method="post">
<table border="0" width="62%">
       <td clospan="3"><center><b>Tambah Anggota<br></center>
<tr><td >Nama Anggota <td> :</td></td>
<td><input type="text" name="nama" size="22" maxlength="20"></td></tr>
<tr><td>Alamat<td> :</td></td>
<td><textarea name="alamat" cols="35" ></textarea></td></tr>
<tr><td>Email<td> :</td> </td>
<td><input type="text" name="email" size="33" maxlength="30"></td></tr>
<tr> <td>Phone<td> :</td></td>
<td><input type="text" name="phone" size="33" maxlength="12"></td></tr>
<tr><td>Jenis Kelamin<td> :</td></td>
<td><input type="radio" name="jenis_kelamin" value="p" >Pria
<input type="radio" name="jenis_kelamin" value="w">Wanita</td></tr>
<tr><td>Password <td> :</td></td>
<td><input type="text" name="password" size="22"></td></tr>
<td clospan="3"><input type="submit" value="Simpan">
<input type="hidden" name="act" value="add">
<input type="reset" value="Batal"></td>
</table>
</form>
</center>
<?php

include"footer.php";
?>
