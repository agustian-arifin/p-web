<?php
// *** LOAD PAGE HEADER
include "header.php";
include"sidebar.php";



$qry_0 = "SELECT id_produk FROM produk ";
$qry_t="WHERE  category LIKE '%".$_SESSION['scategory']."%' AND ";
$qry_t.="( nama_produk LIKE '%".$_SESSION['scari']."%' ";
$qry_t.="OR category LIKE '%".$_SESSION['scari']."%' ";
$qry_t.="OR deskripsi LIKE '%".$_SESSION['scari']."%') ";
 

$total_rec=@mysql_num_rows(mysql_query($qry_0.$qry_t)); 

$rowperpage=12; 

if (!empty($_GET['page'])) $recno=($_GET['page']-1)*$rowperpage; else $recno=0;

$sql = "SELECT * FROM produk ".$qry_t." ORDER BY id_produk DESC LIMIT $recno,$rowperpage;";


$result = mysql_query($sql);
$ada = @mysql_num_rows($result);
$no=0;

if ($ada>0){ 
    if ($total_rec>$rowperpage){ 
    $paging_html.= '<div id="paging">';
    if (empty($_GET['page'])) $_GET['page']=1; 
    
    if ($_GET['page']>1) $paging_html.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']-1).'">&laquo;prev</a>';
   
    for ($i=1; $i<= ceil($total_rec/$rowperpage); $i++){
        $paging_html.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'"';
        if ($_GET['page']==$i) $paging_html.= ' class="paging_cur" ';
        $paging_html.= '>'.$i.'</a>';
    }
    
    if ($_GET['page']<ceil($total_rec/$rowperpage)) $paging_html.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']+1).'">next&raquo;</a> ';
    $paging_html.= '</div><!-- id="paging" -->';
    } 

?>

    
<div id="bgproduct">

<div id="hightlight2"><i class="fa fa-tasks"></i> List Product </div>

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
          
          echo'<tr><td class="harga_barang">';
          echo"Price: ".format_currency($row['harga'])."";
          echo'</td></tr>';
          
         
          

          echo'</table>';
      echo"</a>";
        echo'</div>';
}


echo"<div id='bgpaging'>".$paging_html."</div>";
echo '</div>';

} else {
     echo"<br>";
    echo "<img src='images/tidak_ditemukan.png'>";

}
// *** LOAD PAGE FOOTER

include "footer.php";
?>