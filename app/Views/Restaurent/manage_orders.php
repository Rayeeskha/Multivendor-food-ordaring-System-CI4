<!DOCTYPE html>
<html>
<head>
	<title>Manage Orders</title>
	<!----------CSS FILE INCLUDE ----->
	<?= view('Restaurent/css_file'); ?>
	<!----------CSS FILE INCLUDE ----->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/Restaurent/assets/vendor/datatables/css/dataTables.bootstrap4.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/Restaurent/assets/vendor/datatables/css/buttons.bootstrap4.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/Restaurent/assets/vendor/datatables/css/select.bootstrap4.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/Restaurent/assets/vendor/datatables/css/fixedHeader.bootstrap4.css'); ?>">
</head>
<body>
<!------NavBar Section Include ------>
<?= view('Restaurent/navbar'); ?>	
<!------NavBar Section Include ------>	
<!--------Left SIDEBAR SECTION INCLUDE ------>
<?= view('Restaurent/left_side_bar'); ?>
<!--------Left SIDEBAR SECTION INCLUDE ------>

<!------Body Section Start ----->
<!-------Body Section Start ---->
 <div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
	<!-----Dish Table Section Start ----->
	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Orders Master</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    	
                    	<table id="example" class="table table-striped table-bordered second" style="width:100%">
                        
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Name</th>
                                <th>Mobile</th>
                              	<th>City</th>
                                <th>Address</th>
                                <th>Total Qty</th>
                                <th>Total Amount</th>
                                <th>Payment Status </th>
                                <th>Delivery boy </th>
                                <th>Order Status</th>
                                <th>Order date </th>
                                <th>Action</th>
                            </tr>
                     
                        <tbody>

                            <?php if($order_master): 
                                count($order_master);
                            foreach($order_master as $ord): ?>
                            <tr>
                                <td><a href="<?= base_url('Restaurent/view_order_details/'.$ord->order_id); ?>" style="color: blue" target="_blank"><?= $ord->order_id; ?></a></td>
                                <td><?= $ord->first_name; ?><?= $ord->last_name; ?></td>
                               <td><a href="tel:<?= $ord->mobile; ?>"><?= $ord->mobile; ?></a></td>
                                <td>
                                	<span style="color: orange">PIN Code :<?= $ord->pinCode; ?></span>
                                	<span style="color: green">State :<?= $ord->state; ?></span>
                                	<span style="color: silver">City :<?= $ord->city; ?></span>
                                </td>
                                <td><?= word_limiter($ord->permanent_address, 4); ?><br>
                                	<span style="color: orange"><?= $ord->house_number; ?></span>
                                </td>
                                <td><?= $ord->total_quantity; ?></td>
                                <?php if($ord->coupon_id !== "0"): ?>
                                    <td>
                                        <span style="color: grey">Total Price : <span style="color: orange;text-decoration: line-through" class="fa fa-inr">&nbsp;<?= number_format($ord->total_amount); ?></span></span><br>Final Price
                                        <span class="fa fa-inr" style="color: orange"></span><?= number_format($ord->final_price); ?><br>
                                    <span style="color: grey;">CouponCode : <span style="color: red;">
                                        <?= $ord->coupon_code; ?>
                                    </span></span>
                                    </td>
                                <?php else: ?>
                                    <td><span class="fa fa-inr" style="color: orange"></span><?= number_format($ord->total_amount); ?></td>
                                <?php endif; ?>
                                
                                
                                <td>
                                	<span style="color: orange">&nbsp;<?= $ord->payment_mode; ?></span><br>
                                	<?php if($ord->payment_status == 'Pending'): ?>
                                    <span class="badge badge-danger" >Pending</span>
                                    <?php else: ?>
                                        <span class="badge badge-success">SUCCESS</span>
                                    <?php endif; ?>
                                </td>
                                <td></td>
                               
                                <td>
                                    <?php if($ord->order_status == 'Pending'): ?>
                                         <span class="badge badge-danger" >Pending</span>
                                    <?php elseif($ord->order_status == 'Cancel'): ?> 
                                    <span class="badge badge-danger"><?= $ord->order_status; ?></span> 
                                        <h6 style="font-size: 12px;font-weight: 600">by: <span style="color: red;"><?= $ord->cancel_by; ?></span></h6>  
                                    <?php else: ?>
                                        <span class="badge badge-success"><?= $ord->order_status; ?></span>
                                    <?php endif; ?>
                                </td>
                                 <td><?= date('D M Y', strtotime($ord->order_date)); ?></td>
                                <td>
                           			<a href="<?= base_url('Restaurent/view_order_details/'.$ord->order_id); ?>" class="btn btn-success" target="_blank"><span class="fa fa-eye"></span></a>
                                </td>
                            </tr>
                        	<?php endforeach; else: ?>
                        		<h6 style="color: red;">Order Not Found</h6>
                        <?php endif; ?>
                           
                        
                           
                        </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end data table  -->
    <!-- ============================================================== -->
</div>
		
	</div>
</div>


<!------Body Section End ----->

<!--------JS FILE INCLUDE ------>
<?= view('Restaurent/js_file'); ?>
<!--------JS FILE INCLUDE ------>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/Restaurent/assets/vendor/datatables/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('public/Restaurent/assets/vendor/datatables/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('public/Restaurent/assets/vendor/datatables/js/data-table.js'); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
</body>
</html>