<!-----Open Sound Html ----->
<div style="display: none;">
    <audio controls id="audioBox">
        <source src="<?= base_url('public/ordersound/Food Order Sound.mp3') ?>" type="audio/mpeg" />
    </audio>
</div>
<!-----Open Sound Html ----->

<script type="text/javascript">
    var audioBox = document.getElementById("audioBox"); 
    setInterval(function(){
        order_ringtone();
    },3000)
    function order_ringtone(){
        $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= base_url('Delivery_boy/order_ringtone_open/'); ?>',
            success:function(result){
                var data = JSON.parse(result);
                if (data.sound=='yes') {
                    // alert(data.sound);
                    audioBox.play();
                }else{
                    audioBox.pause();
                }
               
            },
            error:function(){
                // alert('Error! Technical Issue Contact with Administrator');
            }
        });
    }



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





</script>
