<?php 
include "user.php";
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
        
        .row.content {
            height: 1500px
        }
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
            .row.content {
                height: auto;
            }
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
                                    <h3 align="left">Error Page</h3>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-newspaper-o"></i>
                                </div>
                            </div>

                            <div class="container">
                                <h2>Error occured. We are fixing it</h2>
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
        <p>&copy; Edy.Devs</p>
    </footer>

</body>

</html>