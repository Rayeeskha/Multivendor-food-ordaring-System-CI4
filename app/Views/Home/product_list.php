<!DOCTYPE html>
<html>
<head>
	<title>Order Now</title>
		<!--------Css File Include ------>
<?= view('Home/css_file'); ?>
<!--------Css File Include ------>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->	

<!-----Body Section Start ------>
     <div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Product List </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="banner-area pb-30">
                            <a href="product-details.html"><img alt="" src="<?= base_url('public/Home/assets/img/banner/banner-49.jpg'); ?>"></a>
                        </div>
                        <div class="shop-topbar-wrapper">
                            <div class="shop-topbar-left">
                                <ul class="view-mode">
                                    <li><a href="#product-grid" data-view="product-grid"><i class="fa fa-th"></i></a></li>
                                    <li class="active"><a href="#product-list" data-view="product-list"><i class="fa fa-list-ul"></i></a></li>
                                </ul>
                                <p>Showing 1 - 20 of 30 results  </p>
                            </div>
                           
                        </div>
                        <div class="grid-list-product-wrapper">
                            <div class="product-list product-view pb-20">
                                <div class="row">
                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="<?= base_url('Home/product_details/1'); ?>">
                                                    <img src="<?= base_url('public/Home/assets/img/product/product-1.jpg'); ?>" alt="">
                                                </a>
                                                <div class="product-action">
                                                    <div class="pro-action-left">
                                                        <a title="Add Tto Cart" href="#"><i class="ion-android-cart"></i> Add Tto Cart</a>
                                                    </div>
                                                    <div class="pro-action-right">
                                                        <a title="Wishlist" href="wishlist.html"><i class="ion-ios-heart-outline"></i></a>
                                                        <a title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#"><i class="ion-android-open"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4>
                                                    <a href="product-details.html">PRODUCTS NAME HERE </a>
                                                </h4>
                                                <div class="product-price-wrapper">
                                                    <span>$100.00</span>
                                                    <span class="product-price-old">$120.00 </span>
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
                              
                                </div>
                            </div>
                            <div class="pagination-total-pages">
                                <div class="pagination-style">
                                    <ul>
                                        <li><a class="prev-next prev" href="#"><i class="ion-ios-arrow-left"></i> Prev</a></li>
                                        <li><a class="active" href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">10</a></li>
                                        <li><a class="prev-next next" href="#">Next<i class="ion-ios-arrow-right"></i> </a></li>
                                    </ul>
                                </div>
                                <div class="total-pages">
                                    <p>Showing 1 - 20 of 30 results  </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title">Shop By Categories</h4>
                                <div class="shop-catigory">
                                    <ul id="faq">
                                        <li> <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-1">Fast Foods <i class="ion-ios-arrow-down"></i></a>
                                            <ul id="shop-catigory-1" class="panel-collapse collapse show">
                                                <li><a href="#">Pizza </a></li>
                                                <li><a href="#">Hamburgers</a></li>
                                                <li><a href="#">Sandwiches</a></li>
                                                <li><a href="#">French fries</a></li>
                                                <li><a href="#">Fried chicken</a></li>
                                            </ul>
                                        </li>
                                        <li> <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-2">Rich Foods <i class="ion-ios-arrow-down"></i></a>
                                            <ul id="shop-catigory-2" class="panel-collapse collapse">
                                                <li><a href="#">Eggs</a></li>
                                                <li><a href="#">Milk</a></li>
                                                <li><a href="#">Almonds</a></li>
                                                <li><a href="#">Cottage Cheese</a></li>
                                                <li><a href="#">Lean Beef</a></li>
                                            </ul>
                                        </li>
                                        <li> <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-3">soft drinks <i class="ion-ios-arrow-down"></i></a>
                                            <ul id="shop-catigory-3" class="panel-collapse collapse">
                                                <li><a href="#"> Pepsi Cola</a></li>
                                                <li><a href="#"> Fruit juices</a></li>
                                                <li><a href="#">Diet Pepsi</a></li>
                                                <li><a href="#">Bitter lemon</a></li>
                                                <li><a href="#">Barley water</a></li>
                                            </ul>
                                        </li>
                                        <li> <a href="#">Vegetables</a> </li>
                                        <li> <a href="#">Fruits</a></li>
                                        <li> <a href="#">Red Meat</a></li>
                                    </ul>
                                </div>
                            </div>
                          
                            <div class="shop-widget mt-40 shop-sidebar-border pt-35">
                                <h4 class="shop-sidebar-title">Popular Tags</h4>
                                <div class="shop-tags mt-25">
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Cheesy</a></li>
                                        <li><a href="#">Fast Food</a></li>
                                        <li><a href="#">French Fries</a></li>
                                        <li><a href="#">Hamburger </a></li>
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">Red Meat</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-----Body Section End ------>

<!------------Product Modal Section Here ------->
 <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <!-- Thumbnail Large Image start -->
                                <div class="tab-content">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="<?= base_url('public/Home/assets/img/product-details/product-detalis-l1.jpg'); ?>" alt="">
                                    </div>
                                    <div id="pro-2" class="tab-pane fade">
                                        <img src="<?= base_url('public/Home/assets/img/product-details/product-detalis-l2.jpg'); ?>" alt="">
                                    </div>
                                    <div id="pro-3" class="tab-pane fade">
                                        <img src="<?= base_url('public/Home/assets/img/product-details/product-detalis-l3.jpg'); ?>" alt="">
                                    </div>
                                    <div id="pro-4" class="tab-pane fade">
                                        <img src="<?= base_url('public/Home/assets/img/product-details/product-detalis-l4.jpg'); ?>" alt="">
                                    </div>
                                </div>
                                <!-- Thumbnail Large Image End -->
                                <!-- Thumbnail Image End -->
                                <div class="product-thumbnail">
                                    <div class="thumb-menu owl-carousel nav nav-style" role="tablist">
                                        <a class="active" data-toggle="tab" href="#pro-1"><img src="<?= base_url('public/Home/assets/img/product-details/product-detalis-s1.jpg'); ?>" alt=""></a>
                                        <a data-toggle="tab" href="#pro-2"><img src="<?= base_url("public/Home/assets/img/product-details/product-detalis-s2.jpg"); ?>" alt=""></a>
                                        <a data-toggle="tab" href="#pro-3"><img src="<?= base_url('public/Home/assets/img/product-details/product-detalis-s3.jpg'); ?>" alt=""></a>
                                        <a data-toggle="tab" href="#pro-4"><img src="<?= base_url('public/Home/assets/img/product-details/product-detalis-s4.jpg'); ?>" alt=""></a>
                                    </div>
                                </div>
                                <!-- Thumbnail image end -->
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <div class="modal-pro-content">
                                    <h3>PRODUCTS NAME HERE </h3>
                                    <div class="product-price-wrapper">
                                        <span>$120.00</span>
                                        <span class="product-price-old">$162.00 </span>
                                    </div>
                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet.</p>    
                                    <div class="quick-view-select">
                                        <div class="select-option-part">
                                            <label>Size*</label>
                                            <select class="select">
                                                <option value="">S</option>
                                                <option value="">M</option>
                                                <option value="">L</option>
                                            </select>
                                        </div>
                                        <div class="quickview-color-wrap">
                                            <label>Color*</label>
                                            <div class="quickview-color">
                                                <ul>
                                                    <li class="blue">b</li>
                                                    <li class="red">r</li>
                                                    <li class="pink">p</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                        </div>
                                        <button>Add to cart</button>
                                    </div>
                                    <span><i class="fa fa-check"></i> In stock</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->

<!------------Product Modal Section Here ------->

<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
</body>
</html>