<?php

include"header.php";
include"left.php";
include"right.php";


echo "<div id='bgartikel'>";

// ***  DEKLARASI VARIABLE
if (!empty($_GET['page'])) $_SESSION['page']=$_GET['page'];
if (!empty($_SESSION['page'])) $_GET['page']=$_SESSION['page'];

// *** QUERY SEARCH
$qry_0 = "SELECT id FROM news ";
//echo "[ $qry_0.$qry_t ]";
$total_rec=@mysql_num_rows(mysql_query($qry_0)); // *** TOTAL RECORD PRODUCT

$rowperpage=5; // *** DISPLAY NUM RECORD PER PAGE

// ** predefine record number
if (!empty($_GET['page'])) $recno=($_GET['page']-1)*$rowperpage; else $recno=0;

// QUERY TABLE php_shop_products n record per page
$sql = "SELECT * from news ORDER BY id DESC LIMIT $recno,$rowperpage;";

//echo $sql;
$result = mysql_query($sql);
$ada = @mysql_num_rows($result);
$no=0;

if ($ada>0){ // ** IF RECORD EXISTS

    // ** PAGING NAVIGATION
    if ($total_rec>$rowperpage){ // *** IF TOTAL RECORD GREATER THAN RECORD PER PAGE => SHOW PAGING
    $paging_html.= '<div id="paging">';
    if (empty($_GET['page'])) $_GET['page']=1; // ** SET DEFAULT PAGE = 1
    // *** PREV RECORD LINK
    if ($_GET['page']>1) $paging_html.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']-1).'">sebelumnya&laquo;</a>';
    // *** PAGING NUMBERS LINK
    for ($i=1; $i<= ceil($total_rec/$rowperpage); $i++){
        $paging_html.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'"';
        if ($_GET['page']==$i) $paging_html.= ' class="paging_cur" ';
        $paging_html.= '>'.$i.'</a>';
    }
    // *** NEXT RECORD LINK
    if ($_GET['page']<ceil($total_rec/$rowperpage)) $paging_html.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']+1).'">selanjutnya&raquo;</a> ';
    $paging_html.= '</div><!-- id="paging" -->';
    } // *** end if ($total_rec>$rowperpage)

echo"<h6>Latest News</h6>";
while ($row = mysql_fetch_array($result))
        {

echo"<div class='artikel'>";


 

 ?>
      <?php
$jumlahkomentar = mysql_num_rows(mysql_query("SELECT * FROM komentar WHERE idArtikel = ".$row['id']." ")); ?>



<?php

echo"<table border='0' >";
      echo"<tr>";

       echo"<td><h3><a href=\"artikel_lengkap.php?id=".$row['id']."\" class=\"\"><span>".$row['judul']."</span></a></h3></tr>";

      echo"<tr><td>";
        echo"<div id='posted'>";
       echo"<ul>";

       echo"<li><a href='index.php'>Home</a></li>";
       echo"<li>&nbsp;&nbsp;&nbsp;&raquo;#".$row['kategori']."</li>";
       echo"<li>&raquo;Posted By : &nbsp;".$row['author']."</li>";
       echo"<li>&raquo;".$row['tanggal']."</li>";
       echo"<li>&raquo;Dibaca : ".$row['views']."Kali</li>";
        echo"<li id ='jumlah_komentar'>".$jumlahkomentar."</li>";
       echo"</ul>";
      echo"</div>";
        //echo"<div id='jumlah_komentar'>".$jumlahkomentar." Komentar</div>";
     echo" </td></tr>";
     

      echo"<td>".substr($row['isi'], 0, 550)."..........</td>";
      echo"</tr>"; echo"<br>";
      echo"<td><a href=\"artikel_lengkap.php?id=".$row['id']."\" class=\"more\"><span>Read More.....</span></a></td>";
 echo"</table>";
 echo"</div>";
}


}else {
    echo "TIDAK ADA DATA";
}
echo"<div id='bgpaging2'>".$paging_html."</div>";
echo"</div>";

echo'<div class="cleared"></div>';
include"footer.php";
?>
