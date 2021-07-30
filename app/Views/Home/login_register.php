<!DOCTYPE html>
<html>
<head>
	<title>Login Register</title>
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

<!--------Body Section Start ------->
<div class="login-register-area pt-95 pb-100">
<div class="container">
    <div class="row">
        <div class="col-lg-7 col-md-12 ml-auto mr-auto">
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

        <?php if(isset($error)): ?>
            <div style="color: red"><?= $error; ?></div>
        <?php endif; ?>
        </div>
            <div class="login-register-wrapper">
             <div class="login-register-tab-list nav">
                    <a class="active" data-toggle="tab" href="#lg1">
                        <h4> login </h4>
                    </a>
                    <a data-toggle="tab" href="#lg2">
                        <h4> register </h4>
                    </a>
                </div>
                <div class="tab-content">
                    <div id="lg1" class="tab-pane active">
                        <div class="login-form-container" style="background: #fff">
                            <div class="login-register-form">
                                <?= form_open('Login/login_user_account'); ?>
                                    <input type="text" name="email" placeholder="Enter Email">
                                    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'email'); ?></span>
                                    <input type="password" name="password" placeholder="Password">
                                    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'password'); ?></span>
                                    <div class="button-box">
                                        <div class="login-toggle-btn">
                                            <input type="checkbox" name="checkbox">
                                            <label>Remember me</label>
                                            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'checkbox'); ?></span>
                                            <a href="<?= base_url('Login/forget_users_password'); ?>">Forgot Password?</a>
                                        </div>
                                        <button type="submit"><span>Login</span></button>
                                    </div>
                                    <br><br>
                                    <!-----Gooogle Login Image Section --->

                                    <?php if(isset($loginButton)): ?>
                                        <div>
                                            <a href="<?= $loginButton; ?>">
                                                <img src="<?= base_url('public/images/logingoogle.png') ?>" style="width: 100%;height: 50px;">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <!-----Gooogle Login Image Section --->
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <div id="lg2" class="tab-pane">
                        <div class="login-form-container" style="background: #fff">
                            <div class="login-register-form">
                                <?= form_open('Registration/register_users'); ?>
                                    <input type="text" name="Username" placeholder="Username" value="<?= set_value('Username'); ?>">
                                     <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'Username'); ?></span>
                                    <input name="email" name="email" value="<?= set_value('email'); ?>" placeholder="Enter Email" type="email">
                                    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'email'); ?></span>
                                    <input name="mobile" value="<?= set_value('mobile'); ?>"  placeholder="Enter Mobile Number" type="number">
                                    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'mobile'); ?></span>
                                    <h6>Select Gender</h6>
                                    <select name="gender" class="form-control">
                                        <option selected="" disabled="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select><br><br>
                                    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'gender'); ?></span>
                                    <input type="password" value="<?= set_value('password'); ?>" name="password" id="password" placeholder="Password">
                                     <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'password'); ?></span>
                                    <span style="position: absolute; left: 80%;top: 66% !important;cursor: pointer;" class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></span>
                                    <input type="password" value="<?= set_value('conf_password'); ?>" name="conf_password" id="confirm_password"    placeholder="Confirm Password">
                                    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'conf_password'); ?></span>
                                    
                                    <div class="button-box">
                                        <button type="submit"><span>Register</span></button>
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
</div></div>
<!--------Body Section End ------->


<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>



</body>
</html>