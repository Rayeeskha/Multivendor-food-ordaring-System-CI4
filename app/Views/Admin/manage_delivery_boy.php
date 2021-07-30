<!DOCTYPE html>
<html>
<head>
	<title>Manage Delivery Boy Master</title>
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
                        <h1>
                        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_delivery_boy_modal">
							  Add Delivery Boy
							</button>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Delivery Boy Master</a></li>
                            <li>
                                <div class="dropdown">
                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Filter Verification 
                                      </button>
                                    <div class="dropdown-menu" style="margin-top: 28%;width: 100px;">
                                        <a class="dropdown-item" href="<?= base_url('Super_admin/filter_deli_boy/new_verification'); ?>" style="border-bottom: 1px solid silver">New Verification</a>
                                        <a class="dropdown-item" href="<?= base_url('Super_admin/filter_deli_boy/old_verification') ?>">Old Verification</a>
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
                        <strong class="card-title">Manage Delivery Boy</strong>
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

                                <?php if($delivery_boy): 
                                    count($delivery_boy);
                                foreach($delivery_boy as $deli): ?>
                                <tr>
                                	<td>
                                		<a href="<?=  base_url('Super_admin/view_del_boy_rating/'.$deli->id) ?>" target="_blank">
                                        
                                        <img src="<?= base_url('public/images/avatar/64-2.jpg') ?>" id="delivery_boy_img">      
                                        </a>
                                
                                	</td>
                                    <td><?= $deli->name; ?></td>
                                    <td><a href="mailto:<?= $deli->email; ?>"><?= $deli->email; ?></a></td>
                                    <td><a href="tel:<?= $deli->mobile; ?>"><?= $deli->mobile; ?></a></td>
                                    <td><?= $deli->pincode; ?></td>
                                    <td><?= $deli->state; ?></td>
                                    <td><?= $deli->city; ?></td>
                                    <td><?= date('d M Y', strtotime($deli->added_date)); ?></td>
                                    <td>
                                        <?php if($deli->status == 'Active'): ?>
                                             <span class="badge badge-success" >Active</span>
                                        <?php elseif($deli->status == 'AdminVerification'): ?>
                                            <span class="badge badge-primary">AdminVerification</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">In Active</span>
                                            <?php endif; ?>
                                    </td>
                                    <td>
                                    	<?php if($deli->status == 'Active'): ?>
											<a  href="<?= base_url('Super_admin/change_delivery_boy_status/'.$deli->id.'/InActive'); ?>" class="btn btn-warning"><span class="fa  fa-eye-slash"></span></a>
                                        <?php else: ?>
                                             <a  href="<?= base_url('Super_admin/change_delivery_boy_status/'.$deli->id.'/Active'); ?>" class="btn btn-success">
                                                <span class="fa  fa-eye" style="color: white !important"></span>
                                             </a>
                                        <?php endif; ?>
										<a href="<?= base_url('Super_admin/edit_delivery_boy/'.$deli->id); ?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                                        <a href="<?= base_url('Super_admin/delete_Delivery_boy/'.$deli->id); ?>" class="btn btn-danger" onclick="return confirm('Confirmation ! Are You Sure You want to Delete this Delivery Boy ?')"><span class="fa fa-trash"></span></a>
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
<!-----Delivery Boy Modal Section Start ------->
<div class="modal fade" id="add_delivery_boy_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Delivery Boy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?= form_open('Super_admin/add_delivery_boy'); ?>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Name</label>
		    <input type="text" class="form-control" name="name" value="<?= set_value('name'); ?>" placeholder="Enter  Name">
		     <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'name'); ?></span>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email</label>
		    <input type="text" class="form-control" name="email" value="<?= set_value('email'); ?>" placeholder="Enter Email">
		     <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'email'); ?></span>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Mobile</label>
		    <input type="number" class="form-control" name="mobile" value="<?= set_value('mobile'); ?>" placeholder="Enter Mobile Number">
		      <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'mobile'); ?></span>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">PinCode</label>
		    <input type="text" class="form-control" name="pincode" name="<?= set_value('pincode'); ?>" onkeyup="get_pincodedetails_api()" id="pincode" placeholder="Enter PinCode">
		    <h6 id="pin_code_error" style="color: red;font-weight: 500;font-size: 14px;padding: 10px;display: none;">Invalid PinCode</h6>
		     <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'pincode'); ?></span>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">State</label>
		    <input type="text" id="state_name" name="state" value="<?= set_value('state'); ?>" class="form-control" placeholder="Enter State" readonly >
		     <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'state'); ?></span>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">City</label>
		    <input type="text" id="city_name" name="city" value="<?= set_value('city'); ?>" class="form-control" placeholder="Enter City" readonly>
		    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'city'); ?></span>
		  </div>
		   <div class="form-group">
		    <label for="exampleInputEmail1">Aadhar Number</label>
		    <input type="text" class="form-control" name="aadhar_number" value="<?= set_value('aadhar_number'); ?>" placeholder="Enter Aadhar Number">
		    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'aadhar_number'); ?></span>
		  </div>
		   <div class="form-group">
		    <label for="exampleInputEmail1">Password</label>
		    <input type="text" class="form-control" name="password" value="<?= set_value('password'); ?>" placeholder="Enter Secret Password">
		    <span style="color: red;font-weight: 500;font-size: 14px;"><?= display_error($validation,'password'); ?></span>
		  </div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Boy</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<!-----Delivery Boy Modal Section End ------->

<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->

<script type="text/javascript">
function get_pincodedetails_api(){
	var pincode=$('#pincode').val();
	if(pincode==''){
		$('#city_name').val('');
		$('#state_name').val('');
	}else{
		$.ajax({
			url:'<?= site_url('Super_admin/api_get_pincode'); ?>',
			type:'post',
			data:'pincode='+pincode,
			success:function(data){
				if(data=='no'){
					$('#pin_code_error').show();
					$('#city_name').val('');
					$('#state_name').val('');
				}else{
					$('#pin_code_error').hide();
					var getData=$.parseJSON(data);
					$('#city_name').val(getData.city);
					$('#state_name').val(getData.state);
				}
			}
		});
	}
}
</script>


</body>
</html>