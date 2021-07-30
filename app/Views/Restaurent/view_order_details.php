<!DOCTYPE html>
<html>
<head>
	<title>View Order Details</title>
		<!----------CSS FILE INCLUDE ----->
	<?= view('Restaurent/css_file'); ?>
	<!----------CSS FILE INCLUDE ----->
</head>
<body>
<!------NavBar Section Include ------>
<?= view('Restaurent/navbar'); ?>	
<!------NavBar Section Include ------>	
<!--------Left SIDEBAR SECTION INCLUDE ------>
<?= view('Restaurent/left_side_bar'); ?>
<!--------Left SIDEBAR SECTION INCLUDE ------>

<!------Body Section Include ------>
 <div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
    	<div class="card">
			<div class="card-body">
				<h6>Delivery Address :   <span style="margin-left: 60%;color: orange">Restaurent Name : <?= session()->get('RES_NAME') ?></span></h6> <br>

				<div class="row">
					<div class="col-12 col-md-6 col-sm-6 col-lg-6">
						<h6>Name : <?= $ord_details[0]->first_name; ?>&nbsp;<?= $ord_details[0]->last_name; ?></h6>
						<h6>Full Address : <?= $ord_details[0]->permanent_address; ?>,&nbsp;<?= $ord_details[0]->house_number; ?></h6>
						<h6>Mobile :<a href="tel:<?= $ord_details[0]->mobile; ?>"><?= $ord_details[0]->mobile; ?></a></h6>
					</div>
					<div class="col-12 col-md-6 col-sm-6 col-lg-6">
						<h6>PIN CODE : <?= $ord_details[0]->pinCode; ?></h6>
						<h6>State : <?= $ord_details[0]->state; ?></h6>
						<h6>City : <?= $ord_details[0]->city; ?></h6>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table">
					<tr>
						<th>Dish Image</th>
						<th>Dish Title</th>
						<th>Dish Attribute</th>
						<th>Dish Price</th>
						<th>Total Quantity</th>
						<th>Total Price</th>
					</tr>
					
					<tbody>

						<?php if($ord_details):
							count($ord_details);
							foreach($ord_details as $ord):
								$get_ord_detail = get_order_details('ordere_details', $ord->order_id);
								foreach($get_ord_detail as $get_ord_det):
									$get_dish_details = get_category_details('dish_master', $get_ord_det->dish_detail_id);
									// var_dump($get_dish_details);
									// exit();
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
							</tr>
							<?php endforeach; ?>

							<?php endforeach; ?>
								<tr><td></td><td></td><td></td><td></td><td></td>
									<?php if($ord->coupon_id !== "0"): ?>
										<td style="float: left">
											<h6>Total Price : <span class="fa fa-inr" style="text-decoration: line-through;color: red">&nbsp;<?= number_format($ord->total_amount); ?></span></h6><br>
											<h6>
												<span style="color: grey;">Coupon Code : <span style="color: orange">&nbsp;<?= $ord->coupon_code; ?></span></span><br>
												Final Price :<span class="fa fa-inr" style="color: green"><?= number_format($ord->final_price); ?></span>
											</h6>
										</td>
									<?php else: ?>
										<td>
											<h6>
												Total Price : <span class="fa fa-inr"></span><?= number_format($ord->total_amount); ?>
											</h6>
										</td>
									<?php endif; ?>

									
								</tr>
							<?php  else: ?>
							<h6 style="color: red;Order Not Found"></h6>
						<?php endif; ?>
						
					</tbody>
				</table>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-6 col-sm-12">
						<?= form_open('Restaurent/change_order_status/'.$ord_details[0]->order_id); ?>
						<h5>Update Order Status</h5>
						<h6 style="padding: 10px">Current Order Status : <span style="color: orange">&nbsp;<?= $ord_details[0]->order_status; ?></span> </h6>

						<select name="order_status" class="form-control">
							<option value="<?= $ord_details[0]->order_status; ?>"><?= $ord_details[0]->order_status; ?> </option>
							<?php if($order_status):
							count($order_status);
							foreach($order_status as $ord_status): ?>
								<option value="<?= $ord_status->order_status; ?>"><?= $ord_status->order_status; ?></option>
							<?php endforeach; else: ?>
							<h6 style="color: red;">Status Not Found</h6>
						<?php endif; ?>
						</select><br>
						<button type="submit" class="btn btn-success">Update Status</button>
						<a href="<?= base_url('Restaurent/print_order_slip/'.$ord_details[0]->order_id); ?>" class="btn btn-primary" target="_blank">Print Slip</a>

						<?= form_close(); ?>
					</div>
					<?php if($ord_details[0]->ord_status_time !== null): 
						$update_time   = strtotime($ord_details[0]->ord_status_time);
						$minutes =  verify_db_detatime_to_current_time_stamp($update_time);
						if($minutes < 5):
					?>	
					<div class="col-12 col-md-6 col-lg-6 col-sm-12">
						<img src="<?= base_url('public/images/deli.gif'); ?>" style="width: 300px;height: 100px;">
						<h6 style="text-align: center;color: grey">Waiting for Delivery boy Confirmation</h6>
					</div>
					<?php else: ?>
					<div class="col-12 col-md-6 col-lg-6 col-sm-12">	
					 	<?php if($ord_details[0]->delivery_boy_id == '0'):
							$select_deli_boy = get_delivery_boy('delivery_boy_master', $ord_details[0]->pinCode);
						?>
					<?= form_open('Restaurent/add_order_del_boy/'. $ord_details[0]->order_id); ?>
						<h5 style="margin-left: 40px;padding: 5px">Assign Delivery Boy</h5><br>
						<select name="delivery_boy" class="form-control">
							<option selected="">select delivery boy</option>
							<?php if($select_deli_boy):
							count($select_deli_boy);
							foreach($select_deli_boy as $sel_boy): ?>
								<option value="<?= $sel_boy->id; ?>"><?= $sel_boy->name; ?></option>
							<?php endforeach; else: ?>
							<h6 style="color: red;">Delivery Boy Not Found</h6>
						<?php endif; ?>
						</select>
						<br>
						<center>
							<button type="submit" class="btn btn-primary">Assign</button>
						</center>

					<?= form_close(); ?>	
					</div>
					<div class="col-12 col-md-6 col-lg-6 col-sm-12">
						<?php else: 
							$get_deli_boy = get_category_details('delivery_boy_master',$ord_details[0]->delivery_boy_id);
							if ($get_deli_boy[0]->image !== null):
						?>
						<center>
							<img src="<?= base_url('public/uploads/delivery_boy/'.$get_deli_boy[0]->image); ?>" style="width: 100px;height: 100px;border-radius: 100%">
						</center>
							<center>
								<h6>Name : <?= $get_deli_boy[0]->name; ?> </h6>
								<h6>Mobile : <a href="tel:<?= $get_deli_boy[0]->mobile; ?>"><?= $get_deli_boy[0]->mobile; ?></a> </h6>
								<h6>Location : <?= $get_deli_boy[0]->city; ?> </h6>
								<h6>PIN CODE : <?= $get_deli_boy[0]->pincode; ?> </h6>
							</center>
						<?php else: ?>
							<center>
								<h5>Delivery Boy</h5>
								<img src="<?= base_url('public/images/ff.png') ?>" style="width: 100px;height: 100px;border-radius: 100%">
							</center>
							<center>
								<h6>Name : <?= $get_deli_boy[0]->name; ?> </h6>
								<h6>Mobile : <a href="tel:<?= $get_deli_boy[0]->mobile; ?>"><?= $get_deli_boy[0]->mobile; ?></a> </h6>
								<h6>Location : <?= $get_deli_boy[0]->city; ?> </h6>
								<h6>PIN CODE : <?= $get_deli_boy[0]->pincode; ?> </h6>
							</center>
							
						<?php endif; ?>

						<?php endif; ?>
					 <?php endif; ?>
					</div>
					<?php else: ?>
					<?php endif; ?>	
					
				</div>
			</div>

		</div>
	</div>


</div>
</div>
</div>
<!------Body Section Include ------>


<!--------JS FILE INCLUDE ------>
<?= view('Restaurent/js_file'); ?>
<!--------JS FILE INCLUDE ------>
</body>
</html>