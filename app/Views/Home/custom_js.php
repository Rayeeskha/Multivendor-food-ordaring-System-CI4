<script type="text/javascript">
	  function add_to_cart(id){
        let attribute = $('input[name="radio_attr"]:checked').val();
        if (attribute == null) {
            alert('Please Select Attribute First !');
        }else{
             $.ajax({
                type:'ajax',
                method:'GET',
                url:'<?= site_url('Home/add_to_cart/'); ?>'+id+'/'+attribute,
                beforeSend:function(data){
                    $('#preloader').modal('show');
                    $('#preloader_heading').text('Fetching dish details......');
                },
                success:function(data){
                    $('#preloader').modal('hide');
                    if (data == "1") {
                       $('#messages').removeClass('hidden').addClass('alert alert-success ');
                        $('#messages_content').html('Congratulation ! Dish Added Succeesfully in your Carts !');
                        location.reload();
                         calculate_carts_product();
                        //Show cart modal function in frontent
                         //Show cart modal function in frontent
                    }else{
                        $('#messages').removeClass('hidden').addClass('alert alert-danger ');
                        $('#messages_content').html('Failed ! Sorry Unable to added Carts!');
                    }
                },
                error:function(){
                    alert('Error! Technical Issue Contact with Administrator');
                }

            });
        }
    }

    function view_carts_products(id){
        if (id) {
           window.location.href='<?= site_url('Home/view_carts/') ?>'+id; 
        }else{
            alert('Please add Products!');
        }
        
    }




    function delete_dish_in_carts(id, is_type){
        $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= site_url('Home/delete_dish_in_carts/'); ?>'+id,
            success:function(data){
                if (data==1) {
                    if(is_type==='load'){
                        alert('Congratulation ! Dish Deleted Succesfully ');
                        window.location.href=window.location.href;
                    }else{
                       alert('Congratulation ! Dish Deleted Succesfully ');
                       location.reload();
                        // window.location.href=window.location.href; 
                    }
                }else{
                    alert('Failed ! Sorry Unable to Deleted');
                }
            },
            error:function(){
                // alert('Error! Technical Issue Contact with Administrator');
            }
        });
    }


    //Update Quantity Script Start 
    function update_quantity(type,product_id,id){
        let qname   = "quantity_" +id;
        let quantity  = $('input[name="'+qname+'"]').val();
        // alert(quantity);
        $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= site_url('Home/update_quantity/'); ?>'+quantity+'/'+type+ '/'+product_id+'/'+id,
            beforeSend:function(data){
                $('#preloader').modal('show');
                $('#preloader_heading').text('Update Product Quantity...');
            },
            success:function(data){
                $('#preloader').modal('hide');
                if (data == "1") {
                    $('#messages').removeClass('hidden').addClass('alert alert-success ');
                    $('#messages_content').html('Congratulation ! Quantity Updated Succesfully!');
                    // location.reload();
                    window.location.href=window.location.href;
                }else{
                    M.toast({html:'Fail ! Product Quantity Not Descrease It Must be Greater than 1 !'});
                    $('#messages').removeClass('hidden').addClass('alert alert-danger ');
                    $('#messages_content').html('Fail ! Product Quantity Not Descrease It Must be Greater than 1 !');
                }
            },
            error:function(){
                alert('Error! Technical Issue Contact with Administrator');
            }

        });
    }
    //Update Quantity Script Start 


        //Calculate Carts Product Script
    calculate_carts_product(); 
    function calculate_carts_product(){
        $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= base_url('Home/calculate_carts_products/'); ?>',
          
            success:function(data){
                var json_data = JSON.parse(data);
                $('#total_products').html(json_data.total_products);
                $('#total_amount').html(json_data.total_amount);
                 // location.reload();
            },
            error:function(){
                // alert('Error! Technical Issue Contact with Administrator');
            }
        });
    }
    //Calculate Carts Product Script


    //Search Restaurent Script
     $('body').click(function(){
        $('#show_product_list').hide();
    });
    function search_restaurent(val){
        if (val.length > 1) {
            $.ajax({
                type:'ajax',
                method:'GET',
                url:'<?= site_url('Home/search_restaurent/'); ?>'+val,
                beforeSend:function(data){
                    
                },
                success:function(data){
                    $('#show_product_list').show();
                    $('#show_product_list').html(data);
                    
                },
                error:function(){
                    alert('Error! Please Enter Restaurent Name');
                }

            });
        }
    } 
    //Search Restaurent Script


    //Get Pincode  Api state city

function get_pincodedetails_api(){
    var pincode=$('#pincode').val();
    if(pincode==''){
        $('#city').val('');
        $('#state').val('');
    }else{
        $.ajax({
            url:'<?= site_url('Super_admin/api_get_pincode'); ?>',
            type:'post',
            data:'pincode='+pincode,
            success:function(data){
                if(data=='no'){
                    $('#pin_error').show();
                    $('#city').val('');
                    $('#state').val('');
                }else{
                    $('#pin_error').hide();
                    var getData=$.parseJSON(data);
                    $('#city').val(getData.city);
                    $('#state').val(getData.state);
                }
            }
        });
    }
}
    //Get Pincode  Api state city




    //Applied Coupon Code Script
      function apply_coupn(){
        let coupon_code = $('#coupon_code').val();
        if (coupon_code == '') {
            $('#coupon_code_error').html('Please Enter Coupon Code');
        }else{
           $.ajax({
                type:'ajax',
                method:'POST',
                url:'<?= base_url('Home/discount_coupn_code/'); ?>',
                data:'coupon_code='+coupon_code,
              
                success:function(result){
                    let data = $.parseJSON(result);
                    if (data.is_error == 'yes') {
                        $('#coupan_box').hide();
                        $('#coupon_code_error').html(data.dd);
                        $('#coupon_code_success').hide();
                    }
                    if (data.is_error== 'no') {
                        $('#coupan_box').show();
                        $('#coupan_price').html(data.dd);
                        $('#total_discount_price').html(data.result);
                        $('#coupon_code_success').html('Coupon Applied Successfully');
                    }

                },
            });
        }
    }
    //Applied Coupon Code Script


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


//Update Dish Rating Script Start
      function update_dish_rating(id, order_id){
        // alert(order_id);
        let dish_rate = $('#dish_rate'+id).val();
        let dish_str = $('#dish_rate'+id+' option:selected').text();
        if (dish_rate == '') {
            // $('#coupon_code_error').html('Please Enter Coupon Code');
        }else{
           $.ajax({          
                type:'ajax',
                method:'POST',
                url:'<?= site_url('Home/update_dish_rating/'); ?>'+id,
                data:'dish_rate='+dish_rate+'&order_id='+order_id,
                success:function(result){
                    $('#rating'+id).html("<div class='set_ratings'>"+dish_str+"</div>");
                    // console.log(result);

                },
            });
        }
    }

    function update_deliboy_rating_rating(id, order_id){
        // alert(order_id);
        let deliboy_rate = $('#deliboy_rate'+id).val();
        let dish_str = $('#deliboy_rate'+id+' option:selected').text();
        if (deliboy_rate == '') {
            // $('#coupon_code_error').html('Please Enter Coupon Code');
        }else{
           $.ajax({          
                type:'ajax',
                method:'POST',
                url:'<?= site_url('Home/update_deliboy_rating/'); ?>'+id,
                data:'deliboy_rate='+deliboy_rate+'&order_id='+order_id,
                success:function(result){
                    $('#deliboyrating_'+id).html("<div class='set_ratings'>"+dish_str+"</div>");
                    // console.log(result);

                },
            });
        }
    }

//Update Dish Rating Script End
</script>

