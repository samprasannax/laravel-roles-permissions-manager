  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dealers Stock     
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dealers Stock</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
                        <div class="col-sm-12">
                          @if(session()->get('success'))
                            <div class="alert alert-success">
                              {{ session()->get('success') }}  
                            </div>
                          @endif 
                        </div>


        <div class="col-xs-12">

            <div class="box">
            <div class="box-header">

              <h3 class="box-title">                
                 Stock Info               
              </h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Dealer Code</th>
                  <th>Dealer Name</th> 
                  <th>Vehicle Type</th> 
                  <th>Model</th>
                  <th>Color</th>                   
                  <th>Chassis No</th>
                  <th>Customer Name(Dealer)</th>
                  <th>DSC Name(Dealer)</th>
                  <th>Delivery Date(Dealer)</th>
                  <th>Status</th>
                  <th>Add Sale Info</th>
                  <th>Make Retrun</th>
                </tr>
                </thead>
                <tbody>
                  @if(!empty($dealer_stock_info))

                  @php($count=0)
                  @foreach ($dealer_stock_info as $dsi)
                  @php($count++)

                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ strtoupper($dsi->dealer_code) }}</td>
                          <td>{{ strtoupper($dsi->dealer_name) }}</td>
                          <td>{{ strtoupper($dsi->type_of_vehicle) }}</td>
                          <td>{{ strtoupper($dsi->model) }}</td>
                          <td>{{ strtoupper($dsi->type_of_color) }}</td>
                          <td>{{ strtoupper($dsi->chassis_no) }}</td>
                          <td>{{ strtoupper($dsi->assc_customer_name) }}</td>
                          <td>{{ strtoupper($dsi->assc_dsc_name) }}</td>   

                          <td>
                            <?php
                            if($dsi->delivery_date != '')
                            {
                              echo date("d-m-Y", strtotime($dsi->delivery_date));
                            }
                            ?> 
                          </td>

                          <td>
                            <?php

                            $stock_status = $dsi->stock_status;

                            if($stock_status == 0)
                            {
                              ?>
                              <button class="btn btn-info btn-xs">In Stock!</button>
                              <?php
                            }
                            else
                            {
                              ?>
                              <button class="btn btn-warning btn-xs">Sold!</button>
                              <?php
                            }
                            ?>
                          </td>


                          <td>                          
                           <button type="button"  onclick="update_assc(this)" class="btn btn-primary update-assc" data-id="{{ $dsi->id }}" data-toggle="modal" data-target="#modal-default" >Update</button>
                          </td>

                          <td> 
                            <?php
                              $stock_status = $dsi->stock_status;
                              $return_status = $dsi->return_status;

                              if($stock_status == 0 && $return_status == 0)
                              {

                              ?>

                             <button onclick="return_assc(this)" type="button" class="btn btn-success assc-return" data-id="{{ $dsi->id }}" data-toggle="modal" data-target="#modal-default" >Retrun</button>

                            <?php
                                }
                             ?>
                          </td>

                      </tr>
                  @endforeach

                  @endif
                
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



       <div class="modal fade" id="modal-default">
          <div class="modal-dialog">


            <div id="assc_new_user"  class="modal-content" style="display:block;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Dealer Sale Deatils</h4>
              </div>

              <div class="modal-body">

                        
                                  <!-- form start -->
                                  <form action="/insert_assc_sale_details" method="POST" enctype="multipart/form-data">
                                      @csrf
                                           <div class="box-body">
                                          <input  type="hidden" name="booking_order_id" id="booking_order_id">
                                          <input  type="hidden" name="unique_id" id="unique_id">
                                          <input  type="hidden" name="dealer_id" id="dealer_id">
                                          
                                          <div class="form-group">
                                            <label for="exampleName">Customer Name</label>
                                            <input type="text" class="form-control is-invalid" id="customer_name" name="customer_name" aria-describedby="exampleInputEmail1-error" placeholder="Customer Name" required="true">
                                          </div>
                                          
                                                                               
                                            <div class="form-group">
                                                <label for="exampleName">S/o | W/o | D/o</label>                                       
                                                       <select class="form-control select2" name="swd_category" id="swd_category" style="width:100%;" >
                                                        <option value="">-- Select Model--</option>
                                                          
                                                        <option value="S/o">S/o</option>
                                                        <option value="W/o">W/o</option>
                                                        <option value="D/o">D/o</option>
                                                           
                                                        </select>
                                            </div>
                                     

                                      

                                         
                                            <div class="form-group">
                                                <label for="exampleName">S/o | W/o | D/o Name</label>
                                                <input type="text" class="form-control" id="swd_name" name="swd_name" aria-describedby="emailHelp" placeholder="Name" >
                                            </div>
                                      
                                        
                                         <div class="form-group">
                                            <label for="exampleName">Contact No</label>
                                            <input type="text" class="form-control is-invalid" id="contact_no" name="contact_no" aria-describedby="exampleInputEmail1-error" >
                                          </div>


                                          <div class="form-group">
                                              <label for="exampleName">Address</label>
                                              <textarea class="form-control" id="description" rows="2" name="description" ></textarea>
                                          </div>
                                          
                                          
                                            <div class="form-group">
                                                  <label for="exampleName">HYP / CASH</label>
                                                 <select class="form-control select2" name="bank_id" id="bank_id"  style="width:230px">
                                                  <option  value="">Select</option>
                                                  <option value="0">CASH</option>
                                                  @foreach($banks as $bank)
                                                  <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                                  @endforeach

                                                </select>
                                            </div>
                                          
                                          

                                          <div class="form-group">
                                            <label for="exampleName">Sales Executive Name</label>
                                            <input type="text" class="form-control is-invalid" id="dsc_name" name="dsc_name" aria-describedby="exampleInputEmail1-error" placeholder="Sales Executive Name" >
                                          </div>

                                          <div class="form-group">
                                            <label for="exampleName">Delivery Date</label>
                                            <input type="date" class="form-control is-invalid" id="delivery_date" name="delivery_date" aria-describedby="exampleInputEmail1-error"  >
                                          </div>
                                          
                                           <div class="form-group">
                                            <label for="exampleName">RTO Date</label>
                                            <input type="date" class="form-control is-invalid" id="rto_date" name="rto_date" aria-describedby="exampleInputEmail1-error"  >
                                          </div>






                                        </div>
                                    <!-- /.box-body -->
                                     <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
                                
                                  </form>
                                
                
              </div>

             
            </div>




            <div id="assc_old_user"  class="modal-content" style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Dealers Sale Deatils</h4>
              </div>

              <div class="modal-body">
                                  <!-- form start -->
                                  <form action="/update_assc_sale_details" method="POST" enctype="multipart/form-data">
                                      @csrf
                                        <div class="box-body">
                                          <input  type="hidden" name="booking_order_id1" id="booking_order_id1">
                                          <input  type="hidden" name="unique_id1" id="unique_id1">
                                          <input  type="hidden" name="dealer_id1" id="dealer_id1">
                                          
                                          <div class="form-group">
                                            <label for="exampleName">Customer Name</label>
                                            <input type="text" class="form-control is-invalid" id="customer_name1" name="customer_name1" aria-describedby="exampleInputEmail1-error" placeholder="Customer Name" required="true">
                                          </div>
                                          
                                                                             
                                            <div class="form-group">
                                                <label for="exampleName">S/o | W/o | D/o</label>                                       
                                                       <select class="form-control select2" name="swd_category1" id="swd_category1" style="width:100%;">
                                                        <option value="">-- Select Model--</option>
                                                          
                                                        <option value="S/o">S/o</option>
                                                        <option value="W/o">W/o</option>
                                                        <option value="D/o">D/o</option>
                                                           
                                                        </select>
                                            </div>
                                     

                                      

                                         
                                            <div class="form-group">
                                                <label for="exampleName">S/o | W/o | D/o Name</label>
                                                <input type="text" class="form-control" id="swd_name1" name="swd_name1" aria-describedby="emailHelp" placeholder="Name" >
                                            </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="exampleName">Contact No</label>
                                            <input type="text" class="form-control is-invalid" id="contact_no1" name="contact_no1" aria-describedby="exampleInputEmail1-error" >
                                          </div>
                                        
                                         <div class="form-group">
                                              <label for="exampleName">Address</label>
                                              <textarea class="form-control" id="description1" rows="2" name="description1" ></textarea>
                                          </div>
                                          
                                          
                                         
                                             <div class="form-group">
                                                  <label for="exampleName">HYP / CASH</label>
                                                 <select class="form-control select2" name="bank_id1" id="bank_id1"  style="width:230px">
                                                  <option  value="">Select </option>
                                                  <option value="0">CASH</option>
                                                  @foreach($banks as $bank)
                                                  <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                                  @endforeach

                                                </select>
                                            </div>
                                       
                                        
                                        



                                          <div class="form-group">
                                            <label for="exampleName">Sales Executive Name</label>
                                            <input type="text" class="form-control is-invalid" id="dsc_name1" name="dsc_name1" aria-describedby="exampleInputEmail1-error" placeholder="Sales Executive Name" >
                                          </div>

                                          <div class="form-group">
                                            <label for="exampleName">Delivery Date</label>
                                            <input type="date" class="form-control is-invalid" id="delivery_date1" name="delivery_date1" aria-describedby="exampleInputEmail1-error" placeholder="Delivery Date" >
                                          </div>
                                          
                                          <div class="form-group">
                                            <label for="exampleName">RTO Date</label>
                                            <input type="date" class="form-control is-invalid" id="rto_date1" name="rto_date1" aria-describedby="exampleInputEmail1-error"  >
                                          </div>
                                          
                                          
                                          



                                         



                                        </div>
                                    <!-- /.box-body -->

                                     <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                
                                  </form>
              </div>
            </div>




                <div id="return_info"  class="modal-content" style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Dealers Retrun Info </h4>
              </div>

              <div class="modal-body" >

                        
                                  <!-- form start -->
                                  <form action="/check_assc_info" method="POST" enctype="multipart/form-data">

                                      @csrf
                                        <div class="box-body">
                                          <input  type="hidden" name="assc_booking_order_id" id="assc_booking_order_id">
                                          <input  type="hidden" name="assc_unique_id" id="assc_unique_id">
                                          <input  type="hidden" name="assc_dealer_id" id="assc_dealer_id">

                                          <input  type="hidden" name="vehicle_type" id="vehicle_type">
                                          <input  type="hidden" name="model_id" id="model_id">
                                          
                                          <div class="form-group">
                                            <label for="exampleName">Vehicle Chassis No</label>
                                            <input type="text" class="form-control is-invalid" id="return_chassis_no" name="return_chassis_no" aria-describedby="exampleInputEmail1-error"  required="true" readonly="true">
                                          </div>

                                          <div class="form-group">
                                            <label for="exampleName">Vehicle Amount</label>
                                            <input type="text" class="form-control is-invalid" id="assc_vehicle_amount" name="assc_vehicle_amount" aria-describedby="exampleInputEmail1-error"  required="true" readonly="true">
                                          </div>

                                          <div class="form-group">
                                            <label for="exampleName">Return Date</label>
                                            <input type="date" class="form-control is-invalid" id="return_date" name="return_date" aria-describedby="exampleInputEmail1-error"  required="true">
                                          </div>

                                          <div class="form-group">
                                              <label for="exampleName">Description</label>
                                              <textarea class="form-control" id="return_description" rows="6" name="return_description" ></textarea>
                                          </div>


                                          <div class="form-group" id="warranty_amount1" style="display:none;">
                                              <label for="exampleName">Warranty Amount.(For this vehicle we have send warranty. so we need to take return warranty card.)</label>
                                              <input type="text" class="form-control is-invalid" id="warranty_amount" name="warranty_amount" aria-describedby="exampleInputEmail1-error" value="0"  required="true" readonly="true">
                                          </div>


                                        </div>
                                    <!-- /.box-body -->

                                     <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                
                                  </form>
              </div>
            </div>



            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->





    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 @include('layouts.bottom-footer')
 <script>
   var app_url = "{{config('app.url')}}";  
