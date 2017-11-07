<!DOCTYPE html>
<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
	  //logger == login
	  if($_POST['logger'] == 'login'){
	  $myusername = mysqli_real_escape_string($db,$_POST['myusername']);
      $mypassword = mysqli_real_escape_string($db,$_POST['mypassword']); 
      
      $sql = "SELECT id,active FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
	  //echo 'Active   '.$active;
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");
		 session_regenerate_id();
         $_SESSION['login_user'] = $myusername;

         
         header("location: dashboard.php");
		 exit;
      }else {
         $error = "Your Login Name or Password is invalid";
      } 
	  }
	  /*else{
		  //logger == register 
		$myemail = mysqli_real_escape_string($db,$_POST['myemail']);
		$myfirstname = mysqli_real_escape_string($db,$_POST['myfirstname']);
		$mylastname = mysqli_real_escape_string($db,$_POST['mylastname']);
		
		$sql = "INSERT INTO admin SET username = '$myemail',firstname='$myfirstname',surname='$mylastname' ";
		$result = mysqli_query($db,$sql);	
		
		echo $sql;
		if($result)
		{
			header("location: details.php");
			exit;
		}
		else {
         $error = "A problem happened. Contact YYY";
		}		
	  }*/
      
   }
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content 
        <div class="top-content">        	
            <div class="inner-bg">-->
                <div class="container">
                    
                    <div class="row">
					<div class="col-sm-3"></div>
                        <div class="col-sm-6">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3 align="center">Login to ShopAdmin</h3>
	                            		<p align="center">Enter username and password to log on:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="myusername">Username</label>
				                        	<input type="text" name="myusername" placeholder="Username..." class="form-username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="mypassword">Password</label>
				                        	<input type="password" name="mypassword" placeholder="Password..." class="form-password form-control" id="form-password">
				                        </div>
				                        <button type="submit" class="btn">Sign in!</button>
										<input type="hidden" name="logger" value="login">
									</form>
			                    </div>
		                    </div>
	                        
                        </div>
						<div class="col-sm-3"></div>
                    </div>
                    
                </div>
            <!--</div>-->            
        <!--</div>-->

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>