<!DOCTYPE html>
<html>
<head>
	<title>Track User</title>
	<!-------Css File Include ----->
	<?= view('Delivery_boy/css_file'); ?>
	<!-------Css File Include ----->
	<?= view('Home/trach_Style'); ?>
</head>
<body class="sidebar-light">
<!------Delivery Boy navbar File Include ----->
<?= view('Delivery_boy/navbar'); ?>
<!------Delivery Boy navbar File Include ----->

<!------Left Side Bar Section Include ----->
<?= view('Delivery_boy/side_bar'); ?>
<!------Left Side Bar Section Include ----->
<div class="main-panel">        
    <div class="content-wrapper">

    	<?php 

			$coordinates = array();
		 	$latitudes = array();
		 	$longitudes = array();
			if ($trach_user) {
				foreach ($trach_user as $row) {
					$latitudes[] = $row['locationLatitude'];
					$longitudes[] = $row['locationLongitude'];
					$coordinates[] = 'new google.maps.LatLng(' . $row['locationLatitude'] .','. $row['locationLongitude'] .'),';
				}
				//remove the comaa ',' from last coordinate
				$lastcount = count($coordinates)-1;
				$coordinates[$lastcount] = trim($coordinates[$lastcount], ",");	
			}
			

		 ?>

    	<div class="card">
    		<div class="card-body" style="border-bottom: 1px solid silver">
			<nav id="gps_nav">  
				<ul id="gps_ul"> 
					<li class="active gps_li"><a href="#"><img src="<?= base_url('public/img/map.png'); ?>"></a></li>
					<li class="gps_li"><a href="<?= base_url('Delivery_boy/view_order/'.$row['order_id']); ?>"><img src="<?= base_url('public/img/logout.png'); ?>" style="width: 30px; height: 30px"></a></li>
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
    </div>
    </div>
</div>



<!------Footer Section Include ------>
<?= view('Delivery_boy/footer'); ?>
<!------Footer Section Include ------>

<!------------Js File Include ------->
<?= view('Delivery_boy/js_file'); ?>
<!------------Js File Include ------->

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