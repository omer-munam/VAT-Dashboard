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
 if (isset($_POST["actionbtndecline"])) {
     $id = $_POST["nameram"];
        
     $query = "DELETE FROM products WHERE id='$id'";

     if ($conn->query($query)==true) {
         echo "<script>  setTimeout(function() {
        $.bootstrapGrowl('The Data Has Been Deleted Successfully', {
            type: 'danger',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);</script>";
     } else {
         echo "error".$query."<br>".$conn->error;
     }
 }
       if (isset($_POST['pubish123'])) {
           mysqli_set_charset($conn, 'utf8');
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
           if ($file_tmp!='') {
               $filename = addslashes($_FILES['images']['name']);
               $tmpname = addslashes(file_get_contents($_FILES['images']['tmp_name']));
               $filetype = addslashes($_FILES['images']['type']);
               $filesize = addslashes($_FILES['images']['size']);
               $array = array('jpg','jpeg');
               $ext = pathinfo($filename, PATHINFO_EXTENSION);


               $file_name = $_FILES['images']['name'];
               $file_tmp = $_FILES['images']['tmp_name'];
               $file_path = "../app/images/products/".$filename;
               move_uploaded_file($file_tmp, $file_path);

          

               $query = "UPDATE products SET barcode='$barcode', title_ar='$title_ar', title_en='$title_en',images='$filename',default_price='$default_price', catid='$catid', subcat='$subcat',status='$status' WHERE id='$id'";
           } else {
               $query = "UPDATE products SET barcode='$barcode', title_ar='$title_ar', title_en='$title_en',default_price='$default_price', catid='$catid', subcat='$subcat',status='$status' WHERE id='$id'";
           }


           if ($conn->query($query)===true) {
               echo "<script>setTimeout(function() {
        $.bootstrapGrowl('The Product Has Been Updated Successfully', {
            type: 'success',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);</script>";
           } else {
               echo "error".$query."<br>".$conn->error;
           }
       }

    include('includes/header.php');
?>
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Invoices</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Invoices / </span></li>
                                <li><span></span></li>
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
           
            




            <form action="#" method="POST"  class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm">
                <div>
     <div class="container">
         <div class="row justify-content-center">

                 <div class="col-lg-10 bg-light rounded my-2 py-2">
                     <table id="example" class="table table-striped table-bordered">
       <thead>
           <tr>
                               <th width="100px"> Invoice Number</th>
                           <th> Product Name </th>
                           <th> Product Price </th>
                           
                           <th style="text-align: center;width:200px""> Product Quantity</th>
                           <th> Invoice Type </th>
                           <th> Invoice Date </th>
                           </tr>
       </thead>
       <tbody>
           <?php
                                   mysqli_set_charset($conn, 'utf8');
                        $from_storeid =  $_SESSION['id'];
                        $query = "SELECT ps.*,products.*,sl.title_en AS outlet FROM products_stores ps INNER JOIN products ON ps.productid=products.id INNER JOIN store_locations sl ON ps.store_location=sl.id WHERE products.admin_approved='1' AND ps.storeid='$from_storeid'";

                        $result=mysqli_query($conn, $query);
                        $row_cnt = $result->num_rows;
                             if ($row_cnt>0) {
                                 while ($row=$result->fetch_assoc()) {
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
                                     $category = mysqli_query($conn, "select * from categories"); ?>

                <select name="catid" class="form-control" id="catid<?php echo $id ?>" style="height: 50px">
                    <?php
                        while ($categoryrow = mysqli_fetch_array($category)) {
                            ?>
                        <option <?php if ($categoryrow['id']==$catid) {
                                echo "Selected";
                            } ?> value="<?php echo $categoryrow['id']; ?>"> <?php echo  $categoryrow['title_en']; ?> </option>
                    <?php
                        } ?>
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
                          <td><?php echo $id; ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Product Title In Arabic</td>
                          <td><?php echo $title_ar; ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Product Title In English</td>
                          <td><?php echo $title_en; ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Image</td>
                          <td><img src="<?php echo '../app/images/products/'.$images ?>" data-echo="<?php echo $row['upload_file_img'] ?>" style="height:50px;width:50px" /></td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Default Price</td>
                          <td><?php echo $default_price; ?> </td>
                        </tr>

                        <tr style="background-color: #ffffff">
                           <td>Category </td>
                          <td><?php
                          
                          $catquery = "select * from categories where id='$catid'";
                                     $catresult = mysqli_query($conn, $catquery);
                                     $catname = mysqli_fetch_assoc($catresult);
                          
                                     echo $catname['title_en']; ?> </td>
                        </tr>

                         <tr style="background-color: #ffffff">
                           <td>SubCategory</td>
                          <td><?php
                          
                          $subcatquery = "select * from subcat where id='$subcat'";
                                     $subcatresult = mysqli_query($conn, $subcatquery);
                                     $subcatname = mysqli_fetch_assoc($subcatresult);
                          
                                     echo $subcatname['title_en']; ?> </td>
                        </tr>

                        
                         <tr style="background-color: #ffffff">
                           <td>Store</td>
                          <td><?php
                          
                           echo $outlet; ?> </td>
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
        });
    </script>
            <!-- page title area end -->
            
        
        <!-- main content area end -->
<?php include('includes/footer.php');?>


