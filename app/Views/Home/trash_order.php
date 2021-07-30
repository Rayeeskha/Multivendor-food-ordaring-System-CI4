<!DOCTYPE html>
<html>
<head>
	<title>Trash Order</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
	<?= view('Home/trach_Style'); ?>
    <style type="text/css">
        h6{font-weight: 500;font-size: 13px;}
    </style>

</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->

<!-----Body Section Start ---->
<div class="container" style="padding: 10px">
	<div class="card">
		<h6 style="margin-left: 10%;padding: 10px"><a href="<?= base_url('Home/order_history'); ?>" class="btn btn-info">Back to Order</a></h6>
		<?php if($trash_order[0]->delivery_boy_id !==  "0"): 
			$get_deli_boy = get_category_details('delivery_boy_master', $trash_order[0]->delivery_boy_id);
			// var_dump($get_deli_boy);
		?>
		 <center>
		 	<img class="card-img-top" src="<?= base_url('public/uploads/Delivery_boy/'.$get_deli_boy[0]->image); ?>" alt="Card image cap" class="responsive-img" style="width: 150px;height: 150px;border-radius: 100%;border: 1px solid silver">
		 </center>
		<div class="card-body" style="border-bottom: 1px solid silver">
			<center>
		    	<h4 class="card-title">Delivery Boy  </h4>
		 		<h6>Name : <?= $get_deli_boy[0]->name; ?></h6>
		 		<h6>Mobile : <a href="tel:<?= $get_deli_boy[0]->mobile; ?>" style="color: blue"><?= $get_deli_boy[0]->mobile; ?></a></h6>
		 	</center>
		</div>

		<?php 

			$coordinates = array();
		 	$latitudes = array();
		 	$longitudes = array();

			$map_data = get_order_location($trash_order[0]->order_id);
			if ($map_data) {
				foreach ($map_data as $row) {
					$latitudes[] = $row['locationLatitude'];
					$longitudes[] = $row['locationLongitude'];
					$coordinates[] = 'new google.maps.LatLng(' . $row['locationLatitude'] .','. $row['locationLongitude'] .'),';
				}
				//remove the comaa ',' from last coordinate
				$lastcount = count($coordinates)-1;
				$coordinates[$lastcount] = trim($coordinates[$lastcount], ",");	
			}
			

		 ?>

		<div class="card-body" style="border-bottom: 1px solid silver">
			<nav id="gps_nav">  
				<ul id="gps_ul"> 
					<li class="active gps_li"><a href="#"><img src="<?= base_url('public/img/map.png'); ?>"></a></li>
					<li class="gps_li"><a href="#"><img src="<?= base_url('public/img/logout.png'); ?>" style="width: 30px; height: 30px"></a></li>
				</ul> 
			</nav>
			<div class="outer-scontainer">
		        <div class="row">
		            <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
		            	<div class="form-area">	      
	    					<button type="submit" id="submit" name="import" class="btn-submit">RELOAD DATA</button>
							<br />
						</div>
		            </form>
		        </div>
			<div id="map" style="width: 100%; height: 80vh;"></div>
		</div>
	</div>

	<?php else: ?>
	 	<center>
	 		<img src="<?= base_url('public/images/deli.gif'); ?>" style="width: 300px;height: 100px;">
			<h5 style="text-align: center;color: red">Waiting for Restaurent Confirmation</h5>
	 	</center>
	 <?php endif; ?>
  	</div>
</div>
<!-----Body Section End ---->

<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>

<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
<script>
	function initMap() {
	  var mapOptions = {
	    zoom: 18,
	    center: {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>}, //{lat: --- , lng: ....}
	    mapTypeId: google.maps.MapTypeId.SATELITE
	  };

	  var map = new google.maps.Map(document.getElementById('map'),mapOptions);

	  var RouteCoordinates = [
	  	<?php
	  		$i = 0;
			while ($i < count($coordinates)) {
				echo $coordinates[$i];
				$i++;
			}
	  	?>
	  ];

	  var RoutePath = new google.maps.Polyline({
	    path: RouteCoordinates,
	    geodesic: true,
	    strokeColor: '#1100FF',
	    strokeOpacity: 1.0,
	    strokeWeight: 10
	  });

	  mark = '<?= base_url('public/img/mark.png'); ?>';
	  flag = '<?= base_url('public/img/flag.png'); ?>';

	  startPoint = {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>};
	  endPoint = {<?php echo'lat:'.$latitudes[$lastcount] .', lng:'. $longitudes[$lastcount] ;?>};

	  var marker = new google.maps.Marker({
	  	position: startPoint,
	  	map: map,
	  	icon: mark,
	  	title:"Start point!",
	  	animation: google.maps.Animation.BOUNCE
	  });

	  var marker = new google.maps.Marker({
	  position: endPoint,
	   map: map,
	   icon: flag,
	   title:"End point!",
	   animation: google.maps.Animation.DROP
	});

	  RoutePath.setMap(map);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<!--remenber to put your google map key-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-dFHYjTqEVLndbN2gdvXsx09jfJHmNc8&callback=initMap"></script>

</body>
</html>