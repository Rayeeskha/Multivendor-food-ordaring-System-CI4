<!DOCTYPE html>
<html>
<head>
	<title>Manage Users</title>
	<!------Css File Include ------>
	<?= view('Admin/css_file'); ?>
	<!------Css File Include ------>
    <style type="text/css">
        td{font-size: 13px;font-weight: 600;}
       
    </style>

</head>
<body>
<!------Left Panel Included ------>
<?= view('Admin/left_panel'); ?>	
<!------Left Panel Included ------>


<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<?= view('Admin/right_top_bar'); ?>
<!------RightFulltopbar & Dashboard Wrapper section Include ---->

<!------Body Section Start  ------->

<div class="breadcrumbs" >
<div class="breadcrumbs-inner">
    <div class="row m-0">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>

                </div>
                 <button type="button" class="btn btn-primary" data-backdrop="static" data-toggle="modal" data-target="#add_order_modal"> Add Order Status
                 </button>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Order Master</a></li>
                        <li>
                            <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter Orders
                              </button>
                              <div class="dropdown-menu" style="margin-top: 28%;width: 100px;">
                                <a class="dropdown-item" href="<?= base_url('Super_admin/filter_orders/pending_order'); ?>" style="border-bottom: 1px solid silver">Pending Order</a>
                                <a class="dropdown-item" href="<?= base_url('Super_admin/filter_orders/processing_order') ?>">Processing Order</a>
                             
                              </div>
                            </div>
                        </li>
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
                    <strong class="card-title">Manage Users</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
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
                        </thead>
                        <tbody>

                            <?php if($order_master): 
                                count($order_master);
                            foreach($order_master as $ord): ?>
                            <tr>
                                <td><a href="<?= base_url('Super_admin/view_order_details/'.$ord->order_id); ?>" style="color: blue" target="_blank"><?= $ord->order_id; ?></a></td>
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
                           			<a href="<?= base_url('Super_admin/view_order_details/'.$ord->order_id); ?>" class="btn btn-success" target="_blank"><span class="fa fa-eye"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <h6 style="color: red;font-weight: 500;font-size: 14px;">Records Not Found</h6>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<!------Body Section End    ------->

<!------Add Order Status ------>
<div class="modal fade" id="add_order_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?=  form_open('Super_admin/add_order_status'); ?>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Order Status</label>
            <input type="text" class="form-control" name="order_status" value="<?= set_value('order_status'); ?>" placeholder="Order Status" required="">
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'order_status'); ?></span>
           </div>
         
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <?= form_close(); ?>
  </div>
</div>
<!------Add Order Status ------>



<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->


</body>
</html>