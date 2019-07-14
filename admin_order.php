
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";
 echo"<div id='bgkonten'>";

// ***  (start) TAMPILAN FORM CARI / SEARCH
            //echo '<div class="formcari">';

           // echo'<form method="post" action="cari_order.php">';

            //echo'<input type="hidden" name="act" value="search">';
           // echo '<input class="texbox" name="cari" placeholder="Search Here" size="50">';
            // echo'<input class="btn" type="submit" value="CARI" title="cari">';
           // echo'</form>';
           // echo'</div>';

// *** set last current page by session


if (!empty($_GET['page'])) $_SESSION['page']=$_GET['page'];
if (!empty($_SESSION['page'])) $_GET['page']=$_SESSION['page'];


if ( ($_GET['act']=="delete") && !empty($_GET[id]) ){
    @mysql_query("DELETE FROM daftar_order WHERE kode_order='".$_GET[id]."'");
    //echo"Data Berhasil Dihapus";
}


$status=$_POST['status'];
echo"<center>";
echo '<h1 align="center">Daftar Orderan Masuk</h1>'.$msg;

$total=mysql_num_rows(mysql_query("SELECT kode_order FROM daftar_order;"));

$rowperpage=1;
// QUERY TABLE php_shop_products
if (!empty($_GET['page'])) $recno=($_GET['page']-1)*$rowperpage; else $recno=0;
$sql = "SELECT * FROM daftar_order ORDER BY kode_order DESC LIMIT $recno,$rowperpage;";
$result = mysql_query($sql);
$ada = mysql_num_rows($result);
$no=0;
if ( ($total>0) && ($ada == 0) ) echo '<script>window.location="'.$_SERVER['PHP_SELF'].'?page=1";</script>';

if ($ada>0){
    if ($total>$rowperpage){ // *** IF TOTAL RECORD GREATER THAN RECORD PER PAGE => SHOW PAGING

    if (empty($_GET['page'])) $_GET['page']=1;

if ($_GET['page']>1) echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']-1).'">&laquo; </a> | ';
    for ($i=1; $i<= ceil($total/$rowperpage); $i++){
        echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a> | ';
    }
    if ($_GET['page']<ceil($total/$rowperpage)) echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']+1).'">&raquo; </a> ';

    } // *** END if ($total>$rowperpage)



$status="LUNAS";
while ($row = mysql_fetch_array($result)){

$cek = mysql_query("SELECT * FROM konfirmasi WHERE kode_order ='".$row['kode_order']."'");

$num_row = mysql_num_rows($cek);
if ($num_row ==0){
    $konfirmasi="<blink>Belum</blink>";
}
else{
    $konfirmasi="<s>Sudah</s>";
}
$sql="SELECT * FROM pembeli WHERE kode_order= '".$row['kode_order']."' ";
$hasil = mysql_query($sql);

if ($data = mysql_fetch_array($hasil))
       {
           $nama=$data['nama_pembeli'];
           $email=$data['email_pembeli'];
           $telepon=$data['telepon_pembeli'];
           $alamat=$data['alamat_pembeli'];
     }



         echo"<table id='data_pembeli'>";
                echo "<tr><td>";



         echo"<a href=\"".$_SERVER['PHP_SELF']."?id=".$row['kode_order']."&amp;act=update\"> <input type='button' value='Lunas' class='btn_submit'></a> "
            ."<a onclick=\"return confirm('Are you sure to Delete?');\" href=\"".$_SERVER['PHP_SELF']."?id=".$row['kode_order']."&amp;act=delete\">
            <input type='button' value='Delete' class='btn_submit'></a>


            </td>";
			echo "</tr>";

              if ( ($_GET['act']=="update") && ($_GET['id']==$row['kode_order']) ){
            $orders_info=@mysql_result(@mysql_query("UPDATE daftar_order SET status ='".$status."' WHERE kode_order='".$_GET['id']."'"));
         }
                 $no++;
                echo "<tr><td>&raquo; Status   :<del> ".$row['status']."</del></td></tr>";
                 echo "<tr><td>&raquo; Status Konfirmasi : ".$konfirmasi."</td></tr>";
                echo "<tr><td>&raquo; Kode Order  : ".$row['kode_order']."</td></tr>";
				echo "<tr><td>&raquo; Tanggal Order  : ".$row['tanggal_order']."</td></tr>";
                echo "<tr><td>&raquo; Jam Order  : ".$row['jam_order']."</td></tr>";
                echo "<tr><td>&raquo; Info belanja : ".$row['orders_info']."</td></tr>";

           echo"</table>";

           echo"<table id='alamat_pembeli'>";
            //if ( ($_GET['act']=="view") && ($_GET['id']==$row['id_order']) ){
            //$sql="SELECT * FROM pembeli WHERE kode_order= '".$row['kode_order']."' ";
           // $result = mysql_query($sql);

//if ($row = mysql_fetch_array($result))
       // {


             echo'<tr><td><h4>ALAMAT PEMBELI</h4></td></tr>';
    echo "<tr><td>&raquo; Nama  &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;     : ".$nama."</td></tr>";
                echo "<tr><td>&raquo; Email &nbsp;&nbsp; &nbsp; &nbsp;   &nbsp;&nbsp;   : ".$email."</td></tr>";
                echo "<tr><td>&raquo; Telepon &nbsp;&nbsp; &nbsp;&nbsp;  : ".$telepon."</td></tr>";
                echo "<tr><td>&raquo; Alamat &nbsp;&nbsp; &nbsp; &nbsp;     : ".$alamat."</td></tr>";
			echo "</tr>";

        //}

}
  echo"</table>";
  //echo'</form>';

}
echo"</center>";
echo"</div>";
?>
<div class="cleared"></div>
<?php
include"footer.php";
?>

