<!DOCTYPE html>
<html>
<head>
	<title>View Order Details</title>
	<!-------Css File Include ----->
	<?= view('Delivery_boy/css_file'); ?>
	<!-------Css File Include ----->
</head>
<body class="sidebar-light">
<!------Delivery Boy navbar File Include ----->
<?= view('Delivery_boy/navbar'); ?>
<!------Delivery Boy navbar File Include ----->

<!------Left Side Bar Section Include ----->
<?= view('Delivery_boy/side_bar'); ?>
<!------Left Side Bar Section Include ----->

<!-------Body Section Start ------>
 <!-- partial -->
<div class="main-panel">        
    <div class="content-wrapper">
    	<div class="card">
    		<div class="card-header">
    			<h6>Order Details # <?= $view_order[0]->order_id; ?> <span style="margin-left: 10%">Order date : <?= date('d M Y', strtotime($view_order[0]->order_date)); ?></span>

    			<a href="<?= base_url('Delivery_boy/track_users/'.$view_order[0]->order_id); ?>" style="margin-left: 40%;border: 1px solid silver;padding: 8px">
    				<span class="fa fa-map"></span>&nbsp;Track User</a>
    			</h6>

    		</div>
			<div class="card-body" style="border-bottom: 1px solid silver">
				<h6>Delivery Address</h6>
				<br>

				<div class="row">

					<div class="col-12 col-md-4 col-sm-12 col-lg-4">
						<h6>Name : <?= $view_order[0]->first_name; ?>&nbsp;<?= $view_order[0]->last_name; ?></h6>
						<h6>Full Address : <?= $view_order[0]->permanent_address; ?>,&nbsp;<?= $view_order[0]->house_number; ?></h6>
						<h6>Mobile :<a href="tel:<?= $view_order[0]->mobile; ?>"><?= $view_order[0]->mobile; ?></a></h6>
					</div>
					<div class="col-12 col-md-4 col-sm-12 col-lg-4">
						<h6>PIN CODE : <?= $view_order[0]->pinCode; ?></h6>
						<h6>State : <?= $view_order[0]->state; ?></h6>
						<h6>City : <?= $view_order[0]->city; ?></h6>
					</div>
					<div class="col-12 col-lg-4 col-md-12 col-sm-4">
						<span style="float: right;">
						Restaurent Address
						<?php
							$get_restaurent = get_restaurent_details('restaurent', $view_order[0]->restaurent_id);
						?>
						<h6>Name : <span style="color: orange">&nbsp;<?= $get_restaurent[0]->name; ?></span></h6>
						<h6> Address : <span style="color: orange">&nbsp;<?= $get_restaurent[0]->exact_location; ?></span></h6>
						<h6> PinCode : <span style="color: orange">&nbsp;<?= $get_restaurent[0]->pincode; ?></span></h6>
						
				</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-responsive">
					<tr>
						<th>Dish Image</th>
						<th>Dish Title</th>
						<th>Dish Attribute</th>
						<th>Dish Price</th>
						<th>Total Quantity</th>
						<th>Total Price</th>
						<th>Payment Status</th>
						<th>Order Status</th>
					</tr>
					
					<tbody>

						<?php if($view_order):
							count($view_order);
							foreach($view_order as $ord):
								$get_ord_detail = get_order_details('ordere_details', $ord->order_id);
								foreach($get_ord_detail as $get_ord_det):
									$get_dish_details = get_category_details('dish_master', $get_ord_det->dish_detail_id);
							?>
							<tr>
								<td>
									<img src="<?= base_url('public/uploads/dish_image/'.$get_dish_details[0]->image_two); ?>" style="width: 100px;height: 70px">
								</td>
								<td><?= $get_dish_details[0]->dish_title; ?></td>
								<td><?= $get_ord_det->attribute; ?></td>
								<td><span class="fa fa-inr"></span><?= number_format($get_ord_det->price); ?></td>
								<td><?= $get_ord_det->qty; ?></td>
								<td>
									<?php 
										$total = $get_ord_det->price * $get_ord_det->qty;
									?>
									<span class="fa fa-inr"><?= number_format($total); ?></span>
								</td>
								<td>
									<?php if($ord->payment_status == "Pending"): ?>
										<label class="badge badge-danger"><?= $ord->payment_status; ?></label>
									<?php else: ?>
										<label class="badge badge-success"><?= $ord->payment_status; ?></label>
									<?php endif; ?>
								</td>
								<td>
									<?php if($ord->order_status == "Accept"): ?>
										<label class="badge badge-info"><?= $ord->order_status; ?></label>
									<?php else: ?>
										<label class="badge badge-primary" style="background: green"><?= $ord->order_status; ?></label>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>

							<?php endforeach; ?>
								<tr><td></td><td></td><td></td><td></td>
									 <?php if($ord->coupon_id !== "0"): ?>
									 	<td>
									 		<h6 style="font-size: 12px;">Applied Coupon :
									 			<span style="color: orange"> <?= $ord->coupon_code ?></span>
									 		</h6>
									 	</td>
									 	<td>
									 		<h6 style="color: grey;font-weight: 500;font-size: 13px;">Total Price : <span class="fa fa-inr" style="text-decoration: line-through"><?= number_format($ord->total_amount); ?></span></h6>

									 		<h6 style="color: green;font-weight: 500;font-size: 13px;">Paid Price : <span class="fa fa-inr"></span><?= number_format($ord->final_price); ?></h6>
									 		
									 	</td>
		                             <?php else: ?>
		                              <td style="float: left">
											Total Price : <span class="fa fa-inr"></span><?= number_format($ord->total_amount); ?>
										</td>
		                            <?php endif; ?>
									
								</tr>
							<?php  else: ?>
							<h6 style="color: red;Order Not Found"></h6>
						<?php endif; ?>
					</tbody>
				</table>
				<a href="<?= base_url('Delivery_boy/print_order/'.$view_order[0]->order_id); ?>" class="btn btn-primary" target="_blank"><span class="fa fa-print">&nbsp;Print Order</span></a>
				<a href="<?= base_url('Delivery_boy/delivered_order/'.$view_order[0]->order_id); ?>" class="btn btn-info">Delivered Order</a>

			</div>
		</div>
	</div>
</div>
<!-------Body Section Start ------>




<!------Footer Section Include ------>
<?= view('Delivery_boy/footer'); ?>
<!------Footer Section Include ------>

<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->
</body>
</html>