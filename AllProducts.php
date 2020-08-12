<?php
    session_start();
    include("includes/connection.php");


   if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1 && $_SESSION['isvendor']!==1) {
          header('location:login.php');
          die();
       }


 if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === 1 && $_SESSION['isvendor']===1) {
          header('location: AllProducts.php');
          die();
       }
 if(isset($_POST["actionbtndecline"]))
    {
        $id = $_POST["nameram"];
        
        $query = "DELETE FROM products WHERE id='$id'";

        if($conn->query($query)==TRUE)
        {
            echo "<script>  setTimeout(function() {
        $.bootstrapGrowl('The Data Has Been Deleted Successfully', {
            type: 'danger',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);</script>";

        }
        else
        {
            echo "error".$query."<br>".$conn->error;
        }

    }
       if (isset($_POST['pubish123'])) {
            mysqli_set_charset($conn,'utf8');
            $barcode = $_POST['barcode'];
            $title_ar = $_POST['title_ar'];
            $title_en = $_POST['title_en'];
            $default_price = $_POST['default_price'];
            $catid = $_POST['catid'];
            $subcat = $_POST['subcat'];
            $status = $_POST['status'];
            $from_storeid = $_SESSION['id'];
            $id = $_POST['id'];
            $Image= $_FILES['images'];
            $file_tmp = $_FILES['images']['tmp_name'];
        if($file_tmp!='')
        {
            $filename = addslashes($_FILES['images']['name']);
            $tmpname = addslashes(file_get_contents($_FILES['images']['tmp_name']));
            $filetype = addslashes($_FILES['images']['type']);
            $filesize = addslashes($_FILES['images']['size']);
            $array = array('jpg','jpeg');
            $ext = pathinfo($filename, PATHINFO_EXTENSION);


            $file_name = $_FILES['images']['name'];
            $file_tmp = $_FILES['images']['tmp_name'];
            $file_path = "../app/images/products/".$filename; 
            move_uploaded_file($file_tmp,$file_path);

          

             $query = "UPDATE products SET barcode='$barcode', title_ar='$title_ar', title_en='$title_en',images='$filename',default_price='$default_price', catid='$catid', subcat='$subcat',status='$status' WHERE id='$id'";
        }

        else
        {
             $query = "UPDATE products SET barcode='$barcode', title_ar='$title_ar', title_en='$title_en',default_price='$default_price', catid='$catid', subcat='$subcat',status='$status' WHERE id='$id'";

        }


        if($conn->query($query)===TRUE)
        {
            echo "<script>setTimeout(function() {
        $.bootstrapGrowl('The Product Has Been Updated Successfully', {
            type: 'success',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);</script>";
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
     
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.js"></script>

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
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-product-hunt"></i> <span>Products</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="AllProducts.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Products</span></a>
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
                            <h4 class="page-title pull-left">All Products</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Products / </span></li>
                                <li><span>All Products</span></li>
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
           
            




            <form action="#" method="POST"  class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm">
                <div >
     <div class="container">
         <div class="row justify-content-center">

                 <div class="col-lg-10 bg-light rounded my-2 py-2">
                     <table id="example" class="table table-striped table-bordered">
       <thead>
           <tr>
                               <th width="100px"> Outlet Name</th>
                           <th> Product Name In Arabic </th>
                           <th> Product Name In English </th>
                           <th style="text-align: center;width:200px""> Action</th>
                           </tr>
       </thead>
       <tbody>
           <?php
                                   mysqli_set_charset($conn,'utf8');
                        $from_storeid =  $_SESSION['id'];
                        $query = "SELECT ps.*,products.*,sl.title_en AS outlet FROM products_stores ps INNER JOIN products ON ps.productid=products.id INNER JOIN store_locations sl ON ps.store_location=sl.id WHERE products.admin_approved='1' AND ps.storeid='$from_storeid'";

                        $result=mysqli_query($conn,$query);
                        $row_cnt = $result->num_rows;
                             if ($row_cnt>0) {        
                            while ($row=$result->fetch_assoc()) 
                            {
                                $id = $row["id"];
                                $title_ar = $row['title_ar'];
                                $title_en = $row['title_en'];
                                $images = $row['images'];
                                $default_price = $row['default_price'];
                                $catid = $row['catid'];
                                $subcat =  $row['subcat'];
                                $status =  $row['status'];
                                $from_storeid =  $row['from_storeid'];
                                $from_locid =  $row['from_locid'];
                                $outlet = $row['outlet'];
                                $query123 = "SELECT store_locatis"
                            ?>
                         <tr>
                               <td style="background-color: #ffffff"><?php echo  $outlet ?></td>
                           <td style="background-color: #ffffff"><?php echo  $title_ar ?></td>
                           <td style="background-color: #ffffff"><?php echo  $title_en ?></td>
                           
                           
                           <td style="background-color: #ffffff"><!-- Button trigger modal -->
<button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#exampleModal_<?php echo $row['id'] ?>"value="<?php echo $row['id'] ?>" >
  View details
</button>
 <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal1_<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>" >
  Edit
</button>
        <input type="submit"  name="actionbtndecline" class="btn btn-danger btn-xs" value="Delete">


<div class="modal fade" id="exampleModal1_<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



                <form action="AllProducts.php" method="post" class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm" >
                <input type="hidden" name="id" value="<?php echo $id; ?>">

    
        <!-- <div class="form-group">
            <label class="col-xs-4" style="font-size: 16px;">What You are Selling</label>   
        
            </div> -->
       <!--<div class="form-group">-->
        
        <!--<div id="product_name_div">-->
        <!--    <label class="col-xs-6">Bar Code<span class="validatestar">*</span></label>-->
        <!--    <div class="col-xs-6">-->
        <!--          <input type="text" class="form-control" name="barcode" value="<?php echo $barcode; ?>">-->
        <!--        <div id="product_name_error"></div>-->
        <!--      </div>-->
        <!--    </div>          -->
        <!--  </div>-->

          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Title in arabic<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="text" class="form-control" name="title_ar" value="<?php echo $title_ar; ?>">
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>

          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Title in English<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="text" class="form-control" name="title_en" value="<?php echo $title_en; ?>">
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>

          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Image<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="file" class="form-control" name="images" id="images" value="<?php echo $images; ?>">
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>

          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Default Price<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <input type="text" class="form-control" name="default_price" value="<?php echo $default_price; ?>">
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>

          <div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Category<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <?php 
                include("includes/connection.php");
                $category = mysqli_query($conn,"select * from categories");
            ?>

                <select name="catid" class="form-control" id="catid<?php echo $id ?>" style="height: 50px">
                    <?php 
                        while($categoryrow = mysqli_fetch_array($category))
                        { 
                    ?>
                        <option <?php if($categoryrow['id']==$catid){ echo "Selected"; } ?> value="<?php echo $categoryrow['id']; ?>"> <?php echo  $categoryrow['title_en']; ?> </option>
                    <?php
                        }
                    ?>
                  </select>
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>
          <div id="result<?php echo $id ?>">
              
          </div>

          <div style="text-align: center;">
              <button type="submit" class="btn btn-secondary btn-md" name="pubish123">Edit</button>

              </div>
 
          <hr>

      </form>
      <script>  
 $(document).ready(function(){  
    $('#catid<?php echo $id ?>').change(function(){  
       message = $(this).children("option:selected").val();
        $.ajax({  
             url:"catresult.php",  
             method:"POST",  
             data:{message:message},  
             success:function(data){  
                  $('#result<?php echo $id ?>').fadeIn().html(data);  
                    
             }  
        });  
    });


});  

</script>
        
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal_<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example" class="table table-striped table-hover" >
            <thead style="background:#afcad3;font-weight: bolder;">
                                         <tr>
                           

                       </tr>
                                   </thead>

                     
                        <tr style="background-color: #ffffff">
                           <td>Product Id</td>
                          <td><?php echo $id;  ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Product Title In Arabic</td>
                          <td><?php echo $title_ar;  ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Product Title In English</td>
                          <td><?php echo $title_en;  ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Image</td>
                          <td><img src="<?php echo '../app/images/products/'.$images ?>" data-echo="<?php echo $row['upload_file_img'] ?>" style="height:50px;width:50px" /></td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Default Price</td>
                          <td><?php echo $default_price;  ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Category </td>
                          <td><?php
                          
                          $catquery = "select * from categories where id='$catid'";
                          $catresult = mysqli_query($conn,$catquery);
                          $catname = mysqli_fetch_assoc($catresult);
                          
                          echo $catname['title_en'];  ?> </td>
                        </tr>

                         <tr style="background-color: #ffffff">
                           <td>SubCategory</td>
                          <td><?php
                          
                          $subcatquery = "select * from subcat where id='$subcat'";
                          $subcatresult = mysqli_query($conn,$subcatquery);
                          $subcatname = mysqli_fetch_assoc($subcatresult);
                          
                          echo $subcatname['title_en'];   ?> </td>
                        </tr>

                        
                         <tr style="background-color: #ffffff">
                           <td>Store</td>
                          <td><?php
                          
                           echo $outlet;
                          ?> </td>
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
                               </tr>

                            <?php
                        }
                   }
                  ?>
       </tbody>

   </table>
                 </div>
             
         </div>
     </div>
         
     </div>
  <input type="hidden" id="ram" name="nameram">

            </form>
     <script type="text/javascript">
      $(document).ready(function() {
   $('#example').DataTable();
} );
   
</script>
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
        var table = document.getElementById("example"),rIndex;
            
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


