
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";
echo"<div id='bgkonten'>";
echo '<h1 align="center">Daftar Artikel</h1>';

$total=mysql_num_rows(mysql_query("SELECT id FROM news;"));

$rowperpage=3;
// QUERY TABLE php_shop_products
if (!empty($_GET['page'])) $recno=($_GET['page']-1)*$rowperpage; else $recno=0;
$sql = "SELECT * FROM news ORDER BY id DESC LIMIT $recno,$rowperpage;";
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
    echo '
    <table border="1px">
    <tr bgcolor=#fff>
    <td><b>NO</b></td>
    <td><b>Judul</b></td>
    <td><b>isi</b></td>
    <td ><b>Dibaca</b></td>
     <td colspan=2 align=center><b>Aksi</b></td>
     </tr>';
        while ($row = mysql_fetch_array($result)){
            $no++;
			echo "<tr><td>".($recno+$no)."</td>";

				echo "<td>".$row['judul']."</td>";
                $kalimat=$row['isi'];
                $potong=substr($kalimat, 0, 400);
                echo "<td>".$potong."</td>";
                echo "<td>".$row['views']."Kali</td>";

				echo "<td><a href=\"edit.php?id=".$row['id']."\"><i class='fa fa-pencil' style='font-size: 20px;'></i></a></a></td>";
                echo"<td><a href=\"delete.php?id=".$row['id']."\"><i class='fa fa-eraser' style='font-size: 20px;'></i></a> </td>";
				

			echo "</tr>";
		}
    echo'
    </table>
    ';
} else {
    echo "<marquee>Artikel Masih Kosong Silahkan Isi</marquee>";
}

?>

<?php echo'<a href="tambah_artikel.php"><i class="fa fa-arrow-circle-o-left"></i> TAMBAH</a></td>';?>
</div>
<div class="cleared"></div>
<?php
include"footer.php";
?>

