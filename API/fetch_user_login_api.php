<?php
include "config.php";

if($_POST) 
{
$email=$_POST['email'];
$password=$_POST['password'];

$data=array();
$q=mysqli_query($db,"select email,status,balance from shopper");
while ($row=mysqli_fetch_object($q)){
 $data[]=$row;
}
echo json_encode($data);

}

?>