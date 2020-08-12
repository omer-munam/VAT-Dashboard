<?php
    session_start();
    include("includes/connection.php");


  if (!isset($_SESSION['isadmin']) && $_SESSION['isadmin'] !== 1 && $_SESSION['loggedin'] !== 1) {
          header('location:login.php');
          die();
      }

    if(isset($_POST["actionbtnaccept"]))
    {
        $s_id = $_POST["nameram"];

        
        $query = "UPDATE signup SET is_admin_approved=1 WHERE s_id=$s_id";
        if($conn->query($query)===TRUE)
        {
            echo "<script>alert('The Query Is Successfully Fired')</script>";
        }
        else
        {
            echo "error".$query."<br>".$conn->error;
        }

    }

    if(isset($_POST["actionbtndecline"]))
    {
        $s_id = $_POST["nameram"];
        
        $query = "DELETE FROM signup WHERE s_id=$s_id";


        if($conn->query($query)==TREU)
        {
            echo "<script>alert('The Query Is Successfully Fired')</script>";

        }
        else
        {
            echo "error".$query."<br>".$conn->error;
        }

    }
   

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
                    <a href="index.html"><img src="assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="index.php" aria-expanded="true"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                                <!-- <ul class="collapse">
                                    <li class="active"><a href="index.html">ICO dashboard</a></li>
                                    <li><a href="index2.html">Ecommerce dashboard</a></li>
                                    <li><a href="index3.html">SEO dashboard</a></li>
                                </ul> -->
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
                                </ul>
                            </li>
                             <!-- <li>
                                <a href="sellersignup.php" aria-expanded="true"><i class="fa fa-users"></i> <span>seller signup </span></a>
                            </li> -->
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-shopping-cart"></i> <span>Shop</span></a>
                                <ul class="collapse">
                                    <li><a href="AllShop.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Shop</span></a></li>
                                    <li><a href="AddShop.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Add Shop</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-first-order"></i> <span>Order</span></a>
                                <ul class="collapse">
                                    <li><a href="AllOrder.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Order</span></a></li>
                                    <li><a href="OrderStatus.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Order Status</span></a></li>
                                </ul>
                            </li>


                            <!-- <li>
                                <a href="Classified-Products.html" aria-expanded="true"><i class="fa fa-shopping-cart"></i><span>Classified Products</span></a></li> -->
                            <li>
                                <a href="Delete-Contents.html" aria-expanded="true"><i class="fa fa-trash"></i> <span>Delete Contents</span></a>
                                <ul class="collapse">
                                    <li><a href="DeleteProducts.php"><i class="fa fa-circle fs_i"></i>Delete Products</a></li>
                                    <li><a href="DeleteShops.php"><i class="fa fa-circle fs_i"></i>Delete Shops</a></li>
                                    <li><a href="DeleteCategories.php"><i class="fa fa-circle fs_i"></i>Delete Categories</a></li>
                                    <!-- <li><a href="Delete-All-Classified.html"><i class="fa fa-circle fs_i"></i>Delete All Classified</a></li> -->
                                </ul>
                            </li>
                           
                           
                            <li class="active">
                                <a href="#" aria-expanded="true"><i class="fa fa-truck"></i><span>Delievery Management</span></a>
                                <ul class="collapse">
                                    <li><a href="AllVendor.php"><i class="fa fa-circle fs_i"></i>All Vendor</a></li>
                                    <li class="active"><a href="AddVendor.php"><i class="fa fa-circle fs_i"></i>Add Vendor</a></li>
                                    <li><a href="DeleteVendor.php"><i class="fa fa-circle fs_i"></i>Delete Vendor</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" aria-expanded="true"><i class="fa fa-users"></i><span>Admin Panel</span></a>
                                <ul class="collapse">
                                    <li><a href="ManageProfile.php"><i class="fa fa-circle fs_i"></i>Manage Profile</a></li>
                                    <li><a href="EditAccount.php"><i class="fa fa-circle fs_i"></i>Edit Account</a></li>
                                    <li><a href="ChangePassword.php"><i class="fa fa-circle fs_i"></i>Change Password</a></li>
                                   
                                    <li><a href="ImageSetting.php"><i class="fa fa-circle fs_i"></i>Image Setting</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" aria-expanded="true"><i class="fa fa-money"></i><span>Currency Symbols</span></a>
                                <ul class="collapse">
                                    <li><a href="AllSymbols.php"><i class="fa fa-circle fs_i"></i>All Symbols</a></li>
                                    <li><a href="AddSymbols.php"><i class="fa fa-circle fs_i"></i>Add Symbols</a></li>
                                    <li><a href="DeleteSymbols.php"><i class="fa fa-circle fs_i"></i>Delete Symbols</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" aria-expanded="true"><i class="fa fa-money"></i><span>Currency Code</span></a>
                                <ul class="collapse">
                                    <li><a href="AllCurrencyCode.php"><i class="fa fa-circle fs_i"></i>All Currency Code</a></li>
                                    <li><a href="AddCurrencyCode.php"><i class="fa fa-circle fs_i"></i>Add Currency Code</a></li>
                                    <li><a href="DeleteCurrencyCode.php"><i class="fa fa-circle fs_i"></i>Delete Currency Code</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" aria-expanded="true"><i class="fa fa-truck"></i><span>Delivery Cost Setting</span></a>
                                <ul class="collapse">
                                    <li><a href="AddCost.php"><i class="fa fa-circle fs_i"></i>Add Cost</a></li>
                                    <li><a href="ManageCost.php"><i class="fa fa-circle fs_i"></i>Manage Cost</a></li>
                                </ul>
                            </li>
                           
                           

                          
                            <li>
                                <a href="ReturnedManagement.php" aria-expanded="true"><i class="fa fa-arrow-left"></i><span>Returned Management</span></a>
                            </li>
                            <li>
                                <a href="#" aria-expanded="true"><i class="fa fa-file-text"></i> <span>Reports</span></a>
                                <ul class="collapse">
                                    <li><a href="CustomerReports.php"><i class="fa fa-circle fs_i"></i>Customer Reports</a></li>
                                    <li><a href="VendorReports.php"><i class="fa fa-circle fs_i"></i>Vendor Reports</a></li>
                                    <li><a href="ProductReports.php"><i class="fa fa-circle fs_i"></i>Product Reports</a></li>
                                    <li><a href="OrderReports.php"><i class="fa fa-circle fs_i"></i>Order Reports</a></li>
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
                        <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
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
                            <h4 class="page-title pull-left">Add Vendor</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Delievery Management / </span></li>
                                <li><span>Add Vendor</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['adminname'] ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
           
            <form action="index.php" method="POST">
                <h4 class="container">Add Vendors</h4><br><br>
                 <table id="table1" class="table table-striped table-hover" style="width: 90%;margin-left: 60px;height: 180px">
                                        <thead style="background:#e8e8e8;font-weight: bolder;">
                                         <tr>
                           <th> V_Id</th>
                           <th> Vendor Name </th>
                           <th> Email Address </th>
                           <th>Details</th>
                           <th colspan="2" style="text-align: center"> Action</th>

                       </tr>
                                   </thead>

                                   <tbody style="background: #cedbe0">
                       <?php
                        $query = "SELECT * FROM signup WHERE is_admin_approved=0";

                        $result=mysqli_query($conn,$query);
                             if ($result->num_rows>0) {        
                            while ($row=$result->fetch_assoc()) 
                            {
                                $s_id = $row["s_id"];
                                $DUsername = $row['username'];
                                $DEmail_Address = $row['email_address'];
                                $DMobile_Number = $row['mobile_number'];
                                $DShop_based_in = $row['shop_based_in'];
                                $DAccount_Type = $row['account_type'];
                                $DShop_Name =  $row['shop_name'];
                                $Privacy =  $row['privacy'];
                                $Package =  $row['packages'];
                                $Created =  $row['created'];
                            ?>
                         <tr>
                           <td><?php echo  $s_id ?></td>
                           <td><?php echo  $DUsername ?></td>
                           <td><?php echo  $DEmail_Address ?></td>
                           <td><!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal_<?php echo $row['s_id'] ?>"value="<?php echo $row['s_id'] ?>" >
  View detail
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_<?php echo $row['s_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign up details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="table1" class="table table-striped table-hover" style="width: 90%;margin-left: 60px;height: 180px">
            <thead style="background:#afcad3;font-weight: bolder;">
                                         <tr>
                           

                       </tr>
                                   </thead>

                     
                        <tr>
                           <td>Username</td>
                          <td><?php echo $DUsername;  ?> </td>
                        </tr>

                        <tr>
                           <td>Email</td>
                          <td><?php echo $DEmail_Address;  ?> </td>
                        </tr>

                        <tr>
                           <td>Mobile Number</td>
                          <td><?php echo $DMobile_Number;  ?> </td>
                        </tr>

                        <tr>
                           <td>Shop Based In</td>
                          <td><?php echo $DShop_based_in;  ?> </td>
                        </tr>

                        <tr>
                           <td>Account Type</td>
                          <td><?php echo $DAccount_Type;  ?> </td>
                        </tr>

                        <tr>
                           <td>Shop Name</td>
                          <td><?php echo $DShop_Name;  ?> </td>
                        </tr>

                         <tr>
                           <td>Privacy</td>
                          <td><?php echo $Privacy;  ?> </td>
                        </tr>

                         <tr>
                           <td>Created</td>
                          <td><?php echo $Created;  ?> </td>
                        </tr>

                         <tr>
                           <td>Package</td>
                          <td><?php echo $Package;  ?> </td>
                        </tr>


              </tbody>
          </thead>
      </table>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div></td>
                           
                           <td><input type="submit"  name="actionbtnaccept" class="actionbtn" value="Accept"></td>
                            <td><input type="submit"  name="actionbtndecline" class="actionbtn" value="Decline"></td>
                           </tr>

                            <?php
                        }
                   }
                  ?>
              </tbody>
             </tbody>
            </table>

                 <input type="hidden" id="ram" name="nameram">

        </form>
            <!-- page title area end -->
            
        
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
