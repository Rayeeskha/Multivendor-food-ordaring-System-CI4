<!DOCTYPE html>
<html>
<head>
  <title>Update Website Status</title>
  <!------Css File Include ------>
  <?= view('Admin/css_file'); ?>
  <!------Css File Include ------>
  <style type="text/css">
    .form-control-label{font-size: 14px;font-weight: 600}
  </style>

</head>
<body>
<!------Left Panel Included ------>
<?= view('Admin/left_panel'); ?>  
<!------Left Panel Included ------> 

<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<?= view('Admin/right_top_bar'); ?>
<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<div class="breadcrumbs">
     <div class="breadcrumbs-inner">
      <div class="row m-0">
        <div class="col-sm-4">
          <div class="page-header float-left">
            <div class="page-title">
                  <h1>Dashboard</h1>
             </div>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="page-header float-right">
            <div class="page-title">
               <ol class="breadcrumb text-right">
                  <li><a href="#">Dashboard</a></li>
                  <li class="active">Update Website Settings</li>
                </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
    <div class="col-lg-6 col-sm-12 col-md-12">
      <?= form_open('Super_admin/update_web_settings/'.$web_setting[0]->id); ?>
        <div class="card">
            <div class="card-header"><strong>Update  </strong><small style="color: orange;font-weight: 600"> Website Settings</small></div>
              <div class="card-body card-block">
                  <div class="form-group"><label for="category" class=" form-control-label">Cart Min Price</label><input type="text" class="form-control" name="cart_min_price" value="<?= $web_setting[0]->cart_min_price; ?>"></div>
                  <div class="form-group"><label for="category" class=" form-control-label">Cart Min Price</label><input type="text" class="form-control" name="cart_min_price_msg" value="<?= $web_setting[0]->cart_min_price_msg; ?>"></div>
                  <div class="form-group">
                    <label for="category" class=" form-control-label">Website Status</label>
                    <select name="website_close" class="form-control">

                      <option value="<?= $web_setting[0]->website_close; ?>" selected><?= $web_setting[0]->website_close; ?></option>
                      <option value="Open">Open</option>
                      <option value="Close">Close</option>
                    </select>
                  </div>
                    <div class="form-group"><label for="vat" class=" form-control-label">Website Close Msg</label><input type="text"  class="form-control" name="website_close_msg" value="<?= $web_setting[0]->website_close_msg; ?>"></div>
                    <div class="form-group"><label for="vat" class=" form-control-label">User Register Cashback Amount</label><input type="text"  class="form-control" name="wallet_amt" value="<?= $web_setting[0]->wallet_amt; ?>"></div>
                    <div class="form-group"><label for="vat" class=" form-control-label">User Referal Cashback Amount</label><input type="text"  class="form-control" name="referal_amt" value="<?= $web_setting[0]->referal_amount; ?>"></div>
                    <div class="form-group"><label for="vat" class=" form-control-label">Delivery Reg Cashback</label><input type="text"  class="form-control" name="deli_reg_cash" value="<?= $web_setting[0]->deli_boy_reg_cahback; ?>"></div>
                     <div class="form-group"><label for="vat" class=" form-control-label">Delivery Per Order Amount</label><input type="text"  class="form-control" name="deli_per_ord_amt" value="<?= $web_setting[0]->deliBoyPerOrderAmt; ?>"></div>
                   
              </div>
              <button type="submit" class="btn btn-primary">Update Website Settings</button>
            </div>
        </div>
     </div>
    <?= form_close(); ?>
</div>



<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->
</body>
</html>