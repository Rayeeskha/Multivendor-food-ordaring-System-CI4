<!DOCTYPE html>
<html>
<head>
	<title>Rated Delivery Boy Details</title>
	 <!------Css File Include ------>
    <?= view('Admin/css_file'); ?>
    <!------Css File Include ------>
    <style type="text/css">
    	h6{font-weight: 700;font-size: 14px;padding: 5px}
    </style>
</head>
<body>
<!------Left Panel Included ------>
<?= view('Admin/left_panel'); ?>    
<!------Left Panel Included ------> 
<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<?= view('Admin/right_top_bar'); ?>
<!------RightFulltopbar & Dashboard Wrapper section Include ---->

<!------Body Section Start ---->
<div class="breadcrumbs" >
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>
                        	Delivery Boy Rating
                        </h1>
                    </div>
                </div>
            </div>
        </div>
      <div class="card">
      		<div class="card-body" style="border-bottom: 1px solid silver">
      			<?php if($deli_boy_detail): ?>
      				<center>
      					<img src="<?= base_url('public/uploads/delivery_boy/'.$deli_boy_detail[0]->image) ?>" style="width: 100px;border-radius: 100%">
      					<h6>Name : <span style="color: orange">&nbsp;<?= $deli_boy_detail[0]->name; ?></span></h6>
      					<h6>Mobile : <a href="tel:<?= $deli_boy_detail[0]->mobile; ?>"><?= $deli_boy_detail[0]->mobile; ?></a></h6>
      				</center>
      			<?php else: ?>
      			<?php endif; ?>
      		</div>
        	<div class="card-body" style="border-bottom: 1px solid silver">
        			 <?php 
                        $rated_boy = get_rated_deliveryboy_details('delivery_boy_rating',$deli_boy_detail[0]->id);
                        if($rated_boy):
                        foreach($rated_boy as  $rated_del_boy):
                        $data=  getRatingByDeliveryBoy($deli_boy_detail[0]->id);
					?>
					<?php endforeach; ?>
					<?php else: ?>
					<?php endif; ?>
        		   <div class="rattings-wrapper">
                    <div class="sin-rattings">
                        <div class="star-author-all">
                                <i class="fa fa-star" style="color: orange"></i>
                                <i class="fa fa-star" style="color: orange"></i>
                                <i class="fa fa-star" style="color: orange"></i>
                                <i class="fa fa-star" style="color: orange"></i>
                                <i class="fa fa-star" style="color: orange"></i>
                                <span>(<?= $data; ?>)</span>
                            </div>
                            <div class="ratting-author f-right">
                                <h3></h3>
                                <span>12:24</span>
                                <span>9 March 2018</span>
                            </div>
                        </div>
                        <p><?= $rated_del_boy->review; ?></p>
                    </div>
                   
                </div>
        	</div>
        </div>



    </div>
</div>
<!------Body Section End ---->


<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->
</body>
</html>