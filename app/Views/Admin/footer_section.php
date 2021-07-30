 <style type="text/css">
     #drop_down_css{width: 180px !important;}
     #drop_down_css a{color: grey; font-size: 14px;font-weight:700;}
     #drop_down_css li a{border-bottom: 1px solid silver; margin-left: 15px; padding: 5px;}
     #drop_down_css li a:hover{background: black;color: white }
     td{font-size: 12px;font-weight: 700}
       .widget .weatherInfo .temperature {
         flex: 0 0 40%;
         width: 100%;
         font-size: 65px;
         display: flex;
         justify-content: space-around;
         }
        .widget .weatherInfo .description .weatherCondition {
         text-transform: uppercase;
         font-size: 35px;
         font-weight: 100;
         }
         .widget .weatherInfo .description .place {
         font-size: 15px;
         }
           .widget .date {
         flex: 0 0 30%;
         height: 40%;
         background: #70C1B3;
         border-bottom-right-radius: 20px;
         display: flex;
         justify-content: space-around;
         align-items: center;
         color: white;
         font-size: 30px;
         font-weight: 800;
         }
          .widget .weatherInfo .description {
         flex: 0 60%;
         display: flex;
         flex-direction: column;
         width: 100%;
         height: 100%;
         justify-content: center;
         margin-left:-15px;
         }
         .widget .weatherInfo {
         flex: 0 0 70%;
         height: 40%;
         background: darkslategray;
         border-bottom-left-radius: 20px;
         display: flex;
         align-items: center;
         color: white;
         }
         .widget .weatherInfo .temperature {
         flex: 0 0 40%;
         width: 100%;
         font-size: 65px;
         display: flex;
         justify-content: space-around;
         }
          .widget .weatherIcon {
         flex: 1 100%;
         height: 60%;
         border-top-left-radius: 20px;
         border-top-right-radius: 20px;
         background: #FAFAFA;
         font-family: weathericons;
         display: flex;
         align-items: center;
         justify-content: space-around;
         font-size: 100px;
         }
         .widget .weatherIcon i {
         padding-top: 30px;
         }

 </style>

 <!-- Content -->
<div class="content">
<!-- Animated -->
<div class="animated fadeIn">
<!-- Widgets  -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-2">
                        <i class="pe-7s-cart"></i>
                    </div>
                    <div class="stat-content">
                        <div class="row">
                            <div class="col-12 col-lg-8 col-md-8 col-sm-8">
                                <div class="text-left dib">
                                    <div class="stat-text"><span id="show_orders"></span></div>
                                    <div class="stat-heading" id="show_order_heading">Revenue</div>    
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                                <div class="btn-group dropright" style="cursor: pointer;" >
                                  <span class="fa fa-ellipsis-v  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 
                                  </span>
                                  <div class="dropdown-menu" id="drop_down_css">
                                    <!-- Dropdown menu links -->
                                    <li><a href="#!" onclick="count_admin_orders('today')">Today Order</a></li>
                                        <li><a href="#!" onclick="count_admin_orders('yesterday')">Privious Day Order</a></li>
                                        <li><a href="#!" onclick="count_admin_orders('last_30_days')">Last 30 Days Orders</a></li>
                                        <div class="divider"></div>
                                        <li><a href="#!" onclick="count_admin_orders('all')">All Orders</a></li>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-five">
                
                <div class="stat-icon dib flat-color-1">
                    <i class="pe-7s-cash"></i>
                </div>
                <div class="stat-content">
                    <div class="row">
                        <div class="col-12 col-lg-8 col-md-8 col-sm-8">
                            <div class="text-left dib">
                                <div class="stat-text"><span id="show_income"></span></div>
                                <div class="stat-heading" id="show_income_heading">Income</div></div>
                        </div>
                        <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                            <div class="btn-group dropright" style="cursor: pointer;" >
                              <span class="fa fa-ellipsis-v  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             
                              </span>
                              <div class="dropdown-menu" id="drop_down_css">
                                <!-- Dropdown menu links -->
                                <li><a href="#!" onclick="count_admin_income('today')">Today Order</a></li>
                                    <li><a href="#!" onclick="count_admin_income('yesterday')">Privious Day Order</a></li>
                                    <li><a href="#!" onclick="count_admin_income('last_30_days')">Last 30 Days Orders</a></li>
                                    <div class="divider"></div>
                                    <li><a href="#!" onclick="count_admin_income('all')">All Orders</a></li>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
<div class="card">
    <div class="card-body">
        <div class="stat-widget-five">
            <div class="stat-icon dib flat-color-3">
                <i class="pe-7s-browser"></i>
            </div>
            <div class="stat-content">
                <div class="row">
                    <div class="col-12 col-lg-8 col-md-8 col-sm-8">
                        <div class="text-left dib">
                            <div class="stat-text"><span id="show_restaurent">
                                <?php $total_rest = get_total_all_records('restaurent');
                                    if ($total_rest) {
                                        echo count($total_rest);
                                    }else{
                                        echo "0";
                                    }
                                 ?>
                            </span></div>
                            <div class="stat-heading">Total Restaurent</div></div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="card">
    <div class="card-body">
        <div class="stat-widget-five">
            <div class="stat-icon dib flat-color-4">
                <i class="pe-7s-users"></i>
            </div>
            <div class="stat-content">
                <div class="text-left dib">
                    <div class="stat-text"><span class="count">
                         <?php $total_users = get_total_all_records('users_master');
                            if ($total_users) {
                                echo count($total_users);
                            }else{
                                echo "0";
                            }
                         ?>
                    </span></div>
                    <div class="stat-heading">Total Visited Users</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
                <!-- /Widgets -->

