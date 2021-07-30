<!DOCTYPE html>
<html>
<head>
	<title>Technical Support Message</title>
		<!--------Css File Include ------>
<?= view('Home/css_file'); ?>
<!--------Css File Include ------>
<style type="text/css">

#container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

#container::after {
  content: "";
  clear: both;
  display: table;
}

#container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

#container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>
</style>

</head>
<body>
<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->
<!-----Body Sction Start ----->
<div class="breadcrumb-area gray-bg">
<div class="container">
<div class="breadcrumb-content">
	<div class="card">
	<div class="card-body">
	    <div class="container">
	    	<div class="row">
	    		<div class="col-12 col-lg-4 col-md-4 col-sm-4"></div>
	    		<div class="col-12 col-lg-4 col-md-4 col-sm-4">
	    			<h4 class="card-title box-title">Live Chat</h4>
					    <div class="card-content">
					    	<?php if($replay_msg):
					    	count($replay_msg);
					    	foreach($replay_msg as $msg): ?>
					    		<div class="container" id="container">
								  <img src="<?= base_url('public/images/avatar/khan.jpg'); ?>" alt="Avatar" style="width:50px;border-radius: 100%">
								  <p><?= $msg->message; ?></p>
								  <span class="time-right"><?=  $msg->time; ?></span>
								</div>
					    	<?php endforeach; else: ?>
					    <?php endif; ?>
					        
						<div class="container darker" id="container">
						  <img src="<?= base_url('public/images/avatar/64-1.jpg'); ?>" alt="Avatar" class="right" style="width:50px;border-radius: 100%">
						  <p id="user_message">Hey! I'm fine. Thanks for asking!</p>
						  <span class="time-left" id="user_time">11:01</span>
						</div>
						<div class="row">
							<div class="col-12 col-md-8 col-sm-8 col-lg-8">
								<input type="text" name="" class="form-control" id="type_user_message">
							</div>
							<div class="col-12 col-lg-4 col-md-4 col-sm-4">
								<button type="button" class="btn btn-primary" onclick="sent_message(<?= $msg->user_id; ?>);" style="height: 40px;width: 100%">Sent</button>
							</div>
						</div>

					</div>
	    		</div>
	    		<div class="col-12 col-lg-4 col-md-4 col-sm-4"></div>
	    	</div>
	    </div>
	</div> <!-- /.card-body -->
	</div><!-- /.card -->

</div>
</div>
</div>

<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>

<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
<script type="text/javascript">
	function sent_message(id){
		let msg = $('#type_user_message').val();
		// alert(msg);
		if(msg==''){
	        $('#type_user_message').val('');
	    }else{
	        $.ajax({
	            url:'<?= site_url('Home/sent_message/'); ?>'+id,
	            type:'post',
	            data:'msg='+msg,
	            success:function(result){
	                let data = $.parseJSON(result);
                    if (data.is_error == 'no') {
                    	$('#user_message').html(data.user_message);
                        $('#user_time').html(data.user_time);
                         $('#type_user_message').val('');
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