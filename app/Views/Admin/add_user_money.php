<!DOCTYPE html>
<html>
<head>
  <title>Add User Money</title>
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
                  <li class="active">Add User Money</li>
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
      <?= form_open('Super_admin/manage_user_money/'.$user_details[0]->id); ?>
        <div class="card">
            <div class="card-header"><strong>Manage  </strong><small> Money</small></div>
              <div class="card-body card-block">
                  <div class="form-group"><label for="money" class=" form-control-label">Add Money</label><input type="number" class="form-control" name="money" value="" placeholder="Add Money"></div>
                    <div class="form-group"><label for="vat" class=" form-control-label">Message</label><input type="text"  class="form-control" name="message" placeholder="Enter Mesage" ></div>
              </div>
              <button type="submit" class="btn btn-primary">Add Money</button>
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