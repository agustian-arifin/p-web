
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";




if ($_POST['act']=="add"){
    $sql_add="INSERT INTO produk(category,nama_produk,deskripsi,harga,stok) VALUES ("
    ."'".$_POST['category']."','".$_POST['name']."','".$_POST['description']."','".$_POST['price']."','".$_POST['stok']."') ";
    @mysql_query($sql_add);

if( !empty($_FILES['gambar']['name']) )
    {
    $path = "../items/";
    $lastid=@mysql_result(@mysql_query("SELECT id_produk FROM produk ORDER BY id_produk DESC LIMIT 0,1"),0,0);
    $new_image_name = $lastid.".jpg";
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, $path.$new_image_name);
    }

    echo '
    <script>window.location="admin_product.php"</script>
    ';
}

?>
<div id="bgkonten">
<td><a href="admin_product.php"><i class="fa fa-arrow-circle-o-left"></i> Back</a></td>
<h1 align="center">Tambah Produk</h1>
<form method="post" enctype="multipart/form-data">
<table>
<tr><td>&laquo;&nbsp;Kategori</td><td>:</td><td><select name="category" class="texbox">

<?php
$rcat=@mysql_query("SELECT * FROM categories");
while ($rowcat=@mysql_fetch_array($rcat)){
      echo ' <option value="'.$rowcat['nama'].'">'.$rowcat['nama'].'</option>';
}
echo'</td></tr>';
?>

</select><br>

<tr><td>&laquo;&nbsp;Nama Produk</td><td>:</td><td><input name="name" size="50" class="texbox"></td></tr>
<tr><td>&laquo;&nbsp;Deskripsi</td><td>:</td><td><textarea cols="80" rows="7" name="description"></textarea></td></tr>
<tr><td>&laquo;&nbsp;Harga</td><td>:</td><td><input name="price" size="30" class="texbox"></td></tr>
<tr><td>&laquo;&nbsp;Stok</td><td>:</td><td><input name="stok" size="30" class="texbox"></td></tr>

<tr><td>&laquo;&nbsp;<input type="file" name="gambar" ></td></tr>
<tr>
<td><input type="submit" value="SIMPAN" class="btn_submit">
    <input type="hidden" name="act" value="add"></td></tr>
    </table>
    </form>
</div>
<div class="cleared"></div>
<?php
include"footer.php";
?>
<