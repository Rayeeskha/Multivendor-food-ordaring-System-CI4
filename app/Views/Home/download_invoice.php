<!DOCTYPE html>
<html>
<head>
	<title>Download Invoice</title>
<!--------Css File Include ------>
<?= view('Home/css_file'); ?>
<!--------Css File Include ------>
</head>
<body onload="window.print();">
<!----------Body Section Start -------->
         <!-- shopping-cart-area start -->
<div class="cart-main-area pt-55 pb-55">
<div class="container">
    <img src="<?= base_url('public/images/ff.png') ?>" style="width: 200px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <form action="#">
                <div class="table-content  wishlist">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Until Price</th>
                                <th>Qty</th>
                                <th>Attribute</th>
                                <th>Subtotal</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if($down_invoice):
                        	count($down_invoice);
                        	foreach($down_invoice as $dwn_invc): 
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
	                    <div class="card-body">
	                    	<h6>Total Amount <span style="float: right" class="fa fa-inr">
	                    		<?= number_format($down_invoice[0]->total_amount); ?>
	                    	</span></h6>

                            <!-----Check coupn is Applied or Not ----->
                            <?php if($dwn_invc->coupon_id !== "0"): ?>
                                <b><span style="float: right;" >Order Total : <b><span class="fa fa-inr" style="text-decoration: line-through; color: red">&nbsp; <?= number_format($dwn_invc->total_amount); ?></span></b></span> <br>
                                <h6 style="color: grey;float: right;">FINAL PRICE : <span class="fa fa-inr" style="color: green;"><?= $dwn_invc->final_price; ?></span></h6>
                                 <h6 >Applied Coupon : <span style="color: red">&nbsp;<?= $dwn_invc->coupon_code; ?></span></h6>
                             <?php else: ?>
                                <b><span style="float: right;" >Order Total : <b><span class="product-price-old">&nbsp; <?= number_format($dwn_invc->total_amount); ?></span></b></span>
                            <?php endif; ?>
                            <!-----Check coupn is Applied or Not -----> 

	                    </div>
	                </div>

                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!----------Body Section End -------->


<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>

</body>
</html>