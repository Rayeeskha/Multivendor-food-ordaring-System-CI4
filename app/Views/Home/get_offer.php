<!DOCTYPE html>
<html>
<head>
	<title>Offer Details</title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
	<style type="text/css">
		h6{font-size: 14px}
	</style>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->
<div class="breadcrumb-area gray-bg">
	<div class="container">
	    <div class="breadcrumb-content">
	        <ul>
	            <li><a href="#!">Discount Offer Restaurent</a></li>
	        </ul>
	    </div>
	</div>
</div>
<div class="shop-page-area pt-40 pb-40">
	<div class="container">
		<div class="row">
			<?php if($coupon_master):
			count($coupon_master);
			foreach($coupon_master as $coupn): ?>
				<div class="col-12 col-lg-3 col-md-12 col-sm-12">
					<div class="card">
						<div class="card-header">
							<h6>Discount Restaurent</h6>
						</div>
						<div class="card-body">
							<?php $restaurent_id =  get_restaurent_details('restaurent',$coupn->restaurent_id); 
							?>
							<h6 style="color: orange;font-size: 14px"><?= $restaurent_id[0]->name; ?></h6>
							<h6>Coupon Code : <span style="color: red;"><?= $coupn->coupon_code; ?></span></h6>
							<?php if($coupn->coupon_type == "Percentage"): ?>
								<h6 style="color: green">Dicount : <?= $coupn->coupon_value; ?> %</h6>
							<?php else: ?>
								<h6 style="color: green">Flate  :<span class="fa fa-inr"></span> <?= $coupn->coupon_value; ?> </h6>
							<?php endif; ?>
							<h6>Cart Min Value : <span style="color: red">&nbsp;<?= $coupn->cart_min_value; ?></span></h6>
							<h6>Added On : <span style="color: green">&nbsp;<?= date('d M Y', strtotime($coupn->added_on)); ?></span></h6>
							<h6>Expiry On : <span style="color: red">&nbsp;<?= date('d M Y', strtotime($coupn->expiry_on)); ?></span></h6>
							
						</div>
					</div>
				</div>
			<?php endforeach; else: ?>
			<h6 style="color: red;">Currentlty Not any Discount</h6>
		<?php endif; ?>
		
		</div>
	</div>
</div>

<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
</body>
</html>