<div id='wrapper'>
<?php
include "header-admin.php";

if ($_POST['act']=="update"){
$sql_edit="UPDATE news SET
 "."judul='".$_POST['judul']."',
 "."isi='".$_POST['isi']."'

 "."WHERE id='".$_POST['id']."' ";
  @mysql_query($sql_edit);

echo'<script>window.location="admin_artikel.php"</script>';

}

if (!empty($_GET['id'])){

$rs=@mysql_query("SELECT * FROM news WHERE id='".$_GET['id']."'");
$row=@mysql_fetch_array($rs);
echo'<div id="bgkonten">';
echo'
<form method="post">
Judul: <input name="judul"  class="texbox"  size="50" value="'.$row['judul'].'"><br>
Isi <br> <textarea class="ckeditor" class="ckeditor" cols="10" rows="40" name="isi">'.$row['isi'].'</textarea><br>
<a href="admin_artikel.php">[BACK]</a>
<input type="submit" value="UPDATE" class="btn">
<input type="hidden" name="act" value="update">
<input type="hidden" name="id" value="'.$row['id'].'">
</form>';

}
echo"</div>";

?>
<?php
echo'<div class="cleared"></div><br>';
include"footer_2.php";
?>
</div>
