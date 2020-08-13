<?php
 session_start();
include("includes/connection.php");

   if (!isset($_SESSION['loggedin'])) {
       header('location:login.php');
       die();
   }
       $id = $_SESSION['id'];
    //   $query1="SELECT * FROM store_locations WHERE storeid='$id' AND admin_approved='1'";
    //   $query3="SELECT ps.* FROM products_stores ps INNER JOIN products ON ps.productid=products.id WHERE products.admin_approved='1' AND ps.storeid='$id' GROUP BY ps.productid";
    //   $query2="SELECT * FROM orders WHERE storeid='$id'";

    //   $result1=mysqli_query($conn,$query1);
    //   $result2=mysqli_query($conn,$query2);
    //   $result3=mysqli_query($conn,$query3);

    //   $row_count1=mysqli_num_rows($result1);
    //   $row_count2=mysqli_num_rows($result2);
    //   $row_count3=mysqli_num_rows($result3);

    include('includes/header.php');
?>


    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="index.php">Home</a></li>
                        <li><span>Dashboard</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                <div class="user-profile pull-right">
                    <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name'] ?><i class="fa fa-angle-down"></i></h4>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0" style="font-size: 28px;">Outlets</h4>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>
                                <?php //echo $row_count1;?>
                            </h2>
                        </div>
                    </div>
                    <canvas id="coin_sales1" height="100"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0" style="font-size: 28px;">Orders</h4>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2><?php //echo $row_count2;?></h2>
                        </div>
                    </div>
                    <canvas id="coin_sales2" height="100"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0" style="font-size: 28px;">Products</h4>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2><?php //echo $row_count3;?></h2>
                        </div>
                    </div>
                    <canvas id="coin_sales3" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>