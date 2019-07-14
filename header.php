<!DOCTYPE html PUBLIC>
<html xmlns>
<head>
<title>Etalase Toko Online</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


<!-- Start Slider HEAD section --> <!-- add to the <head> of your page -->
	<link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>
	<!-- End Slider.com HEAD section -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



<style>
#bgmenu{
    background:#0096D6;
    height:26px;
    width:100%;
    padding-top:5px;
}

</style>

<div id="bgmenu">
<div id="contact">
<ul>
       <li><i class="fa fa-phone-square"></i> Phone : 081234567890</li>
       <li><i class="fa fa-envelope-o"></i> Email : info@email.com</li>
       <li><i class="fa fa-building-o"></i> Office : Warungboto, Kec. Umbulharjo, Kota Yogyakarta</li>
       <li></li><li></li> <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
	   <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
	     <li><a href="#"><i class="fa fa-user"></i> Log In</a></li>
       <li><a href="#"><i class="fa fa-shopping-cart"></i> Checkout</a></li>
       <li><a href="#"><i class="fa fa-pencil-square-o"></i> Konfirmasi</a></li>
</ul>
</div>
</div>


<div id="header"><!--start header-->

<div id="header_content">	<!--start header conteent-->
	
</div><!--End header conteent-->

     </div><!--end header-->

<div id="container"><!--start container-->
<div class="cleared"></div>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// *** LOAD SESSION
session_start();
// *** LOAD CONFIGURATION VARS
include "web_config_vars.php";
// *** DB CONNECTION
include "db_conn.php";
date_default_timezone_set('Asia/Jakarta');
?>