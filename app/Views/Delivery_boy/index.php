<!DOCTYPE html>
<html>
<head>
	<title>Register Your Account</title>
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
              <h6 class="font-weight-light">Delivery Boy Registration</h6>
            <?= form_open_multipart('Registration/register_delivery_boy_acc'); ?>
            	<div class="form-group">
              		<label>Username</label>
	                <input type="text" class="form-control" value="<?= set_value('usernamme'); ?>" name="usernamme" placeholder="Username">
	            </div>
	             <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'usernamme'); ?></span>
	            <div class="form-group">
	            	<label>Email</label>
	                <input type="text" class="form-control" name="email" value="<?= set_value('email'); ?>" placeholder="Enter Email">
	            </div>
	              <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'email'); ?></span>
	             <div class="form-group">
	             	<label>Mobile</label>
	                <input type="number" class="form-control" name="mobile" value="<?= set_value('mobile'); ?>" placeholder="Enter Mobile">
	            </div>
	             <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'mobile'); ?></span>
	            <div class="form-group">
	            	<label>Password</label>
	                <input type="password" class="form-control" name="password" id="password" value="<?= set_value('password'); ?>" placeholder="Password">

	                <span style="position: absolute; left: 80%;top: 43% !important;cursor: pointer;" class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></span>
	            </div>
	            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'password'); ?></span>
	            <div class="form-group">
	            	<label>Confirm Password</label>
	                <input type="password" class="form-control" name="confirmpassword" id="confirm_password" value="<?= set_value('confirmpassword'); ?>" placeholder="Confirm Password">
	            </div>
	             <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'confirmpassword'); ?></span>
	            <div class="form-group">
	            	<label>Aadhar Number</label>
	                <input type="text" class="form-control" name="Aadharnumber" value="<?= set_value('Aadharnumber') ?>" placeholder="Aadhar Number">
	            </div>
	            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'Aadharnumber'); ?></span>
	        <div class="row">
              	<div class="col-lg-6 col-md-6 col-lg-6">
              		<div class="form-group">
              			<label>PINCODE</label>
	                  <input type="text" class="form-control" name="pincode" id="pincode" value="<?= set_value('pincode'); ?>" id="exampleInputPassword1" placeholder="PINCODE" onkeyup="get_pincodedetails_api()">
	                  <h6 style="color: red;font-weight: 500;font-size: 13px;padding: 8px;display: none;" id="pin_code_error">Invalid PINCODE</h6>
	            	</div>
	            	 <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'pincode'); ?></span>
              	</div>
              	<div class="col-lg-6 col-md-6 col-lg-6">
              		<div class="form-group">
              			<label>State</label>
	                  <input type="text" class="form-control" name="state" value="<?= set_value('state'); ?>" id="state_name" placeholder="State">
	            	</div>
	            	 <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'state'); ?></span>
              	</div>
            </div>
            <div class="form-group">
            	<label>City</label>
	            <input type="text" class="form-control" name="city" value="<?= set_value('city'); ?>" id="city_name" placeholder="Enter City">
	        </div>
	         <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'city'); ?></span>
	        <div class="form-group">
	        	<label>Upload Image</label>
	            <input type="file" class="form-control" name="avatar">
	        </div>
	         <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'avatar'); ?></span>
	        <div class="mt-3">
	        	<button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Register</button>
	        	<span style="color: grey">I have already Account ?</span>
	        	<a href="<?= base_url('Login/login_delivery_boyaccount'); ?>" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn">Login</a>
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



<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->


</body>
</html>