</script>
 <script>

  $(function () {

    $('#example1').DataTable();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

    // $('#delivery_date').datepicker('setDate', 'today');
    // $('#delivery_date1').datepicker('setDate', 'today');
    // $('#return_date').datepicker('setDate', 'today');

// Update Assc Sale Details






  });
  
  
     function update_assc(ths){
           var unique_id = $(ths).attr('data-id');
                                               $("#assc_new_user").css("display", "none");
                                               $("#assc_old_user").css("display", "none");
                                                $("#return_info").css("display", "none");

                              $.ajax({


                                  type: "POST",
                                  url: app_url+'/fetch_assc_user_details',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {
                                     if(msg.length>0)
                                      {
                                        //alert("test");
                                          var count=1; 
                                          for(var i=0; i<msg.length; i++){

                                               if(msg[i].assc_customer_name!='' && msg[i].assc_dsc_name!='' && msg[i].delivery_date!='' && msg[i].stock_status!= 0 )
                                               {
                                                $("#assc_new_user").css("display", "none");
                                                $("#assc_old_user").css("display", "block");
                                              

                                                $("#unique_id1").val(msg[i].id);
                                                $("#booking_order_id1").val(msg[i].booking_order_id);
                                                $("#dealer_id1").val(msg[i].dealer_id);

                                                $("#customer_name1").val(msg[i].assc_customer_name);
                                                $("#dsc_name1").val(msg[i].assc_dsc_name);
                                                $("#delivery_date1").val(msg[i].delivery_date);
                                                
                                                $("#rto_date1").val(msg[i].rto_date);
                                                
                                                $('#swd_category1').val(msg[i].swd_category).trigger('change');
                                                 $("#contact_no1").val(msg[i].contact_no);
                                                 $("#swd_name1").val(msg[i].swd_name);
                                                
                                                
                                                
                                                
                                                $('textarea#description1').val(msg[i].description);

                                                  $('#bank_id1').val(msg[i].bank_id).trigger('change');

                                               }else{

                                                $("#unique_id").val(msg[i].id);
                                                $("#booking_order_id").val(msg[i].booking_order_id);
                                                $("#dealer_id").val(msg[i].dealer_id);

                                                $("#assc_new_user").css("display", "block");
                                                $("#assc_old_user").css("display", "none");

                                               }

                                            
                                          }
                                      }
                                      else
                                      {


                                              $("#assc_new_user").css("display", "block");
                                              $("#assc_old_user").css("display", "none");
                                              $("#return_info").css("display", "none");
                                             

                                      }
                                     
                                  }

                             });
     }



