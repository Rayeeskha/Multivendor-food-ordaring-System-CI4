<!DOCTYPE html>
<html>
<head>
	<title>Forget Passowrd</title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
	<style type="text/css">
		body{background: rgb(224, 227, 231)}
	</style>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->


<!-----Body Section Start ------>
  <div class="login-register-area pt-95 pb-100">
        <div class="container">
            <div class="row">
               <div class="col-md-4 col-lg-4 col-sm-4"></div>
               <div class="col-md-4 col-lg-4 col-sm-4">
               	 <div class="tab-content">
					<div id="lg1" class="tab-pane active">
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
					    <div class="login-form-container" style="background: #fff">
					    	<h6>Reset Password </h6><br>
					        <div class="login-register-form">
					            <?= form_open(); ?>
					                <input type="text" name="new_password" placeholder="Enter New Password">
					                <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'new_password'); ?></span>
					                <input type="text" name="Confirm_password" placeholder="Enter New Password">
					                <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'Confirm_password'); ?></span>
					        	</div>
					                 <center>
					                 	<button type="submit" class="btn btn-success" style="cursor: pointer;"><span>Forget Password ?</span></button>
					                 </center>
					   
					            <?= form_close(); ?>
					        </div>
					    </div>
					</div>	<br><br>
               </div>
               <div class="col-md-4 col-lg-4 col-sm-4"></div>
            </div>
        </div>
   	</div>
<!-----Body Section Start ------>


<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>


<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
</body>
</html>