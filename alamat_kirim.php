<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// *** LOAD PAGE HEADER
include "header.php";
include"left.php";
include"right.php";
?>
<div id="keranjang">
<h2>DETAIL BELANJA</h2>
<br>
<?php
//unset ($err);

if ($_POST['act']=="order"){
    if (empty($_POST['info_belanja'])) $err['info_belanja']="<span class=\"err\">Your Cart still empty.</span>\n";
    if (empty($_POST['namalengkap'])) $err['namalengkap']="<span class=\"err\">Please fill Your Name.</span>\n";
    if (empty($_POST['email'])) $err['email']="<span class=\"err\">Please fill Your Email.</span>\n";
    if (!preg_match("/^[a-z0-9\_\.\-]+\@[a-z0-9\_\.\-]+$/i",$_POST['email'])) $err['email']="<span class=\"err\">Email &quot;".$_POST['email']."&quot; is not valid.</span>\n";
    if (empty($_POST['telphp'])) $err['telphp']="<span class=\"err\">Please fill Your Telephone/HP.</span>\n";
    if (empty($_POST['alamat'])) $err['alamat']="<span class=\"err\">Please fill Your Address.</span>\n";
    if ($_POST['sixletterscode']<>$_SESSION['6_letters_code']) $err['sixletterscode']="<span class=\"err\">Validation Code not correct.</span>\n";

    if(count($err)>0){ // *** if submit error
        echo "Some Errors occurs, Please fill the Delivery Address form completly &amp; correctly.";
    } else { // *** if submit OK
        $mode="order_send_ok";
        // *** WRITE DATABASE
        $sql_insert="INSERT INTO php_shop_orders (order_date,fullname,email,telp_cell,address,orders_info) "
        ."VALUES ('".date("Y-m-d H:i:s")."','".$_POST['namalengkap']."','".$_POST['email']."','".$_POST['telphp']."', "
        ."'".$_POST['alamat']."','".$_POST['info_belanja']."')";
        @mysql_query($sql_insert);

        /* MENGIRIM EMAIL ORDERAN */
        $to      = $_POST['email'];
        $subject = 'Orderan Toko Online Pahmi.com';
        $message = $_POST['info_belanja'];
        $headers = 'From: pahmiritonga@gmail.com' . "\r\n" .
            'Reply-To: pahmiritonga@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        @mail($to, $subject, $message, $headers);

        /* MENGIRIM EMAIL NOTIIFIKASI ORDERAN MASUK */
        $to2      = "pahmiritonga@gmail.com";
        $subject = 'Orderan Toko Online Pahmi.com';
        $message = $_POST['info_belanja'];
        $headers2 = 'From: '.$_POST['email'] . "\r\n" .
            'Reply-To: ' .$_POST['email']. "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        @mail($to2, $subject, $message, $headers2);

        unset ($_SESSION['cart']);
        echo 'Yang Terhormat'.$_POST['namalengkap'].',</br>
        Orderan Anda Sudah terkirim</br>
        Dan Akan Segera Dikirim 1x24 Jam Setelah Transfer</br>
        </br>
        Thank you.</br></br>';
    }
}

