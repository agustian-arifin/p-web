
<?php
include "header-admin.php";

if ($_POST['act']=="update"){
$sql_edit="UPDATE categories SET
 "."nama='".$_POST['kategori']."'

 "."WHERE id_kategori='".$_POST['id']."' ";
  @mysql_query($sql_edit);

echo'<script>window.location="tambah_kategori.php"</script>';

}

if (!empty($_GET['id'])){

$rs=@mysql_query("SELECT * FROM categories WHERE id_kategori='".$_GET['id']."'");
$row=@mysql_fetch_array($rs);
echo'<div id="bgkonten">';
echo'
<form method="post">
Nama Kategori: <input name="kategori"  class="texbox" value="'.$row['nama'].'"><br>
<a href="tambah_kategori.php"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
<input type="submit" value="UPDATE" class="btn_submit">
<input type="hidden" name="act" value="update">
<input type="hidden" name="id" value="'.$row['id_kategori'].'">
</form>';

}
echo"</div>";
?>
<div class="cleared"></div>
<?php
include"footer.php";
?>

