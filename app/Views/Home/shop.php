<!DOCTYPE html>
<html>
<head>
	<title>Shop Now</title>
	<!--------Css File Include ------>
<?= view('Home/css_file'); ?>
<!--------Css File Include ------>
<style type="text/css">
    .rating{color: green;font-weight: 500;font-size: 12px;}
    .search_box{width: 200px; height: 35px; float: left;}
    .search_box_btn{height: 35px;background-color:rgb(60, 179, 113);}

</style>
</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->

<!-------Custom Style Section Include ---->
<?= view('Home/custom_style'); ?>
<!-------Custom Style Section Include ---->

<!-----Body Sction Start ----->
<div class="breadcrumb-area gray-bg">
<div class="container">
    <div class="breadcrumb-content">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li class="active">Product List</li>
        </ul>
    </div>
</div>
</div>

<?php $get_web_status =  get_website_settings();
    if($get_web_status[0]->website_close !="Open"):           
?>
<div class="breadcrumb-content" style="background: red;padding: 15px">
    <center>
       <h6 style="color: white;font-weight: 500"> <?= $get_web_status[0]->website_close_msg; ?></h6>
    </center>
</div>
<?php endif; ?>


<div class="shop-page-area pt-100 pb-100">
<div class="container">
    <div class="row flex-reverse">
         <div class="col-lg-3">
            <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
              <div class="shop-widget mt-40 shop-sidebar-border pt-35">
                    <h4 class="shop-sidebar-title">Filter By Categories</h4>
                    <li><a href="<?= base_url('Home/shop/'.$dishes[0]->restaurent_id); ?>" style="color: red"><u>clear</u></a></li>
                    <div class="sidebar-list-style mt-20">
                    <?php if($categories):
                        count($categories); ?>
                        
                       <?php foreach($categories as $cate): ?>
                        <ul>
                            <li>
                              <img src="<?= base_url('public/images/check.png'); ?>" style="width: 20px;"><a href="<?= base_url('Home/filter_shop/'.$cate->id); ?>">
                                <?= $cate->category; ?> </a>
                            </li>
                        </ul>
                    <?php endforeach; else: ?>
                    <?php endif; ?>
                        
                    </div>
                </div>
             </div>
        </div>
        <div class="col-lg-9">
            <div class="shop-topbar-wrapper">
                <div class="product-sorting-wrapper">
                   
                    
                   <div class="product-show shorting-style">
                        <a href="<?= base_url("Home/filter_veg_non_veg/Veg"); ?>">Veg <input type="radio" name="type" value="Veg" class="dish_radio" />
                        </a>
                        <a href="<?= base_url("Home/filter_veg_non_veg/Non-Veg"); ?>">Non-Veg <input type="radio" name="type" onclick="setFoodType('Non-Veg')" value="Non-Veg" class="dish_radio" ></a>
                    </div>
                    
                </div>
            </div>
         
            <div class="grid-list-product-wrapper">
                <div class="product-grid product-view pb-20">
                    <div class="row">
                    <?php if($dishes):
                        count($dishes); 
                        foreach($dishes as $dish): ?>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30" >
                            <div class="product-wrapper" style="border: 1px solid silver;">
                                <div class="product-img">
                                   <img src="<?= base_url('public/uploads/dish_image/'.$dish->image_two); ?>" alt="" style="width: 100%; height: 180px">
                                </div>
                                <div class="product-content">
                                    <h4>
                                        <?php if($dish->dish_type == 'Non-Veg'): ?>
                                            <a href="<?= base_url('Home/product_details/'.$dish->id); ?>">
                                                <img src="<?= base_url('public/Home/images/bg/non-veg.png'); ?>">
                                                <?= $dish->dish_title; ?> 
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('Home/product_details/'.$dish->id); ?>">
                                                <img src="<?= base_url('public/Home/images/bg/veg.png'); ?>">
                                                <?= $dish->dish_title; ?> 
                                            </a>
                                        <?php endif; ?>
                                    </h4>

                                    <?php 
                                        $rated_dish = get_rated_dish_details('dish_rating',$dish->id);
                                        if($rated_dish !== "null"){
                                            $data=  getRatingByDishId($dish->id);
                                           echo $data;
                                        }else{
                                            
                                        }

                                    // $data = 
                                   
                                     ?>

                                    <div class="product-price-wrapper">
                                        <?php 
                                            $get_dish =  get_dish_details('dish_details', $dish->id);
                                            if($get_dish):
                                            count($get_dish);
                                            foreach($get_dish as $dish_attri):

                                         ?>

                                         <?php 
                                            if($get_web_status[0]->website_close == "Open"):
                                          ?>
                                            <span><input type="radio" class="dish_radio" 
                                                name="radio_attr"  value="<?= $dish_attri->id; ?>">
                                            <?php endif; ?>
                                                <?= $dish_attri->attribute; ?></span>&nbsp;

                                            <span class="fa fa-inr"><?= $dish_attri->price; ?></span>
                                        
                                            <span class="product-price-old"></span>
                                            <?php endforeach; endif; ?>
                                    </div>
                                 </div>

                                  <div style="border: 1px solid silver;padding: 8px;">
                                    <?php
                                        
                                        if($get_web_status[0]->website_close == "Open"):
                                     ?>
                                    <div class="row">
                                        <div class="col-12 col-sm-6  col-md-6 col-lg-6">
                                            <center>
                                                <a href="#!" class="btn btn-flat"  onclick="add_to_cart(<?= $dish->id; ?>);">
                                                   <span class="fa fa-shopping-cart"></span>
                                                </a>
                                            </center>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <center>
                                                <a href="#!" class="btn btn-flat">
                                              <span class="fa fa-eye"></span>
                                          </a>
                                            </center>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                        <h6 style="color: red;font-weight: 500;font-size: 12px">
                                            <?= $get_web_status[0]->website_close_msg; ?>
                                        </h6>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

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

<!-----Toast Messages ----->



<!-----Preloder Modal Section Start ---->
<!-- Button trigger modal -->




<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>

<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>


</body>
</html>