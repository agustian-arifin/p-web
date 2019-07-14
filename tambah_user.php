
<?php
include "header-admin.php";

if ($_POST['act']=="add"){
$pengguna=$_POST['pengguna'];
$sandi=md5($_POST['sandi']);
$nama=$_POST['nama'];
$telepon=$_POST['telepon'];
$jabatan=$_POST['jabatan'];
$proses="INSERT into admin_web(username,password,nama,telepon,jabatan)
         VALUES('$pengguna','$sandi','$nama','$telepon','$jabatan')";
$hasil=mysql_query ($proses);



    echo '
    <script>window.location="tambah_user.php"</script>
    ';
}

?>
<div id='bgkonten'>
<table border="0px">
 <form method="post" enctype="multipart/form-data">
<tr><td>Username</td> <td>:</td> <td><input name="pengguna" size="50" class="texbox" maxlength="12"></td></tr>
<tr><td>Password</td> <td>:</td><td><input name="sandi" size="50" class="texbox"></td></tr>
<tr><td>Nama</td> <td>:</td><td><input name="nama" size="50" class="texbox"></td></tr>
<tr><td>Telepon</td> <td>:</td><td><input name="telepon" size="50" class="texbox"></td></tr>
<tr><td>Jabatan</td> <td>:</td><td>
<select name="jabatan">
<option>--Pilih--</option>
<option>Admin</option>
<option>Owner</option>




</td></tr>


    <a href="index.php"><i class="fa fa-arrow-circle-o-left"></i> Back</a></td>
    <input type="submit" value="TAMBAH" class="btn_submit">
    <input type="hidden" name="act" value="add">
    </form>
    <?php
    $sql = "SELECT * FROM admin_web";
    $result = mysql_query($sql);

    echo"

    <table border='1'  cellspacing='0' cellpadding='0'>
    <tr><td colspan=7><h3 align='center'>Data User/Admin</h3></td></tr>

    <tr>
    <td><b>Username</b></td>
    <td><b>Password</b></td>
    <td><b>Nama Lengkap</b></td>
    <td><b>Telepon</b></td>
    <td><b>Jabatan</b></td>

    <td colspan=2><b>Pilihan</b></td>
    </tr>";

    while ($row = mysql_fetch_array($result))
        {

             echo"<tr>";
             echo"<td>".$row['username']."</td>";
             echo"<td>".$row['password']."</td>";
             echo"<td>".$row['nama']."</td>";
             echo"<td>".$row['telepon']."</td>";
             echo"<td>".$row['jabatan']."</td>";

             //echo "<td><a href='admin_changepassword.php'>[Ganti Password]</a></td>";
             //echo"<td><a href=\"hapus_user.php?id=".$row['id_admin']."\">[DELETE]</a> </td>";
			 echo"<td><a href='admin_changepassword.php'><i class='fa fa-pencil' style='font-size: 20px;'></i> Ganti Password</a></td>";
			 echo "<td><a href=\"hapus_user.php?id=".$row['id_admin']."\"> <i class='fa fa-eraser' style='font-size: 20px;'></i></a><td>";
            
             echo"</tr>";

}
echo"</table>";
    ?>
</div>
<div class="cleared"></div>
<?php
include"footer.php";
?>


