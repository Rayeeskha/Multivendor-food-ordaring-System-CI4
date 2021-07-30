<!DOCTYPE html>
<html>
<head>
	<title>Food Ordaring</title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
</head>
<body>
<!-------Body Section Start ------->




<div class="slider-area">
            <div class="slider-active owl-dot-style owl-carousel">
            <?php if($banner):
                count($banner);
                foreach($banner as $ban_img): ?>
                    <div class="single-slider pt-210 pb-220 bg-img" style="background-image:url(<?= base_url("public/uploads/sliders/".$ban_img->image); ?>);">
                    <img src="">
                    <div class="container">
                        <div class="slider-content slider-animated-1">
                            <h1 class="animated"><?= $ban_img->heading; ?></h1>
                            <h3 class="animated"><?= $ban_img->subtitle; ?></h3>
                            <div class="slider-btn mt-90">
                                <a class="animated" href="<?= base_url('Home/choose_restaurent'); ?>">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; else: ?>
                <div class="single-slider pt-210 pb-220 bg-img" style="background-image:url(<?= base_url('public/Home/assets/img/slider/slider-2.jpg') ?>);">
                    <div class="container">
                        <div class="slider-content slider-animated-1">
                            <h1 class="animated">Drink & Heathy Food</h1>
                            <h3 class="animated">Fresh Heathy and Organic.</h3>
                            <div class="slider-btn mt-90">
                                <a class="animated" href="<?= base_url('Home/choose_restaurent'); ?>">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
               
            </div>
        </div>	

<br><br><br>
<!--------Banner Sction Include ------>
<div class="banner-area row-col-decrease pb-75 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="single-banner mb-30">
                            <div class="hover-style">
                                <a href="#"><img src="<?= base_url('public/Home/assets/img/banner/banner-7.jpg'); ?>" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="single-banner mb-30">
                            <div class="hover-style">
                                <a href="#"><img src="<?= base_url('public/Home/assets/img/banner/banner-8.jpg'); ?>" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 


<!-------Banner Logo Section ------>
        <div class="banner-area">
            <div class="container">
               <?php if($banner): ?>
                    <div class="discount-overlay bg-img pt-130 pb-130" style="background-image:url(<?= base_url("public/uploads/sliders/".$ban_img->image_two); ?>););">
                        <div class="discount-content text-center">
                            <h3>It’s Time To Start <br>Your Own Revolution By Laurent</h3>
                            <p><?= $ban_img->subtitle; ?></p>
                            <div class="banner-btn">
                                <a href="<?= base_url('Home/choose_restaurent'); ?>">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="discount-overlay bg-img pt-130 pb-130" style="background-image:url(<?= base_url('public/Home/assets/img/banner/banner-4.jpg'); ?>);">
                    <div class="discount-content text-center">
                        <h3>It’s Time To Start <br>Your Own Revolution By Laurent</h3>
                        <p>Exclusive Offer -10% Off This Week</p>
                        <div class="banner-btn">
                            <a href="<?= base_url('Home/choose_restaurent'); ?>">Order Now</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
               
            </div>
        </div>
        <div class="brand-logo-area pt-100 pb-100">
            <div class="container">
                <div class="brand-logo-active owl-carousel">
                    <div class="single-brand-logo">
                        <img alt="" src="<?= base_url('public/Home/assets/img/brand-logo/logo-1.png'); ?>">
                    </div>
                    <div class="single-brand-logo">
                        <img alt="" src="<?= base_url('public/Home/assets/img/brand-logo/logo-2.png'); ?>">
                    </div>
                    <div class="single-brand-logo">
                        <img alt="" src="<?= base_url('public/Home/assets/img/brand-logo/logo-3.png'); ?>">
                    </div>
                    <div class="single-brand-logo">
                        <img alt="" src="<?= base_url('public/Home/assets/img/brand-logo/logo-4.png'); ?>">
                    </div>
                    <div class="single-brand-logo">
                        <img alt="" src="<?= base_url('public/Home/assets/img/brand-logo/logo-5.png'); ?>">
                    </div>
                    <div class="single-brand-logo">
                        <img alt="" src="<?= basE_url('public/Home/assets/img/brand-logo/logo-2.png') ?>">
                    </div>
                </div>
            </div>
        </div>
<!-------Banner Logo Section ------>

<!--------Banner Sction Include ------>        
<!-------Body Section Start ------->	

<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>


<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>


</body>
</html>