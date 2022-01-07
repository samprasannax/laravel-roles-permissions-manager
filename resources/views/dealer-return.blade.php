  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dealer Stock Return   
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dealer Stock Return</li>
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
                 Stock Return Info                
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
                  <th>Return Date</th>
                  <th>Return Description</th>
                 <!--  <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                  @if(!empty($dealer_stock_info))
                  @php($count=0)
                  @foreach ($dealer_stock_info as $dsi)
                  @php($count++)

                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ $dsi->dealer_code }}</td>
                          <td>{{ $dsi->dealer_name }}</td>
                          <td>{{ $dsi->type_of_vehicle }}</td>
                          <td>{{ $dsi->model }}</td>
                          <td>{{ $dsi->type_of_color }}</td>
                          <td>{{ $dsi->chassis_no }}</td>
                          <td>{{ date("d-m-Y", strtotime($dsi->return_date)) }}</td>
                          <td>{{ $dsi->return_description }}</td>   

                        

                          <!--
                          <td>                          
                           <a href="/delete_assc_return/{{$dsi->id}}"><button type="button"  onclick="return confirm('Are you sure want to delete?')" class="btn btn-primary update-assc">Delete the Retrun</button></a>
                          </td>
                          -->
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
                                            <label for="exampleName">Sales Executive Name</label>
                                            <input type="text" class="form-control is-invalid" id="dsc_name" name="dsc_name" aria-describedby="exampleInputEmail1-error" placeholder="Sales Executive Name" required="true">
                                          </div>

                                          <div class="form-group">
                                            <label for="exampleName">Delivery Date</label>
                                            <input type="text" class="form-control is-invalid" id="delivery_date" name="delivery_date" aria-describedby="exampleInputEmail1-error"  required="true">
                                          </div>



                                          <div class="form-group">
                                              <label for="exampleName">Description</label>
                                              <textarea class="form-control" id="description" rows="6" name="description" ></textarea>
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

              <div class="modal-body" >

                        
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
                                            <label for="exampleName">Sales Executive Name</label>
                                            <input type="text" class="form-control is-invalid" id="dsc_name1" name="dsc_name1" aria-describedby="exampleInputEmail1-error" placeholder="Sales Executive Name" required="true">
                                          </div>

                                          <div class="form-group">
                                            <label for="exampleName">Delivery Date</label>
                                            <input type="text" class="form-control is-invalid" id="delivery_date1" name="delivery_date1" aria-describedby="exampleInputEmail1-error" placeholder="Sales Executive Name" required="true">
                                          </div>



                                          <div class="form-group">
                                              <label for="exampleName">Description</label>
                                              <textarea class="form-control" id="description1" rows="6" name="description1" ></textarea>
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
                                            <input type="text" class="form-control is-invalid" id="return_date" name="return_date" aria-describedby="exampleInputEmail1-error"  required="true">
                                          </div>

                                          <div class="form-group">
                                              <label for="exampleName">Description</label>
                                              <textarea class="form-control" id="return_description" rows="6" name="return_description" ></textarea>
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

    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

    $('#delivery_date').datepicker('setDate', 'today');
    $('#delivery_date1').datepicker('setDate', 'today');
    $('#return_date').datepicker('setDate', 'today');

// Update Assc Sale Details

      $('.update-assc').click(function(){
           var unique_id = $(this).attr('data-id');
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
                                                $('textarea#description1').val(msg[i].description);



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
     });



// Update Retun Value

      $('.assc-return').click(function(){
           var unique_id = $(this).attr('data-id');

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
                                        //alert("test");
                                          var count=1; 
                                          for(var i=0; i<msg.length; i++){

                                              
                                                $("#return_info").css("display", "block");
                                                 $("#assc_new_user").css("display", "none");
                                                $("#assc_old_user").css("display", "none");

                                                $("#assc_unique_id").val(msg[i].id);
                                                $("#assc_booking_order_id").val(msg[i].booking_order_id);
                                                $("#assc_dealer_id").val(msg[i].dealer_id);

                                                $("#return_chassis_no").val(msg[i].chassis_no);
                                                $("#assc_vehicle_amount").val(msg[i].vehicle_amount);
                                                 $("#vehicle_type").val(msg[i].vehicle_type_id);
                                                $("#model_id").val(msg[i].model_id);
                                               


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
     });






  });
</script>
