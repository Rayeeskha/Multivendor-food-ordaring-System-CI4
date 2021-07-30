<!DOCTYPE html>
<html>
<head>
	<title>View Restaurent Details</title>
	<!------Css File Include ------>
	<?= view('Admin/css_file'); ?>
	<!------Css File Include ------>
	<style type="text/css">
		h6{font-size: 13px;font-weight: 800;color: grey;padding: 5px;}
	</style>
</head>
<body>
<!------Left Panel Included ------>
<?= view('Admin/left_panel'); ?>	
<!------Left Panel Included ------>
<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<?= view('Admin/right_top_bar'); ?>
<!------RightFulltopbar & Dashboard Wrapper section Include ---->

<!---------Body Section Start ------->
<div class="breadcrumbs" >
    <div class="breadcrumbs-inner">
	    <div class="card">
			<div class="card-header">
				<h6>Restaurent Details</h6>
			</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-lg-4 col-md-4 col-sm-4">
							<img src="<?= base_url('public/uploads/restaurent/uploads/restaurent_img/'.$restaurent[0]->image) ?>" class="responsive-img" style="width: 100%;height: 100%">
						</div>
						<div class="col-12 col-lg-8 col-md-8 col-sm-8">
							<h6>Restaurent Name : <span style="color: orange">&nbsp;<?= $restaurent[0]->name; ?></span></h6>
							<h6>Restaurent Mobile : <span style="color: orange">&nbsp;<?= $restaurent[0]->mobile; ?></span></h6>
							<h6>Restaurent Email : <span style="color: orange">&nbsp;<?= $restaurent[0]->email; ?></span></h6>
							<h6>GST NUMBER : <span style="color: orange">&nbsp;<?= $restaurent[0]->gst_number; ?></span></h6>
							<h6>AADHAR NUMBER : <span style="color: orange">&nbsp;<?= $restaurent[0]->aadhar_number; ?></span></h6>
							<h6>STATE : <span style="color: orange">&nbsp;<?= $restaurent[0]->state; ?></span></h6>
							<h6>CITY : <span style="color: orange">&nbsp;<?= $restaurent[0]->city; ?></span></h6>
							<h6>PIN CODE : <span style="color: orange">&nbsp;<?= $restaurent[0]->pincode; ?></span></h6>
							<h6>EXACT LOCATION : <span style="color: orange">&nbsp;<?= $restaurent[0]->exact_location; ?></span></h6>
							<h6>STATUS : <span style="color: green">&nbsp;<?= $restaurent[0]->status; ?></span></h6>
						</div>
					</div>
					<br><br>
					<center>
						<a href="<?= base_url('Super_admin/manage_restaurent') ?>" class="btn btn-primary">Back to Dahboard</a>
					</center>
				</div>
			</div>
		</div>
    </div>
</div>


<!---------Body Section End ------->



<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->
</body>
</html>