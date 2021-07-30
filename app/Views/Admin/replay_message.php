<!DOCTYPE html>
<html>
<head>
	<title>Replay Message</title>
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

<!------Body Section Start ------>
<div class="breadcrumbs" >
<div class="breadcrumbs-inner">
<div class="row m-0">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Support Message</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                 	<li><a href="#">Support Message</a></li>
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
<div class="col-lg-12">
<div class="card">
<div class="card-body">
    <h4 class="card-title box-title">Live Chat</h4>
    <div class="card-content">
        <div class="messenger-box">

            <ul>
            	<?php if($replay_msg): 
                ?>
                	<li>
	                    <div class="msg-received msg-container">
	                		<div class="avatar">
	                           <img src="<?= base_url('public/images/avatar/64-1.jpg'); ?>" alt="">
	                           <div class="send-time"><?= date('h:i:s', strtotime($replay_msg[0]->added_on)); ?></div>
	                        </div>
	                        <div class="msg-box">
	                            <div class="inner-box">
	                                <div class="name">
	                                    <?= $replay_msg[0]->name; ?>
	                                </div>
	                                <div class="meg">
	                                    <?= $replay_msg[0]->message; ?>
	                                </div>
	                            </div>
	                        </div>
		             
               		</div>
               	</li>
               <?php endif; ?>
                <!-- /.msg-received -->

                <?php $get_cus_msg =  get_message_details('chating_customer', $replay_msg[0]->user_id, '2');
                    // var_dump($get_cus_msg);
                 ?>

               	<!-----Next Message Should Be there ----->
                <?php if($get_cus_msg):
                foreach($get_cus_msg as $cust_msg): ?>
                    <li>
                        <div class="msg-received msg-container">
                            <div class="avatar">
                               <img src="<?= base_url('public/images/avatar/64-1.jpg'); ?>" alt="">
                               <div class="send-time"><?= date('h:i:s', strtotime($cust_msg->time)); ?></div>
                            </div>
                            <div class="msg-box">
                                <div class="inner-box">
                                    <div class="name">
                                        <?= $replay_msg[0]->name; ?>
                                    </div>
                                    <div class="meg">
                                        <?= $cust_msg->message; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                <?php endforeach; else: ?>
            <?php endif; ?>
                

               	<!-----Next Message Should Be there ----->
               
                <li>
                	
                    <div class="msg-sent msg-container">
                        <div class="avatar">
                           <img src="<?= base_url('public/images/avatar/khan.jpg'); ?>" alt="">
                           <div class="send-time" id="admin_send_time">11.11 am</div>
                        </div>
                        <div class="msg-box">
                            <div class="inner-box">
                                <div class="name" id="admin_name">
                                   Khan Rayees
                                </div>
                                <div class="meg" id="adminmesage">
                                    Hay how are you doing?
                                </div>
                            </div>
                        </div>
                    </div><!-- /.msg-sent -->
                </li>
            </ul>
            <div class="send-mgs">
                <div class="yourmsg">
                    <input class="form-control" type="text" placeholder="Type Message ..." id="type_message">
                </div>
                <button class="btn msg-send-btn" onclick="sent_message(<?= $replay_msg[0]->user_id; ?>);">
                    <i class="pe-7s-paper-plane"></i>
                </button>
            </div>
        </div><!-- /.messenger-box -->
    </div>
</div> <!-- /.card-body -->
</div><!-- /.card -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!------Body Section End ------>


<!------Js File Include ------->
<?= view('Admin/js_file'); ?>
<!------Js File Include ------->	

<script type="text/javascript">
	function sent_message(id){
		let msg = $('#type_message').val();
		// alert(msg);
		if(msg==''){
	        $('#type_message').val('');
	    }else{
	        $.ajax({
	            url:'<?= site_url('Super_admin/sent_message/'); ?>'+id,
	            type:'post',
	            data:'msg='+msg,
	            success:function(result){
	                let data = $.parseJSON(result);
                    if (data.is_error == 'no') {
                    	$('#admin_name').html(data.adminname);
                        $('#adminmesage').html(data.adminmessage);
                        $('#admin_send_time').html(data.adminmsg_time);
                         $('#type_message').val('');
                    }
                    if (data.is_error== 'yes') {
                       alert('Failed');
                    }
	            }
	        });
	    }
	}


</script>

</body>
</html>