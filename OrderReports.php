<?php
 session_start();
include("includes/connection.php");

   if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1 && $_SESSION['isvendor']!==1) {
          header('location:login.php');
          die();
       }
       $id = $_SESSION['id'];
      $query1="SELECT * FROM store_locations WHERE storeid='$id' AND admin_approved='1'";
      $query3="SELECT ps.* FROM products_stores ps INNER JOIN products ON ps.productid=products.id WHERE products.admin_approved='1' AND ps.storeid='$id' GROUP BY ps.productid";
      $query2="SELECT * FROM orders WHERE storeid='$id'";

      $result1=mysqli_query($conn,$query1);
      $result2=mysqli_query($conn,$query2);
      $result3=mysqli_query($conn,$query3);

      $row_count1=mysqli_num_rows($result1);
      $row_count2=mysqli_num_rows($result2);
      $row_count3=mysqli_num_rows($result3);
      
      
      
      

$data = '';

$query11 = "SELECT * FROM products";
$result11 = mysqli_query($conn,$query11);
while($row11 = mysqli_fetch_assoc($result11))
{
	$id = $row11['id']; 
	$Name = $row11['title_en'];


	
	$query22 = "SELECT COUNT(pid) as pid FROM orders WHERE pid='$id'"; 
	$result22 = mysqli_query($conn,$query22);
	$row22 = mysqli_fetch_assoc($result22);
	$order = $row22['pid']; 

	$data .= "{ label: '".$Name."', y: ".$order."}, ";

}

$data = substr($data, 0, -2);



$data1 = '';

$query11 = "SELECT * FROM stores";
$result11 = mysqli_query($conn,$query11);
while($row11 = mysqli_fetch_assoc($result11))
{
	$id = $row11['id']; 
	$Name = $row11['title_en'];


	
	$query22 = "SELECT COUNT(pid) as pid FROM orders WHERE storeid='$id'"; 
	$result22 = mysqli_query($conn,$query22);
	$row22 = mysqli_fetch_assoc($result22);
	$order = $row22['pid']; 

	$data1 .= "{ label: '".$Name."', y: ".$order."}, ";

}

$data1 = substr($data1, 0, -2);


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dalil Alqahwa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
     <style type="text/css">
        
        .actionbtn {
  background-color:  #0e0c28;
  border: 2px solid #0e0c28;
  color: white;
  padding: 5px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 25px;
}
    </style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.php"><img src="assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="index.php" aria-expanded="true"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                                
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-product-hunt"></i> <span>Products</span></a>
                                <ul class="collapse">
                                    <li><a href="AllProducts.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Products</span></a>
                                    </li>
                                    <li><a href="AddProducts.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Add Products</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-list-alt"></i> <span>Category</span></a>
                                <ul class="collapse">
                                    <li><a href="AllCategories.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Categories</span></a></li>
                                    <li><a href="AddCategories.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Add Categories</span></a></li>
                                    <li><a href="AllSubCategories.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Subcategories</span></a></li>
                                    <li><a href="AddSubCategories.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Add Subcategories</span></a></li>
                                </ul>
                            </li>
                           
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-shopping-cart"></i> <span>Outlet</span></a>
                                <ul class="collapse">
                                    <li><a href="AllShop.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Outlets</span></a></li>
                                    <li><a href="AddShop.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Add Outlet</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-first-order"></i> <span>Order</span></a>
                                <ul class="collapse">
                                    <li><a href="AllOrder.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Order</span></a></li>
                                     <li><a href="PendingCommissions.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Pending Commission</span></a></li>
                                   <li><a href="PaidCommissions.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Paid Commission</span></a></li>
                                  
                                </ul>
                           
                           
                                         
                            <li>
                                <a href="#" aria-expanded="true"><i class="fa fa-users"></i><span>Profile Settings</span></a>
                                <ul class="collapse">
                                    <li><a href="ManageProfile.php"><i class="fa fa-circle fs_i"></i><span lass="menu-title">Manage Profile</span></a></li>
                                    
                                    <li><a href="ManagePhones.php"><i class="fa fa-circle fs_i"></i><span lass="menu-title">Manage Phones</span></a></li> 

                                    
                                </ul>
                            </li>
                         
                         
                               
                         
                            
                            <li>
                                <a href="ReturnedManagement.php" aria-expanded="true"><i class="fa fa-arrow-left"></i><span>Returned Management</span></a>
                            </li>
                            <li class="active">
                                <a href="#" aria-expanded="true"><i class="fa fa-file-text"></i> <span>Reports</span></a>
                                <ul class="collapse">
                                    <li><a href="CustomerReports.php"><i class="fa fa-circle fs_i"></i><span lass="menu-title">Customer Reports</span></a></li>
                                   
                                    <li><a href="ProductReports.php"><i class="fa fa-circle fs_i"></i><span lass="menu-title">Product Reports</span></a></li>
                                    <li class="active"><a href="OrderReports.php"><i class="fa fa-circle fs_i"></i><span lass="menu-title">Order Reports</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <!--<div class="search-box pull-left">-->
                        <!--    <form action="#">-->
                        <!--        <input type="text" name="search" placeholder="Search..." required>-->
                        <!--        <i class="ti-search"></i>-->
                        <!--    </form>-->
                        <!--</div>-->
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="dropdown">
                        
                            </li>
                          
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Order Report</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>

                                <li><span>Reports / </span></li>
                                <li><span>Order Reports</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['vendorname'] ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>



            
            <!-- page title area end -->
            <script type="text/javascript">
