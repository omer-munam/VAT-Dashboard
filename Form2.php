<?php
  session_start();
  include("includes/connection.php");
  require_once 'vendor/autoload.php';

  if (!isset($_SESSION['loggedin'])) {
      header('location:login.php');
      die();
  }

  mysqli_set_charset($conn, 'utf8');
  $user_id =  $_SESSION['id'];
  $query = "SELECT * FROM invoices WHERE user_id='$user_id' AND inv_type='Selling' AND inv_date >= DATE_FORMAT(CURDATE(), '%Y-%m-%d') - INTERVAL 3 MONTH";

  $result=mysqli_query($conn, $query);
  if ($result) {
      $row_cnt = $result->num_rows;
      if ($row_cnt>0) {
          $total_amountS = 0;
          while ($row=$result->fetch_assoc()) {
              $id = $row["id"];
              $inv_num =  $row['inv_number'];
              $prod_name =  $row['prod_name'];
              $prod_price =  $row['prod_price'];
              $prod_qty =  $row['prod_qty'];
              $inv_type =  $row['inv_type'];
              $inv_date = $row['inv_date'];

              $total_amountS += ($prod_price * $prod_qty);
          }
          $taxS = $total_amountS * 0.19;
          // echo "<p class=\"h6\">No. of products sold: ". $row_cnt ."</p>";
          // echo "<p class=\"h6\">Total Amount: ". $total_amountS ."</p>";
          // echo "<p class=\"h6\">Tax to be paid: ". $taxS ."</p>";
      }
  }

  mysqli_set_charset($conn, 'utf8');
  $user_id =  $_SESSION['id'];
  $query = "SELECT * FROM invoices WHERE user_id='$user_id' AND inv_type='Buying' AND inv_date >= DATE_FORMAT(CURDATE(), '%Y-%m-%d') - INTERVAL 3 MONTH";

  $result=mysqli_query($conn, $query);
  if ($result) {
      $row_cnt = $result->num_rows;
      if ($row_cnt>0) {
          $total_amountB = 0;
          while ($row=$result->fetch_assoc()) {
              $id = $row["id"];
              $inv_num =  $row['inv_number'];
              $prod_name =  $row['prod_name'];
              $prod_price =  $row['prod_price'];
              $prod_qty =  $row['prod_qty'];
              $inv_type =  $row['inv_type'];
              $inv_date = $row['inv_date'];

              $total_amountB += ($prod_price * $prod_qty);
          }
          $taxB = $total_amountB * 0.19;
          // echo "<p class=\"h6\">No. of products sold: ". $row_cnt ."</p>";
          // echo "<p class=\"h6\">Total Amount: ". $total_amountB ."</p>";
          // echo "<p class=\"h6\">Tax to be received: ". $taxB ."</p>";


          $tax = $taxS - $taxB;
          $total_amount = $total_amountB + $total_amountS;
          

          $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('TAX_DECLARATION_FORM.docx');
          $templateProcessor->setValue('start_date', date('Y-m-d', strtotime("-3 Months")));
          $templateProcessor->setValue('end_date', date('Y-m-d'));
          $templateProcessor->setValue('current_date', date('Y-m-d'));
          $templateProcessor->setValue('tax', $tax);
          $templateProcessor->setValue('VAT_pin', $_SESSION['VAT_pin']);
          $templateProcessor->setValue('VAT_Account', $_SESSION['id']);

          $file = $_SESSION['name'].'-TAX_DECLARATION_FORM-'.date('Y-m-d').'.docx';
          $templateProcessor->saveAs($file);
      }
  }

  include('includes/header.php');
?>


    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <!-- <h4 class="page-title pull-left">Dashboard</h4> -->
                    <ul class="breadcrumbs pull-left">
                        <li><a href="index.php">Home</a></li>
                        <li><span>Tax Declaration Form</span></li>
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

    <div class="container">
      <div class="single-report">
        <div class="s-report-inner pr--20 pt--30 mb-5">
          <div class="row d-flex justify-content-between">
            <div class="col-3 align-self-center d-flex justify-content-center"><img src="assets/images/icon/left_logo.png" alt=""></div>
            <div class="col-3 align-self-start d-flex justify-content-center"><img src="assets/images/icon/center_logo.png" alt=""></div>
            <div class="col-3 align-self-center d-flex justify-content-center"><img src="assets/images/icon/right_logo.jpg" alt=""></div>
          </div>
          <div class="s-report-title d-flex justify-content-center mt-3">
            <h4 class="header-title font-weight-bold mb-0 " style="font-size: 28px;"><u>TAX DECLARATION FORM</u></h4>
          </div>
          <div class="row">
            <div class="col-8 p-4">
              <div class="row justify-content-center">
                <p class="mr-2">For the period of</p>
                <span class="text_box d-flex justify-content-center"><?php echo date('Y-m-d', strtotime("-3 Months")) ?></span>
                <p class="ml-2 mr-2">to</p>
                <span class="text_box d-flex justify-content-center"><?php echo date('Y-m-d') ?></span>
              </div>
              <div class="row mt-5 justify-content-end">
                <p class="mr-2">VTA REG. NUMBER</p>
                <span class="text_box"></span>
              </div>
              <div class="row mt-1 justify-content-end">
                <p class="mr-2">DATE</p>
                <span class="text_box d-flex justify-content-center"><?php echo date('Y-m-d') ?></span>
              </div>
            </div>
            <div class="col-4">
              <div class="receipt-stamp w-50 h-100">
                <p class="d-flex justify-content-center">Receipt Stamp</p>
              </div>
            </div>
          </div>
          <div class="container col-10 mt-3 p-3" style="background: #4472C4;">
            <div class="s-report-title">
              <h4 class="header-title mb-0 text-white" style="font-size: 24px;">PAYMENT RECEIPT</h4>
            </div>
            <div class="row pl-3 mb-3">
              <h4 class="header-title mb-0 mr-2 text-white" style="font-size: 22px;">Amount to be paid: </h4>
              <span class="text_box d-flex justify-content-center">&euro; <?php echo $tax ?></span>
            </div>
            <div class="row">
              <div class="col-4">
                <h4 class="header-title text-white" style="font-size: 22px;">For internal use only</h4>
                <div class="bg-white w-100" style="border: 1px solid greenyellow;">
                  <div class="h-100 p-2">
                    <p class="font-weight-bold">Payment Date:</p>
                    <span class="text_box2 d-block text-white"></span> 
                    <p class="font-weight-bold mt-1">Pass Pin:</p>
                    <span class="text_box2 d-block text-white"></span>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="d-flex justify-content-center mt-4">
                  <h4 class="header-title mb-0 text-white" style="font-size: 22px;">VAT PIN</h4>
                </div>
                <div class="d-flex justify-content-center">
                  <span class="text_box d-flex justify-content-center" style="height: 30px;"><?php echo $_SESSION['VAT_pin']; ?></span>
                </div>
                <div class="d-flex justify-content-center">
                  <h4 class="header-title mb-0 mt-1  text-white" style="font-size: 22px;">VAT ACC. NUMBER</h4>
                </div>
                <div class="d-flex justify-content-center">
                  <span class="text_box d-flex justify-content-center" style="height: 30px; width: 200px"><?php echo $_SESSION['id']; ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container mt-3 mb-4 d-flex justify-content-center">
          <a href="<?php echo $file ?>" class="btn btn-secondary">Download TAX Declaration Form</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

<?php include('includes/footer.php');?>