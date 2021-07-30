<!DOCTYPE html>
<html>
<head>
	<title>Filter Products</title>
	<!--------Css File Include ------>
<?= view('Home/css_file'); ?>
<!--------Css File Include ------>
<style type="text/css">
    .product-sorting-wrapper{width: 100% ;}
    .product-sorting-wrapper .product-show{float: right;}
    .dish_radio{width: 16px;height: 12px;margin-right: 5px;}
    .btn-flat:hover{background: #ff3d00;color: white}
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
                        <li><a href="#!">Home</a></li>
                        <li class="active">Shop Grid Style </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-reverse">
                    <div class="col-lg-3">
                        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                          <div class="shop-widget mt-40 shop-sidebar-border pt-35">
                    
                                <h4 class="shop-sidebar-title">Filter By Categories</h4>
                                    <?php if($filter_pro): ?>
                                <li><a href="<?= base_url('Home/shop/'.$filter_pro[0]->restaurent_id); ?>" style="color: red"><u>clear</u></a></li>
                            <?php endif; ?>

                                <div class="sidebar-list-style mt-20">
                                <?php if($categories):
                                    count($categories);
                                    foreach($categories as $cate): ?>
                                        <ul>
                                            <li><img src="<?= base_url('public/images/check.png'); ?>" style="width: 20px;"><a href="<?= base_url('Home/filter_shop/'.$cate->id); ?>"><?= $cate->category; ?> </a></li>
                                        </ul>
                                <?php endforeach; else: ?>
                                <?php endif; ?>
                                    
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-9">
                         <div class="shop-topbar-wrapper" style="height: 100px;">
                             <div class="product-sorting-wrapper">
                                 <?= form_open('Home/search_shop_products'); ?>
                                    <div>
                                        <?php if($filter_pro): ?>
                                        <input type="hidden" name="category_id" value="<?= $filter_pro[0]->category_id; ?>">
                                    <?php endif; ?>
                                        <input type="text" name="search_dish_title" value="<?= set_value('search_dish_title'); ?>" class="form-control search_box">
                                        <button type="submit" class="btn btn-primary search_box_btn">Seach</button>
                                    </div>
                                <?= form_close(); ?>
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
                                <?php if($filter_pro):
                                    count($filter_pro); 
                                    foreach($filter_pro as $dish): ?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper" style="border: 1px solid silver">
                                            <div class="product-img">
                                                <a href="<?= base_url('Home/product_details/'.$dish->id); ?>">
                                                <img src="<?= base_url('public/uploads/dish_image/'.$dish->image_two); ?>" alt="" style="width: 100%; height: 200px;">
                                                </a>
                                               
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
                                                <div class="product-price-wrapper">
                                                <?php 
                                                    $get_dish =  get_dish_details('dish_details', $dish->id);
                                                    if($get_dish):
                                                    count($get_dish);
                                                    foreach($get_dish as $dish_attri):

                                                 ?>
                                                    <span><input type="radio" class="dish_radio" 
                                                    name="radio_attr"  value="<?= $dish_attri->id; ?>"><?= $dish_attri->attribute; ?></span>&nbsp;
                                                    <span class="fa fa-inr"><?= $dish_attri->price; ?></span>
                                                
                                                    <span class="product-price-old"></span>
                                                    <?php endforeach; endif; ?>
                                                </div>
                                                  <div style="border: 1px solid silver;padding: 8px;">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                                            <center>
                                                                <a href="#!" class="btn btn-flat" onclick="add_to_cart(<?= $dish->id; ?>);">
                                                                   <span class="fa fa-shopping-cart" ></span>
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
<!---------Customer Js File Include ------>
<?= view('Home/custom_js'); ?>
<!---------Customer Js File Include ------>
</body>
</html>