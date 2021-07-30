<style type="text/css">
    #search_form{display: flex;}
    #search_form li:first-child{width: 550px;}
    #show_product_list{background: white;margin-top: 0px; position: absolute; z-index: 99;width: 470px;display: none; border: 1px solid silver}
    #show_product_list a{display: block;font-size: 14px;color: grey;font-weight: bold;padding-left: 15px;line-height: 35px; }
    #show_product_list a:hover{background: rgba(0,0,0,0.05);}
    .btn-flat:hover{background: #ff3d00;color: white}
     #quantity{width: 50px !important;height: 30px;} 
     #inc_dnc_btn{cursor: pointer;}
     #inc_dnc_btn :hover{background: pink;border-radius: 100%}
     #wallet_box_header{font-weight: 500;font-size: 15px;}
     
</style>
<!-- header start -->
<header class="header-area">
<div class="header-top black-bg">
    <div class="container">
        <div class="row">
            <?php if(session()->has("loggedin_user") || session()->has('google_user')): ?>
            <?php //get wallet Income throw login user
                if(session()->has('google_user')){
                    $uinfo = session()->get('google_user_info');
                    $user_id = $uinfo['google_uid'];
                }else{
                   $user_id = session()->get('user_id');
                } 
            ?>

            <div class="col-lg-7 col-md-7 col-12 col-sm-7">
                <div class="welcome-area">
                    <p id="wallet_box_header">
                        <a href="<?= base_url('Home/view_wallate_details'); ?>" style="color: white;">
                      <span class="fa fa-shopping-cart"></span>&nbsp;&nbsp;
                      Wallet Amount ( <span class="fa fa-inr"></span> 
                       <?php   $wallet =  get_wallate_amount($user_id); 
                            if ($wallet !== ""): 
                       ?>
                            <?= number_format($wallet); ?></a>
                        <?php else: echo "0"; ?>
                       <?php endif; ?>)
                    </p>    
                </div>
            </div>
            <?php else: ?>
                <div class="col-lg-7 col-md-7 col-12 col-sm-7">
                    <div class="welcome-area">
                        <p>Online Food Ordaring</p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-5 col-md-5 col-12 col-sm-5">
                <div class="account-curr-lang-wrap f-right">
                    <?php if(session()->has("loggedin_user") || session()->has('google_user')): ?>
                    <ul>
                         
                       <li class="top-hover"><a href="#">Setting  <i class="ion-chevron-down"></i></a>
                            <ul>
                                <li><a href="<?= base_url('Home/view_profile'); ?>">Profile  </a></li>
                                <li><a href="<?= base_url('Home/order_history'); ?>">Order History</a></li>
                                <li><a href="<?= base_url('Home/technical_support'); ?>">Chat now</a></li>
                                <li><a href="<?= base_url("Home/logout_users_account"); ?>">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php else: ?>
                         <ul>
                           <li class="top-hover"><a href="#">Setting  <i class="ion-chevron-down"></i></a>
                                <ul>
                                   <li><a href="<?= base_url('Home/login_register'); ?>">Login</a></li>
                                    <li><a href="<?= base_url('Home/login_register'); ?>">Register</a></li>
                                    <li><a href="#!">my account</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-middle">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-12 col-sm-3">
                <div class="logo">
                    <a href="<?= base_url('Home/index'); ?>">
                        <img alt="" src="<?= base_url('public/images/ff.png'); ?>" style="width: 150px;">
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 col-sm-5">
               <ul id="search_form" style="list-style-type:none;"> 
                    <li>
                        <input type="text" name="search" onkeyup="search_restaurent(this.value)" id="search" placeholder="Search Restaurent Name" autocomplete="off" class="form-control">
                        <div id="show_product_list">
                            <a href="">Product name</a>
                            <a href="">Product name</a>
                            <a href="">Product name</a>
                            <a href="">Product name</a>
                        </div>
                    </li>
                 </ul>
            </div><br><br><br><br>
            <div class="col-lg-4 col-md-4 col-12 col-sm-4">
                <div class="header-middle-right f-right">
            <?php if(session()->has("loggedin_user") || session()->has('google_user')): ?>
                <?php if(session()->has('google_user')): 
                    $uinfo = session()->get('google_user');
                ?>
                    <img src="<?= $uinfo['profile_pic']; ?>" height="50" width="50" style="border-radius: 50%">Welcome (<?= ucfirst($uinfo['name']); ?>) 
                    
                <?php elseif(session()->has("loggedin_user")):
                     $session = session();

                     if (!session()->has("user_profile_session")):
                 ?>
                 <?php else: ?>
                    <img src="<?= base_url('public/uploads/user_profile/'.session()->get('user_profile_session')) ?>" height="50" width="50" style="border-radius: 50%">
                 <?php endif; ?>

                    <h6>Welcome (<?= ucfirst($session->get('username')); ?>)</h6>
                    

                <?php endif; ?>
            <?php else: ?>
                    <div class="header-login">
                        <a href="<?= base_url('Home/login_register'); ?>">
                            <div class="header-icon-style">
                                <i class="icon-user icons"></i>
                            </div>
                            <div class="login-text-content">
                                <p>Register <br> or <span>Sign in</span></p>
                            </div>
                        </a>
                    </div>

                <?php endif; ?>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="header-cart">
                        <a href="#">
                            <div class="header-icon-style">
                                <i class="icon-handbag icons"></i>
                                <span class="count-style" id="total_products">0</span>
                            </div>
                            <div class="cart-text">
                                <span class="digit">My Cart</span>
                                <span class="cart-digit-bold"><span class="fa fa-inr">&nbsp;
                                    <span  id="total_amount">0</span>
                                </span></span>
                            </div>
                        </a>
                      
                        <?php $final_price = 0; 
                          if($carts_pro): ?>
                            <div class="shopping-cart-content">
                            <?php foreach($carts_pro as $pro_details):
                                $final_price += $pro_details->rate * $pro_details->qty;
                               
                            $get_pro_detal = get_category_details('dish_master', $pro_details->dish_details_id);
                        ?>
                        
                         <ul id="cart_ul">
                            <li class="single-shopping-cart">
                                <div class="shopping-cart-img">
                                    <a href="#"><img alt="" src="<?= base_url('public/uploads/dish_image/'.$get_pro_detal[0]->image); ?>" style="width: 70px;"></a>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="#"><?=  $pro_details->dish_title; ?></a></h4>
                                    <h6><?=  $pro_details->qty; ?> </h6>
                                   
                                    <!---Quantity Form --->
                                    <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="" id="inc_dnc_btn"  onclick="update_quantity('sub', '<?= $pro_details->dish_details_id; ?>', '<?= $pro_details->id; ?>')">
                                          <span class="glyphicon glyphicon-minus">-</span>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity_<?= $pro_details->id; ?>" class="form-control input-number" value="<?= $pro_details->qty; ?>" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="" id="inc_dnc_btn"  onclick="update_quantity('add', '<?= $pro_details->dish_details_id; ?>', '<?= $pro_details->id; ?>')">
                                            <span class="glyphicon glyphicon-plus">+</span>
                                        </button>
                                    </span>
                                </div>
                                    <!---Quantity Form --->
                                   
                                    <span class="fa fa-inr"> 
                                        <?php 
                                            $total_amount = $pro_details->rate * $pro_details->qty;
                                            echo number_format($total_amount);
                                        ?>
                                       </span>
                                </div>
                                <div class="shopping-cart-delete" onclick="return confirm('Are you sure you want to  delete this Dish ?..');">
                                    <a href="#"><i class="ion ion-close"  onclick="delete_dish_in_carts(<?= $pro_details->id; ?>)"></i></a>
                                </div>
                            </li>
                        </ul>
                        <?php endforeach; ?>
                            <div class="shopping-cart-total">
                              <h4>Total : <span class="shop-total fa fa-inr"><?= number_format($final_price); ?></span></h4>
                            </div>
                            <div class="shopping-cart-btn">
                                <a href="#!" onclick="view_carts_products(<?= $pro_details->session_id; ?>)">checkout</a>
                               
                            </div>
                        </div>
                        
                    </div>
                        <?php endif; ?>  
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-bottom transparent-bar black-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="main-menu">
                    <nav>
                        <ul>
                            <li class="top-hover"><a href="<?= base_url('Home/choose_restaurent'); ?>">home </a>
                                
                            </li>
                            <li><a href="<?= base_url('Home/about_us'); ?>">about</a></li>
                            
                            <li><a href="<?= base_url('Home/contact_us'); ?>">contact us</a></li>
                            <li><a href="<?= base_url('Home/get_offer'); ?>">Offer</a></li>
                           
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile-menu-area-start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow" id="nav">
                            <li><a href="<?= base_url('Home/about_us'); ?>">about us </a></li>
                            <li><a href="<?= base_url('Home/choose_restaurent'); ?>"> Shop </a> </li>
                            <li><a href="<?= base_url('Home/login_register'); ?>">login / register</a></li>
                            <li><a href="<?= base_url('Home/contact_us'); ?>">contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile-menu-area-end -->
</header>

    <!---Php Meassge Show --->
    <div style="margin-left: 20px;margin-right: 10px">
      <?php  if(session()->getTempdata('success')): ?>
            <div class="card">
              <div class="card-content" style="margin-left: 20px;margin-right: 20;padding: 10px; background: green;color: white;font-weight: 500">
                <span class="fa fa-check"></span>&nbsp;&nbsp;<?= session()->getTempdata('success'); ?>
              </div>
            </div>
          <?php endif; ?>
          <?php  if(session()->getTempdata('error')): ?>
            <div class="card">
              <div class="card-content" style="margin-left: 10px;margin-right: 10;padding: 10px; background: red;color: white;font-weight: 500">
                <span class="fa fa-times"></span>&nbsp;&nbsp;<?= session()->getTempdata('error'); ?>
              </div>
            </div>
    <?php endif; ?>
    </div>
    <!---Php Meassge Show --->

