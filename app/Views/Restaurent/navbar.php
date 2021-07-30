<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
<!-- ============================================================== -->
<!-- navbar -->
<!-- ============================================================== -->
  <div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <a class="navbar-brand" href="<?= base_url('Restaurent/dashboard') ?>"><img src="<?= base_url('public/images/ff.png') ?>" style="width: 120px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                <li class="nav-item dropdown notification">
                     <?php 
                        $args = [
                            'order_date'     => date('Y-m-d'),
                            'order_status'   => 'Pending',
                            'restaurent_id'  => session()->get('RESTAURENT_UID')
                        ];
                        $today_order =  get_today_orders($args); 
                           if($today_order):
                        ?>

                    <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"><?= count($today_order); ?></i> <span class="indicator"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                        <li>
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
                                        <td><a href="<?= base_url('Restaurent/accept_order/'.$t_ord->order_id.'/Accept'); ?>"  class="btn btn-success"><span class="fa fa-eye">
                                            Accept
                                        </span></a></td>
                                    </tr>
                                <?php endforeach; ?> 
                            </table>
                        </li>
                    </ul>
                    <?php else: ?>
                        <a class="nav-link nav-icons" href="#"><i class="fas fa-fw fa-bell">0</i><span class="indicator"></span></a>
                    <?php endif; ?>

                </li>
               
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url('public/uploads/restaurent/uploads/restaurent_img/'.session()->get('RES_IMAGE')); ?>" alt="" class="user-avatar-md rounded-circle"></a>

                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name"><?= session()->get('RES_NAME'); ?></h5>
                            <span class="status"></span><span class="ml-2">Available</span>
                        </div>
                        <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                        <a class="dropdown-item" href="<?= base_url('Restaurent/Logout_restaurent'); ?>"><i class="fas fa-power-off mr-2"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- ============================================================== -->
        <!-- end navbar -->


       