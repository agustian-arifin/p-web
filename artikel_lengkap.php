<?php

include"header.php";
include"left.php";
include"right.php";


$query = "UPDATE news SET views = views + 1  WHERE id='".$_GET['id']."'";
mysql_query($query);

$idArtikel = $_GET['id'];
if ($_GET['act'] == "submit")
{
   // membaca data komentar dari form
   $nama = strip_tags($_POST['nama']);
   $url = strip_tags($_POST['url']);
   $komentar = $_POST['komentar'];
   $isi = strip_tags($_POST['komentar']);
   $idArtikel = $_POST['idArtikel'];
   $tglKomentar = date("Y-m-d");
   
$cek = mysql_query("SELECT * FROM komentar WHERE idArtikel ='".$idArtikel."'");
while ($row=mysql_fetch_array($cek)){
if($row['komentar']==$isi)
  {
  echo'<script>alert("Anda Sudah Mengisi Komentar, Terima Kasih");window.location="blog.php";</script>';
     exit;
    }
}


// jika tidak ada komentar (jumlah data hasil query = 0), tampilkan keterangan belum ada komentar
//else 
<?php
echo'
<tr><td>&laquo;&nbsp;Nama Anda</td><td>:</td><td>
<input  name="nama" size="35" class="texbox" maxlength="30" value="'.$_POST['nama'].'"><br>'.$err['nama'].' </td></tr>

<tr><td>&laquo;&nbsp;URL Anda</td><td>:</td><td>
<input name="url" size="50" class="texbox" value="'.$_POST['url'].'"><br>'.$err['url'].'</td></tr>

<tr><td>&laquo;&nbsp;Komentar</td><td>:</td><td>
<textarea class="texarea" name="komentar" cols="50" rows="7" value="'.$_POST['komentar'].'"></textarea><br>'.$err['komentar'].'</td></tr>';
?>
<?php
echo "<tr><td></td><td></td><td><input type='submit' name='submit' value='Kirim' class='btn'><input type='hidden' name='idArtikel' value='".$idArtikel."'></td></tr>";
echo"</table>";
echo"</div>";
echo"</div>";
 echo"<div class='cleared'></div>";

include"footer.php";
?>
