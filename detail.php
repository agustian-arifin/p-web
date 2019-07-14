<?php
// *** LOAD PAGE HEADER
include "header.php";
include"sidebar.php";

$query = "UPDATE produk SET views = views + 1  WHERE id_produk='".$_GET['id_barang']."'";
mysql_query($query);

// QUERY TABLE php_shop_products n record per page
$sql = "SELECT * FROM produk WHERE id_produk='".$_GET['id_barang']."' ";
//echo $sql;
$result = mysql_query($sql);



    // *** DISPLAY TABLE PRODUCTS
echo '<div id=bgproduct_detail>';

    while ($row = mysql_fetch_array($result))
        {


echo'<div id="detail">';
 echo"<table><tr><td><a href='index.php'><i class='fa fa-home'></i> Home</a> &raquo; <a href=\"detail.php?id_barang=".$row['id_produk']."\" class=\"tbeli\">Detail Produk</a> &raquo; ".$row['category']." &raquo; ".$row['nama_produk']."</table></td></tr>";
   
echo"</div>";  
     
echo"<table id='desc_singkat'>";
	 echo"<tr><td><h1> ".$row['nama_produk']."</h></td></tr>";
     echo"<tr><td>&raquo; Kode Barang: BR".$row['id_produk']."</td></tr>";
	 echo"<tr><td>&raquo; Kategori: ".$row['category']."</td></tr>";
	 echo"<tr><td><h1>".format_currency($row['harga'])."</h1></td></tr>";
	 echo"</table>";	
echo'<table>';   
     echo"<td >".$gambar."<a href=\"items/".$row['id_produk'].".jpg\" >
     <img src=\"items/".$row['id_produk'].".jpg\" width='400px' height='400px' align=center border=1px </a>";	 
     echo"</td>";	
     echo"</tr>";    
echo"</table>";

 

echo"<div id='detail2'>";

echo"<table id='tabledetail'>";
echo"<div id='hightlight'><i class='fa fa-tasks'></i> Spesifikasi</div>";
     echo"<tr>";
     echo"<td></td>";
     echo"<td class='desc_long'>".$row['deskripsi']."</td>";
     echo"</tr>";
echo"</table>";
echo"</div>";
}

//include"produk_terkait.php";
echo '</div>';




echo '<div class="cleared"></div>';

// *** LOAD PAGE FOOTER
include "footer.php";

?>


