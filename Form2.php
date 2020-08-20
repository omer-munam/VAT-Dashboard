<?php
  session_start();
  include("includes/connection.php");
  require_once 'vendor/autoload.php';

  if (!isset($_SESSION['loggedin'])) {
      header('location:login.php');
      die();
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
                        <li><span>Form 2</span></li>
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
      <div class="row">
        <div class="col-md-6">
          <div class="single-report">
            <div class="s-report-inner pr--20 pt--30 mb-3">
              <div class="s-report-title d-flex justify-content-center">
                <h4 class="header-title mb-0" style="font-size: 28px;">Selling</h4>
              </div>
              <?php
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
                          echo "<p class=\"h6\">No. of products sold: ". $row_cnt ."</p>";
                          echo "<p class=\"h6\">Total Amount: ". $total_amountS ."</p>";
                          echo "<p class=\"h6\">Tax to be paid: ". $taxS ."</p>";
                      }
                  }
              ?>
            </div>
            <canvas  height="100"></canvas>
          </div>
        </div>

        <div class="col-md-6">
          <div class="single-report">
            <div class="s-report-inner pr--20 pt--30 mb-3">
              <div class="s-report-title d-flex justify-content-center">
                <h4 class="header-title mb-0" style="font-size: 28px;">Buying</h4>
              </div>
              <?php
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
                          echo "<p class=\"h6\">No. of products sold: ". $row_cnt ."</p>";
                          echo "<p class=\"h6\">Total Amount: ". $total_amountB ."</p>";
                          echo "<p class=\"h6\">Tax to be received: ". $taxB ."</p>";


                          $tax = $taxS - $taxB;
                          $total_amount = $total_amountB + $total_amountS;
                          

                          $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('TAX_DECLARATION_FORM.docx');
                          $templateProcessor->setValue('start_date', date('Y-m-d', strtotime("-3 Months")));
                          $templateProcessor->setValue('end_date', date('Y-m-d'));
                          $templateProcessor->setValue('current_date', date('Y-m-d'));
                          $templateProcessor->setValue('tax', $tax);
                          $templateProcessor->setValue('VAT_pin', $_SESSION['VAT_pin']);

                          $file = $_SESSION['name'].'-TAX_DECLARATION_FORM-'.date('Y-m-d').'.docx';
                          $templateProcessor->saveAs($file);

                          // echo "<a href=\"MyWordFile.docx\">Download Word file</a>";
                      }
                  }
              ?>
            </div>
            <canvas  height="100"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-3 d-flex justify-content-center">
      <a href="<?php echo $file ?>" class="btn btn-secondary">Download TAX Declaration Form</a>
    </div>
  </div>
  </div>
</div>

<?php include('includes/footer.php');?>