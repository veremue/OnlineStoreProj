<?php
include "config.php";

if($_POST) 
{
$email=$_POST['email'];
$topupamnt=$_POST['topupamnt'];

//get the current balance
$balance = 0;
$qry = "select balance from shopper where email = '$email'";
$result=mysqli_query($db,$qry);

if(mysqli_num_rows($result) == 1)
{
        $member = mysqli_fetch_array($result);
        $balance = $member['balance'];
}

//update balance
$new_balance = $balance + $topupamnt;
$updateqry = "update shopper set balance = '$new_balance' where email = '$email'";
echo $updateqry;
$resultupdt=mysqli_query($db,$updateqry);

if($resultupdt)
{
    echo 'Success';
}
else{
    echo 'Failure';
}
}
else{
    echo 'Error';
}

?>