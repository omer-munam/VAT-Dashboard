<?php
 session_start();
  include("includes/connection.php");
 
    if (!isset($_SESSION['isadmin']) && $_SESSION['isadmin'] !== 1 && $_SESSION['loggedin'] !== 1) {
          header('location:login.php');
          die();
      }
  $press=0;
  $php_variable=1;
  $finalpid=0;

  if(isset($_POST['addcategory'])){

  
        $hid = $_POST['hid'];
        $category = $_POST['category'];
        
            $hid1 = $_SESSION['ID1'];
            $finalresult = mysqli_query($conn,"select * from category where name='$hid' and parent_id='$hid1';");

            while($finalres=mysqli_fetch_array($finalresult))
            { 
                $finalpid= $finalres['id'];
            }    

       


        $query = "INSERT INTO category(name,parent_id) VALUES('$category','$finalpid') ;";
        if($conn->query($query)===TRUE)
        {
            echo "<script>alert('HERO')</script>";
        }
    

  }


   if(isset($_POST['addparentcategory'])){
    
        $result1 = mysqli_query($conn,"select * from category where parent_id=0");
    }

    if(isset($_POST['addsubcategory'])){
        $hid = $_POST['hid'];
        $result11 = mysqli_query($conn,"select * from category where name='$hid'");

        while($res11=mysqli_fetch_array($result11))
        { 
            $pid11= $res11['id'];
        }    
        
        $result2 = mysqli_query($conn,"select * from category where parent_id='$pid11'");


       

    }

    if(isset($_POST['addsubsubcategory'])){
        $hid = $_POST['hid'];
        
        $result3 = mysqli_query($conn,"select * from category where name='$hid'");

        while($res3=mysqli_fetch_array($result3))
        { 
            $pid3= $res3['id'];
        }    
        
        $result4 = mysqli_query($conn,"select * from category where parent_id='$pid3'");

    }






?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>shopattip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
/*$(document).ready(function(){
    $("select.form-control").change(function(){
        var selectedCountry = $(this).children("option:selected").val();
        alert("You have selected the country - " + selectedCountry);
         document.getElementById("hid").value = selectedCountry;

    });
});*/

function ddlselect()
{
    var d = document.getElementById("ddselect");
    var displaytext = d.options[d.selectedIndex].text;
     alert("You have selected the  : " + displaytext);
     document.getElementById("hid").value = displaytext;
}

function ddlselect1()
{
    var d1 = document.getElementById("ddselect1");
    var displaytext1 = d1.options[d1.selectedIndex].text;
     alert("You have selected the  : " + displaytext1);
     document.getElementById("hid").value = displaytext1;
   
}

function ddlselect2()
{
    var d2 = document.getElementById("ddselect2");
    var displaytext2 = d2.options[d2.selectedIndex].text;
     alert("You have selected the  : " + displaytext2);
     document.getElementById("hid").value = displaytext2;
}

