<div id='wrapper'>
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";

if ($_POST['act']=="delete"){
    $sql_delete="DELETE FROM categories "
    ."WHERE id_kategori='".$_POST['id']."' ";

    @mysql_query($sql_delete);
    echo'<script>alert("Sure to Delete??");window.location ="tambah_kategori.php";</script>';
}

if (!empty($_GET['id'])){

    $rs=@mysql_query("SELECT * FROM categories WHERE id_kategori='".$_GET['id']."'");
    $row=@mysql_fetch_array($rs);



echo '
<div id="bgkonten">
<form method="post" enctype="multipart/form-data">
<p>Nama Kategori : '.$row['nama'].'</p><br>
    <a href="tambah_kategori.php">[BACK]</a>
    <input type="submit" value="HAPUS POST" class="btn">
    <input type="hidden" name="act" value="delete" >
    <input type="hidden" name="id" value="'.$row['id_kategori'].'">
    </form>';

}
echo"</div>";
include"footer.php";
?>
</div>
