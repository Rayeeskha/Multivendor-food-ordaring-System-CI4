<!DOCTYPE html>
<html>
<head>
	<title>Manage Dishes</title>
	<!----------CSS FILE INCLUDE ----->
	<?= view('Restaurent/css_file'); ?>
	<!----------CSS FILE INCLUDE ----->
	<style type="text/css">
		 /* Pagination Css File Include  */
       .pagination li.active{background: none;}
      .pagination a{color: black; font-weight: 500;border: 1px solid black;padding:2px 5px;margin-left: 2px;border-radius: 3px;}
      #pagination nav {background:none;box-shadow: none; }
      .pagination  li.active a{color: white;background: black}         
       /* Pagination Css File Include  */ 
       #dish_img{width:120px;height: 70px;}
      
        #search_dishes{display: flex;}
       #search_dishes li:first-child{width: 250px}
       ul {list-style-type: none;}
	</style>
</head>
<body>
<!------NavBar Section Include ------>
<?= view('Restaurent/navbar'); ?>	
<!------NavBar Section Include ------>	
<!--------Left SIDEBAR SECTION INCLUDE ------>
<?= view('Restaurent/left_side_bar'); ?>
<!--------Left SIDEBAR SECTION INCLUDE ------>

<!-----Body Section Start ----->	
<!-------Body Section Start ---->
 <div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
	<!-----Dish Table Section Start ----->
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
        	<div class="row" style="padding: 10px">
        		<div class="col-12 col-lg-6 col-md-6 col-sm-6">
        			<?= form_open('Restaurent/search_dishes'); ?>
        			<ul id="search_dishes">
						<li>
							<input type="text" name="dish_name" value="<?= set_value('dish_name'); ?>" placeholder="Enter Dish Title" required="" class="form-control">
						</li>
						<li>
							<button type="submit" class="btn btn-primary" style="background: #005a87;box-shadow: none;text-transform: capitalize;height: 35px">Search Now</button>
						</li>
					</ul>
					<?= form_close(); ?>
        		</div>
        		<div class="col-12 col-lg-6 col-md-6 col-sm-6">
        			 <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter Dishes 
                          </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= base_url('Restaurent/filter_dishes/new_dishes'); ?>" style="border-bottom: 1px solid silver">New Dishes</a>
                            <a class="dropdown-item" href="<?= base_url('Restaurent/filter_dishes/old_dishes') ?>">Old Dishes</a>
                        </div>
                    </div>
        		</div>
        	</div>
            <h5 class="card-header">Manage Dishes</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Dish Type</th>
                                <th>Added On</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <?php if($dishes):
                        	count($dishes);
                        	foreach($dishes as $dish_det): ?>
                        <tbody>
                            <tr>
                                <td>
                                	<img src="<?= base_url('public/uploads/dish_image/'.$dish_det['image_two']); ?>" id="dish_img">
                                </td>
                                <td><?= $dish_det['dish_title']; ?></td>
                                <td>
                                	<?php if($dish_det['dish_type'] == "Veg"): ?>
                                		<img src="<?= base_url('public/Home/images/bg/veg.png'); ?>"> <?= $dish_det['dish_type']; ?>
                                	<?php else: ?>
                                		<img src="<?= base_url('public/Home/images/bg/non-veg.png'); ?>"> <?= $dish_det['dish_type']; ?>
                                	<?php endif; ?>
                                </td>
                                <td>
                                	<?= date('d M Y', strtotime($dish_det['added_on'])); ?>
                                </td>
                                <td>
                                	<h6 style="color: green"><?= $dish_det['status']; ?></h6>
                                </td>
                                <td>
                                	<?php if($dish_det['status'] == 'Active'): ?>
                                        <a  href="<?= base_url('Restaurent/change_dish_status/'.$dish_det['id'].'/InActive'); ?>" class="btn btn-warning"><span class="fa  fa-eye-slash"></span></a>
                                    <?php else: ?>
                                         <a  href="<?= base_url('Restaurent/change_dish_status/'.$dish_det['id'].'/Active'); ?>" class="btn btn-success">
                                            <span class="fa  fa-eye" style="color: white !important"></span>
                                         </a>
                                    <?php endif; ?>
									<a href="<?= base_url('Restaurent/edit_dish_details/'.$dish_det['id']); ?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                                    <a href="<?= base_url('Restaurent/delete_dish/'.$dish_det['id']); ?>" class="btn btn-danger" onclick="return confirm('Confirmation ! Are You Sure You want to Delete this Dish Details ?')"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                        	<h6 style="color: red;">No Dish Found</h6>
                        <?php endif; ?>
                        <tr>
							<td colspan="7">
								<div id="pagination" style="color: white">
									<?= $pager->links() ?>
								</div>
							</td>
						</tr>
                        </tbody>

                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic table  -->
    <!-- ============================================================== -->
            </div>
	<!-----Dish Table Section END ----->

<!--------JS FILE INCLUDE ------>
<?= view('Restaurent/js_file'); ?>
<!--------JS FILE INCLUDE ------>


</div>
</div>
<!-----Body Section End ----->	

</body>
</html>