if ($mode!="order_send_ok"){ // *** DISPLAY FORM IF NO ORDERS TO BE SENT

$no=0;
$checkout_cnt="";

// JIKA KERANJANG TIDAK KOSONG
if($_SESSION['cart']) {
    // TAMPILKAN TABEL KERANJANG

    $checkout_cnt.= "<table   cellspacing=0 cellpadding=0 id=\"tbcheckout\">";	// format tampilan menggunakan HTML table
    $checkout_cnt.="";

        // LOOPING / PENGULANGAN : UNTUK MENDEFINISIKAN ISI KERANJANG
        // $product_id sebagai key DAN $quantity sebagai value
        foreach($_SESSION['cart'] as $product_id => $quantity) {

            // MENDAPATKAN name, description, price DARI database - INI TERGANTUNG penamaan implementation database anda .
            // GUNAKAN FUNCTION sprintf AGAR/SUPAYA $product_id MASUK KE DALAM query SEBAGAI SEBUAH number - UNTUK MENGHINDARI SQL injection (HACKING)
            $sql = sprintf("SELECT name, description, price FROM php_shop_products WHERE id = %d;",
                            $product_id);

            $result = mysql_query($sql);

            // HANYA MENAMPILKAN JIKA PRODUCT NYA ADA / TIDAK KOSONG
            if(mysql_num_rows($result) > 0) {
                $no++;

                list($name, $description, $price) = mysql_fetch_row($result);

                // MENGHITUNG SUBTOTAL ($line_cost) DARI HARGA ($price) * JUMLAH ($quantity)
                $line_cost = $price * $quantity;

                // MENGHITUNG TOTAL JUMLAH ($quantity)
                 $total_quantity += $quantity;





                // MENGHITUNG TOTAL DENGAN MENAMBAHKAN SUBTOTAL ($line_cost) MASING2 PRODUCT
                $total = $total + $line_cost;

                $checkout_cnt.="<tr>";
                    // MENAMPILKAN DATA KE DALAM table cells
                    $checkout_cnt.="<td>$name</td>";
                    $checkout_cnt.="<td class=\"num\">".format_currency($price)."</td>";
                    $checkout_cnt.="<td class=\"num\">".$description."</td>";
                    $checkout_cnt.="<td class=\"num\">$quantity</td>";
                    $checkout_cnt.="<td class=\"num\">".format_currency($line_cost)."</td>";
                    $checkout_cnt.="<td class=\"num\">"."<a href=\"$_SERVER[PHP_SELF]?action=remove&id=$product_id\">[-]</a></td>";

                    $info_belanja.="$name | $price | $quantity | $line_cost \n";

                $checkout_cnt.="</tr>";

            }

        }

        //show the total
        $checkout_cnt.="<tr bgcolor=\"#fff\">";
        $checkout_cnt.="<td colspan=\"4\"  class=\"num\">TOTAL BAYAR</td>";
        $checkout_cnt.="<td class=\"num\"></td><td class=\"num\">".format_currency($total)."</td>";
        $checkout_cnt.="</tr>";
        $info_belanja.="TOTAL=  $total\n";


    $checkout_cnt.="</table>";
    $checkout_cnt.=""."<a href=\"$_SERVER[PHP_SELF]?action=empty\" class=\"btnkrnjg\" onclick=\"return confirm('Yakin Akan dihapus?');\">Kosongkan Keranjang</a>";

    echo $checkout_cnt;

    echo $err['info_belanja'].'



    <form method="post">
    <input type="hidden" name="info_belanja" value="'.htmlentities($checkout_cnt).'">
    <table id="kirim" border=0 cellspacing=0 cellpadding=0>
    <tr><td class="ck">Name : </td><td class="cv"><input name="namalengkap" class="mytextinp" value="'.$_POST['namalengkap'].'">'.$err['namalengkap'].'</td></tr>
    <tr><td class="ck">Email : </td><td class="cv"><input name="email" class="mytextinp" value="'.$_POST['email'].'">'.$err['email'].'</td></tr>
    <tr><td class="ck">telp/HP : </td><td class="cv"><input name="telphp" class="mytextinp" value="'.$_POST['telphp'].'">'.$err['telphp'].'</td></tr>
    <tr><td class="ck">Address :</br><small>Street, City, Country</small></td><td class="cv"><textarea name="alamat" rows=4 cols=40 class="mytextinp">'.$_POST['alamat'].'</textarea>'.$err['alamat'].'</td></tr>
    <tr><td class="ck">Type the Code</br>on input box below</td><td class="cv">
        <img src="captcha.php?rand=" id="captchaimg" style="float:left;margin:6px 4px 0 0;border:1px dashed #000;">
        <small style="float:left">can not read?</br><a href=\'javascript: refreshCaptcha();\'>retry</a> another code</small>
        <script language="JavaScript" type="text/javascript">
            function refreshCaptcha()
            {
                var img = document.images[\'captchaimg\'];
                img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
            }
        </script>
        <div class="cleared"></div>
        <input id="sixletterscode" name="sixletterscode" type="text"  maxlength="6"
        class="mytextinp" style="width:160px;height:60px;font-family:FontCaptcha;font-size:44px;color:#009;text-align:center;">
        '.$err['sixletterscode'].'</td></tr>

    <tr><td></td><td><input type="hidden" name="act" value="order">
    <input type="submit" value="SEND" class="mybutton">
    <input type="reset" value="CLEAR" class="mybutton"></td></tr>
    </table>

    </form>
    ';
}else{
    //otherwise tell the user they have no items in their cart
    echo "Keranjang Anda Maih kosong Silahkan Belanja Belanja Terlebih Dahulu<br>";
    echo "Terima Kasih<br>";

}
echo '&nbsp;<div class="cleared"></div><a href="list_barang.php" class="mybtn">&laquo; Lanjutkan Belanja</a>';


} // *** END if ($mode!="order_send_ok") // *** DISPLAY FORM IF NO ORDERS TO BE SENT



?>
</div>
<?php
include"footer.php";
?>
