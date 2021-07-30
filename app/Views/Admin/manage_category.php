<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
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
                                    <li><a href="#">Manage Category</a></li>
                                   <li>
                                        <button type="button" class="btn btn-primary" data-backdrop="static" data-toggle="modal" data-target="#add_category_modal">
                                      Add Catgory
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
                                <strong class="card-title">Manage Category</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Order Number</th>
                                            <th>Created date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if($category): 
                                            count($category);
                                        foreach($category as $cat): ?>
                                        <tr>
                                            <td><?= $cat->category; ?></td>
                                            <td><?= $cat->order_number; ?></td>
                                            <td><?= date('D M Y h:i:s', strtotime($cat->created_date)); ?></td>
                                            <td>
                                                <?php if($cat->status == 'Active'): ?>
                                                     <span class="badge badge-success" >Active</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">In Active</span>
                                                    <?php endif; ?>
                                            </td>
                                            <td>
                                            	<?php if($cat->status == 'Active'): ?>
													<a  href="<?= base_url('Super_admin/change_category_status/'.$cat->id.'/InActive'); ?>" class="btn btn-warning"><span class="fa  fa-eye-slash"></span></a>
                                                <?php else: ?>
                                                     <a  href="<?= base_url('Super_admin/change_category_status/'.$cat->id.'/Active'); ?>" class="btn btn-success">
                                                        <span class="fa  fa-eye" style="color: white !important"></span>
                                                     </a>
                                                <?php endif; ?>
												<a href="<?= base_url('Super_admin/edit_category_details/'.$cat->id); ?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                                                <a href="<?= base_url('Super_admin/delete_category/'.$cat->id); ?>" class="btn btn-danger" onclick="return confirm('Confirmation ! Are You Sure You want to Delete this Category ?')"><span class="fa fa-trash"></span></a>
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
<div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?=  form_open('Super_admin/add_category'); ?>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Add Category</label>
            <input type="text" class="form-control" name="category" placeholder="Add Category ">
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'category'); ?></span>
           </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Order Number</label>
            <input type="text" class="form-control" name="order_number" placeholder="Enter Order Number">
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'order_number'); ?></span>
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