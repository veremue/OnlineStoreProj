<?php
 include "config.php";
 
 //echo 'we are in';

 //if(isset($_POST['insert']))
 if($_POST) 
 {
 $email=$_POST['email'];
 $password=$_POST['password'];
 $confirm_password=$_POST['confirm_password'];

 //check if passwords match
 if($password == $confirm_password){

    //check if email already exists
    $chkduplicate = "select * from shopper where email='$email'";
    
    $query = mysqli_query($db,$chkduplicate);
    //echo $chkduplicate;

    if(mysqli_num_rows($query) > 0){        
            echo '<div class="container">';
            echo '<h4 style="color:green">Form Submit Successfully..</h4><br>';
            echo '<p>Error - email already exists..</p><br>';
            echo '<p><a href="index.html">Try again here</a> using a diffent email and enjoy shopping thereafter</p>';
            echo '</div>';
        
    }
    else{
    $md5password = md5($password);
    
     $today = date("Y-m-d H:i:s");
    
     $sql = "INSERT INTO `shopper` (`email`,`password`,`lastLoginDate`) VALUES ('$email','$md5password','$today') "; 
     $insert = mysqli_query($db,$sql);
    
     if($insert){
        echo '<div class="container">';
        echo '<h4 style="color:green">Form Submit Successfully..</h4><br>';
        echo '<p>You have successfully registered with this email: '.$email.'<br>';
        echo '<p><a href="index.html">Log in</a> and enjoy shopping</p>';
        echo '</div>';
    }
    else{
        echo '<div class="container">';
        echo '<h4 style="color:green">Error - Unable to create account at this time..</h4><br>';
        echo '<p><a href="#">Contact us</a> for help</p>';
        echo '</div>';
    }
}
 }
 else{
     echo '<div class="container">';
     echo '<h4 style="color:green">Error - Passwords do not match..</h4><br>';
     echo '<p><a href="index.html">Try again here</a> and enjoy shopping thereafter</p>';
     echo '</div>';
 }

}
 ?>