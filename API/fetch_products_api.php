<?php
include "config.php";

$data=array();
$q=mysqli_query($db,"select productName, productDescription,discountPercentage,price,discountAmount,adjustedPrice from product");

while ($row=mysqli_fetch_object($q)){
 $data[]=$row;
}
echo json_encode($data);
?>