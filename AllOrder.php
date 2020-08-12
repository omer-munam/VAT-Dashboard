<?php
    session_start();
    include("includes/connection.php"); 


  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1) {
          header('location:login.php');
          die();
      }

      if (isset($_POST['publish123'])) {
         $status=$_POST['status'];
         $id=$_POST['id'];
         $query="UPDATE orders SET status='$status' where id='$id'";
         if ($conn->query($query)==TRUE) {
            echo "<script>  setTimeout(function() {
        $.bootstrapGrowl('The Status Has Been updated Successfully', {
            type: 'info',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);</script>";}
            else{
                echo "error".$query."<br>".$conn->error;            
         }
      }

  //   if(isset($_POST["actionbtnaccept"]))
  //   {
  //       $s_id = $_POST["nameram"];

        
  //       $query = "UPDATE signup SET is_admin_approved=1 WHERE s_id=$s_id";
  //       if($conn->query($query)===TRUE)
  //       {
  //           echo "<script>alert('The Query Is Successfully Fired')</script>";
  //       }
  //       else
  //       {
  //           echo "error".$query."<br>".$conn->error;
  //       }

  //   }

  //   if(isset($_POST["actionbtndecline"]))
  //   {
  //       $s_id = $_POST["nameram"];
        
  //       $query = "DELETE FROM signup WHERE s_id=$s_id";


  //       if($conn->query($query)==TREU)
  //       {
  //           echo "<script>alert('The Query Is Successfully Fired')</script>";

  //       }
  //       else
  //       {
  //           echo "error".$query."<br>".$conn->error;
  //       }

  //   }
   

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
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.js"></script>
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
                           
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-shopping-cart"></i> <span>Outlet</span></a>
                                <ul class="collapse">
                                    <li><a href="AllShop.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Outlets</span></a></li>
                                    <li><a href="AddShop.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">Add Outlet</span></a></li>
                                </ul>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-first-order"></i> <span>Order</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="AllOrder.php" aria-expanded="true"><i class="fa fa-circle fs_i"></i><span class="menu-title">All Order</span></a></li>
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
                            <h4 class="page-title pull-left">All Order</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span>Order / </span></li>
                                <li><span>All Order</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['vendorname']?><i class="fa fa-angle-down"></i></h4>
                            <!-- $_SESSION['adminname'] -->
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card-footer small text-muted" style="background: #f1f6f9">
            <form action="export.php" method="post">
                <input type="submit" name="submit1"  class="btn btn-info" value="Click Here To Export" />    
            </form>
            </div>
            <form method="POST">
                <div >
     <div class="container">
         <div class="row justify-content-center">

                 <div class="col-lg-10 bg-light rounded my-2 py-2">
                     <table id="example" class="table table-striped table-bordered">
       <thead>
           <tr>
                               <tr>
                           <th>Order Id</th>
                           <th>Product Name</th>
                           <th>Quantity</th>
                           <th>Customer Name</th>
                           <th>Dated </th>
                           <th>Status </th>
                           <th style="text-align: center; width: 150px"> Details</th>
                           </tr>
       </thead>
       <tbody>
           <?php
                        mysqli_set_charset($conn,'utf8');
                        $storeid = $_SESSION['id'];
                        $query = "SELECT * FROM orders WHERE storeid=$storeid";

                        $result=mysqli_query($conn,$query);
                        $row_cnt = $result->num_rows;
                             if ($row_cnt>0) {        
                            while ($row=$result->fetch_assoc()) 
                            {
                                $id = $row["id"];
                                $pid = $row['pid'];
                                $qty = $row['qty'];
                                $uid = $row['uid'];
                                $dated = $row['dated'];
                                $status = $row['status'];
                                $psid =  $row['psid'];
                                $threadid =  $row['threadid'];
                                $delid =  $row['delid'];
                                $storeid =  $row['storeid'];
                                $locid = $row["locid"];
                                $catid = $row['catid'];
                                $subcatid = $row['subcatid'];
                                $keyvalue = $row['keyvalue'];
                                $delieverytime = $row['deliverytime'];
                                $orderid = $row['orderid'];
                                $delieverycost =  $row['deliverycost'];
                                $notes =  $row['notes'];
                                $product_cost =  $row['product_cost'];
                                $total_price =  $row['total_price'];
                                $original_price = $row["orignal_price"];
                                $del_type = $row['del_type'];
                                $del_id = $row['del_id'];
                                $del_accepted = $row['del_accepted'];
                                $del_requested = $row['del_requested'];
                            ?>
                         <tr>
                           <td style="background-color: #ffffff"><?php echo  $id ?></td>
                           <td style="background-color: #ffffff"><?php 

                $customer = mysqli_query($conn,"SELECT * FROM products WHERE id='$pid'");
            ?>
                    <?php 
                        while($customerrow = mysqli_fetch_array($customer))
                        { 
                            echo $customerrow['title_en'];  
                        }
                    ?></td>
                           <td style="background-color: #ffffff"><?php echo  $qty ?></td>
                           <td style="background-color: #ffffff"><?php 

                $customer = mysqli_query($conn,"SELECT * FROM users WHERE id='$uid'");
            ?>
                    <?php 
                        while($customerrow = mysqli_fetch_array($customer))
                        { 
                            echo $customerrow['name'];  
                        }
                    ?></td>
                           <td style="background-color: #ffffff"><?php echo  $dated ?></td>
                           <?php
                                if($row['status']==0){
                                ?>
                               <td style="background-color: #ffffff">Sent</td>
                               <?php
                               } elseif($row['status']==1){
                                ?>
                               <td style="background-color: #ffffff">Accepted</td>
                               <?php
                               }elseif($row['status']==2){
                                ?>
                               <td style="background-color: #ffffff">Ready</td>
                               <?php
                               }elseif($row['status']==3){
                                ?>
                               <td style="background-color: #ffffff">Delieverd</td>
                               <?php
                               }elseif ($row['status']==4) {
                                ?>
                               <td style="background-color: #ffffff">Finished</td>
                               <?php
                               }elseif ($row['status']==5){
                                ?>
                                <td style="background-color: #ffffff">Cancel</td>
                                <?php
                               }elseif ($row['status']==6){
                                ?>
                                <td style="background-color: #ffffff">Return Pending</td>
                                <?php
                               }  
                        ?>
                           
                           <td style="background-color: #ffffff"><!-- Button trigger modal -->
<button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#exampleModal_<?php echo $row['id'] ?>"value="<?php echo $row['id'] ?>" >
  View details
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="table1" class="table table-striped table-hover" style="margin-left: auto;">
            <thead style="background:#afcad3;font-weight: bolder;">
                                         <tr>
                           

                       </tr>
                                   </thead>

                     
                        <tr style="background-color: #ffffff">
                           <td>Order Id</td>
                          <td><?php echo $id;  ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Product Name</td>
                          <td style="background-color: #ffffff"><?php 

                $customer = mysqli_query($conn,"SELECT * FROM products WHERE id='$pid'");
            ?>
                    <?php 
                        while($customerrow = mysqli_fetch_array($customer))
                        { 
                            echo $customerrow['title_en'];  
                        }
                    ?></td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Quantity</td>
                          <td><?php echo $qty;  ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Customer Name</td>
                          <td style="background-color: #ffffff"><?php 

                $customer = mysqli_query($conn,"SELECT * FROM users WHERE id='$uid'");
            ?>
                    <?php 
                        while($customerrow = mysqli_fetch_array($customer))
                        { 
                            echo $customerrow['name'];  
                        }
                    ?></td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Dated</td>
                          <td><?php echo $dated;  ?> </td>
                        </tr>

                         <tr style="background-color: #ffffff">
                           <td>Status</td>
                          <?php
                                if($row['status']==0){
                                ?>
                               <td style="background-color: #ffffff">Sent</td>
                               <?php
                               } elseif($row['status']==1){
                                ?>
                               <td style="background-color: #ffffff">Accepted</td>
                               <?php
                               }elseif($row['status']==2){
                                ?>
                               <td style="background-color: #ffffff">Ready</td>
                               <?php
                               }elseif($row['status']==3){
                                ?>
                               <td style="background-color: #ffffff">Delieverd</td>
                               <?php
                               }elseif ($row['status']==4) {
                                ?>
                               <td style="background-color: #ffffff">Finished</td>
                               <?php
                               }elseif ($row['status']==5){
                                ?>
                                <td style="background-color: #ffffff">Cancel</td>
                                <?php
                               }elseif ($row['status']==6){
                                ?>
                                <td style="background-color: #ffffff">Return Pending</td>
                                <?php
                               }  
                        ?>
                        </tr>

                        <!--<tr style="background-color: #ffffff">-->
                        <!--   <td>Delivery  ID</td>-->
                        <!--  <td><?php echo $delid;  ?> </td>-->
                        <!--</tr>-->

                        <tr style="background-color: #ffffff">
                           <td>Store Name</td>
                          <td style="background-color: #ffffff"><?php 

                $customer = mysqli_query($conn,"SELECT * FROM stores WHERE id='$storeid'");
            ?>
                    <?php 
                        while($customerrow = mysqli_fetch_array($customer))
                        { 
                            echo $customerrow['title_en'];  
                        }
                    ?></td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Location Name</td>
                          <td style="background-color: #ffffff"><?php 

                $customer = mysqli_query($conn,"SELECT * FROM store_locations WHERE id='$locid'");
            ?>
                    <?php 
                        while($customerrow = mysqli_fetch_array($customer))
                        { 
                            echo $customerrow['title_en'];  
                        }
                    ?></td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Category</td>
                          <td style="background-color: #ffffff"><?php 

                $customer = mysqli_query($conn,"SELECT * FROM categories WHERE id='$catid'");
            ?>
                    <?php 
                        while($customerrow = mysqli_fetch_array($customer))
                        { 
                            echo $customerrow['title_en'];  
                        }
                    ?></td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Sub Category</td>
                          <td style="background-color: #ffffff"><?php 

                $customer = mysqli_query($conn,"SELECT * FROM subcat WHERE id='$subcatid'");
            ?>
                    <?php 
                        while($customerrow = mysqli_fetch_array($customer))
                        { 
                            echo $customerrow['title_en'];  
                        }
                    ?></td>
                        </tr>

                        <!--<tr style="background-color: #ffffff">-->
                        <!--   <td>Key Value</td>-->
                        <!--  <td><?php echo $keyvalue;  ?> </td>-->
                        <!--</tr>-->
                        
                        <?php if($del_type === 1){ ?>
                         <tr style="background-color: #ffffff">
                           <td>Delivery </td>
                          <td><?php echo $delieverytime;  ?> </td>
                        </tr>
                        <?php } ?>

                         <tr style="background-color: #ffffff">
                           <td>Order Id</td>
                          <td><?php echo $orderid;  ?> </td>
                        </tr>

                         <tr style="background-color: #ffffff">
                           <td>Delievery Cost</td>
                          <td><?php echo $delieverycost;  ?> </td>
                        </tr>

                        <!--<tr style="background-color: #ffffff">-->
                        <!--   <td>Notes</td>-->
                        <!--  <td><?php echo $notes;  ?> </td>-->
                        <!--</tr>-->

                        <tr style="background-color: #ffffff">
                           <td>Product Cost</td>
                          <td><?php echo $product_cost;  ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Total Price</td>
                          <td><?php echo $total_price;  ?> </td>
                        </tr>

                         <tr style="background-color: #ffffff">
                           <td>Original Price</td>
                          <td><?php echo $original_price;  ?> </td>
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
</div>
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal1_<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>" >
  Status
</button>


<div class="modal fade" id="exampleModal1_<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



                <form action="AllOrder.php" method="post" class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm" style="padding-left: 100px; width: 400px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

    
        <!-- <div class="form-group">
            <label class="col-xs-4" style="font-size: 16px;">What You are Selling</label>   
        
            </div> -->
       <div class="form-group">
        
        <div id="product_name_div">
            <label class="col-xs-6">Status<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <select name="status" class="form-control" id="status" style="height: 50px">
                        <option <?php if ($row['status'] == 0 ) echo 'selected' ; ?> value="0">Sent</option>
                        <option <?php if ($row['status'] == 1 ) echo 'selected' ; ?> value="1">Accepted</option>
                        <option <?php if ($row['status'] == 2 ) echo 'selected' ; ?> value="2">Ready</option>
                        <option <?php if ($row['status'] == 3 ) echo 'selected' ; ?> value="3">Delievered</option>
                        <option <?php if ($row['status'] == 4 ) echo 'selected' ; ?> value="4">Finished</option>
                        <option <?php if ($row['status'] == 5 ) echo 'selected' ; ?> value="5">Cancel</option>
                  </select>
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>


          <div style="text-align: center;">
              <button type="submit" class="btn btn-secondary btn-md" name="publish123">Edit</button>

              </div>
      </form>
        
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
</td>
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
