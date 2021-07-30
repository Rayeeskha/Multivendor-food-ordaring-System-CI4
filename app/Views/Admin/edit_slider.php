<!DOCTYPE html>
<html>
<head>
  <title>Edit Slider </title>
  <!------Css File Include ------>
  <?= view('Admin/css_file'); ?>
  <!------Css File Include ------>
  <style type="text/css">
  	#slider_images{width: 100px;border: 1px solid silver}
  </style>

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
                  <h1>Edit Slider</h1>
             </div>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="page-header float-right">
            <div class="page-title">
               <ol class="breadcrumb text-right">
                 <li class="active">Edit Slider</li>
                </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
    <div class="col-lg-6 col-sm-12 col-md-12">
      <?= form_open_multipart('Super_admin/update_slider_details/'.$edit_slider[0]->id); ?>
        <div class="card">
            <div class="card-header"><strong>Edit </strong><small> Slider</small></div>
              <div class="card-body card-block">
                  <div class="form-group"><label class=" form-control-label">Slider Heading</label><input type="text" class="form-control" name="heading" value="<?= $edit_slider[0]->heading; ?>" required></div>
                 <div class="form-group"><label for="vat" class=" form-control-label">Subtitle</label><input type="text"  class="form-control" name="subtitle" value="<?= $edit_slider[0]->subtitle; ?>" required>
                 </div>
                  <div class="form-group">
                  	<label for="vat" class=" form-control-label">Slider Image One</label><br>
                  	<img src="<?= base_url('public/uploads/sliders/'.$edit_slider[0]->image); ?>" id="slider_images">
                  	<input type="file"  class="form-control" name="image_one"required>
                 </div>
                  <div class="form-group">
                  	<label for="vat" class=" form-control-label">Slider Image Second</label><br>
                  	<img src="<?= base_url('public/uploads/sliders/'.$edit_slider[0]->image_two); ?>" id="slider_images" required>
                  	<input type="file"  class="form-control" name="image_two" >
                 </div>
              </div>
              <button type="submit" class="btn btn-primary">Edit Slider</button>
            </div>
        </div>
     </div>
    <?= form_close(); ?>
</div>



<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->
</body>
</html>