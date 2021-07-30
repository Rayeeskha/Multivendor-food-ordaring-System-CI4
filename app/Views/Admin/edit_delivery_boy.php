h<!DOCTYPE html>
<html>
<head>
  <title>Edit Delivery Boy Details</title>
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
                  <li class="active">Edit Delivery Boy</li>
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
      <?= form_open('Super_admin/update_delivery_boy/'.$delivery_boy[0]->id); ?>
        <div class="card">
            <div class="card-header"><strong>Edit </strong><small> Delivery Boy</small></div>
              <div class="card-body card-block">
              		<div class="row">
              			<div class="col-lg-6 col-sm-12 col-md-12">
              				<div class="form-group"><label for="delivery_boy" class=" form-control-label"> Name</label><input type="text" class="form-control" name="delivery_boy" value="<?= $delivery_boy[0]->name; ?>"></div>
              				<div class="form-group"><label for="vat" class=" form-control-label">Mobile</label><input type="text"  class="form-control" name="mobile" value="<?= $delivery_boy[0]->mobile; ?>">
                			</div>
                			<div class="form-group"><label for="vat" class=" form-control-label">State</label><input type="text"  class="form-control" name="state" value="<?= $delivery_boy[0]->state; ?>">
                			</div>
              			</div>
              			<div class="col-lg-6 col-sm-12 col-md-12">
              				<div class="form-group"><label for="vat" class=" form-control-label">Email</label><input type="email"  class="form-control" name="email" value="<?= $delivery_boy[0]->email; ?>">
                 			</div>
                 			
                			<div class="form-group"><label for="vat" class=" form-control-label">PiCode</label><input type="text"  class="form-control" name="pincode" value="<?= $delivery_boy[0]->pincode; ?>">
                			</div>
                			<div class="form-group"><label for="vat" class=" form-control-label">City</label><input type="text"  class="form-control" name="city" value="<?= $delivery_boy[0]->city; ?>">
                			</div>
              			</div>
              		</div>
                  <div class="form-group"><label for="vat" class=" form-control-label">Aadhar Number</label><input type="text"  class="form-control" name="aadhar_number" value="<?= $delivery_boy[0]->aadhar_number; ?>">
                </div>
                 
              </div>
              <button type="submit" class="btn btn-primary">Edit Delivery Boy</button>
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