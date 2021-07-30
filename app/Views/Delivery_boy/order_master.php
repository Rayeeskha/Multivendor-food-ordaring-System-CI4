<!DOCTYPE html>
<html>
<head>
	<title>Order Master</title>
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

     <!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Orders(<?php if($order_master): echo count($order_master); else: echo "0"; endif; ?>)</h4>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="order-listing" class="table">
              <thead>
                <tr>
                    <th>Order Id #</th>
                    <th>Total QTY</th>
                    <th>Total Price</th>
                    <th>Purchased On</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                  
                    <th>Actions</th>
                </tr>
              </thead>
              <?php if($order_master):
              count($order_master);
              foreach($order_master as $ord_mst): ?>
              <tbody>
                <tr>
                    <td><?= $ord_mst->order_id; ?></td>
                    <td><?= $ord_mst->total_quantity; ?></td>
                    <td><span class="fa fa-inr">&nbsp;<?= number_format($ord_mst->total_amount); ?></span></td>
                    <td><?= $ord_mst->first_name; ?>&nbsp;<?= $ord_mst->last_name; ?></td>
                    <td><a href="tel:<?= $ord_mst->mobile; ?>"><?= $ord_mst->mobile; ?></a></td>
                    <td><?= $ord_mst->permanent_address; ?>
                    	<br><span style="color: grey;">PinCode : &nbsp;<?= $ord_mst->pinCode; ?></span>	<br>
                    	<span style="color: orange">H.No: <?= $ord_mst->house_number; ?></span>
                    </td>
                    <td>
                    	<?php if($ord_mst->payment_status == 'Pending'): ?>
                      <label class="badge badge-danger"><?= $ord_mst->payment_status; ?></label>
                      <?php else: ?>
                      	 <label class="badge badge-success"><?= $ord_mst->payment_status; ?></label>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if($ord_mst->order_status == 'Accept'): ?>
                      <label class="badge badge-success"><?= $ord_mst->order_status; ?></label>
                      <?php else: ?>
                         <label class="badge badge-success" style="background: green"><?= $ord_mst->order_status; ?></label>
                      <?php endif; ?>
                    	
                    </td>
                    <td>
                    	<a href="<?= base_url('Delivery_boy/view_order/'.$ord_mst->order_id); ?>"  class="btn btn-outline-primary">View</a>
                   </td>
                </tr>
              </tbody>
          <?php endforeach; else: ?>
          	<h6 style="color: red;">Records Not Found</h6>
          <?php endif; ?>
            </table>
          </div>
		</div>
      </div>
    </div>
  </div>


<!-------Body Section Start ----->



<!------Footer Section Include ------>
<?= view('Delivery_boy/footer'); ?>
<!------Footer Section Include ------>

<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->

</body>
</html>