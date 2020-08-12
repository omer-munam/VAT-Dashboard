<?php
include("includes/connection.php");
session_start();
mysqli_set_charset($conn,"utf8");

if(isset($_POST["submit"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Customers.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Customer ID', 'Customer Name', 'Username', 'Contact Number', 'Email','Registered On','Social Type','Device Type','Ip Address','Last Signin'));  
      $query2 = "SELECT * FROM users ORDER BY id DESC";  
      $result2 = mysqli_query($conn, $query2);  
      while($row2 = mysqli_fetch_assoc($result2))  
      {  
        $registeredOn = strval($row2['registeredOn']);
        $last_signin = strval($row2['last_signin']);
        $social_type=$row2['social_type'];
        $device_type=$row2['device_type'];
        if ($social_type==0){
        	$social_type="Normal";
        }elseif($social_type==1){
        	$social_type="Facebook";
        }elseif ($social_type==2) {
        	$social_type="Google";
        }elseif ($social_type==3) {
        	$social_type="Twitter";
        }

        if ($device_type==0) {
        	$device_type="iphone";
        }elseif ($device_type==1) {
        	$device_type="Android";
        }
        
           fputcsv($output, array($row2['id'],$row2['name'],$row2['username'],$row2['contact'],$row2['email'],$registeredOn,$social_type,$device_type,$row2['ipaddress'],$last_signin));  
           
           // use above code or use this { fputcsv($output,$row2); }
      }  
      fclose($output);  
 }

if(isset($_POST["submit1"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Orders.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Order ID', 'Product Name', 'Quantity', 'Customer Name', 'Order Date','Status','Store Name','Location Name','Category','Sub Category','Delivery Time','Order ID','Product Cost','Total Price','Original Price'));  
      $storeid = $_SESSION['id'];
      $query2 = "SELECT * FROM orders WHERE storeid=$storeid ORDER BY id DESC ";  
      $result2 = mysqli_query($conn, $query2);  
      while($row2 = mysqli_fetch_assoc($result2))  
      {  
		mysqli_set_charset($conn,"utf8");
        $dated = strval($row2['dated']);
        $deliverytime = strval($row2['deliverytime']);
        $pid=$row2['pid'];
        $uid=$row2['uid'];
        $storeid=$row2['storeid'];
        $locid=$row2['locid'];
        $catid=$row2['catid'];
        $subcatid=$row2['subcatid'];
		mysqli_set_charset($conn,"utf8");
        $customer = mysqli_query($conn,"SELECT * FROM products WHERE id='$pid'");
        $customerrow = mysqli_fetch_array($customer);
        $product_name=$customerrow['title_en'];
        $customer = mysqli_query($conn,"SELECT * FROM users WHERE id='$uid'");
        $customerrow = mysqli_fetch_array($customer);
        $customer_name=$customerrow['name'];
        if($row2['status']==0){
        	$status="Sent";
        }elseif ($row2['status']==1) {
        	$status="Accepted";
        }elseif ($row2['status']==2) {
        	$status="Ready";
        }elseif ($row2['status']==3) {
        	$status="Delieverd";
        }elseif ($row2['status']==4) {
        	$status="Finished";
        }elseif ($row2['status']==5) {
        	$status="Cancel";
        }
        $customer = mysqli_query($conn,"SELECT * FROM stores WHERE id='$storeid'");
        $customerrow = mysqli_fetch_array($customer);
        $store_name=$customerrow['title_en'];
        $customer = mysqli_query($conn,"SELECT * FROM store_locations WHERE id='$locid'");
        $customerrow = mysqli_fetch_array($customer);
        $location_name=$customerrow['title_en'];
        $customer = mysqli_query($conn,"SELECT * FROM categories WHERE id='$catid'");
        $customerrow = mysqli_fetch_array($customer);
        $category_name=$customerrow['title_en'];
        $customer = mysqli_query($conn,"SELECT * FROM subcat WHERE id='$subcatid'");
        $customerrow = mysqli_fetch_array($customer);
        $sub_cat=$customerrow['title_en'];
        
           fputcsv($output, array($row2['id'],$product_name,$row2['qty'],$customer_name,$dated ,$status,$store_name,$location_name,$category_name,$sub_cat,$deliverytime,$row2['orderid'],$row2['product_cost'],$row2['total_price'],$row2['orignal_price']));  
           
           // use above code or use this { fputcsv($output,$row2); }
      }  
      fclose($output);  
 }  

      ?>