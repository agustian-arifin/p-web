
<div id="left">
<div id="hightlight"><i class="fa fa-tasks"></i></div>
<div class="kiri_kategori">
<?php
 //$idbarang = "SELECT id FROM php_shop_products WHERE id=".$_GET['id']"";
echo"<form method='post' action='#'>";
$rcat=@mysql_query("SELECT * FROM #");

    
while ($rowcat = @mysql_fetch_array($rcat)) {

      echo"<div id='kategori'>";
         echo"<ul id=''>";
           echo "<li><i class='fa fa-check-square'></i>
           <a href=\"list_barang.php?category=".$rowcat['nama']."\">".$rowcat['nama']. " </a>";
           ?>

           <?php
           $idkat = "SELECT id categories";

           $jumlahkategori = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id = $idkat"));
           ?> <?php echo"".$jumlahkategori.""?> </li>

<?php

         echo"</ul>";
       echo"</div>";
}
echo"</form>";
echo"</div>";
echo"<br>";
?>

<div id="hightlight2"></div>
<div class="kiri">

</div><br>

<div id="hightlight2"></div>
<div class="kiri">
</div><br><br>

</div>