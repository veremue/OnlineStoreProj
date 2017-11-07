<?php
include "config.php";

if($_POST) 
{
$email=$_POST['email'];
$id=$_POST['id'];
$adjustedPrice = $_POST['adjustedPrice'];
$quantity = 1; //only one product allowed at a time


//insert into sales
$sql = "INSERT INTO `sales` (`productid`,`shopperid`,`quantity`) VALUES ('$id','$email','$quantity')"; 
$insert = mysqli_query($db,$sql);

//reduce balance
//get the current balance
$balance = 0;
$query = "select balance from shopper where email = '$email'";
$result=mysqli_query($db,$query);

if(mysqli_num_rows($result) == 1)
{
        $member = mysqli_fetch_array($result);
        $balance = $member['balance'];
}

//update balance
$new_balance = $balance - $adjustedPrice;
$updateqry = "update shopper set balance = '$new_balance' where email = '$email'";
$resultupdt=mysqli_query($db,$updateqry);

if($result && $resultupdt)
{
    echo 'success';
}
else{
    echo 'error';
}

}

?>