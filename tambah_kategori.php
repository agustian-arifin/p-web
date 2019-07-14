
<?php
include "header-admin.php";
if ($_POST['act']=="add"){
    $sql_add="INSERT INTO categories(nama) VALUES ("."'".$_POST['kategori']."') ";
    @mysql_query($sql_add);


    echo '
    <script>window.location="tambah_kategori.php"</script>
    ';
}

?>
<div id='bgkonten'>
<table border="0px">
 <form method="post" enctype="multipart/form-data">
<tr><td>Nama Kategori</td> <td>:</td> <td><input name="kategori" size="25" class="texbox"></td></tr>

    <td><a href="index.php"><i class="fa fa-arrow-circle-o-left"></i> Back</a></td>
    <input type="submit" value="SIMPAN" class="btn_submit">
    <input type="hidden" name="act" value="add">
    </form>

    <?php
    $sql = "SELECT * FROM categories";
    $result = mysql_query($sql);
    
    echo"
    <table border='1'  cellspacing='0' cellpadding='0'>
    <tr><td colspan=5><h3 align='center'>Daftar Kategori</h3></td></tr>

    <tr bgcolor=>
    <td><b>ID</b></td>
    <td><b>Nama Kategori</b></td>
    <td colspan=4><b>Pilihan</b></td>
    </tr>";
    
    while ($row = mysql_fetch_array($result))
        {

             echo"<tr>";
             echo"<td>".$row['id_kategori']."</td>";
             echo"<td>".$row['nama']."</td>";
             //echo "<td><a href=\"edit_kategori.php?id=".$row['id_kategori']."\">[EDIT]</a></td>";
             //echo"<td><a href=\"hapus_kategori.php?id=".$row['id_kategori']."\">[DELETE]</a> </td>";
			 echo "<td><a href=\"edit_kategori.php?id=".$row['id_kategori']."\"> <i class='fa fa-pencil' style='font-size: 20px;'></i></a><td>";
             echo"<td><a href=\"hapus_kategori.php?id=".$row['id_kategori']."\"><i class='fa fa-eraser' style='font-size: 20px;'></i></a></td>";
             echo"</tr>";

}
echo"</table>";
    ?>

</div>
<div class="cleared"></div>
<?php
include"footer.php";
?>


