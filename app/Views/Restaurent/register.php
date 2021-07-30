<!DOCTYPE html>
<html>
<head>
	<title>Restaurent Register</title>
	<!----------CSS FILE INCLUDE ----->
	<?= view('Restaurent/css_file'); ?>
	<!----------CSS FILE INCLUDE ----->
	<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>
<body>
<!--------Body Section Start ------->
   <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="#!"><img class="logo-img" src="<?= base_url('public/images/ff.png') ?>" alt="logo" style="width: 200px"></a><span class="splash-description">Please enter your user information.</span></div>

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



            
            <div class="card-body">
            <?= form_open_multipart('Registration/register_restaurent'); ?>
            	
               <div class="form-group">
              		<label>Restaurent Name</label>
	                <input type="text" class="form-control" value="<?= set_value('name'); ?>" name="name" placeholder="Username">
	            </div>
	             <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'name'); ?></span>
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
	            	<label>Aadhar Number</label>
	                <input type="text" class="form-control" name="Aadharnumber" value="<?= set_value('Aadharnumber') ?>" placeholder="Aadhar Number">
	            </div>
	            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'Aadharnumber'); ?></span>
	            <div class="form-group">
	            	<label>GST Number</label>
	                <input type="text" class="form-control" name="GSTNumber" value="<?= set_value('GSTNumber') ?>" placeholder="GST Number">
	            </div>
	            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'GSTNumber'); ?></span>

	        <div class="row">
              	<div class="col-lg-6 col-md-6 col-lg-6">
              		<div class="form-group">
              			<label>PINCODE</label>
	                  <input type="text" class="form-control" name="pincode" id="pincode" value="<?= set_value('pincode'); ?>" id="exampleInputPassword1" placeholder="PINCODE" onkeyup="get_pincodedetails_api()">

	                  <h6 style="color: red;padding: 5px;display: none;" id="pincode_error">Invalid PinCode</h6>
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
            	<label>Exact Locationn</label>
	            <input type="text" class="form-control" name="exact_location" value="<?= set_value('exact_location'); ?>" id="city_name" placeholder="Enter Exact Location">
	        </div>
	        <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'exact_location'); ?></span>
			<div class="form-group">
            	<label>Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?= set_value('password'); ?>" placeholder="Password">

                <span style="position: absolute; left: 80%;top: 70% !important;cursor: pointer;" class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></span>
            </div>
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'password'); ?></span>
            <div class="form-group">
            	<label>Confirm Password</label>
                <input type="password" class="form-control" name="confirmpassword" id="confirm_password" value="<?= set_value('confirmpassword'); ?>" placeholder="Confirm Password">
            </div>
             <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'confirmpassword'); ?></span>
	        <div class="form-group">
	        	<label>Upload Image</label>
	            <input type="file" class="form-control" name="avatar">
	        </div>
	         <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'avatar'); ?></span>
            </div>

            <button type="submit" class="btn btn-primary ">Register</button>
	    <?= form_close(); ?> 

            <h6 style="padding: 8px; text-align: center;">I have already Account ?</h6>   	
            <div class="card-footer bg-white p-0  ">
                <div class="">
                    <a href="<?= base_url('Login/restaurent_login'); ?>" class="btn btn-info btn-lg btn-block" style="width: 100% !important">Login Account</a></div>
               
            </div>
        </div>
    </div>
<!--------Body Section Start ------->



<!--------JS FILE INCLUDE ------>
<?= view('Restaurent/js_file'); ?>
<!--------JS FILE INCLUDE ------>


</body>
</html>