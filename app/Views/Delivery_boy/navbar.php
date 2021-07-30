 <?php $session = session(); ?>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
          <li class="nav-item nav-toggler-item">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
          
        </ul>
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

          <a class="navbar-brand brand-logo" href="<?= base_url('Delivery_boy/dashboard'); ?>"><img src="<?= base_url('public/uploads/delivery_boy/'.$session->get('deliboyimage')) ?>" alt="logo"/></a>

          <a class="navbar-brand brand-logo-mini" href="<?= base_url('Delivery_boy/dashboard'); ?>"><img src="<?= base_url('public/uploads/delivery_boy/'.$session->get('deliboyimage')) ?>" alt="logo"/></a>

        </div>
        <?php 
        $deli_id = session()->get('delivery_boy_id');
        $wallate = get_deliboy_wallate_amount($deli_id);
          if($wallate !== "0"):
        ?>
      <a href="<?= base_url('Delivery_boy/view_wallate_details'); ?>">
      <h6 style="margin-top: 20px;">
        <span class="fa fa-shopping-cart"></span>Wallet Amount <span class="fa fa-inr">&nbsp;(<?= $wallate; ?>)
        </span>
      </h6>
      </a>  
    <?php else: ?>
      <h6 style="margin-top: 20px;">
      <span class="fa fa-shopping-cart"></span>Wallet Amount <span class="fa fa-inr">&nbsp;(0)</span>
    </h6> 
    <?php endif; ?>       
         <?php 
              $session = session();
                $args = [
                    'order_date'   => date('Y-m-d'),
                    'pinCode'      => $session->get('deliboypincode'),
                    'order_status' => 'Accept'
                ];
                $today_order =  get_today_orders($args); 
               if($today_order):
          ?>
         <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name"></span>
              <span class="fa fa-shopping-cart"><?= count($today_order); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item">
                <table class="table">
                    <tr>
                      <th>Order Id</th>
                      <th>total qty</th>
                      <th>total amount</th>
                      <th>Order Status</th>
                      <th>Accept</th>
                  </tr>
                   <?php foreach($today_order as $t_ord): ?>
                        <tr>
                            <td style="color: orange"><?= $t_ord->order_id; ?></td>
                           
                            <td style="color: grey"><?= $t_ord->total_quantity; ?></td>

                            <!-----Check coupn is Applied or Not ----->
                            <?php if($t_ord->coupon_id !== "0"): ?>
                                <td style="color: grey"> <?= number_format($t_ord->final_price); ?> </td>
                             <?php else: ?>
                               <td style="color: grey"><?= number_format($t_ord->total_amount); ?></td>
                            <?php endif; ?>
                          <!-----Check coupn is Applied or Not ----->    
                            <td style="color: grey"  ><span class="badge badge-danger">
                                <?= $t_ord->order_status; ?>
                            </span></td>
                            <td><a href="<?= base_url('Delivery_boy/accept_order/'.$t_ord->order_id); ?>"  class="btn btn-success"><span class="fa fa-eye">
                                Accept
                            </span></a></td>
                        </tr>
                    <?php endforeach; ?> 
                </table>
              </a>
            </div>
          </li>
        </ul>
         <?php else: ?>
              <h6></h6>
          <?php endif; ?>
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name">

                <?=   $session->get('deliboyname'); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item">
                <a href="<?= base_url('Delivery_boy/logout_account'); ?>">
                  <span class="fa fa-key">Logout</span></a>
              
              </a>
            </div>
          </li>
          
          <li class="nav-item nav-toggler-item-right d-lg-none">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
     </ul>
      </div>
    </nav>


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