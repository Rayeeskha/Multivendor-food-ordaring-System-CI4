<!DOCTYPE html>
<html>
<head>
	<title>Login Your Account</title>
	<!-------Css File Include ----->
	<?= view('Delivery_boy/css_file'); ?>
	<!-------Css File Include ----->
</head>
<body class="sidebar-light">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">

          	  <!---Php Meassge Show --->
		    <div style="margin-left: 20px;margin-right: 10px">
		      <?php  if(session()->getTempdata('success')): ?>
		            <div class="card">
		              <div class="card-content" style="margin-left: 20px;margin-right: 20;padding: 10px; background: green;color: white;font-weight: 500">
		                <span class="fa fa-check"></span>&nbsp;&nbsp;<?= session()->getTempdata('success'); ?>
		              </div>
		            </div>
		          <?php endif; ?>
		          <?php  if(session()->getTempdata('error')): ?>
		            <div class="card">
		              <div class="card-content" style="margin-left: 10px;margin-right: 10;padding: 10px; background: red;color: white;font-weight: 500">
		                <span class="fa fa-times"></span>&nbsp;&nbsp;<?= session()->getTempdata('error'); ?>
		              </div>
		            </div>
		    <?php endif; ?>
		    </div>
		    <!---Php Meassge Show --->
          	
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo text-center">
                <img src="<?= base_url('public/images/ff.png'); ?>" alt="logo">
              </div>
              <h6 class="font-weight-light">Sign in to continue. (Delivery Boy)</h6>
              <?= form_open(); ?>
                <div class="form-group">
                	<label>Enter Email id</label>
                  <input type="email" class="form-control" value="<?= set_value('email'); ?>" name="email" placeholder="Enter Email">
                </div>
                 <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'email'); ?></span>
                <div class="form-group">
                	<label>Enter Password</label>
                  <input type="password" class="form-control" name="password" value="<?= set_value('password'); ?>" placeholder="Password">
                </div>
 				<span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'password'); ?></span>
                <div class="mt-3">
                	<button type="submit"  class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button><br>
                  <a href="<?= base_url('Delivery_boy/index'); ?>">Register</a>
                  
                </div>
                
             <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
<!--------Body Section End   ------->

<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->
</body>
</html>