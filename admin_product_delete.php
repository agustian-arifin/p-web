
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";

if ($_POST['act']=="delete"){
    $sql_delete="DELETE FROM produk "
    ."WHERE id_produk='".$_POST['id']."' ";

    @mysql_query($sql_delete);
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
<form method="post" enctype="multipart/form-data">
&raquo;&nbsp;Kategori : '.$row['category'].'<br>
&raquo;&nbsp;Nama Produk : '.$row['nama_produk'].'<br>
&raquo;&nbsp;Deskripsi : '.$row['deskripsi'].'<br>
&raquo;&nbsp;Harga: '.$row['harga'].'<br>
&raquo;&nbsp;'.$gambar.'</br>
    
    <input type="submit" value="DELETE" class="btn_submit">
    <input type="hidden" name="act" value="delete" >
    <input type="hidden" name="id" value="'.$row['id_produk'].'">
    </form>
';

}
echo"</div>";
?>
<div class="cleared"></div>

<?php
include"footer.php";
?>

