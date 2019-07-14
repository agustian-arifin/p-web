<?php
echo '<h1>Products</h1>';

// KONEKSI DATABASE
$conn = mysql_connect("localhost","root","") or die("can not access database");
mysql_select_db("phpshop",$conn) or die("can not connect");

echo '
<table border="1">
';

// QUERY TABLE php_shop_products
		$sql = "SELECT id, name, description, price FROM php_shop_products;";
		$result = mysql_query($sql);
        while ($row = mysql_fetch_array($result)){
		
			echo "<tr>";
			
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['description']."</td>";
				echo "<td>".$row['price']."</td>";
				echo "<td><a href=\"cart.php?action=add&id=".$row['id']."\">[+] Add To Cart</a></td>";
			
			echo "</tr>";
		}
		
echo'
</table>
';

echo '<a href="cart.php">View Cart</a>';
?>
