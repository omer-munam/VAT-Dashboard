<?php
    session_start();
    include("includes/connection.php");
    $place_address=urldecode($_GET['place_address']);
    $place_location=urldecode($_GET['place_location']);
    $location = substr($place_location, 1, -1);
    $coord = explode(', ', $location);
    $longitude =  floatval($coord[0]);
    $latitude = floatval($coord[1]);

    
    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1 && $_SESSION['isvendor']!==1) {
        header('location:login.php');
        die();
     }

   if(isset($_POST['publish123'])){
      $temp_name = $_FILES["image"] ["tmp_name"];
        $extension1 = explode(".", $_FILES["image"] ["name"]);
        $filename = md5(time()). rand(1,9999) . '.' . end($extension1);
        move_uploaded_file($temp_name,"../app/images/stores/$filename");

                    $title_ar=$_POST['title_ar'];
                    $title_en=$_POST['title_en'];
                    $latitude=$_POST['latitude'];
                    $longitude=$_POST['longitude'];
                    $location=$_POST['location'];
                    $radius=$_POST['radius'];
                    $status=$_POST['status'];
                    $address=$_POST['address'];
                    $storeid = $_SESSION['id'];
                    $minimum_del=$_POST['minimum_del'];
                    mysqli_set_charset($conn,'utf8');            
                    $query = "INSERT INTO store_locations(title_ar, title_en,storeid, location, latitude,longitude, radius, status, image, address, minimum_del,admin_approved) VALUES('$title_ar', '$title_en','$storeid','$location','$latitude','$longitude','$radius','$status','$filename','$address','$minimum_del','0')";
                    if($conn->query($query)===TRUE){
                      echo "<script>setTimeout(function() {
                        $.bootstrapGrowl('The Outlet Has Been Added Successfully', {
                            type: 'success',
                            align: 'right',
                            width: 400,
                            stackup_spacing: 30
                        });
                    }, 1000);</script>";
                        }

                            else{
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

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>




    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.js"></script>
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
                    <a href="index.php"><img src="assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
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
                           
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-shopping-cart"></i> <span>Outlet</span></a>
                                <ul class="collapse">
                                    <li><a href="AllShop.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Outlets</span></a></li>
                                    <li class="active"><a href="AddShop.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Add Outlet</span></a></li>
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
                                    <li><a href="ManageProfile.php"><i class="fa fa-circle fs_i"></i><span class="menu-title">Manage Profile</span></a></li>
                                   
                                    <li><a href="ManagePhones.php"><i class="fa fa-circle fs_i"></i><span class="menu-title">Manage Phones</span></a></li> 

                                    
                                </ul>
                            </li>
                         
                         
                               
                         
                            
                            <li>
                                <a href="ReturnedManagement.php" aria-expanded="true"><i class="fa fa-arrow-left"></i><span>Returned Management</span></a>
                            </li>
                            <li>
                                <a href="#" aria-expanded="true"><i class="fa fa-file-text"></i> <span>Reports</span></a>
                                <ul class="collapse">
                                    <li><a href="CustomerReports.php"><i class="fa fa-circle fs_i"></i><span class="menu-title">Customer Reports</span></a></li>
                                  
                                    <li><a href="ProductReports.php"><i class="fa fa-circle fs_i"></i><span class="menu-title">Product Reports</span></a></li>
                                    <li><a href="OrderReports.php"><i class="fa fa-circle fs_i"></i><span class="menu-title">Order Reports</span></a></li>
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
                            <h4 class="page-title pull-left">Add Outlets</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span>Outlets / </span></li>
                                <li><span>Add Outlet</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo  $_SESSION['vendorname']?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
     
                 
            <form action="" method="POST" class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm" style="padding-left: 100px; width: 400px">
    
        <div class="form-group">
            <label class="col-xs-4" style="font-size: 16px;">Add shop</label>   
        
            </div>
            
            
          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Address<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="text" onClick="window.location.href='googlemap.php'" required class="form-control" value="<?php echo $_GET['place_address']; ?>" name="address" >
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>
          <input type="hidden" value="<?php echo $location ?>" class="form-control" name="location">
          <input type="hidden" value="<?php echo $longitude ?>" class="form-control" name="longitude">
          <input type="hidden" value="<?php echo $latitude ?>" class="form-control" name="latitude">
      
          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Title in arabic<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="text" required class="form-control" name="title_ar" >
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>

          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Title in English<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="text" required class="form-control" name="title_en" >
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>

          <div class="form-group">
          <div id="product_name_div">
            <label class="col-xs-6">Images<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="file" required class="form-control" name="image" >
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>

      

          <div class="form-group">
              <div id="product_name_div">
            <label class="col-xs-6">Minimum Delivery<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="text" required class="form-control" name="minimum_del" >
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>  
          
          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Status<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <select name="status" required id="status" style="height: 40px" class="form-control">
                      <option value="0">Offline</option>
                      <option value="1">Available</option>
                  </select>
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>

          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Radius<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="text" required class="form-control" name="radius" >
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>
          
            <div style="text-align: center;">
              <button type="submit" class="btn btn-secondary btn-md" name="publish123">Add</button>

              </div>

       
    </div>
         
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
    <!-- <script src="assets/js/vendor/jquery-2.2.4.min.js"></script> -->
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
