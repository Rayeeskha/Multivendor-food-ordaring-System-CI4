<!DOCTYPE html>
<html>
<head>
	<title>Filter Restaurent</title>
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
                            <div class="product-grid product-view pb-20" >
                                <div class="row">
                                <?php if($filter_res):
                                    count($filter_res); 
                                    foreach($filter_res as $dish): ?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper" style="border: 1px solid silver">
                                            <div class="product-img">
                                            	<?php if($dish->image != ""): ?>
                                            		<a href="<?= base_url('Home/shop/'.$dish->restaurent_uid); ?>">
	                                                <img src="<?= base_url('public/uploads/resturent/'.$dish->image); ?>" alt="" style="width: 100%; height: 100%">
	                                                </a>
                                            	<?php else: ?>
                                            			<a href="<?= base_url('Home/shop/'.$dish->restaurent_uid); ?>">
                                            		<img src="<?= base_url('public/images/res.jpg'); ?>">
                                            	</a>
                                            	<?php endif; ?>
                                               
                                            </div>
                                            <div class="product-content">
                                                <h4>
                                                    <a href="<?= base_url('Home/product_details/'.$dish->id); ?>" style="margin-left: 10px"><?= $dish->name; ?> </a>
                                                </h4>
                                                <div class="product-price-wrapper" style="padding: 5%">
                                                    <span><span class="fa fa-map" style="color: red">&nbsp;<?= $dish->state; ?></span></span><br>
                                                   <span><?= $dish->city; ?></span>
                                                   <span>(<?= $dish->exact_location; ?>)</span>
                                                </div>
                                            </div>
                                            <div class="product-list-details">
                                                <h4>
                                                    <a href="product-details.html">PRODUCTS NAME HERE </a>
                                                </h4>
                                                <div class="product-price-wrapper">
                                                    <span>$100.00</span>
                                                    <span class="product-price-old">$120.00 </span>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipic it, sed do eiusmod tempor labor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                                <div class="shop-list-cart-wishlist">
                                                    <a href="#" title="Wishlist"><i class="ion-ios-heart-outline"></i></a>
                                                    <a href="#" title="Add To Cart"><i class="ion-android-cart"></i></a>
                                                    <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                        <i class="ion-android-open"></i>
                                                    </a>
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
                                <?php if($filter_res):
                                    count($filter_res);
                                    foreach($filter_res as $cate): ?>
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