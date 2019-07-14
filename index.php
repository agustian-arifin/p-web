
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";
echo"<div id='bgkonten'>";
$sql = "SELECT * FROM admin_web where username='".$_SESSION['admin_username']."'";
    $result = mysql_query($sql);

 while ($row = mysql_fetch_array($result))
        {

            echo'<p><h3>Selamat Datang </h3></p>';

echo"<p>Halo <h3>".$row['nama']."</h3> Selamat datang di halaman Administrator.</p>";
echo'<p>Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten website anda.</p>';

             echo'<p>Data Pribadi Anda Adalah : </p><br>';
             echo"<p>&raquo; Nama : ".$row['nama']."</p>";
             echo"<p>&raquo; Telepon :".$row['telepon']."</p>";
            

}
echo"</div>";
?>
<div class="cleared"></div>
<?php
include"footer.php";
?>
</div>