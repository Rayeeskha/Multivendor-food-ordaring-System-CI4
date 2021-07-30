<script type="text/javascript">

//Show Hide Passsword Script 
var state= false;
function toggle(){
    if(state){
        document.getElementById("password").setAttribute("type","password");
        document.getElementById("confirm_password").setAttribute("type","password");
        document.getElementById("eye").style.color='#7a797e';
        state = false;
    }
    else{
        document.getElementById("password").setAttribute("type","text");
        document.getElementById("confirm_password").setAttribute("type","text");
        document.getElementById("eye").style.color='#5887ef';
        state = true;
    }
}
//Show Hide Passsword Script


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
          $('#pincode_error').show();
          $('#city_name').val('');
          $('#state_name').val('');
        }else{
          $('#pincode_error').hide();
          var getData=$.parseJSON(data);
          $('#city_name').val(getData.city);
          $('#state_name').val(getData.state);
        }
      }
    });
  }
}


	
</script>