<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// *** LOAD PAGE HEADER
include "header.php";
include"sidebar.php";


//echo $sql;
$result = mysql_query($sql);
$ada = @mysql_num_rows($result);

?>

<style>
#bgslider{
    margin-left:1px;
    height:auto;
    width:980px;
    float:right;
    
}

</style>
<div id="bgslider">
     <!-- Start Slider BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
		<li><img src="data1/images/promo_cisco.jpg" alt="" width="900px" title="" id="wows1_0"/></li>
		<li><a href="http://wowslider.com/vf"><img src="data1/images/promo_hp.jpg" width="900px" alt="full screen slider" title="full screen slider" id="wows1_1"/></a></li>
		<li><img src="data1/images/promo_laptop.jpg" width="900px" alt="" title="" id="wows1_2"/></li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title=""><img src="data1/tooltips/promo_cisco.jpg" width="900px" alt=""/></a>
		<a href="#" title="full screen slider"><img src="data1/tooltips/promo_hp.jpg" width="900px" alt="full screen slider"/></a>
		<a href="#" title=""><img src="data1/tooltips/promo_laptop.jpg" width="900px" alt=""/></a>
	</div></div>
	<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
	<!-- End Slider BODY section -->

</div>
<?php

//echo "[ $qry_0.$qry_t ]";
$total_rec=@mysql_num_rows(mysql_query($qry_0.$qry_t)); // *** TOTAL RECORD PRODUCT

$rowperpage=12; // *** DISPLAY NUM RECORD PER PAGE

// ** predefine record number
if (!empty($_GET['page'])) $recno=($_GET['page']-1)*$rowperpage; else $recno=0;

// QUERY TABLE php_shop_products n record per page
$sql = "SELECT * FROM produk ".$qry_t." ORDER BY id_produk DESC LIMIT $recno,$rowperpage;";

//echo $sql;
$result = mysql_query($sql);
$ada = @mysql_num_rows($result);
$no=0;


?>

   
<div id='bgproduct'>
<div id="hightlight2"> <i class="fa fa-tasks"></i> Terbaru <a href="list_barang.php"> [Cari Produk]</a></div> 

<?php
    while ($row = mysql_fetch_array($result))
        {
         echo "<a href=\"detail.php?id_barang=".$row['id_produk']."\" class=\"tbeli\">";
		 
        echo'<div class="barang">';		  
        echo'<table>';
		
		 echo'<tr><td class="nama_barang" align="center">';
         echo"".$row['nama_produk']."";
         echo'</td></tr>';
		
        echo'<tr><td>';
        echo"".$gambar."<a href=\"items/".$row['id_produk'].".jpg\" target='_blank'>
        <img src=\"items/".$row['id_produk'].".jpg\" width=190 height=204  align=center border=0 ></a>";
        echo'</td></tr>';
          
          echo'</table>';
		  echo"</a>";
        echo'</div>';
}

echo '</div>';

include "footer.php";
?>