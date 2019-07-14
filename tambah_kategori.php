<?php
include "header-admin.php";
if ($_POST['act']=="add"){
    $sql_add="INSERT INTO categories(title) VALUES ("."'".$_POST['title']."') ";
    @mysql_query($sql_add);


    echo '
    <script>window.location="admin_artikel.php"</script>
    ';
}

?>
<div id='bgartikel'>
<table border="0px">
 <form method="post" enctype="multipart/form-data">
<tr><td>JUDUL</td> <td>:</td> <td><input name="title" size="50" class="texbox"></td></tr>

    <a href="admin.php">[BACK]</a>
    <input type="submit" value="POSTING" class="btn">
    <input type="hidden" name="act" value="add">
    </form>

</div>
