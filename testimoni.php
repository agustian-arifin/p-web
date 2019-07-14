<?php

include"header.php";
include"left.php";
include"right.php";


if ($_POST['act']=="add"){

// membaca data komentar dari form
   $nama = strip_tags($_POST['nama']);
   $email = strip_tags($_POST['email']);
  $komentar = $_POST['komentar'];
   $isi = strip_tags($_POST['komentar']);
   //$idArtikel = $_POST['idArtikel'];
   $tglKomentar = date("Y-m-d");
    $gambar=$_POST['gambar'];
   //$cekdata="select * from pages WHERE   komentar = "$_POST['komentar']" ";
  // $ada=mysql_query($cekdata) or die(mysql_error());
$cek = mysql_query("SELECT * FROM testimoni WHERE komentar ='".$_POST['komentar']."'");

 if(mysql_num_rows($cek)>0)
  {
  echo'<script>alert("Anda Sudah Mengisi Testimoni, Terima Kasih");window.location ="testimoni.php";</script>';
     exit;
    }


if (empty($_POST['nama'])) $err['nama']="<span class=\"err\">Silahkan Isi Nama Anda</span>\n";
    //if (empty($_POST['url'])) $err['url']="<span class=\"err\">Silahkan Isi URL Anda</span>\n";
    if (empty($_POST['komentar'])) $err['komentar']="<span class=\"err\">Silahkan Isi Komentar Anda.</span>\n";
     if (empty($_POST['email'])) $err['email']="<span class=\"err\">Silahkan lengkapi Email Anda.</span>\n";
 if (!preg_match("/^[a-z0-9\_\.\-]+\@[a-z0-9\_\.\-]+$/i",$_POST['email'])) $err['email']="<span class=\"err\">Email &quot;".$_POST['email']."&quot; Anda Tidak valid.</span>\n";

   if (empty($_FILES['gambar']['name'])) $err['gambar']="<span class=\"err\">Gambar Tidak Boleh Kososng</span>\n";
    //if (empty($_POST['alamat'])) $err['alamat']="<span class=\"err\">Silahkan Lengkapi Alamat Anda.</span>\n";
    if ($_POST['sixletterscode']<>$_SESSION['6_letters_code']) $err['sixletterscode']="<span class=\"err\">Validasi Yang Anda Masukkan Salah.</span>\n";

    if(count($err)>0){ // *** if submit error
        echo "<div id='notif2'>Data Yang Anda Masukkan Masih Ada Yang Salah, Silahkan Perbaiki, Terima Kasih</div>";
    }
    
else{
   $query = "INSERT INTO testimoni (nama, email, komentar, commentDate)
           VALUES ('$nama', '$email', '$komentar', '$tglKomentar')";
   $hasil = mysql_query($query);

if( !empty($_FILES['gambar']['name']) )
    {
    $path = "gambar2/";
    $lastid=@mysql_result(@mysql_query("SELECT id_testimoni FROM testimoni ORDER BY id_testimoni DESC LIMIT 0,1"),0,0);
    $new_image_name = $lastid.".jpg";
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, $path.$new_image_name);
    }

  echo'<script>alert("Terima Kasih Saudara '.$_POST['nama'].'  Atas Kesedaiannya Memberikan Testimoninya !!");window.location ="testimoni.php";</script>';



}
}

?>




<div id='keranjang'>
<h2>Isi Testimonial</h2>

<div id='formcomment'>

<form method="post" enctype="multipart/form-data">
<table>
<?php
echo'
<tr><td>&raquo;&nbsp;Nama*</td><td></td><td>
<input  name="nama" size="35" class="texbox" maxlength="30" value="'.$_POST['nama'].'"><br>'.$err['nama'].' </td></tr>

<tr><td>&raquo;&nbsp;Email*</td><td></td><td>
<input name="email" size="50" class="texbox" value="'.$_POST['email'].'"><br>'.$err['email'].'</td></tr>

<tr><td>&raquo;&nbsp;Komentar*</td><td></td><td>
<textarea class="texarea" name="komentar" cols="50" rows="7" value="'.$_POST['komentar'].'"></textarea><br>'.$err['komentar'].'</td></tr>

<tr><td>&raquo;&nbsp;Bukti/Gambar*</td><td></td><td><input type="file" name="gambar" value="'.$_POST['gambar'].'" >'.$err['gambar'].'</td></tr>';
?>