<!--  /Traffic -->
<div class="clearfix"></div>
<!-- Orders -->
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title" style="border-bottom: 1px solid silver">Last 30 Days Orders </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <div id="Admin_order_chart" style="height: 300px; width: 100%;"></div>
                    </div> <!-- /.table-stats -->
                </div>
            </div> <!-- /.card -->
        </div>  <!-- /.col-lg-8 -->

    </div>
</div>


<!-- /.orders -->
<!-- To Do and Live Chat -->
<div class="row">
<div class="col-lg-6">
<div class="card">
    <div class="card-body">
        <h4 class="card-title box-title">Total Delivery Boy</h4>
        <div class="card-content">
            <div class="todo-list">
                <div class="tdl-holder">
                    <div class="tdl-content">
                        <center>
                            <h6 style="font-weight: 800">
                                <img src="<?= base_url('public/images/slo1.jpg') ?>" style="width: 70px;border-radius: 100%">

                            (<?php $get_del_boy =  get_total_delivery_boy();
                                if ($get_del_boy) {
                                  echo count($get_del_boy);
                                }
                            ?> )                       
                             </h6>
                        </center>

                    </div>

                </div>
            </div> <!-- /.todo-list -->
        </div>
    </div> <!-- /.card-body -->
</div><!-- /.card -->
</div>





<div class="col-lg-6">
<div class="card">
<div class="card-body">
<h4 class="card-title box-title">Contact us Message</h4>
<div class="card-content">
    <div class="messenger-box">
            <table class="table table-responsive">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
                <?php
                    $args = [
                        'response'  => 'Not-replay'
                    ]; 
                    $contact_us =  get_user_support_mesg_using_status('contact_us',$args);
                    if($contact_us):
                        foreach($contact_us as $con_msg):
                ?>
                <tr>
                    <td>
                        <?= $con_msg->name; ?>
                    </td>
                    <td>
                        <a href="mailto:<?= $con_msg->email; ?>"><?= $con_msg->email; ?></a>
                    </td>
                    <td>
                        <a href="tel:<?= $con_msg->mobile; ?>"><?= $con_msg->mobile; ?></a>
                    </td>
                    <td>
                        <?= $con_msg->subject; ?>
                    </td>
                    <td>
                        <?= $con_msg->message; ?>
                    </td>
                    <td>
                        <?= date('d M Y',strtotime($con_msg->added_on)); ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                    <h6 style="color: red">No Data Found</h6>
                <?php endif; ?>

            </table>
    </div><!-- /.messenger-box -->
</div>
</div> <!-- /.card-body -->
</div><!-- /.card -->
</div>
</div>
                <!-- /To Do and Live Chat -->
                <!-- Calender Chart Weather  -->
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="box-title">Chandler</h4> -->
                                <div class="calender-cont widget-calender">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div><!-- /.card -->
                    </div>

                   
                    <div class="col-lg-8 col-md-6">
                        <div class="card weather-box">

                            <h4 class="weather-title box-title">Check City Weather</h4>
                            <div class="card-body" style="border-bottom: 1px solid silver">
                                <div class="weather-widget">
                                    <div id="weather-one" class="weather-one">
                                        <?= form_open('Super_admin/get_weather_details_api'); ?>
                                        <div class="row">
                                            <div class="col-12 col-lg-9 col-md-9 col-sm-9">
                                                <input type="text" name="check_weather" value="<?= set_value("check_weather"); ?>" class="form-control" placeholder="Enter City Name">
                                            </div>
                                            <div class="col-12 col-lg-3 col-md-3 col-sm-3">
                                                <button type="submit" class="btn btn-primary">Check Weather</button>

                                            </div>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                   <div class="container">
                                    <?php if($weather_data): ?>
                                       <article class="widget">
                                             <div class="weatherIcon">
                                                <img src="http://openweathermap.org/img/wn/<?php echo $weather_data['weather'][0]['icon']?>@4x.png"/>
                                             </div>
                                             <div class="weatherInfo">
                                                <div class="temperature">
                                                   <span><?php echo round($weather_data['main']['temp']-273.15)?>°</span>
                                                </div>
                                                <div class="description mr45">
                                                   <div class="weatherCondition"><?php echo $weather_data['weather'][0]['main']?></div>
                                                   <div class="place"><?php echo $weather_data['name']?></div>
                                                </div>
                                                <div class="description">
                                                   <div class="weatherCondition">Wind</div>
                                                   <div class="place"><?php echo $weather_data['wind']['speed']?> M/H</div>
                                                </div>
                                             </div>
                                             <div class="date">
                                               <?php echo date('d M',$weather_data['dt'])?> 
                                                 
                                             </div>
                                        </article>
                                    <?php else: ?>
                                    <?php endif; ?>
                                   </div>
    
                                </div>


                                </div>
                            </div>
                        </div><!-- /.card -->
                        

                    </div>
                </div>
                <!-- /Calender Chart Weather -->
                <!-- Modal - Calendar - Add New Event -->
                <div class="modal fade none-border" id="event-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Add New Event</strong></h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /#event-modal -->
                <!-- Modal - Calendar - Add Category -->
                <div class="modal fade none-border" id="add-category">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Add a category </strong></h4>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Category Name</label>
                                            <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Choose Category Color</label>
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                                <option value="success">Success</option>
                                                <option value="danger">Danger</option>
                                                <option value="info">Info</option>
                                                <option value="pink">Pink</option>
                                                <option value="primary">Primary</option>
                                                <option value="warning">Warning</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /#add-category -->
            </div>
            <!-- .animated -->

      
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

        <!--Local Stuff-->
