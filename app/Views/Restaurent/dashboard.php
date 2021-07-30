<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
		<!----------CSS FILE INCLUDE ----->
	<?= view('Restaurent/css_file'); ?>
	<!----------CSS FILE INCLUDE ----->
</head>
<body>
<!------NavBar Section Include ------>
<?= view('Restaurent/navbar'); ?>	
<!------NavBar Section Include ------>	

<!--------Left SIDEBAR SECTION INCLUDE ------>
<?= view('Restaurent/left_side_bar'); ?>
<!--------Left SIDEBAR SECTION INCLUDE ------>

<!------Body Section Start ----->
<!------Dashboard Cart Section ----->

<div class="dashboard-wrapper">
<div class="dashboard-influence">
<div class="container-fluid dashboard-content">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
       	<!--------Dahboard Wrapper Section ------->	

<!-- widgets   -->
<!-- ============================================================== -->
<div class="row">
    <!-- ============================================================== -->
    <!-- four widgets   -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- total views   -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Total Orders</h5>
                    <h2 class="mb-0"> 
                    	<?php if($total_orders): echo count($total_orders); else: echo "0"; endif; ?>
                    </h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                    <i class="fa fa-eye fa-fw fa-sm text-info"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end total views   -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- total followers   -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Visited Users</h5>
                    <h2 class="mb-0"> <?php if($total_orders): echo count($total_orders); else: echo "0"; endif; ?></h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                    <i class="fa fa-user fa-fw fa-sm text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end total followers   -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- partnerships   -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Total Product</h5>
                    <h2 class="mb-0">
                    	<?php if($dishes): echo count($dishes); else: echo "0"; endif; ?>
                    </h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary-light mt-1">
                    <i class="fa fa-handshake fa-fw fa-sm text-secondary"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end partnerships   -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- total earned   -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Total Earned</h5>
                    <h2 class="mb-0">
                    	<?php 
                    	
                    	$final_price  = 0;
                    	if($total_orders):
                    	count($total_orders);
                    	foreach($total_orders as $ord):
                    		$final_price += $ord->total_amount;
                    	 ?>

                    	<?php endforeach; ?>
                    	<?= number_format($final_price); ?>
                    <?php else: ?>
                    	<?= '0'; ?>
                    <?php endif;?>

                    </h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-brand-light mt-1">
                    <i class="fa fa-money-bill-alt fa-fw fa-sm text-brand"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end total earned   -->
    <!-- ============================================================== -->
</div>
<!--------Dahboard Wrapper End point ------->

<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title" style="border-bottom: 1px solid silver">Last 30 Days Orders </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <div id="Restaurent_order_chart" style="height: 300px; width: 100%;"></div>
                    </div> <!-- /.table-stats -->
                </div>
            </div> <!-- /.card -->
        </div>  <!-- /.col-lg-8 -->

    </div>
</div>	  	

</div>
</div>
</div>
</div>
<!--------Dahboard Wrapper End ------->	 


<!------Dashboard Cart Section ----->                    
<!------Body Section End ----->





<!--------JS FILE INCLUDE ------>
<?= view('Restaurent/js_file'); ?>
<!--------JS FILE INCLUDE ------>
<!----Dashboard Js File Include ---->
<?= view('Restaurent/dashboard_js'); ?>
<!----Dashboard Js File Include ---->
</body>
</html>