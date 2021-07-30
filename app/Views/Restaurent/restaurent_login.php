<!DOCTYPE html>
<html>
<head>
	<title>Restaurent Login</title>
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


<!-------Body Section Start ------->
   <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="#!"><img class="logo-img" src="<?= base_url('public/images/ff.png') ?>" alt="logo" style="width: 200px"></a><span class="splash-description">Please enter your user information.</span>
            	<span class="splash-description" style="color: orange">Restaurent Login</span>

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




            </div>
            <div class="card-body">
                <?= form_open() ?>
                    <div class="form-group">
                    	<label>Enter Email</label>
                        <input class="form-control form-control-lg" id="email" name="Email" value="<?= set_value('Email'); ?>" type="text" placeholder="Enter Email" autocomplete="off">
                    </div>
                    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'Email'); ?></span>
                    <div class="form-group">
                    	<label>Enter Password</label>
                        <input class="form-control form-control-lg" id="password" value="<?= set_value('password'); ?>" name="password" type="password" placeholder="XXXXXXXX">
                    </div>
                     <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'password'); ?></span>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                     <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'checkbox'); ?></span>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                <?= form_close(); ?>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="<?= base_url('Registration/Restaurent_register'); ?>" class="footer-link">Create An Account</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>

<!-------Body Section End ------->



<!--------JS FILE INCLUDE ------>
<?= view('Restaurent/js_file'); ?>
<!--------JS FILE INCLUDE ------>

</body>
</html>