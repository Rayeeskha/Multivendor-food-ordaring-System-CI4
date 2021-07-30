<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>
	<!--------Css File Include ------>
<?= view('Home/css_file'); ?>
<!--------Css File Include ------>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->

<!---------Body Section Start ------->
 <div class="contact-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <a href="<?= base_url('Home/find_office_location'); ?>">
                            <div class="contact-info-wrapper text-center mb-30">
                                <div class="contact-info-icon">
                                    <i class="ion-ios-location-outline"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Our Location</h4>
                                    <p>012 345 678 / 123 456 789</p>
                                    <p><a href="#">info@example.com</a></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="contact-info-wrapper text-center mb-30">
                            <div class="contact-info-icon">
                                <i class="ion-ios-telephone-outline"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Contact us Anytime</h4>
                                <p><a href="tel:9554540271">Mobile: 012 345 678</a></p>
                                <p><a href="mailto:rayeesinfotech@gmail.com">rayeesinfotech@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="contact-info-wrapper text-center mb-30">
                            <div class="contact-info-icon">
                                <i class="ion-ios-email-outline"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Write Some Words</h4>
                                <p><a href="mailto:rayeesinfotech@gmail.com">rayeesinfotech@gmail.comm </a></p>
                                <p><a href="mailto:rayeesinfotech@gmail.com">inforayees@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-12">
                        <div class="contact-message-wrapper">
                            <h4 class="contact-title">GET IN TOUCH</h4>
                            <?= form_open('Home/support_message'); ?>
                            <div class="contact-message">
                                <div class="row">
                                        <div class="col-lg-6">
                                            <div class="contact-form-style mb-20">
                                                <input name="name" placeholder="Full Name" type="text">
                                            </div>
                                            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'name'); ?></span>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-form-style mb-20">
                                                <input name="email" placeholder="Email Address" type="email">
                                            </div>
                                            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'email'); ?></span>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-form-style mb-20">
                                                <input name="subject" placeholder="Subject" type="text">
                                            </div>
                                             <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'subject'); ?></span>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-form-style mb-20">
                                                <input name="mobile" placeholder="Mobile Number" type="number">
                                            </div>
                                            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'mobile'); ?></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style">
                                                <textarea name="message" placeholder="Message"></textarea>
                                                <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'message'); ?></span>
                                                <button class="submit btn-style" type="submit">SEND MESSAGE</button>
                                            </div>
                                        </div>
                                    </div>
                              <?= form_close(); ?>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                     
                    </div>
                </div>
            </div>
             <div class="col lg-12 col-md-12 col-sm-12">
        	
        </div>
        </div>
        
       
<!---------Body Section End   ------->

<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
</body>
</html>