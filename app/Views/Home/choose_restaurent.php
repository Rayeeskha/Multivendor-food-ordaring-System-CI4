<!DOCTYPE html>
<html>
<head>
	<title>Choose Restaurent</title>
	<!--------Css File Include ------>
<?= view('Home/css_file'); ?>
<!--------Css File Include ------>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->		
<!-----Body Sction Start ----->
<div class="breadcrumb-area gray-bg">
<div class="container">
    <div class="breadcrumb-content">
        <ul>
            <li><a href="#!">Choose Restaurent</a></li>
        </ul>
    </div>
</div>
</div>
<div class="shop-page-area pt-100 pb-100">
<div class="container">
    <div class="row flex-row-reverse">
        <div class="col-lg-9">
         <div class="grid-list-product-wrapper">
                <div class="product-grid product-view pb-20">
                    <div class="row">
                    <?php if($restaurent):
                        count($restaurent); 
                        foreach($restaurent as $dish): ?>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                            <div class="product-wrapper" style="border: 1px solid silver">
                                <div class="product-img">
                                	<?php if($dish->image != ""): ?>
                                		<a href="<?= base_url('Home/shop/'.$dish->restaurent_uid); ?>">
                                        <img src="<?= base_url('public/uploads/restaurent/uploads/restaurent_img/'.$dish->image); ?>" alt="restaurent_image" style="width: 100%; height: 100%">
                                        </a>
                                	<?php else: ?>
                                			<a href="<?= base_url('Home/shop/'.$dish->restaurent_uid); ?>">
                                		<img src="<?= base_url('public/images/res.jpg'); ?>"  style="width: 100%; height: 180px" class="responsive-img">
                                	</a>
                                	<?php endif; ?>
                                   
                                </div>
                                <div class="product-content" style="margin-left: 10px">
                                    <h4>
                                        <a href="<?= base_url('Home/product_details/'.$dish->id); ?>"><?= $dish->name; ?> </a>
                                    </h4>
                                    <div class="product-price-wrapper">
                                        <?php $res_status = get_restaurent_opn_status('restaurent_opening_status', $dish->restaurent_uid);
                                         ?>
                                         <?php if($res_status[0]->opening_status == "Open"): ?>
                                        <h6 style="font-weight: 500;font-size: 14px;">Restaurent Status : <span style="color: green;">&nbsp;<?= $res_status[0]->opening_status; ?> </span> </h6>

                                        <?php else: ?>
                                             <h6 style="font-weight: 500;font-size: 14px;">Currently : <span style="color: red;">&nbsp;<?= $res_status[0]->opening_status; ?> </span> </h6>
                                        <?php endif; ?>

                                        <span><span class="fa fa-map" style="color: red">&nbsp;<?= $dish->state; ?></span></span><br>
                                       <span><?= $dish->city; ?></span>
                                       <span>(<?= $dish->exact_location; ?>)</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    <?php endforeach; else: ?>
                    	<h6 style="color: red;">Product Not Found</h6>
                    <?php endif; ?>
              </div>
          </div>
      </div>
  </div>
        <div class="col-lg-3">
            <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
              <div class="shop-widget mt-40 shop-sidebar-border pt-35">
                    <h4 class="shop-sidebar-title">Filter By City</h4>
                    <div class="sidebar-list-style mt-20">
                    <?php if($restaurent):
                        count($restaurent);
                        foreach($restaurent as $cate): ?>
                            <ul>
                                <li><input type="checkbox"><a href="<?= base_url('Home/filter_restaurent/'.$cate->city); ?>"><?= $cate->city; ?> </a></li>
                            </ul>
                    <?php endforeach; else: ?>
                    <?php endif; ?>
                        
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>
</div>
<!-----Body Sction End ----->


<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>

<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>

</body>
</html>