// Update Retun Value

    function return_assc(ths){

           var unique_id = $(ths).attr('data-id');

                                                $("#return_info").css("display", "none");
                                                $("#assc_new_user").css("display", "none");
                                                $("#assc_old_user").css("display", "none");
                                              
                              $.ajax({


                                  type: "POST",
                                  url: app_url+'/fetch_assc_retrun_details',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {
                                   
                                     if(msg.length>0)
                                      {
                                       
                                      

                                                $("#return_info").css("display", "block");
                                                $("#assc_new_user").css("display", "none");
                                                $("#assc_old_user").css("display", "none");

                                                $("#assc_unique_id").val(msg[0].id);
                                                $("#assc_booking_order_id").val(msg[0].booking_order_id);
                                                $("#assc_dealer_id").val(msg[0].dealer_id);

                                                $("#return_chassis_no").val(msg[0].chassis_no);
                                                $("#assc_vehicle_amount").val(msg[0].vehicle_amount);
                                                $("#vehicle_type").val(msg[0].vehicle_type_id);
                                                $("#model_id").val(msg[0].model_id);

                                                var warranty_status = msg[0].warranty_status;
                                                 
                                                 if(warranty_status == 1)
                                                 {
                                                    $("#warranty_amount1").css("display", "block");
                                                    $("#warranty_amount").val(msg[0].warranty_amount);
                                                 }
                                                 else
                                                 {
                                                   $("#warranty_amount").val('0');
                                                 }
                                               


                                      }
                                      else
                                      {


                                              $("#return_info").css("display", "none");
                                              $("#assc_new_user").css("display", "none");
                                              $("#assc_old_user").css("display", "none");
                                                                                         

                                      }
                                     
                                  }

                             });
     }

</script>
