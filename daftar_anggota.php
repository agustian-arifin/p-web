<?php
// *** LOAD PAGE HEADER
include "header.php";
include"sidebar.php";
?>
<?php
if ($_POST['act']=="add"){
    $sql_add="INSERT INTO produk(username,email,password,nama,stok) VALUES ("
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


<div id="bgproduct">
	<div id="hightlight2"><i class="fa fa-exchange"></i> Daftar Anggota Baru</div>
	<form method="post" enctype="multipart/form-data">
	*Username<br>
	<input name="username" class="texbox" size="90" required><br>
	*Email<br>
	<input name="email" class="texbox" size="90" required><br>
	*Password<br>
	<input type ="password" name="password" class="texbox" size="90" required><br>
	*Nama Perusahaan<br>
	<input name="nama" class="texbox" size="90" required><br>
	*No Telephone<br>
	<input name="email" class="texbox" size="90" required><br>
	*Alamat Kantor<br>
	<textarea name="alamat" class="textarea" rows="5" cols="100" required ></textarea><br>
	<input type="button" class="btn" value="DAFTAR">
	<input type="hidden" name="act" value="add">
	</form>
</div>
<?php
echo '&nbsp;<div class="cleared"></div>';
// *** LOAD PAGE FOOTER
include "footer.php";

?>
