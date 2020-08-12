<div class="form-group">
        <div id="product_name_div">
            <label class="col-xs-6">Sub Category<span class="validatestar">*</span></label>
            <div class="col-xs-6">
                  <?php 
                  $catid = $_POST['message'];
                include("includes/connection.php");
                mysqli_set_charset($conn,'utf8');
                $category = mysqli_query($conn,"select * from subcat where catid='$catid'");
            ?>

                <select name="subcat" class="form-control" id="subcat" style="height: 50px">
                    <?php 
                        while($categoryrow = mysqli_fetch_array($category))
                        { 
                    ?>
                        <option value="<?php echo $categoryrow['id']; ?>"> <?php echo  $categoryrow['title_en']; ?> </option>
                    <?php
                        }
                    ?>
                  </select>
                <div id="product_name_error"></div>
              </div>
            </div>          
          </div>