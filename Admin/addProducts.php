<?php 
include "user.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {

$productName = mysqli_real_escape_string($db,$_POST['productName']);
$productDescription = mysqli_real_escape_string($db,$_POST['productDescription']);
$price = mysqli_real_escape_string($db,$_POST['price']);

//DISCOUNTS
/* 1. Price 50 – 100 : 0% discount
2. Price 112 – 115: 0.25% discount
3. Price > 120: 0.50% discount */

$discountPercentage = 0;
$discountAmount = 0;

if($price >= 50 && $price <= 100){
  $discountPercentage = 0;
}
elseif($price >= 112 && $price <= 115){
  $discountPercentage = 0.25;
}
elseif($price > 120){
  $discountPercentage = 0.5;
}
else{
  $discountPercentage = 0;
}

$discountAmount = ($discountPercentage / 100) * $price;
$adjustedPrice = $price - $discountAmount;
$adjustedPrice = round($adjustedPrice,2);

/* echo 'Price '.$price;
echo 'Discount Percentage '.$discountPercentage;
echo 'Discount Amount '.$discountAmount;
echo 'Discounted Price '.$adjustedPrice;
 */
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false){
    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));
  
    //Insert data into database
    $sql = "INSERT INTO product SET user = '$myuser', adjustedPrice = '$adjustedPrice', discountPercentage = '$discountPercentage', discountAmount = '$discountAmount', productName = '$productName', productDescription = '$productDescription', price = '$price', productPic = '$imgContent'"; 
	  $insert = mysqli_query($db,$sql);
    if($insert){
      header("location: dashboard.php");
      exit;
      //echo 'Success';
    }else{
      header("location: 404.php");
      exit;
      //echo 'Failed '.$sql;
    } 
}else{
  header("location: 404.php");
  exit;
  echo 'Failed image';
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<div class="container-fluid">
<div class="row content">
<div class="col-sm-3 sidenav">
  <h4><b><?php echo $myuser ?></b></h4>
  <ul class="nav nav-pills nav-stacked">
    <li><a href="addProducts.php">Add Products</a></li>
    <li><a href="viewProducts.php">View Products</a></li>
    <li><a href="viewUsers.php">View Users</a></li>
    <li><a href="viewsSales.php">View Sales</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul><br>
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Search ...">
    <span class="input-group-btn">
      <button class="btn btn-default" type="button">
        <span class="glyphicon glyphicon-search"></span>
      </button>
    </span>
  </div>
</div>

    <div class="col-sm-9" id="section1">      
      
	  <!--<div class="container">-->
                    
                    <div class="row">
					
                        <div class="col-sm-8">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3 align="left">Admin - Add Product</h3>
	                            	</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-newspaper-o"></i>
	                        		</div>
	                            </div>

	                            <div class="form-bottom">

				                    <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data">

                            
  <div class="form-group">
    <label for="productName">Product Name</label>
    <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product" required>
     </div>
  <div class="form-group">
    <label for="productDescription">Description</label>
    <input type="text" class="form-control" id="productDescription" name="productDescription" placeholder="Description" required>
  </div>
  <div class="form-group">
    <label for="price">Description</label>
    <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
  </div>
  <div class="form-group">
    <label for="picture">Upload Photo [< 1MB]</label>
    <input type="file" class="form-control-file" id="image" name="image">
  </div>

  <button type="submit" class="btn btn-primary btn-lg">Submit</button>


									          </form>
			                    </div>
		                    </div>
	                        
                        </div>
						
                    </div>
                    
                <!--</div>-->
      <hr> 
      </div>
	  
    </div>
  </div>

<footer class="container-fluid">
  <p>&copy;	Edy.Devs</p>
</footer>

</body>
</html>
