<!DOCTYPE html>
<html>
<head>
	<title>Order Reports</title>
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

<!-------Body Section Start ----->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
    		
    		<div class="card-body" style="border-bottom: 1px solid silver">
	    			<h5 style="font-weight: 500;margin-top: 5px; font-size: 20px;"><span class="fa fa-shopping-cart" style="color: red"></span>&nbsp;Manage Sales <span style="margin-left: 65%;">
	    				<a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#sale_modal" style="font-size: 15px;font-weight: 500;">
					<span class="fa fa-filter"></span>&nbsp;Customize Sales</a></span>
				</h5>

				<h6 style="color: grey;font-size: 15px; font-weight: 500;"> Date : 28-Feb-2021 To <?= date('d-M-Y'); ?> 
					<span style="margin-left: 65%;">
						<a href="<?= base_url('Delivery_boy/order_reports'); ?>" style="font-size: 15px;color: red;">
							Reset</a>
					</span>
				</h6>


				<!-- Modal -->
				<div class="modal fade" id="sale_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Customize Sales Report</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				    <?= form_open('Delivery_boy/search_sales'); ?>
						<div  class="row" style="margin-bottom: 0px;margin-top: 10px;">
							<div class="col l6 m6 s12">
								<input type="date" name="start_date" id="input_box" required class="form-control">
							</div>
							<div class="col l6 m6 s12">
								<input type="date" name="last_date" id="input_box" required class="form-control">
							</div>
						</div>
					 </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">Fetch Sales..</button>
				      </div>
				    <?= form_close(); ?>  
				    </div>
				  </div>
				</div>
			</div>
    	</div>
		<div class="card">
    		<div class="card-body">
    			<table class="table">
    				<tr>
						<th style="text-align: center;">DATE</th>
						<th>CUSTOMER</th>
						<th style="text-align: right;">UNIT SALES</th>
						<th style="text-align: right;">TOTAL AMOUNT</th>
					</tr>
				<?php if($sale_reports):
					count($sale_reports);
					foreach($sale_reports as $sale): ?>
						<tr>
							<td style="text-align: center;">
							<?= date('d M Y',strtotime($sale['order_date'])); ?></td>
							<td>
								(<?= $sale['COUNT(order_date)']; ?>)

								<?php 
									$total_customer  = get_all_customer($sale['order_date']);
								?>
								 <?php
									$i = 0;
									if(count($total_customer)):
									 	foreach($total_customer as $total_cus):
									 		$i++;
									  ?>
									<i><span style="color: grey;">Sold By : <?=  $total_cus->first_name; ?> &nbsp;<?= $total_cus->last_name; ?></span></i> <br/>
							</td>
							<td  style="text-align: right;font-size: 14px;font-weight: 500;color: black;">
								<?= $sale['SUM(total_quantity)']; ?><br/>
								<span style="color: grey;">Unit : <?= $total_cus->total_quantity; ?></span>
							</td>
							<td style="text-align: right;font-size: 14px;font-weight: 500;color: black;">
								<span class="fa fa-rupee-sign"></span>&nbsp;
							<?= number_format($sale['SUM(total_amount)'],2, '.',','); ?> /-<br/>
							</td>
							<td>
								<i><span style="color: grey;"><span class="fa fa-rupee-sign"></span>&nbsp;
							 <?= number_format($total_cus->total_amount,2, '.',','); ?> /-</span></i> <br/>
							</td>

							<?php endforeach;
							else: ?>
								<i>Customer Not Found's</i>
							<?php endif; ?>
						</tr>
					<?php endforeach; else: ?>
					<h6 style="color: red;">Sale Not Found</h6>
				<?php endif; ?>
    			</table>
    		</div>
    	</div>
	</div>
</div>
<!-------Body Section End ----->




<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->
</body>
</html>