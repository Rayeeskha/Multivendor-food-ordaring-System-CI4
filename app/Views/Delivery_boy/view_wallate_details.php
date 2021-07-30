<!DOCTYPE html>
<html>
<head>
	<title>View Wallate Details</title>
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

<!---------Body Section Start ----->
<div class="main-panel">        
    <div class="content-wrapper">
    	<div class="card">
    		<div class="card-header">
				<h6>Wallate Details</h6>
			</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th>S.NO</th>
						<th>Amount</th>
						<th>Message</th>
						<th>Date</th>
					</tr>
					<?php
						$deli_id = session()->get('delivery_boy_id'); 
						$deli_boy_details = getDeliveryBoyWallateDetailsUsingUID($deli_id);
						if($deli_boy_details):
							count($deli_boy_details);
							$sr=1;
							foreach($deli_boy_details as $wallate):
						?>
						<tr>
				 		<td><?= $sr; ?></td>
				 		<td>
				 			<?php if($wallate->type == 'In'): ?>
				 			<span class="fa fa-inr" style="color: green;font-weight: 700">&nbsp;<?= $wallate->amount; ?></span>
				 			<?php else: ?>
				 				<span class="fa fa-inr" style="color: red;font-weight: 700">&nbsp;<?= $wallate->amount; ?></span>
				 			<?php endif; ?>
				 		</td>
				 		<td>
				 			<?php if($wallate->type == 'In'): ?>
				 			<span style="color: green;font-weight: 700">&nbsp;<?= $wallate->message; ?></span>
				 			<?php else: ?>
				 				<span style="color: red;font-weight: 700">&nbsp;<?= $wallate->message; ?></span>
				 			<?php endif; ?>
				 		</td>
				 		<td>
				 			<?= date('d M Y', strtotime($wallate->added_on)); ?>
				 		</td>
				 		
				 	</tr>
					<?php $sr++; endforeach; else: ?>
					<h6 style="color: red">No Records Found</h6>
				<?php endif; ?>
				</table>
			</div>
    	</div>
    </div>
</div>
<!---------Body Section End   ----->



<!------Footer Section Include ------>
<?= view('Delivery_boy/footer'); ?>
<!------Footer Section Include ------>

<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->

</body>
</html>