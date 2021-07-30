<!DOCTYPE html>
<html>
<head>
	<title>Add Dishes</title>
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

<!-------Body Section Start ---->
 <div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
    	<!-- basic form -->
    <!-- ============================================================== -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">

        <?=  form_open_multipart('Restaurent/upload_dish'); ?>
        <div class="card">
            <h5 class="card-header">Add Dishes</h5>
            <div class="card-body">
                <div class="form-group">
            <label for="exampleInputEmail1">Dish Title</label>
            <input type="text" class="form-control" name="title" value="<?= set_value('title'); ?>" placeholder="Add Dish Title">
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
        <button type="button" class="btn btn-warning" onclick="add_more_attribute();">Add more Attribute</button>
        <button type="submit"  class="btn btn-success">upload Dish</button>
    </div>

    <?= form_close(); ?>
</div>
    </div>
    </div>
</div>


<!-------Body Section End ---->




<!--------JS FILE INCLUDE ------>
<?= view('Restaurent/js_file'); ?>
<!--------JS FILE INCLUDE ------>
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