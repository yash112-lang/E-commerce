<?php

require("connection.php");
$not_delete = false;
$pid = $_GET['pid'];
// echo $pid;
$sql = "DELETE FROM product WHERE product_id='$pid'";
$result = mysqli_query($conn, $sql);
$s = "DELETE FROM images WHERE product_id='$pid'";
$r = mysqli_query($conn, $s);
if($result && $r)
{
   header("location:merchant_index.php");
}
else
{
    $not_delete = true;
    header("location:merchant_index.php?not_delete=$not_delete");
}

?>