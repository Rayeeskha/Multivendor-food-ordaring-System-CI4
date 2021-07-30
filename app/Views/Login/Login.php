<?php $validation = \config\services::validation(); ?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login Your Account</title>
	<link rel="stylesheet" href="<?= base_url('public/Bootstrap/bootstrap.min.css'); ?>">
	 <link href="<?= base_url('public/Bootstrap/style.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('public/Bootstrap/libs/css/style.css'); ?>">
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
 <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="#!"><img class="logo-img" src="<?= base_url('public/images/logo1.jpg'); ?>" alt="logo" style="width:200px;"></a><span class="splash-description" style="font-weight: 500;font-size: 18px;">Please enter your user information.</span>
                <?php if(isset($error)): ?>
                    <div style="color: red"><?= $error; ?></div>
                <?php endif; ?>
            </div>
            <?= form_open('Login'); ?>
            <div class="card-body">
                <div class="form-group">
                        <input class="form-control form-control-lg" id="username" name="username" type="text" placeholder="Username" autocomplete="off" value="<?= set_value('username'); ?>">
                    </div>
                    <span style="color: red"><?= display_error($validation,'username'); ?></span>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" value="<?= set_value('password'); ?>" placeholder="Password">
                    </div>
                    <span style="color: red"><?= display_error($validation,'password'); ?></span>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <span style="color: red"><?= display_error($validation,'checkbox'); ?></span>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            </div>
            <?= form_close(); ?>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
  

</body>
</html>