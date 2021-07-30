   <style type="text/css">
       #order_notification {width: 600px;}
   </style>   
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel" id="edit_category_modal_content">
    	<!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url('Super_admin/index'); ?>"><img src="<?= base_url('public/images/ff.png'); ?>" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="#!"><img src="<?= base_url('public/images/slo.png') ?>" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                             <?php 
                      
                                $args = [
                                    'order_date'   => date('Y-m-d'),
                                    'order_status' => 'Pending'
                                ];
                                $today_order =  get_today_orders($args); 
                               if($today_order):
                            ?>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger"><?=  count($today_order); ?></span>
                            </button>

                           <div class="dropdown-menu" aria-labelledby="notification" id="order_notification">
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
                                            <td style="color: grey"><?= $t_ord->total_amount; ?></td>
                                            <td style="color: grey"  ><span class="badge badge-danger">
                                                <?= $t_ord->order_status; ?>
                                            </span></td>
                                            <td><a href="<?= base_url('Super_admin/accept_order/'.$t_ord->order_id.'/Accept'); ?>"  class="btn btn-success"><span class="fa fa-eye">
                                                Accept
                                            </span></a></td>
                                        </tr>
                                    <?php endforeach; ?> 
                                </table>
                              
                            </div>
                       
                            <?php else: ?>
                                <h6>0</h6>
                            <?php endif; ?>
                        </div>
                      
                        <div class="dropdown for-message">
                            <?php 
                                $supper_msg = get_user_support_message('contact_us');
                                if($supper_msg[0]->user_id !== "0"):
                            ?>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary"><?= count($supper_msg); ?></span>
                            </button>
                            <!-----End drop --->
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have <?= count($supper_msg); ?> Mails</p>
                                <a class="dropdown-item media" href="#">
                                   <table class="table">
                                      <tr>
                                           <th>Name</th>
                                           <th>Email</th>
                                           <th>Mobile</th>
                                           <th>Subject</th>
                                           <th>Message</th>
                                           <th>Date</th>
                                           <th>Replay</th>
                                      </tr>
                                      <?php foreach($supper_msg as $msg):
                                        if($msg->user_id !== "0"):
                                       ?>
                                        <tr>
                                            <td>
                                                <?= $msg->name; ?>
                                            </td>
                                            <td>
                                                <a href="mailto:<?= $msg->email; ?>"><?= $msg->email; ?></a>
                                            </td>
                                            <td>
                                                <a href="tel:<?= $msg->mobile; ?>"><?= $msg->mobile; ?></a>
                                            </td>
                                            <td>
                                                <?= word_limiter($msg->subject, 2); ?>
                                            </td>
                                             <td>
                                                <?= word_limiter($msg->message, 3); ?>
                                            </td>
                                            <td>
                                                <?= date('d M Y', strtotime($msg->added_on)); ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('Super_admin/replay_message/'.$msg->user_id); ?>" class="btn btn-primary">Replay</a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                      <?php endforeach; ?>
                                   </table>
                                </a>
                            </div>
                            <?php else: ?>
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                    <span class="count bg-primary"></span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?= base_url('public/images/admin.jpg'); ?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="<?= base_url('Login/Logout'); ?>"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
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