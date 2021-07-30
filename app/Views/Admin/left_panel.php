    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="<?= base_url('Super_admin/index'); ?>"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="active">
                        <a href="<?= base_url('Super_admin/index'); ?>"><i class="menu-icon fa fa-laptop"></i>Dashboard website </a>
                    </li>

                    <li class="menu-title">Main Content</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Category Master</a>
                        <ul class="sub-menu children dropdown-menu"> 
                            <li><i class="fa fa-id-badge"></i><a href="<?= base_url('Super_admin/manage_category'); ?>">Manage Category</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Order Master</a>
                        <ul class="sub-menu children dropdown-menu">
                           <li><i class="fa fa-users"></i><a href="<?= base_url('Super_admin/order_master'); ?>">Order Master</a></li>
                           
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>User Master</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="<?= base_url('Super_admin/manage_users'); ?>">Manage Users</a></li>
                            
                        </ul>
                    </li>
                     <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Delivery Boy Master</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="<?= base_url('Super_admin/manage_delivery_boy'); ?>">Manage Delivery Boy</a></li>
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="<?= base_url('Super_admin/delivery_boy_pay_out'); ?>">Delivery Boy Payout</a></li>
                        </ul>
                    </li>
                   <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Coupon Master</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="<?= base_url('Super_admin/coupon_master') ?>">Manage Coupons</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Dish Master</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-map-o"></i><a href="<?= base_url("Super_admin/dish_master"); ?>">Dish Master</a></li>
                          
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Restaurent Master</a>
                        <ul class="sub-menu children dropdown-menu">
                           <li><i class="fa fa-users"></i><a href="<?= base_url('Super_admin/manage_restaurent'); ?>">Manage Restaurent</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">Frontend Settings</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Settings</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="<?= base_url('Super_admin/manage_slider'); ?>">Manage Slider</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="<?= base_url('Super_admin/website_settings'); ?>">Website Settings</a></li>
                            
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->