<?php
include "header.php";
include"right.php";
include"left.php";
?>

<?php
session_start();

if ($_GET['logoutdong']=="1"){
	session_destroy();
}

if (($_POST['akun']) && ($_POST['sandi'])){

	$qry="SELECT * FROM anggota WHERE username='".$_POST['akun']."' AND password='".md5($_POST['sandi'])."'";
	$rs=@mysql_query($qry);
	if (@mysql_num_rows($rs)>0){
		$_SESSION['login']=$_POST['akun'];
  echo'<script>alert("Congratulatin Login Succes");window.location ="index.php";</script>';
	} else {
		echo "login gagal";
	}
}


if (!$_SESSION['login']){

echo '
<form method="post">
<input name="akun" placeholder="masukkan akun">
<input type="password" name="sandi" placeholder="masukkan sandi">
<input type="submit" value="masuk">
</form>
';

} else {
	echo '<h2>Hallo ' .$_SESSION['login'].'</h2>';
	echo '<a href="'.$_SERVER['PHP_SELF'].'?logoutdong=1">keluar</a>';
}

?>

<?php
include"footer.php";

?>