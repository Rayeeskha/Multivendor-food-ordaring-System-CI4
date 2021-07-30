h<!DOCTYPE html>
<html>
<head>
  <title>Edit Dish Details</title>
  <!------Css File Include ------>
  <?= view('Admin/css_file'); ?>
  <!------Css File Include ------>

</head>
<body>
<!------Left Panel Included ------>
<?= view('Admin/left_panel'); ?>  
<!------Left Panel Included ------> 

<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<?= view('Admin/right_top_bar'); ?>
<!------RightFulltopbar & Dashboard Wrapper section Include ---->
<div class="breadcrumbs">
     <div class="breadcrumbs-inner">
      <div class="row m-0">
        <div class="col-sm-4">
          <div class="page-header float-left">
            <div class="page-title">
                  <h1>Dashboard</h1>
             </div>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="page-header float-right">
            <div class="page-title">
               <ol class="breadcrumb text-right">
                  <li><a href="#">Dashboard</a></li>
                  <li class="active">Edit Dish Details</li>
                </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
    <div class="col-lg-9 col-sm-12 col-md-12">
      <?= form_open_multipart('Super_admin/update_dish_details/'.$dish[0]->id); ?>
        <div class="card">
            <div class="card-header"><strong>Edit </strong><small> Dish Details</small></div>
              <div class="card-body card-block">
              		<div class="row">
              			<div class="col-lg-12 col-sm-12 col-md-12">
              				<div class="form-group"><label class=" form-control-label"> Title</label><input type="text" class="form-control" name="dish_title" value="<?= $dish[0]->dish_title; ?>"></div>
              				<div class="form-group">
              					<label for="vat" class="form-control-label">Category</label>
              					<select name="category" class="form-control">
              					<?php if($dish[0]->category_id):
              						$get_category = get_category_details('category_master', $dish[0]->category_id);
              						
              					?>
              					<option selected="" value="<?= $get_category[0]->id; ?>"><?= $get_category[0]->category; ?></option>
              					<?php if($category): 
	              					count($category);
	              					foreach($category as $cat): ?>
	              						<option value="<?= $cat->id; ?>"><?= $cat->category; ?></option>
	              					<?php endforeach; else: ?>
	              				<?php endif; ?>
	              				<?php else: ?>
	              					<h6 style="color: red;font-weight: 500;font-size: 14px;">Category Not Found</h6>	
	              				<?php endif; ?>
              					</select>
              				</div>
                			<div class="form-group">
                				<label for="vat" class=" form-control-label">Image</label>
                				<img src="<?= base_url('public/uploads/dish_image/'.$dish[0]->image); ?>" style="width: 100px;height: 100px;border: 1px dashed silver;display: block;margin-bottom: 10px;">
								      <input type="file" name="avatar" id="input_file" required="" class="form-control">
                			</div>
                      <div class="form-group">
                        <label>Dish Type</label>
                        <select name="dish_type" class="form-control">
                           <?php if($dish[0]->dish_type): ?>
                              <option value="<?= $dish[0]->dish_type; ?>" selected><?= $dish[0]->dish_type; ?></option>
                              <option value="Veg">Veg</option>
                              <option value="Non-Veg">Non-Veg</option>
                            <?php else: ?>
                              <h6 style="color: red;">Dish Type Not Found</h6>
                            <?php endif; ?>
                        </select>
                     </div>
                			<div class="form-group">
                				<label for="vat" class=" form-control-label">Dish Discription</label>
              					<textarea name="dish_details" class="form-control" value="<?= $dish[0]->dish_details; ?>"><?= $dish[0]->dish_details; ?></textarea>
                			</div>
                      <h6 id="success_deleted" style="color: red;text-align: center;display: none;"><span class="fa fa-check"></span></h6>
                      
                      <?php $get_dish_details = get_dish_details('dish_details', $dish[0]->id);
                           if($get_dish_details):
                            count($get_dish_details);
                            $li = 1;
                            foreach($get_dish_details as $dish_detail):
                      ?>
                         <div class="form-group" id="edit_dish_box1">
                            <div class="row">
                              <input type="hidden" name="dish_details_id[]" value="<?= $dish_detail->id ?>">
                              <input type="hidden" name="dish_id" value="<?= $dish_detail->dish_id; ?>">
                              <div class="col lg-5 col-md-5 col-sm-5">
                                  <label for="exampleInputEmail1">Attribute</label>
                                  <input type="text" class="form-control" name="attribute[]" value="<?= $dish_detail->attribute; ?>" placeholder="Add Attribute" required>
                              </div>
                              <div class="col lg-5 col-md-5 col-sm-5">
                                 <label for="exampleInputEmail1">Price</label>
                                  <input type="text" class="form-control" name="price[]" value="<?= $dish_detail->price; ?>" placeholder="Add Price" required>
                              </div>


                              <?php if($li!=1): ?>
                                <div class="col lg-2 col-md-2 col-sm-2"> <label for="exampleInputEmail1"></label><br>  <button type="button" onclick="remove_old_attribute('<?= $dish_detail->id; ?>')" class="btn btn-danger" style="margin-top: 8px;">Remove</button> </div></div>
                              <?php endif; ?>
                            </div>
                         

                    <?php $li++; endforeach;  else: ?>
                      <h6 style="color: red;">Dish Attribute not Given</h6>
                  <?php endif; ?>
                   </div>
                		</div>
              		
               <button type="button" class="btn  btn-warning" onclick="edit_more_attribute();">Add more</button>
               <button type="submit" class="btn  btn-primary">Update Dish Details</button>
              </div>
             </div>
            </div>
        </div>
     </div>
    <?= form_close(); ?>
</div>



<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->
  <input type="hidden" name="add_more" id="add_more" value="1" />
<script type="text/javascript">
  function edit_more_attribute(){

    var add_more = $('#add_more').val();
    add_more++;
    $('#add_more').val(add_more);
    var html = '<div class="row" id="box'+add_more+'"><div class="col lg-5 col-md-5 col-sm-5">  <label for="exampleInputEmail1">Attribute</label> <input type="text" class="form-control" name="attribute[]"  placeholder="Add Attribute" required></div> <div class="col lg-4 col-md-4 col-sm-4"> <label for="exampleInputEmail1">Price</label> <input type="text" class="form-control" name="price[]"  placeholder="Add Price" required> </div> <div class="col lg-3 col-md-3 col-sm-3"> <label for="exampleInputEmail1"></label><br>  <button type="button" onclick=remove_attribute("'+add_more+'"); class="btn btn-danger" style="margin-top: 8px;">Remove</button> </div></div>';
    $('#edit_dish_box1').append(html);
  }

  function remove_attribute(id){
    $('#box'+id).remove();
  }

  function remove_old_attribute(id){
    let result = confirm('Are You Sure ! You want to Delete this Attribute?')
    if (result == true) {
      $.ajax({
        type:'ajax',
        method:'GET',
        url:'<?= site_url('Super_admin/delete_attribute/'); ?>'+id,
        success:function(result){
          let data = $.parseJSON(result);
          if (data.is_error == 'no') {
            $('#success_deleted').show();
            $('#success_deleted').html(data.dd); 
          }else{
            $('#success_deleted').show();
            $('#success_deleted').html(data.dd); 
          }
                
        },
          error:function(){
            $('#success_deleted').text('0');
        }
      });
    }
  }
</script>
</body>
</html>