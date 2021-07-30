<!DOCTYPE html>
<html>
<head>
	<title>Manage Restaurent Master</title>
	<!------Css File Include ------>
	<?= view('Admin/css_file'); ?>
	<!------Css File Include ------>

	<style type="text/css">
		td{font-size: 13px;font-weight: 600!important}
		#delivery_boy_img{width: 50px;border-radius: 100%}
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
               <h6><a href="#">Manage Restaurent Master</a></h6>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li>
                        <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter Verification 
                              </button>
                            <div class="dropdown-menu" style="margin-top: 28%;width: 100px;">
                                <a class="dropdown-item" href="<?= base_url('Super_admin/filter_restaurent/new_verification'); ?>" style="border-bottom: 1px solid silver">New Verification</a>
                                <a class="dropdown-item" href="<?= base_url('Super_admin/filter_restaurent/old_verification') ?>">Old Verification</a>
                            </div>
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
            <strong class="card-title">Manage Restaurent</strong>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>PinCode</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Added On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if($restaurent): 
                        count($restaurent);
                    foreach($restaurent as $res): ?>
                    <tr>
                    	<td>
                    		<img src="<?= base_url('public/uploads/restaurent/uploads/restaurent_img/'.$res->image) ?>" id="delivery_boy_img">
                    	</td>
                        <td><?= $res->name; ?></td>
                        <td><a href="mailto:<?= $res->email; ?>"><?= $res->email; ?></a></td>
                        <td><a href="tel:<?= $res->mobile; ?>"><?= $res->mobile; ?></a></td>
                        <td><?= $res->pincode; ?></td>
                        <td><?= $res->state; ?></td>
                        <td><?= $res->city; ?></td>
                        <td><?= date('d M Y', strtotime($res->added_on)); ?></td>
                        <td>
                            <?php if($res->status == 'Active'): ?>
                                 <span class="badge badge-success" >Active</span>
                            <?php elseif($res->status == 'AdminVerification'): ?>
                                <span class="badge badge-primary">AdminVerification</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">In Active</span>
                                <?php endif; ?>
                        </td>
                        <td>
                        	<?php if($res->status == 'Active'): ?>
								<a  href="<?= base_url('Super_admin/verfiy_restaurent/'.$res->restaurent_uid.'/InActive'); ?>" class="btn btn-warning"><span class="fa  fa-eye-slash"></span></a>
                            <?php else: ?>
                                 <a  href="<?= base_url('Super_admin/verfiy_restaurent/'.$res->restaurent_uid.'/Active'); ?>" class="btn btn-success">
                                    <span class="fa  fa-eye" style="color: white !important"></span>
                                 </a>
                            <?php endif; ?>
							<a href="<?= base_url('Super_admin/view_restaurent_details/'.$res->restaurent_uid); ?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                            <a href="<?= base_url('Super_admin/delete_restaurent/'.$res->restaurent_uid); ?>" class="btn btn-danger" onclick="return confirm('Confirmation ! Are You Sure You want to Delete this Restaurent?')"><span class="fa fa-trash"></span></a>
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


<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->




</body>
</html>