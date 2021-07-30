<!DOCTYPE html>
<html>
<head>
	<title>Delivery Boy Payout</title>
	<!------Css File Include ------>
  <?= view('Admin/css_file'); ?>
  <!------Css File Include ------>
  <style type="text/css">
  	#delivery_boy_img{width: 50px;border-radius: 100%}
  </style>
</head>
<body>
<!------Left Panel Included ------>
<?= view('Admin/left_panel'); ?>  
<!------Left Panel Included ------> 
<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<?= view('Admin/right_top_bar'); ?>
<!------RightFulltopbar & Dashboard Wrapper section Include ---->

<!-------Body Section Start -------->

<div class="breadcrumbs" >
<div class="breadcrumbs-inner">
<div class="row m-0">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Delivery Boy Payout</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Delivery Boy Payout</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="content">
<div class="animated fadeIn">
<div class="row">
	<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Delivery Boy Payout</strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>UID</th>
                            <th>Payout Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if($deli_boy_payout): 
                            count($deli_boy_payout);
                        foreach($deli_boy_payout as $deli_pay): 
                        	$delivery_boy = get_category_details('delivery_boy_master',$deli_pay->delivery_boy_id);
                        	if ($delivery_boy):
                        		$pay_out_details = get_deliboy_wallate_amount($deli_pay->delivery_boy_id);
                        		
                        ?>
                        </tr>
	                        <td>
	                        	<?php if($delivery_boy[0]->image !== ""): ?>
	                        		<img src="<?= base_url('public/uploads/delivery_boy/'.$delivery_boy[0]->image); ?>" id="delivery_boy_img">
	                        	<?php else: ?>
	                        	<?php endif; ?>
	                        </td>
	                        <td>
	                        	<?= $delivery_boy[0]->name; ?>
	                        </td>
	                        <td>
	                        	<a href="tel:<?= $delivery_boy[0]->mobile; ?>"><?= $delivery_boy[0]->mobile; ?></a>
	                        </td>
	                        <td>
	                        	<?= $delivery_boy[0]->aadhar_number; ?>
	                        </td>
	                        <td>
	                        	<span class="fa fa-inr">&nbsp;<?= number_format($pay_out_details); ?></span>
	                        </td>
	                        <td>
	                        	<a href="<?= base_url('Super_admin/deliboypayout_details/'.$deli_pay->delivery_boy_id); ?>">
	                        		<span class="btn btn-success">View</span>
	                        	</a>
	                        </td>

                        </tr>
                    
                        <?php else: ?>
                        	<h6 style="color: red">Delivery Boy Not Found</h6>
                        <?php endif; ?>
                    <?php endforeach; else: ?>
                        <h6 style="color: red;font-weight: 500;font-size: 14px;">Records Not Found</h6>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-------Body Section End-------->


<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->	

</body>
</html>