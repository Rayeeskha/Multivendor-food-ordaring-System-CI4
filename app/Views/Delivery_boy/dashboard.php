<!DOCTYPE html>
<html>
<head>
	<title>Delivery Boy Dashboard</title>
	<!-------Css File Include ----->
	<?= view('Delivery_boy/css_file'); ?>
	<!-------Css File Include ----->
</head>
<body class="sidebar-light">
<!------Delivery Boy navbar File Include ----->
<?= view('Delivery_boy/navbar'); ?>
<!------Delivery Boy navbar File Include ----->

<!------Left Side Bar Section Include ----->
<?= view('Delivery_boy/side_bar'); ?>
<!------Left Side Bar Section Include ----->

<!--------Body Section Start ------>
<div class="main-panel">        
    <div class="content-wrapper">
    	<div class="row">
    		<div class="col-12 col-lg-4 col-md-4 col-sm-12">
    			<div class="card" style="background: green;color: white">
    				<div class="card-body">
    					<div class="row">
    						<div class="col-12 col-lg-6 col-md-6 col-sm-12">
    							<h6>Pending Orders</h6>
    						</div>
    						<div class="col-12 col-lg-6 col-md-6 col-sm-12">
    							<?php if($pending_order): echo count($pending_order); else: echo "0";endif; ?>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="col-12 col-lg-4 col-md-4 col-sm-12">
    			<div class="card" style="background: red;color: white">
    				<div class="card-body">
    					<div class="row">
    						<div class="col-12 col-lg-6 col-md-6 col-sm-12">
    							<h6>Cancel Orders</h6>
    						</div>
    						<div class="col-12 col-lg-6 col-md-6 col-sm-12">
    							<?php if($cancel_order): echo count($cancel_order); else: echo "0";endif; ?>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="col-12 col-lg-4 col-md-4 col-sm-12">
    			<div class="card" style="background: orange;color: white">
    				<div class="card-body">
    					<div class="row">
    						<div class="col-12 col-lg-6 col-md-6 col-sm-12">
    							<h6>Total Orders</h6>
    						</div>
    						<div class="col-12 col-lg-6 col-md-6 col-sm-12">
    							<?php if($total_order): echo count($total_order); else: echo "0";endif; ?>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

    	<div class="card" style="margin-top: 5%">
    		<div class="card-header">
    			Last 30 days Orders
    		</div>
    		<div class="card-body">
    			 <div id="delivery_boy_order_chart" style="height: 300px; width: 100%;"></div>
    		</div>
    	</div>

    </div>
</div>
<!--------Body Section Start ------>



<!------Footer Section Include ------>
<?= view('Delivery_boy/footer'); ?>
<!------Footer Section Include ------>

<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->

<script type="text/javascript">
		//Dashboard Chart Section Script Start 
  var chartdata1 = new CanvasJS.Chart("delivery_boy_order_chart",{
    animationEnabled: true,
    exportEnabled: true,
    theme: "light2", 
    title :{
        text: "Last 30days  Orders",
    },
    data: [{
    // type: "column", //change type to bar, line, area, pie, etc
        type: "pie",
        //indexLabel: "{y}", //Shows y value on all Data Points
        indexLabelFontColor: "#5A5757",
        indexLabelFontSize: 16,
        indexLabelPlacement: "outside",
      dataPoints: [
            { label : 'Today',     y: <?= $chart_data['ch_today_order']; ?> },
            { label : 'Yesterday', y: <?= $chart_data['ch_yesterday_order']; ?> },
            { label : '3rd Days',  y: <?= $chart_data['ch_last_3_days_order']; ?> },
            { label : '4rd Days',  y: <?= $chart_data['ch_last_4_days_order']; ?> },
            { label : '5rd Days',  y: <?= $chart_data['ch_last_5_days_order']; ?> },
            { label : '6rd Days',  y: <?= $chart_data['ch_last_6_days_order']; ?> },
            { label : '7rd Days',  y: <?= $chart_data['ch_last_7_days_order']; ?> },
            { label : '8rd Days',  y: <?= $chart_data['ch_last_8_days_order']; ?> },
            { label : '10rd Days',  y: <?= $chart_data['ch_last_10_days_order']; ?> },
            { label : '11rd Days',  y: <?= $chart_data['ch_last_11_days_order']; ?> },
            { label : '12rd Days',  y: <?= $chart_data['ch_last_12_days_order']; ?> },
            { label : '13rd Days',  y: <?= $chart_data['ch_last_13_days_order']; ?> },
            { label : '14rd Days',  y: <?= $chart_data['ch_last_14_days_order']; ?> },
            { label : '15rd Days',  y: <?= $chart_data['ch_last_15_days_order']; ?> },
            { label : '16rd Days',  y: <?= $chart_data['ch_last_16_days_order']; ?> },
            { label : '17rd Days',  y: <?= $chart_data['ch_last_17_days_order']; ?> },
            { label : '18rd Days',  y: <?= $chart_data['ch_last_18_days_order']; ?> },
            { label : '19rd Days',  y: <?= $chart_data['ch_last_19_days_order']; ?> },
            { label : '20rd Days',  y: <?= $chart_data['ch_last_20_days_order']; ?> },
            { label : '21rd Days',  y: <?= $chart_data['ch_last_21_days_order']; ?> },
            { label : '22rd Days',  y: <?= $chart_data['ch_last_22_days_order']; ?> },
            { label : '23rd Days',  y: <?= $chart_data['ch_last_23_days_order']; ?> },
            { label : '24rd Days',  y: <?= $chart_data['ch_last_24_days_order']; ?> },
            { label : '25rd Days',  y: <?= $chart_data['ch_last_25_days_order']; ?> },
            { label : '26rd Days',  y: <?= $chart_data['ch_last_26_days_order']; ?> },
            { label : '27rd Days',  y: <?= $chart_data['ch_last_27_days_order']; ?> },
            { label : '28rd Days',  y: <?= $chart_data['ch_last_28_days_order']; ?> },
            { label : '29rd Days',  y: <?= $chart_data['ch_last_29_days_order']; ?> },
            { label : '30rd Days',  y: <?= $chart_data['ch_last_30_days_order']; ?> },
            
        ]   
    }]
});

chartdata1.render();
</script>
</body>
</html>