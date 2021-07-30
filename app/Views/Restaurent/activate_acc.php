<!DOCTYPE html>
<html>
<head>
	<title>Activate Account</title>
	<!-------Css File Include ----->
	<?= view('Delivery_boy/css_file'); ?>
	<!-------Css File Include ----->
</head>
<body>
<!-------Body Section Start  ----->

<div class="container">
	<div class="card" style="background: black;margin-top: 5%;">
		<div class="card-content" style="border-bottom: 1px dashed silver">
			<div style="margin-left: 20px;margin-right: 10px">
		
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
	</div>
		<div class="card-content">
			<center>
				<a href="<?= base_url('Login/restaurent_login'); ?>" class="btn btn-waves-effect waves-light" style="background: #005a87;text-transform: capitalize;font-weight: 500;border-radius: 5px;"><span class="fa  fa-key"></span>&nbsp;Go to Login Account</a>
			</center>
		</div>
	</div>
</div>
<!-------Body Section End  ----->

<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->
</body>
</html>