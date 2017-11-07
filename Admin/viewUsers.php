<?php include "user.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard</title>
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
		    <li><a href="viewSales.php">View Sales</a></li>
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
      <p>
	  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
		<tr>
		<th> #</th>
		<th>Email </th>
		<th>Balance</th>
		<th>Joining Date </th>
		<th>Last Login Date</th>
		<th></th>
		</tr>
		</thead>
		<tbody>
	  <?php
	  $count = 0;
	  $q=mysqli_query($db,"select * from shopper order by createdOn desc");
		if($q){		
		while($row = mysqli_fetch_assoc($q))
		{
      $count = $count + 1;
      //header("Content-type: image/jpg");
	  ?> 
		<tr class="even gradeA" width = "30px">
		<td><?php echo $count ?></td>		
		<td><?php echo $row['email'] ?></td>
		<td><?php echo $row['balance'] ?></td>
    <td><?php echo $row['createdOn'] ?></td>
    <td><?php echo $row['lastLoginDate'] ?></td>
		<td><a href="#" class="btn btn-success" role="button">edit</a></td>
		</tr>
		<?php
		}//end while
		}//end if
		?>
		
		
		</tbody>
		</table>
	  </p>
      <br>
      <hr> 
      </div>
	  
    </div>
  </div>

<footer class="container-fluid">
  <p>&copy;	Edy.Devs</p>
</footer>

</body>
</html>
