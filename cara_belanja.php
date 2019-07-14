<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// *** LOAD PAGE HEADER
include "header.php";
include"sidebar.php";


$query = "UPDATE news SET views = views + 1  WHERE id='35'";
mysql_query($query);

$idArtikel = '35';

// proses menampilkan detail artikel berdasarkan id artikel
$query = "SELECT * FROM news WHERE id = '35'";
$hasil = mysql_query($query);
$row  = mysql_fetch_array($hasil);


echo"<div id='bgartikel2'>";

       echo"<table border='0'>";
       echo"<div id='posted'>";
       echo"<ul>";

       echo"<li><a href='index.php'>Home</a></li>";
       echo"<li>&nbsp;&nbsp;&nbsp;&raquo;#".$row['kategori']."</li>";
       echo"<li>&raquo;Posted By : &nbsp;".$row['author']."</li>";
       echo"</ul>";
      echo"</div>";
       echo"<div class='cleared'></div>";

        include"share.php";

      echo"<tr>";
      echo"<h1>".$row['judul']."</h1>";

      echo"<td>".$row['isi']."</td>";
      echo"</tr>";
     
   echo "<tr><td><a href=\"download.php?id=".$row['id_produk']."\" class=\"\"></td></tr>";
 echo"</table><br>";
?>



<?php


echo"</div>";
 echo"<div class='cleared'></div>";

include"footer.php";
?>