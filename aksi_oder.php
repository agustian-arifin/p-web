<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// *** LOAD SESSION
session_start();
// *** LOAD CONFIGURATION VARS
include "../web_config_vars.php";
// *** DB CONNECTION
include "../db_conn.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='order' AND $act=='update'){
   // Jika status sebelumnya Lunas dan status baru bukan Lunas
   if ($_POST['status_order_lama']=='Lunas' AND $_POST['status_order']!='Lunas'){

      // Update untuk menambah stok
      mysql_query("UPDATE produk,orders_detail SET produk.stok=produk.stok+orders_detail.jumlah WHERE orders_detail.id_orders='$_POST[id]'");

      // Update untuk menambah produk yang dibeli (best seller = produk yang paling laris)
      mysql_query("UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli-orders_detail.jumlah WHERE orders_detail.id_orders='$_POST[id]'");

      // Update status order
      mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");
  }

  // Jika status sebelumnya bukan Lunas dan status baru Lunas
  elseif ($_POST['status_order_lama']!='Lunas' AND $_POST['status_order']=='Lunas'){

      // Update untuk mengurangi stok
      mysql_query("UPDATE produk,orders_detail SET produk.stok=produk.stok-orders_detail.jumlah WHERE orders_detail.id_orders='$_POST[id]'");

      // Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
      mysql_query("UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli+orders_detail.jumlah WHERE orders_detail.id_orders='$_POST[id]'");

      // Update status order
      mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");

  // Jika status sebelumnya lunas dan status baru bukan lunas
  }

  else{
     mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}


?>
