<!DOCTYPE html>
<html>
<head>
    <title>Dish Master</title>
    <!------Css File Include ------>
    <?= view('Admin/css_file'); ?>
    <!------Css File Include ------>
    <style type="text/css">
       #dish_image{width: 50px;border-radius: 100%}
    </style>
</head>
<body>
<!------Left Panel Included ------>
<?= view('Admin/left_panel'); ?>    
<!------Left Panel Included ------> 
<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<?= view('Admin/right_top_bar'); ?>
<!------RightFulltopbar & Dashboard Wrapper section Include ---->

<!------Body Section Start  ------->

        <div class="breadcrumbs" >
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <button type="button" class="btn btn-primary" data-backdrop="static" data-toggle="modal" data-target="#add_dish_modal">
                                      Add Dish
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                   <li><a href="#">Dish Master</a></li>
                                   <li>
                                        <div class="dropdown">
                                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Filter Dish
                                          </button>
                                          <div class="dropdown-menu" style="margin-top: 28%;width: 100px;">
                                            <a class="dropdown-item" href="<?= base_url('Super_admin/filter_dish/veg'); ?>" style="border-bottom: 1px solid silver">Veg</a>
                                            <a class="dropdown-item" href="<?= base_url('Super_admin/filter_dish/non_veg') ?>">Non Veg</a>
                                         
                                          </div>
                                   </li>
                                    
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Dish Master</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Dish Title</th>
                                            <th>Category</th>
                                            <th>Dish Details</th>
                                           	<th>Added On</th>
                                           	<th>Restaurent</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if($dish_master): 
                                            count($dish_master);
                                        foreach($dish_master as $dish): ?>
                                        <tr>
                                        	<td>
                                            <img class="img-circle" src="<?= base_url('public/uploads/dish_image/'.$dish->image); ?>" width="50"id="dish_image"/>
                                        	</td>
                                            <td><?= $dish->dish_title; ?>
                                                (<?= strtoupper($dish->dish_type); ?>)
                                            </td>
                                            <td>
                                            	<?php 
                                            	$get_category = get_category_details('category_master', $dish->category_id); 
                                            		echo $get_category[0]->category;
                                            	?>
                                            </td>
                                            <td><?= word_limiter($dish->dish_details, 2); ?>
                                              
                                            </td>
                                            <td><?= date('D M Y ', strtotime($dish->added_on)); ?></td>
                                          	<td>
                                          		<?php if($dish->restaurent_id == "0"): ?>
                                          			admin
                                          		<?php else: ?>
                                          			<h6>Under Construction</h6>
                                          		<?php endif; ?>
                                          	</td>
                                            <td>
                                                <?php if($dish->status == 'Active'): ?>
                                                     <span class="badge badge-success" >Active</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">In Active</span>
                                                    <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($dish->status == 'Active'): ?>
                                                    <a  href="<?= base_url('Super_admin/change_dish_status/'.$dish->id.'/InActive'); ?>" class="btn btn-warning"><span class="fa  fa-eye-slash"></span></a>
                                                <?php else: ?>
                                                     <a  href="<?= base_url('Super_admin/change_dish_status/'.$dish->id.'/Active'); ?>" class="btn btn-success">
                                                        <span class="fa  fa-eye" style="color: white !important"></span>
                                                     </a>
                                                <?php endif; ?>
                                               <a href="<?= base_url('Super_admin/edit_dish_details/'.$dish->id); ?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                                                <a href="<?= base_url('Super_admin/delete_dish/'.$dish->id); ?>" class="btn btn-danger" onclick="return confirm('Confirmation ! Are You Sure You want to Delete this Dish Details ?')"><span class="fa fa-trash"></span></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; else: ?>
                                        <h6 style="color: red;font-weight: 500;font-size: 14px;">Records Not Found</h6>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
<!------Body Section End    ------->

<!---------Add Category Modal -------->
<div class="modal fade" id="add_dish_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Dish</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?=  form_open_multipart('Super_admin/upload_dish'); ?>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Dish Title</label>
            <input type="text" class="form-control" name="title" value="<?= set_value('title'); ?>" placeholder="Add Coupon Code ">
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'title'); ?></span>
        </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Category</label><br>
            <select name="category" class="form-control">
            	<option selected="" disabled="">Select Category</option>
            <?php if($category):
            	count($category);
            foreach($category as $cate): ?>
            	 <option value="<?= $cate->id; ?>"><?= $cate->category; ?></option>
            <?php endforeach; else: ?>
            	<h6 style="color: red;">Category Not Found</h6>
            <?php endif; ?>
            </select>
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'category'); ?></span>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Dish Image</label>
                <input type="file" class="form-control" name="avatar[]" multiple="multiple" required="">
                <span style="color: red;font-size: 12px;font-weight: 500">Notes: Please Choose Four Image & Upload Image Only Jpg|Png|Jpeg File Extension</span>
                <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'avatar'); ?></span>
           </div>
           <div class="form-group">
            <label for="exampleInputEmail1">Dish Type</label>
           <select name="dish_type" class="form-control">
             <option selected="" disabled="">Select Dish Title</option>
             <option value="Veg">Veg</option>
             <option value="Non-Veg">Non-Veg</option>
           </select>
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'dish_type'); ?></span>
           </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Dish Discription</label>
            	<textarea name="discription" class="form-control" value="<?= set_value('discription'); ?>"></textarea>
               <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'discription'); ?></span>
          </div>
          <div class="form-group" id="dish_box1">
            <div class="row">
              <div class="col lg-6 col-md-6 col-sm-6">
                  <label for="exampleInputEmail1">Attribute</label>
                  <input type="text" class="form-control" name="attribute[]"  placeholder="Add Attribute" required>
              </div>
              <div class="col lg-6 col-md-6 col-sm-6">
                 <label for="exampleInputEmail1">Price</label>
                  <input type="text" class="form-control" name="price[]"  placeholder="Add Price" required>
              </div>
              
            </div>
          </div>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" onclick="add_more_attribute();">Add more</button>
        <button type="submit"  class="btn btn-success">Submit</button>
      </div>
    </div>
    <?= form_close(); ?>
  </div>
</div>
<!---------Add Category Modal -------->

<!------Edit Category Modal -------->


<!------Edit Category Modal -------->

<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->
  <input type="hidden" name="add_more" id="add_more" value="1" />
<script type="text/javascript">
  function add_more_attribute(){
    var add_more = $('#add_more').val();
    add_more++;
    $('#add_more').val(add_more);
    var html = '<div class="row" id="box'+add_more+'"><div class="col lg-5 col-md-5 col-sm-5">  <label for="exampleInputEmail1">Attribute</label> <input type="text" class="form-control" name="attribute[]"  placeholder="Add Attribute"></div> <div class="col lg-4 col-md-4 col-sm-4"> <label for="exampleInputEmail1">Price</label> <input type="text" class="form-control" name="price[]"  placeholder="Add Price"> </div> <div class="col lg-3 col-md-3 col-sm-3"> <label for="exampleInputEmail1"></label><br>  <button type="button" onclick=remove_attribute("'+add_more+'"); class="btn btn-danger" style="margin-top: 8px;">Remove</button> </div></div>';
    $('#dish_box1').append(html);
  }

  function remove_attribute(id){
    $('#box'+id).remove();
  }

 

</script>








</body>
</html>