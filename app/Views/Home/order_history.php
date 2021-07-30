<!DOCTYPE html>
<html>
<head>
	<title>Order History</title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
    <style type="text/css">
       h6{font-weight: 500;font-size: 13px;}
       .set_ratings {background: green;padding:10px;text-align: center;color: white;font-weight: 500;width: 50%}   
    </style>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->

<!-----Body Sction Start ------>
    <!-- shopping-cart-area start -->
<div class="cart-main-area ">
    <div class="container">
        <h3 class="page-title">Your Order's items
        	<span style="float: right;border: 1px solid silver;padding: 6px;"><a href="#">Track Order</a></span>
        </h3>
        

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
            <?php if($order_history): ?>
                <a href="#!" class="btn btn-success"><?= $order_history[0]->order_id; ?> (<?= count($order_history); ?>)</a>
            <?php endif; ?>
              </div>
          <div class="card-body"  style="border-bottom: 1px solid silver">
             <?php if($order_history):
                count($order_history);
                foreach($order_history as $ord_his):
                    $get_ord_detail = get_order_details('ordere_details', $ord_his->order_id);   
                ?>
            <div class="card">
                <div class="card-body">
                    <a href="#!" class="btn btn-primary">Order Id #<?= $ord_his->order_id; ?></a>
                        
                    <?php if($ord_his->order_status == "Delivered"): ?>
                         <a href="<?= base_url('Home/download_invoice/'.$ord_his->order_id); ?>" target="_blank">
                            <img src="<?= base_url('public/Home/images/pdf.png') ?>" style="width: 50px;">
                        </a>
                        <div style="float: right">
                            <a href="<?= base_url('Home/rating_delivery_boy/'.$ord_his->order_id); ?>">
                                <img src="<?= base_url('public/Home/images/star.gif'); ?>" style="width: 200px;height: 70px;">
                            </a>
                        </div>
                    <?php elseif ($ord_his->order_status == 'Pending'): ?>
                        <a href="<?= base_url('Home/trash_order/'.$ord_his->order_id); ?>" class="btn btn-secondary" style="background: no-repeat;color: grey;border: 1px solid silver;box-shadow: none; float: right;">Track Order</a>

                        <a href="<?= base_url('Home/cancel_orders/' .$ord_his->order_id); ?>"  class="btn btn-danger right" style="border: 1px solid silver;box-shadow: none;float: right;"> Cancel </a> 
                    <?php elseif($ord_his->order_status == "Cancel"): ?>  

                    <?php elseif($ord_his->order_status == "Delivered"): ?>      
                            
                        <!----  --->
                    <?php else: ?>
                        <a href="<?= base_url('Home/trash_order/'.$ord_his->order_id); ?>" class="btn btn-secondary" style="background: no-repeat;color: grey;border: 1px solid silver;box-shadow: none; float: right; ">Track Order</a>
                    <?php endif; ?>      
                </div>
            </div>
           
            <div class="card">

                <div class="card-body">
                <?php
                    foreach($get_ord_detail as $get_ord_det):
                        $get_dish_details = get_category_details('dish_master', $get_ord_det->dish_detail_id);
                 ?>
                <div class="row">
                    <div class="col-12 col-lg-3 col-md-3 col-sm-12" style="border-bottom: 1px solid silver">
                            <img src="<?= base_url('public/uploads/dish_image/'.$get_dish_details[0]->image_two); ?>" style="width: 200px;height:100px; padding: 5px;" class="responsive-img">
                    </div>
                    <div class="col-12 col-lg-3 col-md-3 col-sm-12" style="border-bottom: 1px solid silver;">
                       <h6> Dish Item : <span style="color: orange"><?= $get_dish_details[0]->dish_title; ?></span></h6>
                        <h6>Quantity: <span style="color: orange"><?= $get_ord_det->qty; ?></span></h6>
                        <h6>Dish Price : <span style="color: orange"><?= number_format($get_ord_det->price); ?></span></h6>
                         <h6>Dish Attribute: <span style="color: red"><?= $get_ord_det->attribute; ?></span></h6>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12" style="border-bottom: 1px solid silver;padding: 20px;">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                 <h6 >Total Product Price : 
                                    <?php 
                                        $total_pro_price = $get_ord_det->price * $get_ord_det->qty; 
                                     ?>
                                     <span class="fa fa-inr" style="color: orange">&nbsp;<?= number_format($total_pro_price); ?></span>
                                </h6>

                                <?php if($ord_his->order_status == 'Pending'): ?>
                                    Order Status :<span class="badge badge-primary">Pending..</span>
                                <?php elseif($ord_his->order_status == 'Cancel'): ?>
                                    Order Status :<span class="badge badge-danger"><?= $ord_his->order_status; ?></span>
                                <?php else: ?>
                                     Order Status :<span class="badge badge-info"><?= $ord_his->order_status; ?></span>
                                <?php endif; ?>
                                <br>
                                <h6>Payment Status : <span class="badge badge-warning">&nbsp;<?= $ord_his->payment_status; ?></span> </h6>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                <?php if($ord_his->order_status == "Delivered"): ?>
                                   <div id="rating_<?= $get_dish_details[0]->id; ?>">
                                        <?= getRating($get_dish_details[0]->id, $ord_his->order_id); ?>
                                   </div>
                                   <?php else: ?>
                                        <a href="<?= base_url('Home/download_invoice/'.$ord_his->order_id); ?>" target="_blank">
                                        <img src="<?= base_url('public/Home/images/pdf.png') ?>" style="width: 50px;">
                                    </a>
                                <?php endif; ?> 
                                
                            </div>
                        </div>
                       
                    </div>
                    </div>

                    <?php endforeach; ?>
                </div>

            </div>

            <div class="card" >
                <div class="card-body" style="padding: 5px;">
                    <h6 style="color: green;margin-top: 5px;">Order On : <b><?= date('D, M. d, Y',strtotime($ord_his->order_date)); ?></h6>
                    <h6>
                <!-----Check coupn is Applied or Not ----->
                    <?php if($ord_his->coupon_id !== "0"): ?>
                        <b><span style="float: right;" >Order Total : <b><span class="fa fa-inr" style="text-decoration: line-through; color: red">&nbsp; <?= number_format($ord_his->total_amount); ?></span></b></span> <br>
                        <h6 style="color: grey;float: right;">FINAL PRICE : <span class="fa fa-inr" style="color: green;"><?= number_format($ord_his->final_price); ?></span></h6>
                         <h6 >Applied Coupon : <span style="color: red">&nbsp;<?= $ord_his->coupon_code; ?></span></h6>
                     <?php else: ?>
                        <b><span style="float: right;" >Order Total : <b><span class="product-price-old">&nbsp; <?= number_format($ord_his->total_amount); ?></span></b></span>
                    <?php endif; ?>
                   
                </div>
            </div>
                 
                <?php endforeach; else: ?>
                    <h6 style="color: red;">Order Not Found</h6>
            <?php endif; ?>
                
          </div>
        </div>
        
            </div>
     
    </div>
</div>
</div>
</div>
<!-----Body Sction Start ------>




<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>

<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>

</body>
</html>