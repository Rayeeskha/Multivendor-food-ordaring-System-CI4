<!DOCTYPE html>
<html>
<head>
	<title>Pickup Restaurent</title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->

<!------Body Section Start ------->
        <div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li class="active"><?= $restaurent[0]->name; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-details pt-100 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                    	<?php if($restaurent[0]->image != ""): ?>
                        <?php else: ?>
                    		<a href="<?= base_url('Home/shop/'.$restaurent[0]->restaurent_uid); ?>">
                    			 <img class="zoompro" src="<?= base_url('public/images/res.jpg'); ?>" data-zoom-image="<?= base_url('public/Home/assets/img/product-details/product-detalis-s1.jpg') ?>" alt="zoom"/>
                    		</a>
                    	<?php endif;?>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="product-details-content">
                            <a href="<?= base_url('Home/shop/'.$restaurent[0]->restaurent_uid ); ?>">
                               <h4><?= $restaurent[0]->name; ?></h4> 
                            </a>
                            <div class="rating-review">
                                <div class="pro-dec-rating">
                                    <i class="ion-android-star-outline theme-star"></i>
                                    <i class="ion-android-star-outline theme-star"></i>
                                    <i class="ion-android-star-outline theme-star"></i>
                                    <i class="ion-android-star-outline theme-star"></i>
                                    <i class="ion-android-star-outline"></i>
                                </div>
                                <div class="pro-dec-review">
                                    <ul>
                                        <li>32 Reviews </li>
                                        <li> Add Your Reviews</li>
                                    </ul>
                                </div>
                            </div>
                            <span><?= $restaurent[0]->exact_location; ?></span>
                            <?php 
                            	$restaurent_status = get_restaurent_opn_status('restaurent_opening_status', $restaurent[0]->restaurent_uid ); 
                            ?>
                            <?php if($restaurent_status[0]->opening_status == 'Open'): ?>
                            	<div class="in-stock">
	                                <p>Restaurent Status: <span style="color: green"><?= $restaurent_status[0]->opening_status; ?></span></p>
	                            </div>
                            <?php else: ?>
                            	<p style="color: red">Restaurent Currently: <span><?= $restaurent_status[0]->opening_status; ?></span></p>
                            <?php endif; ?>
                            
                            <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. </p>
                           <div class="pro-dec-social">
                                <ul>
                                    <li><a class="tweet" href="#"><i class="ion-social-twitter"></i> Tweet</a></li>
                                    <li><a class="share" href="#"><i class="ion-social-facebook"></i> Share</a></li>
                                    <li><a class="google" href="#"><i class="ion-social-googleplus-outline"></i> Google+</a></li>
                                    <li><a class="pinterest" href="#"><i class="ion-social-pinterest"></i> Pinterest</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="description-review-area pb-100">
            <div class="container">
                <div class="description-review-wrapper">
                    <div class="description-review-topbar nav text-center">
                        <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                        <a data-toggle="tab" href="#des-details2">Tags</a>
                        <a data-toggle="tab" href="#des-details3">Review</a>
                    </div>
                    <div class="tab-content description-review-bottom">
                        <div id="des-details1" class="tab-pane active">
                            <div class="product-description-wrapper">
                                <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam est usus legentis in iis qui facit eorum claritatem. </p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
                                <ul>
                                    <li>-  Typi non habent claritatem insitam</li>
                                    <li>-  Est usus legentis in iis qui facit eorum claritatem. </li>
                                    <li>-  Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</li>
                                    <li>-  Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.</li>
                                </ul>
                            </div>
                        </div>
                        <div id="des-details2" class="tab-pane">
                            <div class="product-anotherinfo-wrapper">
                                <ul>
                                    <li><span>Tags:</span></li>
                                    <li><a href="#"> All,</a></li>
                                    <li><a href="#"> Cheesy,</a></li>
                                    <li><a href="#"> Fast Food,</a></li>
                                    <li><a href="#"> French Fries,</a></li>
                                    <li><a href="#"> Hamburger,</a></li>
                                    <li><a href="#"> Pizza</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="des-details3" class="tab-pane">
                            <div class="rattings-wrapper">
                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                                            <i class="ion-star theme-color"></i>
                                            <i class="ion-star theme-color"></i>
                                            <i class="ion-star theme-color"></i>
                                            <i class="ion-star theme-color"></i>
                                            <i class="ion-star theme-color"></i>
                                            <span>(5)</span>
                                        </div>
                                        <div class="ratting-author f-right">
                                            <h3>tayeb rayed</h3>
                                            <span>12:24</span>
                                            <span>9 March 2018</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost rud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost.</p>
                                </div>
                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                                            <i class="ion-star theme-color"></i>
                                            <i class="ion-star theme-color"></i>
                                            <i class="ion-star theme-color"></i>
                                            <i class="ion-star theme-color"></i>
                                            <i class="ion-star theme-color"></i>
                                            <span>(5)</span>
                                        </div>
                                        <div class="ratting-author f-right">
                                            <h3>farhana shuvo</h3>
                                            <span>12:24</span>
                                            <span>9 March 2018</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost rud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost.</p>
                                </div>
                            </div>
                            <div class="ratting-form-wrapper">
                                <h3>Add your Comments :</h3>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="star-box">
                                            <h2>Rating:</h2>
                                            <div class="ratting-star">
                                                <i class="ion-star theme-color"></i>
                                                <i class="ion-star theme-color"></i>
                                                <i class="ion-star theme-color"></i>
                                                <i class="ion-star theme-color"></i>
                                                <i class="ion-star"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-20">
                                                    <input placeholder="Name" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-20">
                                                    <input placeholder="Email" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="message" placeholder="Message"></textarea>
                                                    <input type="submit" value="add review">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-area pb-95">
            <div class="container">
                <div class="product-top-bar section-border mb-25">
                    <div class="section-title-wrap">
                        <h3 class="section-title section-bg-white">Related Restaurent</h3>
                    </div>
                </div>
                <div class="related-product-active owl-carousel product-nav">
                    <?php if($filter_rest):
                    count($filter_rest); 
                    foreach($filter_rest as $rest): ?>
                        <div class="product-wrapper">
                        <div class="product-img">
                            <?php if($rest->image !== ""): ?>
                                <a href="<?= base_url('Home/shop/'.$rest->restaurent_uid ); ?>">
                                    <img src="<?= base_url('public/uploads/restaurent/uploads/restaurent_img/'.$rest->image); ?>" alt="">
                                </a>
                            <?php else: ?>
                                <a href="">
                                    <img src="<?= base_url('public/images/res.jpg'); ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="product-content">
                            <h4>
                                <a href="<?= base_url('Home/shop/'.$rest->restaurent_uid ); ?>"><?= $rest->name; ?></a>
                            </h4>
                           <span style="color: red" class="fa fa-map"><?= $rest->state; ?></span><br>
                           <span><?= $rest->city; ?></span>
                           <span>(<?= $rest->exact_location; ?>)</span>
                        </div>
                    </div>
                    <?php endforeach; else: ?>
                        <h6 style="color: red;">Restaurent Not Found</h6>
                <?php endif; ?>  
                    </div>
                </div>
            </div>
        </div>


<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
</body>
</html>