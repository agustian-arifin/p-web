<div id='wrapper'>
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";

if ($_POST['aksi']=="hapus"){
    $sql_delete="DELETE  FROM testimoni WHERE id_testimoni='".$_GET['id']."' ";

    @mysql_query($sql_delete);

    echo'<script>alert("Sure to Delete??");window.location ="testimoni.php";</script>';

}

if (!empty($_GET['id'])){

    $rs=@mysql_query("SELECT * FROM testimoni WHERE id_testimoni='".$_GET['id']."'");
    $row=@mysql_fetch_array($rs);

			if (file_exists("../gambar2/".$row['id_testimoni'].".jpg"))
                $gambar="<a href=\"../gambar2/".$row['id_testimoni'].".jpg\"><img src=\"../gambar2/".$row['id_testimoni'].".jpg\" width=60 height='70'></br>view image</a>";
            else
                $gambar="";

echo '
<div id="bgkonten">
<form method="post" enctype="multipart/form-data">
&laquo;&nbsp;Tanggal : '.$row['commentDate'].'<br>
&laquo;&nbsp;Nama Pengirim : '.$row['nama'].'<br>
&laquo;&nbsp;Email : '.$row['email'].'<br>
&laquo;&nbsp;Pesan : '.$row['komentar'].'<br>

&laquo;&nbsp;'.$gambar.'</br>
    <a href="testimoni.php">[BACK]</a>
    <input type="submit" value="HAPUS" class="btn">
    <input type="hidden" name="aksi" value="hapus" >
    <input type="hidden" name="id" value="'.$_GET['id_testimoni'].'">
    </form>
';

}
echo"</div><br><br><br>";
include"footer.php";
?>
</div>
