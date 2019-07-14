<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";

if ($_POST['act']=="edit"){
    $sql_edit="UPDATE produk SET "
    ."category='".$_POST['category']."', "
    ."nama_produk='".$_POST['name']."', "
    ."deskripsi='".$_POST['description']."', "
      ."harga='".$_POST['price']."', "
    ."stok='".$_POST['stok']."' "
    ."WHERE id_produk='".$_POST['id']."' ";
   @mysql_query($sql_edit);

if( !empty($_FILES['gambar']['name']) )
    {
   $path = "../items/";
    $new_image_name = $_POST['id'].".jpg";
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, $path.$new_image_name);
    }

echo '
    <script>window.location="admin_product.php"</script>
    ';

}

if (!empty($_GET['id'])){
    
    $rs=@mysql_query("SELECT * FROM produk WHERE id_produk='".$_GET['id']."'");
    $row=@mysql_fetch_array($rs);

			if (file_exists("../items/".$row['id_produk'].".jpg"))
                $gambar="<a href=\"../items/".$row['id_produk'].".jpg\"><img src=\"../items/".$row['id_produk'].".jpg\" width=50></br>view image</a>";
            else
                $gambar="";

echo '
<div id="bgkonten">
<td><a href="admin_product.php"><i class="fa fa-arrow-circle-o-left"></i> Back</a></td>
<h1 align="center">Edit Produk</h1>
<form method="post" enctype="multipart/form-data">
<table>
<tr><td>&raquo;&nbsp;category</td><td>:</td> <td><select name="category" class="texbox">
<option value="">PILIH KATEGORI</option>';

$rcat=@mysql_query("SELECT * FROM categories");

while ($rowcat = @mysql_fetch_array($rcat)) {
      echo '<option value="'.$rowcat['nama'].'" ';
      if ($row['category']==$rowcat['nama']) echo "selected";
      echo '>'.$rowcat['nama'].'</option>';
}

echo '</select></td></tr>
<tr><td>&raquo;&nbsp;Nama Produk</td><td>:</td><td><input name="name"  class="texbox" value="'.$row['nama_produk'].'"></td></tr>
<tr><td>&raquo;&nbsp;Deskripsi</td><td>:</td><td><textarea  cols="80" rows="7" name="description">'.$row['deskripsi'].'</textarea></td></tr>
<tr><td>&raquo;&nbsp;Harga</td><td>:</td><td><input name="price" class="texbox" value="'.$row['harga'].'"></td></tr>
<tr><td>&raquo;&nbsp;Stok</td><td>:</td><td><input name="stok" class="texbox" value="'.$row['stok'].'"></td></tr>

<tr><td>&raquo;&nbsp;<input type="file" name="gambar" ></br>'.$gambar.'</td></tr>
<tr><td>
    <input type="submit" value="UPDATE" class="btn_submit">
    <input type="hidden" name="act" value="edit">
    <input type="hidden" name="id" value="'.$row['id_produk'].'">
    </form></td></tr>';

}
echo"</table>";
echo'</div>';

?>
<div class="cleared"></div>
<?php
include"footer.php";
?>
</div>