</script>
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
                            <li class="active">
                                <a href="index.php" aria-expanded="true"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
                                <!-- <ul class="collapse">
                                    <li class="active"><a href="index.html">ICO dashboard</a></li>
                                    <li><a href="index2.html">Ecommerce dashboard</a></li>
                                    <li><a href="index3.html">SEO dashboard</a></li>
                                </ul> -->
                            </li>
                             <li>
                                <a href="sellersignup.php" aria-expanded="true"><i class="fa fa-users"></i> <span>seller signup </span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-shopping-cart"></i> <span>Products</span></a>
                                <ul class="collapse">
                                    <li><a href="#" aria-expanded="true"><i class="fa fa-list"></i><span class="menu-title">Physical Products</span></a>
                                        <ul class="collapse">
                                            <li><a href="Category.php"><i class="fa fa-circle fs_i"></i>Category</a></li>
                                            <li><a href="Brands.php"><i class="fa fa-circle fs_i"></i>Brands</a></li>
                                            <li><a href="Sub-category.html"><i class="fa fa-circle fs_i"></i>Sub-category</a></li>
                                            <li><a href="All-Products.php"><i class="fa fa-circle fs_i"></i>All Products</a></li>
                                            <li><a href="Product-Stock.html"><i class="fa fa-circle fs_i"></i>Product Stock</a></li>
                                            <li><a href="Product-Bundle.html"><i class="fa fa-circle fs_i"></i>Product Bundle</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="Digital-Products.html" aria-expanded="true"><i class="fa fa-list"></i><span class="menu-title">Digital Products</span></a>
                                        <ul class="collapse">
                                            <li><a href="Category.html"><i class="fa fa-circle fs_i"></i>Category</a></li>
                                            <li><a href="Sub-category.html"><i class="fa fa-circle fs_i"></i>Sub-category</a></li>
                                            <li><a href="All-Digitals.html"><i class="fa fa-circle fs_i"></i>All Digitals</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="Classified-Products.html" aria-expanded="true"><i class="fa fa-shopping-cart"></i><span>Classified Products</span></a></li>
                            <li>
                                <a href="Delete-Contents.html" aria-expanded="true"><i class="fa fa-trash"></i> <span>Delete Contents</span></a>
                                <ul class="collapse">
                                    <li><a href="Delete-All-Categories.html"><i class="fa fa-circle fs_i"></i>Delete All Categories</a></li>
                                    <li><a href="Delete-All-Products.php"><i class="fa fa-circle fs_i"></i>Delete All Products</a></li>
                                    <li><a href="Delete-All-Brands.html"><i class="fa fa-circle fs_i"></i>Delete All Brands</a></li>
                                    <li><a href="Delete-All-Classified.html"><i class="fa fa-circle fs_i"></i>Delete All Classified</a></li>
                                </ul>
                            </li>
                         
                            <li>
                                <a href="Sale.html" aria-expanded="true"><i class="fa fa-usd"></i> <span>Sale</span></a>
                            </li>
                            <li>
                                <a href="Discount-Coupon.html" aria-expanded="true"><i class="fa fa-tag"></i> <span>Discount Coupon</span></a>
                            </li>
                            <li>
                                <a href="Ticket.html" aria-expanded="true"><i class="fa fa-life-ring"></i> <span>Ticket</span></a>
                            </li>
                            <li>
                                <a href="Reports.html" aria-expanded="true"><i class="fa fa-file-text"></i> <span>Reports</span></a>
                                <ul class="collapse">
                                    <li><a href="Product-Compare.html"><i class="fa fa-circle fs_i"></i>Product Compare</a></li>
                                    <li><a href="Product-Stock.html"><i class="fa fa-circle fs_i"></i>Product Stock</a></li>
                                    <li><a href="Product-Wishes.html"><i class="fa fa-circle fs_i"></i>Product Wishes</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="Vendor.html" aria-expanded="true"><i class="fa fa-user-plus"></i> <span>Vendor</span></a>
                                <ul class="collapse">
                                    <li><a href="Vendor-List.html"><i class="fa fa-circle fs_i"></i>Vendor List</a></li>
                                    <li><a href="Pay-To-Vendor.html"><i class="fa fa-circle fs_i"></i>Pay To Vendor</a></li>
                                    <li><a href="Vendor-Commission.html"><i class="fa fa-circle fs_i"></i>Vendor Commission</a></li>
                                    <li><a href="Vendor's-Slides.html"><i class="fa fa-circle fs_i"></i>Vendor's Slides</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="Customers.html" aria-expanded="true"><i class="fa fa-users"></i><span>Customers</span></a>
                                <ul class="collapse">
                                    <li><a href="Customers1.html"><i class="fa fa-circle fs_i"></i>Customers</a></li>
                                    <li><a href="Wallet-Loads.html"><i class="fa fa-circle fs_i"></i>Wallet Loads</a></li>
                                    <li><a href="Premium-Package.html"><i class="fa fa-circle fs_i"></i>Premium Package</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="Messaging.html" aria-expanded="true"><i class="fa fa-envelope"></i> <span>Messaging</span></a>
                                <ul class="collapse">
                                    <li><a href="News-Letters.html"><i class="fa fa-circle fs_i"></i>News Letters</a></li>
                                    <li><a href="Contact-Messages.html"><i class="fa fa-circle fs_i"></i>Contact Messages</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="Blog.html" aria-expanded="true"><i class="fa fa-user"></i> <span>Blog</span></a>
                                <ul class="collapse">
                                    <li><a href="Blog-Categories.html"><i class="fa fa-circle fs_i"></i>Blog Categories</a></li>
                                    <li><a href="All-Blogs.html"><i class="fa fa-circle fs_i"></i>All Blogs</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="Frontend-Settings.html" aria-expanded="true"><i class="fa fa-desktop"></i><span>Frontend Settings</span></a>
                                <ul class="collapse">
                                    <li><a href="Slider-Settings.html" aria-expanded="true"><i class="fa fa-sliders"></i><span>Slider Settings</span></a>
                                        <ul class="collapse">
                                            <li><a href="Layer-Slider.html"><i class="fa fa-circle fs_i"></i>Layer Slider</a></li>
                                            <li><a href="Top-Slides.html"><i class="fa fa-circle fs_i"></i>Top Slides</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="Display-Settings.html" aria-expanded="true"><i class="fa fa-television"></i><span>Display Settings</span></a>
                                        <ul class="collapse">
                                            <li><a href="Home-Page.html"><i class="fa fa-circle fs_i"></i>Home Page</a></li>
                                            <li><a href="Contact-Page.html"><i class="fa fa-circle fs_i"></i>Contact Page</a></li>
                                            <li><a href="Header.html"><i class="fa fa-circle fs_i"></i>Header</a></li>
                                            <li><a href="Footer.html"><i class="fa fa-circle fs_i"></i>Footer</a></li>
                                            <li><a href="Theme-Color.html"><i class="fa fa-circle fs_i"></i>Theme Color</a></li>
                                            <li><a href="Logo.html"><i class="fa fa-circle fs_i"></i>Logo</a></li>
                                            <li><a href="Favicon.html"><i class="fa fa-circle fs_i"></i>Favicon</a></li>
                                            <li><a href="Fonts.html"><i class="fa fa-circle fs_i"></i>Fonts</a></li>
                                            <li><a href="Preloader.html"><i class="fa fa-circle fs_i"></i>Preloader</a></li> 
                                        </ul>
                                    </li>
                                    <li><a href="Site-Settings.html" aria-expanded="true"><i class="fa fa-wrench"></i><span>Site Settings</span></a>
                                        <ul class="collapse">
                                            <li><a href="General-Settings.html"><i class="fa fa-circle fs_i"></i>General Settings</a></li>
                                            <li><a href="Email-Templates.html"><i class="fa fa-circle fs_i"></i>Email Templates</a></li>
                                            <li><a href="Third-Party-Settings.html"><i class="fa fa-circle fs_i"></i>Third Party Settings</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="Build-Responsive-Pages.html"><i class="fa fa-code"></i>Build Responsive Pages</a></li>
                                    <li><a href="Set-Default-Images.html"><i class="fa fa-camera"></i>Set Default Images</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="Business-Settings.html" aria-expanded="true"><i class="fa fa-briefcase"></i> <span>Business Settings</span></a>
                                <ul class="collapse">
                                    <li><a href="Activation.html"><i class="fa fa-circle fs_i"></i>Activation</a></li>
                                    <li><a href="Payment Method.html"><i class="fa fa-circle fs_i"></i>Payment Method</a></li>
                                    <li><a href="Currency.html"><i class="fa fa-circle fs_i"></i>Currency</a></li>
                                    <li><a href="Faqs.html"><i class="fa fa-circle fs_i"></i>Faqs</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="Staffs.html" aria-expanded="true"><i class="fa fa-user"></i> <span>Staffs</span></a>
                                <ul class="collapse">
                                    <li><a href="All-Staffs.html"><i class="fa fa-circle fs_i"></i>All Staffs</a></li>
                                    <li><a href="Staff-Permissions.html"><i class="fa fa-circle fs_i"></i>Staff Permissions</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="SEO.html" aria-expanded="true"><i class="fa fa-search-plus"></i><span>SEO</span></a></li>
                            <li>
                                <a href="Language.html" aria-expanded="true"><i class="fa fa-language"></i><span>Language</span></a></li>
                            <li>
                                <a href="Manage-Admin-Profile.html" aria-expanded="true"><i class="fa fa-lock"></i><span>Manage Admin Profile</span></a></li>
                            <li>
                                <a href="Activate.html" aria-expanded="true"><i class="fa fa-check-circle"></i><span>Activate</span></a></li>
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
                             
                                <div class="dropdown-menu bell-notify-box notify-box">
                                   
                                    <div class="nofity-list">
                               
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                               
                                <div class="dropdown-menu notify-box nt-enveloper-box">
                                    <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                    <div class="nofity-list">
                               
                                    </div>
                                </div>
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
                            <h4 class="page-title pull-left">Category</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Products /</span></li>
                                <li><span>Physical Products /</span></li>
                                <li><span>Category</span></li>
                            </ul>
                        </div>
                    </div>

                   
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Fayyaz <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Message</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->

           <br>
           
           
            <form action="category.php" method="post">
            <input type="hidden" id="hid" name="hid" >

                <div class="container">

                    <h4>Add Category</h4><br>

                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Category</label>
                                    <div class="col-md-4">
                                        <input type="text" id="parent" class="form-control" placeholder="Enter Category" name="category">
                                    </div>
                                   <button type="submit" name="addcategory" class="btn btn-xs btn-primary">
                                        Add category
                                        </button> 

                                      
                    
                </div><br>


                                       <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Parent Category</label>
                                    <div class="col-md-4">
                                    <select class="form-control" name="parentcategory" id="ddselect" onchange="ddlselect();">
                                    <?php
                                    ?>
                                        <option>---SELECT---</option>
                                    <?php
                                     while($r=mysqli_fetch_array($result1))
                                    { 
                                        $rpid= $r['id']
                                    ?> 
                                      
                                       <option  value=<?php echo $r['name']?> >
                                        <?php echo $r['name']; ?>
                                    </option>
                                     <?php
                                     $_SESSION['ID1'] = $r['parent_id'];
                                     }
                                     ?>
                                      </select>
                                    </div>

                                     <button type="submit" name="addparentcategory" class="btn btn-xs btn-primary">
                                        Load sub category
                                        </button>
                                      
                    
                </div><br>

                   


                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Sub Category</label>
                                    <div class="col-md-4">
                                          <select class="form-control" name="subcategory"  id="ddselect1" onchange="ddlselect1();">
                                             <?php
                                    ?>
                                        <option>---SELECT---</option>
                                            <?php
                                             while($r2=mysqli_fetch_array($result2))
                                            { 
                                            ?> 
                                          <option value=<?php echo $r2['name']; ?> >
                                        <?php echo $r2['name']; ?>
                                    </option>
                                     <?php
                                     $_SESSION['ID1'] = $r2['parent_id'];
                                     }
                                     ?>
                                      </select>
                                    </div>

                                     <button type="submit" name="addsubcategory" class="btn btn-xs btn-primary">
                                        Load sub category
                                        </button>
                                      </div><br>



                           <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Sub Category1</label>
                                    <div class="col-md-4">
                                           <select class="form-control" name="subsubcategory"  id="ddselect2" onchange="ddlselect2();">
                                             <?php
                                    ?>
                                        <option>---SELECT---</option>
                                            <?php
                                             while($r4=mysqli_fetch_array($result4))
                                            { 
                                            ?> 
                                          <option value=<?php echo $r4['name']; ?> >
                                        <?php echo $r4['name']; ?>
                                        </option>
                                        <?php
                                        $_SESSION['ID1'] = $r4['parent_id'];
                                        }
                                        ?>
                                      </select>
                                    </div>
                                        <button type="submit" name="addsubsubcategory" class="btn btn-xs btn-primary">
                                        Load sub category
                                        </button>
                                    </div><br>
                                    </div>
                                    
                                </form>
                                
                                </div>



        <!-- main content area end -->
       
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© 2018 SHOP AT TIP</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
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
</body>

</html>
