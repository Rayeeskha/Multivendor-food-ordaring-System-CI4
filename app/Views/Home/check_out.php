<!DOCTYPE html>
<html>
<head>
	<title>Checkout </title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->



<!------Body Scetion Start ------->


<div class="breadcrumb-area gray-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="#!">Home</a></li>
                <li class="active"> Checkout </li>
            </ul>
        </div>
    </div>
</div>

<!-- checkout-area start -->
<?php 
	if(session()->has("loggedin_user") || session()->has('google_user')){
		$is_show = '';
		$box_id = '';
		$final_show = 'show';
		$final_box_id = 'payment-2';
	}else{
		$is_show = 'show';
		$box_id = 'payment-1';
		$final_show = '';
		$final_box_id = '';
	} 
?>

                



<div class="checkout-area pb-80 pt-100">
<div class="container">
<div class="row">
<div class="col-lg-9">
<div class="checkout-wrapper">
    <div id="faq" class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title"><span>1.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-1">Checkout method</a></h5>
            </div>
            <div id="<?= $box_id; ?>" class="panel-collapse collapse <?= $is_show; ?> ">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12">
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


                    <div class="checkout-login">
                        <div class="title-wrap">
                            <h4 class="cart-bottom-title section-bg-white">LOGIN</h4>
                        </div>
                        <p>Already have an account? </p>
                       <?= form_open('Home/login_user_account'); ?>
                            <div class="login-form">
                                <label>Email Address * </label>
                                <input type="email" name="email" placeholder="Enter Email id">
                                <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'email'); ?></span>
                            </div>
                            <div class="login-form">
                                <label>Password *</label>
                                <input type="password" name="password" placeholder="Enter password">
                                <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'password'); ?></span>
                            </div>
                       
                        <div class="login-forget">
                        	
                        	<a href="<?= base_url('Home/login_register'); ?>">Dont have Account? &nbsp; Register now</a>
                            
                            <a href="<?= base_url('Login/forget_users_password'); ?>" target="_blank">Forgot your password?</a>

                        </div>
                        <div class="checkout-login-btn">
                            <button type="submit" class="btn-lg btn-primary" style="cursor: pointer;">Login</button>
                        </div>
                         <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title"><span>2.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-2">billing information</a></h5>
    </div>
    <div id="<?= $final_box_id; ?>" class="panel-collapse collapse <?= $final_show; ?>">
        <div class="panel-body">
            <?= form_open('Home/complete_purchase'); ?>
            <div class="billing-information-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-info">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="<?= set_value('first_name'); ?>" placeholder="Enter first Name">
                        </div>
                        <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'first_name'); ?></span>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-info">
                            <label>Last Name</label>
                            <input type="text" name="last_name" value="<?= set_value('last_name'); ?>" placeholder="Enter Last Name">
                        </div>
                        
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-info">
                            <label>Mobile</label>
                            <input type="text" name="mobile" value="<?= set_value('mobile'); ?>" placeholder="Enter Mobile Number">
                        </div>
                        <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'mobile'); ?></span>
                    </div>
                    
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-info">
                            <label>PIN Code</label>
                            <input type="text" name="pinCode" value="<?= set_value('pinCode'); ?>" id="pincode" onkeyup="get_pincodedetails_api()" placeholder="Enter Pin Code">
                        </div>
                        <h6 style="color: red;font-size: 14px;display: none;" id="pin_error">Invalid PIN Code</h6>
                        <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'pinCode'); ?></span>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-info">
                            <label>State</label>
                            <input type="text" value="<?= set_value('state'); ?>" name="state" placeholder="Enter State" id="state">
                        </div>
                         <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'state'); ?></span>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-info">
                            <label>City</label>
                            <input type="text" name="city" id="city" value="<?= set_value('city'); ?>" placeholder="Enter City">
                        </div>
                        <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'city'); ?></span>
                    </div>
                    
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-info">
                            <label>Permanent Address</label>
                            <input type="text" name="permanent_address" value="<?= set_value('permanent_address'); ?>" placeholder="Enter Permanent Address">
                        </div>
                        <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'permanent_address'); ?></span>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-info">
                            <label>House Number</label>
                            <input type="text" name="house_number" value="<?= set_value('house_number'); ?>" placeholder="House Number">
                        </div>
                        <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'house_number'); ?></span>
                    </div>
                </div>
             
                <div class="billing-back-btn">
                    <div class="billing-back">
                        <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                    </div>
                     <?php 
                        if($carts_pro){
                            $cart_total = 0;
                            count($carts_pro);
                            foreach($carts_pro as $cart_item){
                                $cart_total += $cart_item->rate * $cart_item->qty;
                             }
                        }
                    ?>                           
                    <?php 
                        $get_web_status =  get_website_settings();
                        if($get_web_status[0]->cart_min_price != ""):
                        if($cart_total >=$get_web_status[0]->cart_min_price):
                    ?>
                        
                     <div class="billing-btn">
                        <div class="single-ship">
                            <input type="radio" name="payment_type" value="COD" >
                            <label>Cash On Delivery (COD)</label>
                        </div>
                        <div class="single-ship">
                            <input type="radio" name="payment_type" value="Paytm" checked="checked">
                            <label>Paytm</label>
                        </div>

                        <?php if($wallat_total >= $cart_total){
                            $is_disabled = "";
                            $low_msg  = "";
                        }else{
                             $is_disabled = "disabled='disabled'";
                            $low_msg = '(Low Wallet Money)';
                        }
                            
                        ?>
                         <div class="single-ship">
                            <input type="radio" name="payment_type" value="Wallet" <?=  $is_disabled; ?> >
                            <label>Wallet</label>
                            <span style="color: red;font-weight: 500;font-size: 12px;"><?= $low_msg; ?></span>
                        </div>
                     
                        
                        <button type="submit">Complete Purchase</button>
                    </div>

                    <?php else: ?>
                        <div class="billing-btn">
                            <h6 style="color: red;font-weight: 500">
                                <?= $get_web_status[0]->cart_min_price_msg; ?>
                            </h6>
                        </div>
                    <?php endif; ?>
                    <?php endif; ?>

                   
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