window.onload = function () {


var chart1 = new CanvasJS.Chart("chartContainer1", {
	theme: "light1", // "light2", "dark1", "dark2"
	animationEnabled: false, // change to true		
	title:{
		text: "Orders Report"
	},
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "column",
		dataPoints: [
			<?php echo $data1 ?>
		]
	}
	]
});
chart1.render();



}
</script>
<div id="chartContainer1" style="height: 300px; width: 100%;"></div>
        
        <!-- main content area end -->
        <!-- footer area start-->
        
        <!-- footer area end-->
    </div>
    <footer>
            <div class="footer-area">
                <p>© 2019 Dalil Alqahwa</p>
            </div>
        </footer>
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
            <li><a data-toggle="tab" href="#settings">Settings</a></li>
        </ul>
        <div class="offset-content tab-content">
            <div id="activity" class="tab-pane fade in show active">
                <div class="recent-activity">
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Added</h4>
                            <span class="time"><i class="ti-time"></i>7 Minutes Ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You missed you Password!</h4>
                            <span class="time"><i class="ti-time"></i>09:20 Am</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Member waiting for you Attention</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You Added Kaji Patha few minutes ago</h4>
                            <span class="time"><i class="ti-time"></i>01 minutes ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Ratul Hamba sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Hello sir , where are you, i am egerly waiting for you.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                </div>
            </div>
            <div id="settings" class="tab-pane fade">
                <div class="offset-settings">
                    <h4>General Settings</h4>
                    <div class="settings-list">
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch1" />
                                    <label for="switch1">Toggle</label>
                                </div>
                            </div>
                            <p>Keep it 'On' When you want to get all the notification.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show recent activity</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch2" />
                                    <label for="switch2">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show your emails</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch3" />
                                    <label for="switch3">Toggle</label>
                                </div>
                            </div>
                            <p>Show email so that easily find you.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show Task statistics</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch4" />
                                    <label for="switch4">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch5" />
                                    <label for="switch5">Toggle</label>
                                </div>
                            </div>
                            <p>Use checkboxes when looking for yes or no answers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        var table = document.getElementById("table1"),rIndex;
            
            for(var i = 1; i < table.rows.length; i++)
            {
                table.rows[i].onclick = function()
                {
                    rIndex = this.rowIndex;
                    console.log(rIndex);
                    
                    document.getElementById("ram").value = this.cells[0].innerHTML;
                };
            }
            
    </script>
</body>

</html>
