<!DOCTYPE html>
<html>
<head>
	<title>Delivery Boy Payout Details</title>
		<!------Css File Include ------>
  <?= view('Admin/css_file'); ?>
  <!------Css File Include ------>
</head>
<body>
<!------Left Panel Included ------>
<?= view('Admin/left_panel'); ?>  
<!------Left Panel Included ------> 
<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<?= view('Admin/right_top_bar'); ?>
<!------RightFulltopbar & Dashboard Wrapper section Include ---->

<div class="breadcrumbs" >
<div class="breadcrumbs-inner">
<div class="row m-0">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Delivery Boy Payout Details</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Delivery Boy Payout Details</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="content">
<div class="animated fadeIn">
	<div class="card">
		<div class="card-header">
			<h6>Payout Details</h6>
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
				<tr>
					<td>
						<a href="<?= base_url('Super_admin/delivery_boy_pay_out'); ?>" class="btn btn-warning">Back</a>
					</td>
					<td>
						<button class="btn btn-primary">Pay Now</button>
					</td>
				</tr>
				</table>
		</div>
	</div>
</div>
</div>



<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->
</body>
</html>