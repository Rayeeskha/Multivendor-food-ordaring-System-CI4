<!DOCTYPE html>
<html>
<head>
	<title>Manage Slider</title>
	<!------Css File Include ------>
	<?= view('Admin/css_file'); ?>
	<!------Css File Include ------>
	<style type="text/css">
		
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
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Manage Slider</a></li>
                                   <li>
                                        <button type="button" class="btn btn-primary" data-backdrop="static" data-toggle="modal" data-target="#add_category_modal">
                                      Add Slider Image
                                    </button>
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
                                <strong class="card-title">Manage Slider</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image One</th>
                                            <th>Image Two</th>
                                            <th>Heading</th>
                                            <th>Suptitle</th>
                                            <th>Status</th>
                                            <th>Added On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if($slider_image): 
                                            count($slider_image);
                                        foreach($slider_image as $slid): ?>
                                        <tr>
                                        	<td>
                                        		<img src="<?= base_url('public/uploads/sliders/'.$slid->image); ?>" style="width: 100px;">
                                        	</td>
                                            <td>
                                        		<img src="<?= base_url('public/uploads/sliders/'.$slid->image_two); ?>" style="width: 100px;">
                                        	</td>
                                        	<td>
                                        		<?= $slid->heading; ?>
                                        	</td>
                                        	<td>
                                        		<?= $slid->subtitle; ?>
                                        	</td>
                                            
                                            <td>
                                                <?php if($slid->status == 'Active'): ?>
                                                     <span class="badge badge-success" >Active</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">In Active</span>
                                                    <?php endif; ?>
                                            </td>
                                            <td><?= date('D M Y h:i:s', strtotime($slid->added_on)); ?></td>
                                            <td>
                                            	<?php if($slid->status == 'Active'): ?>
													<a  href="<?= base_url('Super_admin/change_slider_status/'.$slid->id.'/InActive'); ?>" class="btn btn-warning"><span class="fa  fa-eye-slash"></span></a>
                                                <?php else: ?>
                                                     <a  href="<?= base_url('Super_admin/change_slider_status/'.$slid->id.'/Active'); ?>" class="btn btn-success">
                                                        <span class="fa  fa-eye" style="color: white !important"></span>
                                                     </a>
                                                <?php endif; ?>
												<a href="<?= base_url('Super_admin/edit_slider/'.$slid->id); ?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                                                <a href="<?= base_url('Super_admin/delete_slider_images/'.$slid->id); ?>" class="btn btn-danger" onclick="return confirm('Confirmation ! Are You Sure You want to Delete this Slider ?')"><span class="fa fa-trash"></span></a>
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

<!---------Add slidegory Modal -------->
<div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?=  form_open_multipart('Super_admin/upload_slider'); ?>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input type="file" class="form-control" name="slider[]" multiple="">
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'slider'); ?></span>
        </div>
         <div class="form-group">
            <label for="exampleInputEmail1">Heading</label>
            <input type="text" class="form-control" name="heading" placeholder="Enter Slider Heading">
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'heading'); ?></span>
        </div>
         <div class="form-group">
            <label for="exampleInputEmail1">Sup Title</label>
            <input type="text" class="form-control" name="subtitle" placeholder="Enter Sub Title">
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'subtitle'); ?></span>
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Save changes</button>
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

</body>
</html>