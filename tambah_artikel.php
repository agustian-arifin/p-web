
<?php
include "header-admin.php";
if ($_POST['act']=="add"){
    $sql_add="INSERT INTO news(judul,tanggal,author,isi,kategori) VALUES ("
    ."'".$_POST['judul']."',
    '".date("Y-m-d H:i:s")."',
    '".$_POST['author']."',
    '".$_POST['isi']."',
    '".$_POST['kategori']."'
    ) ";
    @mysql_query($sql_add);


    echo '
    <script>window.location="admin_artikel.php"</script>
    ';
}

?>

<?php
$sql = "SELECT * FROM admin where username='".$_SESSION['admin_username']."'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result)
?>
<div id='bgkonten'>
<td><a href="admin_artikel.php"><i class="fa fa-arrow-circle-o-left"></i> Back</a></td>
<table border="0px">
 <form method="post" enctype="multipart/form-data">
<tr><td>JUDUL</td> <td>:</td> <td><input name="judul" size="50" class="texbox"></td></tr>
<tr><td>KATEGORI</td> <td>:</td><td><input name="kategori" size="50" class="texbox"></td></tr>
<tr><td>AUTHOR</td> <td>:</td><td><input name="author"  size="50" class="texbox" readonly value=<?php echo" ".$row['nama'].""?>></td></tr>
<tr><td>ISI</td></tr></table>
<textarea class="ckeditor" cols="10" rows="90" name="isi"></textarea><br>


    
    <input type="submit" value="POSTING" class="btn_submit">
    <input type="hidden" name="act" value="add">
    </form>

</div>
<?php
echo'<div class="cleared"></div>';
include"footer.php";
?>

