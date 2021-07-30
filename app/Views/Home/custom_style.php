<style type="text/css">
    .btn-flat:hover{background: #ff3d00;color: white}
    .product-sorting-wrapper{width: 100% ;}
    .product-sorting-wrapper .product-show{float: right;}
    .dish_radio{width: 16px;height: 12px;margin-right: 5px;}
    #preloader{margin-top: 15%;}
    #add_money_box{display: flex;}
     #search_category li:first-child{width: 250px;outline: none; }

     .product-sorting-wrapper{width: 100% ;}
    .product-sorting-wrapper .product-show{float: right;}
    .dish_radio{width: 16px;height: 12px;margin-right: 5px;}
    .btn-flat:hover{background: #ff3d00;color: white}
</style>

<div class="container" style="margin-left: 40%;width: 50%;display: none;">
	<!-----Alert Message Show script ------>
<div id="messages" class="hide" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div id="messages_content"></div>
</div>
<!-----Alert Message Show script ------>


</div>

<!-- Modal -->
<div class="container">
    <div class="modal" id="preloader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding: 0px;">
        <h5 style="padding: 5px;font-size: 22px;font-weight: 500">Please Wait...</h5>
        <center>
            <img src="<?= base_url('public/images/spinner.gif'); ?>" style="width: 100%;height: 150px;">
        </center>
            
        </div>
      <div class="modal-content" style="padding: 10px;">
        <h6 id="preloader_heading" style="margin-top: 0px;font-weight: 500"></h6>
        
    </div>
    </div>
  </div>
</div>
</div>
<!-----Preloder Modal Section End ---->


