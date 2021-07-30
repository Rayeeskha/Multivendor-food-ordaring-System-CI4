<!DOCTYPE html>
<html>
<head>
	<title>View Wallet Amount Details</title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
	<style type="text/css">
		ul   {list-style-type: none;}
	</style>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->	

<br><br>
<!---------Body Section Start ------->
<div class="container">
	<?= form_open('Home/add_money'); ?>
	<ul id="add_money_box">
		<li>
			<input type="number" name="money" value="<?= set_value('money'); ?>" placeholder="Add Money"  class="form-control">
			 <span style="color: red;font-weight: 500;font-size: 14px;">
			 	<?php if(isset($validation)): echo $validation; ?>
			 		<?php else: echo ""; ?>
			 	<?php endif; ?>
			 </span>
		</li>
		<li>
			<button type="submit" class="btn btn-primary" style="background: #13124e;box-shadow: none;text-transform: capitalize;height: 43px">Add Money</button>
		</li>
	</ul>
	<?= form_close(); ?>
	<br><br>
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
				<?php $wallte_details = getWallateDetailsUsingUID($user_id);
					if($wallte_details):
						count($wallte_details);
						$sr=1;
						foreach($wallte_details as $wallate):
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

				<?php $sr++; endforeach;  ?>
				 <?php else: ?>
				 	<h6 style="color: red;">No Record Found</h6>
				 <?php endif; ?>
			</table>	
		</div>
	</div>
</div>

<div style="padding-bottom: 5%"></div>
<!---------Body Section End ------->


<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
</body>
</html>