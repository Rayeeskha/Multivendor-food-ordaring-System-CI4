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
                    <li><a href="#">Website Settings </a></li>
                   
                    
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
                <strong class="card-title">Website Settings</strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Cart Min Price</th>
                            <th>Cart min Price Msg</th>
                            <th>Website Status</th>
                            <th>Website Close Msg</th>
                            <th>User Reg Cash</th>
                            <th>User Referal Amt</th>
                            <th>Deli reg cash amt</th>
                            <th>Deli per ord amt</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if($web_setting): 
                            count($web_setting);
                        foreach($web_setting as $cat): ?>
                        <tr>
                            <td><?= $cat->cart_min_price; ?></td>
                            <td><?= $cat->cart_min_price_msg; ?></td>
                           
                            <td>
                                <?php if($cat->website_close == 'Open'): ?>
                                     <span class="badge badge-success" >Open</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">close</span>
                                    <?php endif; ?>
                            </td>
                             <td><?= $cat->website_close_msg; ?></td>
                              <td>
                                  <span class="fa fa-inr">
                                      <?= number_format($cat->wallet_amt); ?>
                                  </span>
                              </td>
                              <td>
                                  <span class="fa fa-inr">
                                      <?= $cat->referal_amount; ?>
                                  </span>
                              </td>
                              <td>
                                  <span class="fa fa-inr">
                                      <?= $cat->deli_boy_reg_cahback; ?>
                                  </span>
                              </td>
                              <td>
                                  <span class="fa fa-inr">
                                      <?= $cat->deliBoyPerOrderAmt; ?>
                                  </span>
                              </td>
                            <td>
                            	<?php if($cat->website_close == 'Open'): ?>
									<a  href="<?= base_url('Super_admin/change_web_close_status/'.$cat->id.'/Close'); ?>" class="btn btn-warning"><span class="fa  fa-eye-slash"></span></a>
                                <?php else: ?>
                                     <a  href="<?= base_url('Super_admin/change_web_close_status/'.$cat->id.'/Open'); ?>" class="btn btn-success">
                                        <span class="fa  fa-eye" style="color: white !important"></span>
                                     </a>
                                <?php endif; ?>
								<a href="<?= base_url('Super_admin/edit_web_settings/'.$cat->id); ?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                                
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


<!------Edit Category Modal -------->


<!------Edit Category Modal -------->


<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->

</body>
</html>