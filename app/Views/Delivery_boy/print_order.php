<!DOCTYPE html>
<html>
<head>
	<title>Order Id : <?= $print_order[0]->order_id; ?></title>
	<!-------Css File Include ----->
	<?= view('Delivery_boy/css_file'); ?>
	<!-------Css File Include ----->
</head>
<body onload="window.print();">
<!-- Body Section start -->
<div class="container" style="margin-top: 5%">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<?php
					$get_restaurent = get_restaurent_details('restaurent', $print_order[0]->restaurent_id);
				?>
				<div class="col-12 col-md-4 col-lg-4 col-sm-12">
					<img src="<?= base_url('public/images/ff.png') ?>" style="width: 200px;">
				</div>
				<div class="col-12 col-md-4 col-lg-4 col-sm-12">
					<h6>Name : <?= $print_order[0]->first_name; ?>&nbsp;<?= $print_order[0]->last_name; ?></h6>
					<h6>Full Address : <?= $print_order[0]->permanent_address; ?>,&nbsp;<?= $print_order[0]->house_number; ?></h6>
					<h6>Mobile :<a href="tel:<?= $print_order[0]->mobile; ?>"><?= $print_order[0]->mobile; ?></a></h6>
				</div>
				<div class="col-12 col-md-4 col-lg-4 col-sm-12">
					<h6>Name : <span style="color: orange">&nbsp;<?= $get_restaurent[0]->name; ?></span></h6>
					<h6> Address : <span style="color: orange">&nbsp;<?= $get_restaurent[0]->exact_location; ?><span></h6>
					<h6> PinCode : <span style="color: orange">&nbsp;<?= $get_restaurent[0]->pincode; ?></span></h6>
					<h6> Phone : <span style="color: orange">&nbsp;<?= $get_restaurent[0]->mobile; ?></span></h6>
				</div>
			</div>	
		</div>
		<div class="card-body">
			<table class="table">
				<tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Until Price</th>
                    <th>Qty</th>
                    <th>Attribute</th>
                    <th>Subtotal</th>
                </tr>
                <?php if($print_order):
                	count($print_order);
                	foreach($print_order as $dwn_invc): 
                		$get_ord_detail = get_order_details('ordere_details', $dwn_invc->order_id);
                	?>

                	 <?php
                        foreach($get_ord_detail as $get_ord_det):
                            $get_dish_details = get_category_details('dish_master', $get_ord_det->dish_detail_id);
                     ?>
                     <tr>
                        <td class="product-thumbnail">
                            <a href="#"><img src="<?= base_url('public/uploads/dish_image/'.$get_dish_details[0]->image_two); ?>" alt="" style="width: 50px"></a>
                        </td>
                        <td class="product-name"><a href="#"><?= $get_dish_details[0]->dish_title; ?> </a></td>
                        <td class="product-price-cart"><span class="amount"><?= number_format($get_ord_det->price); ?></span></td>
                        <td>
                           <?= $get_ord_det->qty; ?> 
                        </td>
                        <td>
                        	<?= $get_ord_det->attribute; ?>
                        </td>
                        <td class="product-subtotal">
                        	<?php 
                        		$total_price = $get_ord_det->price * $get_ord_det->qty;
                        	?>
                        	<span class="fa fa-inr">&nbsp;<?=  number_format($total_price); ?> </span>
                        </td>
                    </tr>

                 <?php endforeach; ?>
              </tbody>
			</table>
			<?php endforeach; else: ?> 
               <h6 style="color: red;">Order Not Found</h6>
                <?php endif; ?>
            <div class="card">
                <div class="card-body" style="padding: 10px">
                	Payment method : <span style="float: right;color: orange"><?= $dwn_invc->payment_mode; ?></span><br><br>

                    <?php if($dwn_invc->coupon_id !=="0"): ?>
                        <h6>Total Amount  <span style="float: right;text-decoration: line-through;color: red" class="fa fa-inr" >
                        <?= number_format($dwn_invc->total_amount); ?>
                    </span></h6>
                    <h6 style="text-align: center;color: grey;font-size: 12px;">Applied Coupon : <span style="color: orange">&nbsp;<?= $dwn_invc->coupon_code; ?></span> </h6>
                    <h6>FINAL PRICE <span style="float: right;color: green" class="fa fa-inr">
                        <?= number_format($dwn_invc->final_price); ?>
                    </span></h6>
                        
                    <?php else: ?>
                    <h6>Total Amount  <span style="float: right" class="fa fa-inr">
                        <?= number_format($dwn_invc->total_amount); ?>
                    </span></h6>
                    <?php endif; ?>


                </div>
            </div>

		</div>
		
	</div>
</div>

<!----------Body Section End -------->



<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->
</body>
</html>