</div>
</div>
</div>
<div class="col-lg-3 col-md-12 col-sm-12">
    <div class="checkout-progress">
    	
        <h4>Checkout Progress</h4>
        <ul>
        <?php if($carts_pro):
        	$final_price = 0;
    	count($carts_pro);
    	foreach($carts_pro as $cart_item):
    		$final_price += $cart_item->rate * $cart_item->qty;
    		$get_pro_detal = get_category_details('dish_master', $cart_item->dish_details_id);
    	 ?>
            <li style="text-align: center"><img alt="" src="<?= base_url('public/uploads/dish_image/'.$get_pro_detal[0]->image); ?>" style="width: 200px; height: 100px;">

            	<h6 style="font-weight: 500;font-size: 13px;"><?= $cart_item->dish_title; ?></h6>
            	<h6 style="font-weight: 500;font-size: 13px;">Quantity : <?= $cart_item->qty; ?></h6>
            	<h6 style="font-weight: 500;font-size: 13px;">
            		<?php
            			$total_pro_price = $cart_item->rate * $cart_item->qty;
            		 ?>
            		Price : <?= number_format($total_pro_price); ?></h6>       
            </li>
        </ul>
    <?php endforeach; ?>
           <h6 style="text-align: center;font-weight: 500;font-size: 14px">Total Amount :<span class="fa fa-inr"></span> <?= number_format($final_price); ?></h6>
              <?php
                if (session()->has('COUPON_ID') && session()->has('COUPON_CODE')):
                        $coupan_id     = session()->get('COUPON_ID');
                        $coupan_code   = session()->get('COUPON_CODE');
                        $final_coupn_price   = session()->get('FINAL_PRICE');
                ?>
             <h6 style="text-align: center;font-weight: 500;font-size: 13px;color: grey"> Applied Code: <span style="color: orange">&nbsp;<?= $coupan_code; ?></span> </h6>

             <h6 style="text-align: center;font-weight: 500;font-size: 14px"> Final Price: <span style="color: orange">&nbsp;<span class="fa fa-inr">&nbsp;<?= $final_coupn_price; ?></span></span> </h6>

            <?php else: ?>
            <?php endif; ?>
     <?php else: ?>
     	<h6 style="color: red;">Record's Not Found</h6>
<?php endif; ?>

    </div>
</div>
</div>
</div>
</div>


<!------Body Scetion End ------->



<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>


</body>
</html>