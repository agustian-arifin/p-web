<?php
// *** LOAD PAGE HEADER
include "header.php";


$sql="SELECT * FROM pages WHERE id='". $_GET['id'] ."'";
$qry=@mysql_query($sql);
$pecah = @mysql_fetch_array($qry);

echo '<div style="text-align:left">';
echo '<h1>'. $pecah['judul']  .'</h1>';

echo $pecah['isi'];

echo '</div>';





include "footer.php";
?>
