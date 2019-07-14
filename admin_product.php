
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";
echo"<div id='bgkonten'>";
echo "<a href=\"admin_product_add.php\"><input type='button' value='TAMBAH' class='btn_submit'></a> ";


$total=mysql_num_rows(mysql_query("SELECT id_produk FROM produk;"));

$rowperpage=5;
// QUERY TABLE php_shop_products
if (!empty($_GET['page'])) $recno=($_GET['page']-1)*$rowperpage; else $recno=0;
$sql = "SELECT * FROM produk ORDER BY id_produk DESC LIMIT $recno,$rowperpage;";
$result = mysql_query($sql);
$ada = mysql_num_rows($result);
$no=0;
if ($ada>0){
    if (empty($_GET['page'])) $_GET['page']=1;
    ;
    if ($_GET['page']>1) echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']-1).'">&laquo; </a> | ';
    for ($i=1; $i<= ceil($total/$rowperpage); $i++){
        echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a> | ';
    }
    if ($_GET['page']<ceil($total/$rowperpage)) echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']+1).'">&raquo; </a> ';
    echo"<center>";
    echo '
    <table border="1" class="bgproduct">
    <tr>
    <td><b>NO</td>
    <td align="center"><b>KATEGORI</td>
    <td align="center"><b>ID PRODUK</td>
    <td align="center"><b>NAMA</td>
     <td align="center"><b>STOK</td>
      <td align="center"><b>GAMBAR</td>
    <td align="center"><b>DESKRIPSI</td>
    <td align="center"><b>HARGA</td>
    <td colspan="4" align="center"> <b>PILIHAN</td>
    </tr>
    ';
        while ($row = mysql_fetch_array($result)){
            $no++;
			echo "<tr><td>".($recno+$no)."</td>";
			if (file_exists("../items/".$row['id_produk'].".jpg"))
                $gambar="<a href=\"../items/".$row['id_produk'].".jpg\" target='_blank'><img src=\"../items/".$row['id_produk'].".jpg\" width=50 ></br>Lihat Gambar</a>";
            else
                $gambar="";
				echo "<td>".$row['category']."</td>";
                echo "<td>BR".$row['id_produk']."</td>";
				echo "<td>".$row['nama_produk']."</td>";
                echo "<td>".$row['stok']."</td>";
                echo"<td align='center'>".$gambar."</td>";
				echo"<td>".substr($row['deskripsi'], 0, 100)."..........</td>";
				echo "<td>".format_currency($row['harga'])."</td>";
				echo "<td><a href=\"admin_product_edit.php?id=".$row['id_produk']."\"> <i class='fa fa-pencil' style='font-size: 20px;'></i></a><td>";
                echo"<td><a href=\"admin_product_delete.php?id=".$row['id_produk']."\"><i class='fa fa-eraser' style='font-size: 20px;'></i></a></td>";
			
			echo "</tr>";
		}
    echo'
    </table>
    ';
} else {
    echo "Data Yang Diminta Tidak Tersedia";
}

echo"</center>";

echo"</div>";
?>
<div class="cleared"></div>
<?php
include"footer.php";
?>

