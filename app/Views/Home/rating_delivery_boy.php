<!DOCTYPE html>
<html>
<head>
	<title>Delivery Boy Ratings</title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
	<style type="text/css">
		 .set_ratings {background: green;padding:10px;text-align: center;color: white;font-weight: 500;width: 50%}
	</style>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->

<!------Body Section Start ------->

<div class="container">
	<div class="card">
		<div class="card-header">
			<h6>Write your Review</h6>
		</div>
		<div class="card-body">
			<?php 
				$deli_boy = get_category_details('delivery_boy_master', $ratings[0]->delivery_boy_id);
				
			?>
			<center>
			 	<img class="card-img-top" src="<?= base_url('public/uploads/Delivery_boy/'.$deli_boy[0]->image); ?>" alt="Card image cap" class="responsive-img" style="width: 150px;height: 150px;border-radius: 100%;border: 1px solid silver">
			 </center>
			<div class="card-body" style="border-bottom: 1px solid silver">
				<center>
			    	<h4 class="card-title">Delivery Boy  </h4>
			 		<h6>Name : <?= $deli_boy[0]->name; ?></h6>
			 		<h6>Mobile : <a href="tel:<?= $deli_boy[0]->mobile; ?>" style="color: blue"><?= $deli_boy[0]->mobile; ?></a></h6>
			 	</center>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-md-4 col-sm-4 col-lg-4"></div>
				<div class="col-12 col-md-4 col-sm-4 col-lg-4">
					<h6 style="color: orange">Your Rating</h6>
					<div id="deliboyrating_<?= $deli_boy[0]->id; ?>">
                        <?= getDelivery_boy_Rating($deli_boy[0]->id, $ratings[0]->order_id); ?>

                        <br><br>
                        <?= form_open('Home/type_your_review/'.$ratings[0]->order_id); ?>
                        <h6 style="color: orange">Your Feedback</h6>
                        <textarea class="form-control" name="type_your_review"></textarea>
                        <br>
                        <center>
                        	<button type="submit" class="btn-lg btn-primary">Feedback</button>
                        </center>
                        <?= form_close(); ?>


                   </div>
				</div>
				<div class="col-12 col-md-4 col-sm-4 col-lg-4"></div>
			</div>
		</div>
	</div>
</div>

<br><br><br>

<!------Body Section End ------->

<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>

<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
</body>
</html>