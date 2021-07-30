<!DOCTYPE html>
<html>
<head>
	<title>View Profile </title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->

<!--------Body Section Start ----->
<div class="breadcrumb-area gray-bg">
<div class="container">
    <div class="breadcrumb-content">
        <ul>
            <li><a href="<?= base_url('Home/choose_restaurent'); ?>">Home</a></li>
            <li class="active">My Account </li>
        </ul>
    </div>
</div>
</div>
<!-- my account start -->
<div class="myaccount-area pb-80 pt-100">
<div class="container">
    <div class="row">
        <div class="ml-auto mr-auto col-lg-9">
            <div class="checkout-wrapper">
                <div id="faq" class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if($view_profile[0]->referal_code): ?>
                           <div>
                               <h6 style="margin-left: 10%">Referal Code : <span style="color: orange"><?= $view_profile[0]->referal_code; ?></span>
                                   
                                   <span style="text-align: center;margin-left: 10%">Referal Links : <a href="<?= base_url('Home/login_register/referral_code/'.$view_profile[0]->referal_code); ?>" style="color: blue;text-decoration: underline;">Referal Links</a></span>
                               </h6>
                               
                           </div><br>
                       <?php endif; ?>
                            <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Update your account information </a></h5>
                        </div>
                        <div id="my-account-1" class="panel-collapse collapse show">
                            <div class="panel-body">
                                <div class="billing-information-wrapper">
                                    <div class="account-info-wrapper">
                                        <h4>My Account Information</h4>
                                        <h5>Your Personal Details</h5>
                                    </div>
                                    <?= form_open_multipart('Home/update_user_info/'.$view_profile[0]->id); ?>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="billing-info">
                                                <label>First Name</label>
                                                <input type="text" name="name" value="<?= $view_profile[0]->name; ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6">
                                            <div class="billing-info">
                                                <label>Email Address</label>
                                                <input type="email" value="<?= $view_profile[0]->email; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="billing-info">
                                                <label>Mobile</label>
                                                <input type="text" name="mobile" value="<?= $view_profile[0]->mobile; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <select name="gender" class="form-control">
                                            	<option value="<?= $view_profile[0]->gender; ?>" selected><?= $view_profile[0]->gender; ?></option>
                                            	<option value="Male">Male</option>
                                            	<option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                    	<div class="billing-info">
                                    		<?php if($view_profile[0]->profile_pic != ""): ?>
                                    			<img src="<?= base_url('public/uploads/user_profile/'.$view_profile[0]->profile_pic); ?>" style="border: 1px solid silver;width: 200px;height: 100px;" required><br><br>
                                    			<input type="file" name="profile_pic" class="form-control">

                                    		<?php else: ?>
                                    			<img src="<?= base_url('public/images/ff.png') ?>" style="border: 1px solid silver;width: 200px;height: 100px;"><br><br>
                                    			<input type="file" name="profile_pic" class="form-control" required>
                                    		<?php endif; ?> 
                                    	</div>
                                    </div>
                                    <div class="billing-back-btn">
                                        <div class="billing-back">
                                            <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                        </div>
                                        <div class="billing-btn">
                                            <button type="submit">Update data</button>
                                        </div>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                        </div>
                        <div id="my-account-2" class="panel-collapse collapse">
                        	
                            <div class="panel-body">
                                <div class="billing-information-wrapper">
                                    <div class="account-info-wrapper">
                                        <h4>Change Password</h4>
                                    </div>
                                    <?= form_open('Home/change_user_password'); ?>
                                    <div class="row">
                                    	<div class="col-lg-12 col-md-12">
                                            <div class="billing-info">
                                                <label>Old Password</label>
                                                <input type="password" name="old_password" value="<?= set_value('old_password'); ?>" placeholder="Enter Old Password">
                                            </div>
                                              <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'old_password'); ?></span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info">
                                                <label>New Password</label>
                                                <input type="password" name="new_password" value="<?= set_value('new_password'); ?>" placeholder="Enter New Password">
                                            </div>
                                            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'new_password'); ?></span>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info">
                                                <label>Password Confirm</label>
                                                <input type="password" name="confirm_password" value="<?= set_value('confirm_password'); ?>" placeholder="Enter Confirm Password">
                                            </div>
                                            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'confirm_password'); ?></span>
                                        </div>
                                    </div>
                                    <div class="billing-back-btn">
                                        <div class="billing-back">
                                            <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                        </div>
                                        <div class="billing-btn">
                                            <button type="submit">Change Password</button>
                                        </div>
                                    </div>
                                </div>
                                 <?= form_close(); ?>
                            </div>
                           
                        </div>
                    </div>
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--------Body Section End ----->




<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>

</body>
</html>