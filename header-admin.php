<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// *** LOAD SESSION
session_start();
// *** LOAD CONFIGURATION VARS
include "../web_config_vars.php";
// *** DB CONNECTION
include "../db_conn.php";
?>

<link rel="shortcut icon" href="favicon.ico" >
<link href="style_admin.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="lib/ckeditor/ckeditor.js"></script>
<script src="plugin/nicEdit.js" type="text/javascript"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>
<body>

<?php

if (!empty($_POST['username'])){
   //echo "user yang diketik adalah : ".$_POST['username'];
   $password_md5= md5($_POST['password']);
   $sql="SELECT username,password FROM admin_web WHERE username='". $_POST['username'] ."' AND password='". $password_md5 ."'";
   $check=@mysql_num_rows(@mysql_query($sql));
   //echo "[ $check ]";
   if ($check>0){
       $_SESSION['admin_username'] = $_POST['username'];
      $_SESSION['islogin']=$_POST['username'].$password_md5;

    echo'<script>alert("Congratulatin Login Succes");window.location ="index.php";</script>';
   } else {

       echo'<script>alert("Sorry username and Password isnt valid please try again !!!");window.location ="index.php";</script>';
   }

}
if (empty($_SESSION['islogin'])){
?>

<center>

<div id="login">
<div id="login_input">

<center>

<form method="post">

<input class="teksbok_admin" placeholder="Username" type="text" name="username" maxlength="10"><br>
<input class="teksbok_admin" placeholder="Password" type="password" name="password"><br><br>
<input class="tombol_login" type="submit" value="LOGIN">

</form>
</div>


</center>

<?php

exit;
} else {

echo "<center>Anda Sedang Login </center>";
?>

<div id="wrapper">
<div id="head_admin">
<div class="cleared"></div></div>
<div id="bg_admin_menu">
<div class="adminmenu">

<ul>
	<li><a href="index.php">Beranda</a></li>
		<li><a href="tambah_kategori.php">Kategori</a></li>
		  <li><a href="admin_product.php">Produk</a></li>
<li><a href="admin_logout.php">Keluar</a></li>

</ul>
</div>
</div>

<?php
}

?>