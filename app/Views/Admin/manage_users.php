<!DOCTYPE html>
<html>
<head>
	<title>Manage Users</title>
	<!------Css File Include ------>
	<?= view('Admin/css_file'); ?>
	<!------Css File Include ------>
    <style type="text/css">
        td{font-size: 13px;font-weight: 600;}
       
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
                <li><a href="#">Users Master</a></li>
                <li>
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter Users
                      </button>
                      <div class="dropdown-menu" style="margin-top: 28%;width: 100px;">
                        <a class="dropdown-item" href="<?= base_url('Super_admin/filter_users/new_users'); ?>" style="border-bottom: 1px solid silver">New Users</a>
                        <a class="dropdown-item" href="<?= base_url('Super_admin/filter_users/old_users') ?>">Old Users</a>
                     
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
            <strong class="card-title">Manage Users</strong>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Money</th>
                        <th>Status</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if($users): 
                        count($users);
                    foreach($users as $cat): ?>
                    <tr>
                        <td><?= $cat->name; ?></td>
                        <td><a href="mailto:<?= $cat->email; ?>"><?= $cat->email; ?></a></td>
                        <td><a href="tel:<?= $cat->mobile; ?>"><?= $cat->mobile; ?></a></td>
                        <td>
                            <?php 
                               $user_money =  get_wallate_amount($cat->id);
                            ?>
                            <span class="fa fa-inr" style="color: red;font-weight: 700">&nbsp;<?= number_format($user_money); ?></span>
                        </td>
                        
                       
                        <td>
                            <?php if($cat->status == 'Active'): ?>
                                 <span class="badge badge-success" >Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">In Active</span>
                                <?php endif; ?>
                        </td>
                         <td><?= date('D M Y', strtotime($cat->added_date)); ?></td>
                        <td>
                        	<?php if($cat->status == 'Active'): ?>
								<a  href="<?= base_url('Super_admin/change_users_status/'.$cat->id.'/InActive'); ?>" class="btn btn-warning"><span class="fa  fa-eye-slash"></span></a>
                            <?php else: ?>
                                 <a  href="<?= base_url('Super_admin/change_users_status/'.$cat->id.'/Active'); ?>" class="btn btn-success">
                                    <span class="fa  fa-eye" style="color: white !important"></span>
                                 </a>
                            <?php endif; ?>
							
                            <a href="<?= base_url('Super_admin/delete_users/'.$cat->id); ?>" class="btn btn-danger" onclick="return confirm('Confirmation ! Are You Sure You want to Delete this Users ?')"><span class="fa fa-trash"></span></a>
                             <a href="<?= base_url('Super_admin/add_user_money/'.$cat->id); ?>" class="btn btn-primary"><span class="fa fa-edit">Money</span></a>
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