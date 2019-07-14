<a href='#'>
<?php
// *** SWITCH ACTION
'echo<div id="tbcart">';


$product_id = $_GET[id];	 //the product id from the URL
$action 	= $_GET[action]; //the action from the URL


switch($action) {

    case "add":
        // TAMBAH 1 UNTUK NILAI PRODUCT ID -> $product_id

 $sql = mysql_query("SELECT stok FROM produk WHERE id_produk='".$product_id."'");
	while($row=mysql_fetch_array($sql))

if ( $row['stok']==0){
        echo "<script>window.alert('MAAF !!! Stok Habis');
        window.location=('list_barang.php')</script>";
    }
  else{

   $_SESSION['cart'][$product_id]++;
  }
    break;

    case "remove":
        // KURANG 1 UNTUK NILAI PRODUCT ID -> $product_id
       unset ($_SESSION['cart'][$product_id]);

    break;

    case "empty":
        // MENGKOSONGKAN CART (KERANJANG) memakai function unset SELURUH ITEM PRODUCT AKAN DIKOSONGKAN
        unset($_SESSION['cart']);
    break;
    

    case "update":

    $sql = mysql_query("SELECT stok FROM produk WHERE id_produk='".$product_id."'");
	while($r=mysql_fetch_array($sql)){
    if ($_GET['jumbel'] > $r['stok']){
        echo "<script>window.alert('MAAF !!! Jumlah Barang Yang Anda Minta Melebihi Stok Yang Ada');
        window.location=('info_belanja.php')</script>";
    }
    elseif ($_GET['jumbel'] == 0){
        echo "<script>window.alert('MAAF !!! Jumlah Beli Tidak Boleh Dikosongkan');
        window.location=('info_belanja.php')</script>";
    }

    else{
      $_SESSION['cart'][$product_id] = $_GET['jumbel'];

   }
}
  //  }
		break;

    
}


if($_SESSION['cart']) {	// *** JIKA KERANJANG ADA ISI NYA / TIDAK KOSONG


    // TAMPILKAN TABEL KERANJANG
    echo "<table border=\"0\"  cellspacing=0 cellpadding=0 id=\"tbcart\">";	// format tampilan menggunakan HTML table

    echo '<tr><td colspan=4></td></tr>';

        foreach($_SESSION['cart'] as $product_id => $quantity) {

                     $sql = sprintf("SELECT id_produk, nama_produk, harga,stok FROM produk WHERE id_produk = %d;",
                            $product_id);

            $result = mysql_query($sql);

            // HANYA MENAMPILKAN JIKA PRODUCT NYA ADA / TIDAK KOSONG
            if(mysql_num_rows($result) > 0) {

                list($kode, $name, $price) = mysql_fetch_row($result);

                // MENGHITUNG SUBTOTAL ($line_cost) DARI HARGA ($price) * JUMLAH ($quantity)
                $line_cost = $price * $quantity;

                // MENGHITUNG TOTAL DENGAN MENAMBAHKAN SUBTOTAL ($line_cost) MASING2 PRODUCT
                $total_cost += $line_cost;
                $total_quantity += $quantity;

            }

        }

        //TAMPILKAN TOTAL
        echo "<tr>";
            echo "<td>";
            echo "</td>";
            echo "<td><i class='fa fa-shopping-cart' style='font-size: 30px; color:#fff;'></i>  ".number_format($total_quantity,0,"",".")." Cart (Items)</td>";
        echo "</tr>";

        echo "<tr>";
            
           echo "</tr>";

             echo "<tr>";
            
        echo "</tr>";
    echo "</table>";


}
else
{  // JIKA KERANJANG KOSONG -> TAMPILKAN PESAN INI

    echo "<table border=\"0\" cellspacing=0 cellpadding=0 id=\"tbcart\">";	// format tampilan menggunakan HTML table
    //TAMPILKAN TOTAL

     echo "<tr>";
            echo "<td><i class='fa fa-shopping-cart' style='font-size: 30px; color:#fff;'></i> ".number_format($total_quantity,0,"",".")."(Items)</td>";
            echo "</tr>";
            echo"";
    echo "</table>\n";
}
?>
</a>