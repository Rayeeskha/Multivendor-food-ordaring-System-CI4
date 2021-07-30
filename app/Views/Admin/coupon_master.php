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
                                   <li><a href="#">Coupon Master</a></li>
                                   <li>
                                        <button type="button" class="btn btn-primary" data-backdrop="static" data-toggle="modal" data-target="#add_category_modal">
                                      Add Coupon
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
                                <strong class="card-title">Manage Coupon Master</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Coupon Code</th>
                                            <th>Coupon Value</th>
                                            <th>Coupon Type</th>
                                            <th>Cart min Value</th>
                                            <th>Expiry</th>
                                            <th>Added</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if($coupons): 
                                            count($coupons);
                                        foreach($coupons as $cat): ?>
                                        <tr>
                                            <td><?= $cat->coupon_code; ?></td>
                                            <td><?= $cat->coupon_value; ?></td>
                                            <td><?= $cat->coupon_type; ?></td>
                                            <td><?= $cat->cart_min_value; ?></td>
                                            <td><?= date('D M Y ', strtotime($cat->expiry_on)); ?></td>
                                            <td><?= date('D M Y h:i:s', strtotime($cat->added_on)); ?></td>
                                            <td>
                                                <?php if($cat->status == 'Active'): ?>
                                                     <span class="badge badge-success" >Active</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">In Active</span>
                                                    <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($cat->status == 'Active'): ?>
                                                    <a  href="<?= base_url('Super_admin/change_coupon_status/'.$cat->id.'/InActive'); ?>" class="btn btn-warning"><span class="fa  fa-eye-slash"></span></a>
                                                <?php else: ?>
                                                     <a  href="<?= base_url('Super_admin/change_coupon_status/'.$cat->id.'/Active'); ?>" class="btn btn-success">
                                                        <span class="fa  fa-eye" style="color: white !important"></span>
                                                     </a>
                                                <?php endif; ?>
                                               
                                                <a href="<?= base_url('Super_admin/delete_coupn_master/'.$cat->id); ?>" class="btn btn-danger" onclick="return confirm('Confirmation ! Are You Sure You want to Delete this Coupon Code ?')"><span class="fa fa-trash"></span></a>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Add Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?=  form_open('Super_admin/add_coupon_code'); ?>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Coupon Code</label>
            <input type="text" class="form-control" name="couponCode" value="<?= set_value('couponCode'); ?>" placeholder="Add Coupon Code ">
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'couponCode'); ?></span>
        </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Coupon Type</label><br>
            <select name="coupon_type" class="form-control">
                <option selected="" disabled="">Select Coupon Type</option>
                <option value="Percentage">Percentage</option>
                <option value="Rupee">Rupee</option>
            </select>
            <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'coupon_type'); ?></span>
          </div>
           <div class="form-group">
            <label for="exampleInputEmail1">Coupon Value</label>
                <input type="text" class="form-control" name="coupon_value" value="<?= set_value('coupon_value'); ?>" placeholder="Add Coupon Value ">
                <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'coupon_value'); ?></span>
            </div>
             <div class="form-group">
                <label for="exampleInputEmail1">Cart min Value</label>
                    <input type="text" class="form-control" name="cart_min_value" value="<?= set_value('cart_min_value'); ?>" placeholder="Add Cart min Value">
                    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'cart_min_value'); ?></span>
                </div>
             <div class="form-group">
            <label for="exampleInputEmail1">Expiry date</label>
                <input type="date" class="form-control" name="expiry_date">
                <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'expiry_date'); ?></span>
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