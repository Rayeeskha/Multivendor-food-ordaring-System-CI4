<!DOCTYPE html>
<html>
<head>
	<title>View Carts Dish</title>
		<!--------Css File Include ------>
<?= view('Home/css_file'); ?>
<!--------Css File Include ------>
<style type="text/css">
    #coupan_box{display: none;}
</style>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->



<!------Body Section Start -------->

 <div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="<?= base_url('Home/choose_restaurent'); ?>">Home</a></li>
                        <li class="active">Cart </li>
                    </ul>
                </div>
            </div>
        </div>
<!-- shopping-cart-area start -->
<div class="cart-main-area pt-95 pb-100">
<div class="container">
    <h3 class="page-title">Your cart items</h3>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <form action="#">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Until Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php 
                        	$final_price = 0;
                        	if($view_carts):
                        	count($view_carts);
                        	foreach($view_carts as $cart_item):
                        		$final_price += $cart_item->rate * $cart_item->qty;
                        		$get_pro_detal = get_category_details('dish_master', $cart_item->dish_details_id);
                        	 ?>
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#"><img src="<?= base_url("public/uploads/dish_image/".$get_pro_detal[0]->image); ?>" alt="" style="width: 100px; height: 70px;"></a>
                                </td>
                                <td class="product-name"><a href="#"><?= $cart_item->dish_title; ?></a></td>
                                <td class="product-price-cart"><span class="amount fa fa-inr">
                                	<?= number_format($cart_item->rate); ?></span></td>
                                <td>
                                    <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="" id="inc_dnc_btn"  onclick="update_quantity('sub', '<?= $cart_item->dish_details_id; ?>', '<?= $cart_item->id; ?>')">
                                          <span class="glyphicon glyphicon-minus">-</span>
                                        </button>
                                    </span>

                                    <input type="text" id="quantity" name="quantity_<?= $cart_item->id; ?>" class="form-control input-number" value="<?= $cart_item->qty; ?>" min="1" max="100">
                                    <span class="input-group-btn">

                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="" id="inc_dnc_btn"  onclick="update_quantity('add', '<?= $cart_item->dish_details_id; ?>', '<?= $cart_item->id; ?>')">
                                            <span class="glyphicon glyphicon-plus">+</span>
                                        </button>
                                    </span>
                                    
                                </div>
                                </td>
                                <td class="product-subtotal">
                                	<?php 
                                		$pro_sub_total = $cart_item->rate * $cart_item->qty;
                                	?>
                                	<span class="fa fa-inr">&nbsp;<?= number_format($pro_sub_total); ?></span>
                                </td>
                                <td class="product-remove">
                                    <a href="javascript:void(0)"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0)" onclick="return confirm('Are you sure you want to  delete this Dish ?..');"><i class="fa fa-times" onclick="delete_dish_in_carts(<?= $cart_item->id; ?>, 'load')"></i></a>
                               </td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                        <?php else:  ?>
                        	<h6 style="color: red;">Your Carts is Empty ?
                        	<a href="<?= base_url('Home/choose_restaurent'); ?>"class="btn btn-primary" >Continue Shopping ?</a>
                        	</h6>
                        <?php endif; ?>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-shiping-update-wrapper">
                        	<div class="cart-shiping-update">
                            	<a href="<?= base_url('Home/choose_restaurent'); ?>">Continue Shopping</a>
                            </div>
							<div class="cart-clear">
                               <a href="#">Clear Shopping Cart</a>
                            </div>
						</div>
                    </div>
                </div>
            </form>
            <div class="row">
               <?php
                    // $session = session();
                    if($view_carts):
                ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="discount-code-wrapper">
                        <div class="title-wrap">
                           <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4> 
                        </div>
                        <div class="discount-code">
                            <p>Enter your coupon code if you have one.</p>
                            <input type="text"  name="coupon_code" id="coupon_code">
                            <h6 style="color: red;font-size: 14px;font-weight: 500;" id="coupon_code_error"></h6>
                            <h6 style="color: green;font-size: 14px;font-weight: 500;" id="coupon_code_success"></h6>
                            <button class="cart-btn-2" type="button" onclick="apply_coupn();">Apply Coupon</button>
                          
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="grand-totall">
                    
                    <div class="title-wrap">
                            <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                        </div>
                        <h5>Total products <span class="fa fa-inr">&nbsp;<?= number_format($final_price); ?></span></h5>
                       
                        <h4 class="grand-totall-title" style="border-bottom: 1px solid silver">Grand Total  <span class="fa fa-inr">&nbsp;<?= number_format($final_price); ?></span></h4>

                    <div id="coupan_box" >
                        <h4 class="grand-totall-title" style="color: green;font-size: 14px;">Save Price: 
                            <span class="fa fa-inr" id="coupan_price">&nbsp;</span>
                        </h4>
                        <h4 class="grand-totall-title" style="color: green"><b>Final Price :<span class="fa fa-inr" style="color: green" id="total_discount_price">&nbsp;</span></b></h4>
                        
                    </div> 
                       <?php
                            $get_web_status =  get_website_settings();
                            if($get_web_status[0]->website_close !== "Open"):
                        ?>
                            <h6 style="color: red;font-weight: 500;font-size: 14px;"><?= $get_web_status[0]->website_close_msg; ?></h6>
                        <?php else: ?>
                             <a href="<?= base_url('Home/check_out'); ?>">Proceed to Checkout</a>
                        <?php endif; ?> 
                    </div>
                </div>
            </div>
            <?php else: ?>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>


<!------Body Section End -------->


<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>

</body>
</html>