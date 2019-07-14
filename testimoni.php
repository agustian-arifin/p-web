<div id='wrapper'>
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";
echo"<div id='bgkonten'>";


$total=mysql_num_rows(mysql_query("SELECT id_testimoni FROM testimoni;"));

$rowperpage=2;
// QUERY TABLE php_shop_products
if (!empty($_GET['page'])) $recno=($_GET['page']-1)*$rowperpage; else $recno=0;
$sql = "SELECT * FROM testimoni ORDER BY id_testimoni DESC LIMIT $recno,$rowperpage;";
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
    <table border="1">
    <tr>
    <td><b>NO</td>
    <td align="center"><b>TANGGAL</td>
    <td align="center"><b>NAMA</td>
    <td align="center"><b>EMAIL</td>
    <td align="center"><b>PESAN</td>

     <td align="center"><b>BUKTI</td>
    <td colspan="4" align="center"> <b>AKSI</td>
    </tr>
    ';
        while ($row = mysql_fetch_array($result)){
            $no++;
   echo "<tr><td>".($recno+$no)."</td>";
			if (file_exists("../gambar2/".$row['id_testimoni'].".jpg"))
                $gambar="<a href=\"../gambar2/".$row['id_testimoni'].".jpg\" width=20 height=30 target='_blank'>
                <img src=\"../gambar2/".$row['id_testimoni'].".jpg\" width=60 height=60 target='_blank'></br>Lihat Gambar</a>";
            else
                $gambar="";
				echo "<td>".$row['commentDate']."</td>";
                echo "<td>".$row['nama']."</td>";
				echo "<td>".$row['email']."</td>";
				echo "<td>".$row['komentar']."</td>";
                 echo"<td>" .$gambar."</td>";
				//echo "<td><a href=\"admin_product_edit.php?id=".$row['id']."\">[EDIT]</a><td>";
                echo"<td><a href=\"hapus_testimoni.php?id=".$row['id_testimoni']."\">[DELETE]</a></td>";

			echo "</tr>";
		}
    echo'
    </table>
    ';
} else {
    echo "Data Yang Diminta Tidak Tersedia";
}

echo"</center>";


echo"</div><br><br><br><br>";
include"footer.php";
?>
</div>