<?php
echo'<tr><td>&raquo;&nbsp;Kode*</td><td></td><td><img src="captcha.php?rand=" id="captchaimg" style="float:left;margin:6px 4px 0 0;border:1px dashed #000;">
        <small style="float:left">kode ini susah?</br><a href=\'javascript: refreshCaptcha();\'>Coba</a> Kede Lain</small>
        <script language="JavaScript" type="text/javascript">
        function refreshCaptcha(){
            var img = document.images[\'captchaimg\'];
            img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
            }
        </script><div class="cleared"></div><input id="sixletterscode" name="sixletterscode" type="text"  maxlength="6"
        class="texarea" style="width:190px;height:60px;font-family:FontCaptcha;font-size:44px;color:#000;text-align:center;">
        <br>'.$err['sixletterscode'].' </td></tr></center>


 <div class="cleared"></div> ';

?>
<tr><td><input type="submit" value="KIRIM" class="btn"></td></tr>
    <tr><td><input type="hidden" name="act" value="add"></td></tr>
</table>
<p>&raquo;Field yang pake tanda (*) tidak boleh kosong !!</p>

</div>
<hr> <br><br>


<?php

// *** QUERY SEARCH
$qry_0 = "SELECT id_testimoni FROM testimoni ";


//echo "[ $qry_0.$qry_t ]";
$total_rec=@mysql_num_rows(mysql_query($qry_0)); // *** TOTAL RECORD PRODUCT
$rowperpage=1; // *** DISPLAY NUM RECORD PER PAGE

// ** predefine record number
if (!empty($_GET['page'])) $recno=($_GET['page']-1)*$rowperpage; else $recno=0;

// QUERY TABLE php_shop_products n record per page
//$sql = "SELECT id,category, name, description, price FROM php_shop_products ".$qry_t." ORDER BY id DESC LIMIT $recno,$rowperpage;";



$query = "SELECT * FROM testimoni ORDER BY id_testimoni DESC LIMIT $recno,$rowperpage;";
$hasil = mysql_query($query);
if (mysql_num_rows($hasil) > 0)

// ** PAGING NAVIGATION
    if ($total_rec>$rowperpage){ // *** IF TOTAL RECORD GREATER THAN RECORD PER PAGE => SHOW PAGING
    $paging_html.= '<div id="paging">';
    if (empty($_GET['page'])) $_GET['page']=1; // ** SET DEFAULT PAGE = 1
    // *** PREV RECORD LINK
    if ($_GET['page']>1) $paging_html.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']-1).'">&laquo;prev</a>';
    // *** PAGING NUMBERS LINK
    for ($i=1; $i<= ceil($total_rec/$rowperpage); $i++){
        $paging_html.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'"';
        if ($_GET['page']==$i) $paging_html.= ' class="paging_cur" ';
        $paging_html.= '>'.$i.'</a>';
    }
    // *** NEXT RECORD LINK
    if ($_GET['page']<ceil($total_rec/$rowperpage)) $paging_html.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']+1).'">next&raquo;</a> ';
    $paging_html.= '</div><!-- id="paging" -->';
    } // *** end if ($total_rec>$rowperpage)

{
    echo"<div id='bgpaging2'>".$paging_html."</div>";
   // jika ada komentar (jumlah data hasil query > 0), maka tampilkan komentarnya
   while ($data = mysql_fetch_array($hasil))
   {
       //echo"<table>";

      echo"<div id='testi'>";

       echo"<p>&raquo;".$data['commentDate']."</small></p>";
      echo "<p><img src='images/stats.png'>&nbsp;".$data['nama']."</p>"; 
      //echo "<p>&raquo;".$data['email']."</p>";
      echo "<p>&raquo;<q>".$data['komentar']."</q></p>";
      echo'<p>';
        echo"<center>".$gambar."<a href=\"gambar2/".$data['id_testimoni'].".jpg\" target='_blank'>
        <img src=\"gambar2/".$data['id_testimoni'].".jpg\" width=500 height=400 align=center border=1px </a>";
        echo'</center></p>';

     // echo"</tr>";
     // echo"</table>";
     echo"</div>";

   }

}

// jika tidak ada komentar (jumlah data hasil query = 0), tampilkan keterangan belum ada komentar
//else if (mysql_num_rows($hasil) == 0) echo "<p>Belum ada komentar.</p>";
//else if (mysql_num_rows($hasil) > 0) echo "".$hasil."";


// menampilkan form pengisian komentar
?>
<br>
</div>
<div class='cleared'></div>

<?php
include"footer.php";
?>