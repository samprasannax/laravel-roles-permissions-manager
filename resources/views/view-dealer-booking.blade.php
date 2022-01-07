  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       View  Dealers Booking  
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/dealer-booking">View Booking</a></li>
        <li class="active">View Dealers Booking Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">           
            <!-- /.box-header -->
            <!-- form start -->
          

                 <div class="box-body">
                
                  <!-- Booking Info -->

                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Booking Info</h3>
                  </div>
                  <input type="hidden" name="order_id" id="order_id" value="{{ $fetch_dealer_booking[0]->order_id }}">
                

                    <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleName">Date</label>
                          <input class="form-control" type="text" name="booking_date" id="booking_date" value="{{ $fetch_dealer_booking[0]->booking_date }}"required="true">
                        </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Dealer Name</label>
                        <select class="form-control select2" name="dealer_id" id="dealer_id"  required="true" disabled="true">
                          <option value="">Select </option>
                         @foreach($sub_dealers as $sub_dealer)
                             <option value="{{$sub_dealer->id}}" @if($sub_dealer->id==$fetch_dealer_booking[0]->dealer_id) selected @endif >{{strtoupper($sub_dealer->dealer_name)}}</option>
                          @endforeach
                           
                        </select>
                      </div>
                    </div>

                     <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Total Qty</label>
                         <input class="form-control" type="text" name="vehicle_qty" id="vehicle_qty" value="{{ $fetch_dealer_booking[0]->total_qty }}" readonly="true" onkeypress="javascript:return isNumber(event)"   required="true">
                      </div>
                    </div>

                    <div class="col-sm-2">



                      <div class="form-group">
                        <label for="exampleName">Total Amount</label>

                        <input type="hidden" name="old_total_amount" id="old_total_amount" value="{{ $fetch_dealer_booking[0]->total_amount }}">
                         <input class="form-control" type="text" name="total_amount" id="total_amount"  readonly="true" onkeypress="javascript:return isNumber(event)" value="{{ $fetch_dealer_booking[0]->total_amount }}"  required="true">
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Description</label>
                          <textarea class="form-control" id="dealer_booking_description" rows="3" name="dealer_booking_description">{{ $fetch_dealer_booking[0]->booking_description }}</textarea>
                      </div>
                    </div>



                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Vehicle Info</h3>
                  </div>


                   
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Sr.No</th>
                              <th>Vehicle Type</th>
                              <th>Model Name</th> 
                              <th>Color</th> 
                              <th>Vehicle Amount</th> 
                              <th>Chassis No</th>               
                              <th>Book No</th><!-- 
                              <th>Return Status</th>  -->                     
                              <!-- <th>Action</th> -->
                              <!-- <th>Return</th> -->
                            </tr>
                            </thead>
                            <tbody id="temp-vehicle-list">
                              
                                                        
                            </tbody>
                           
                          </table>
            


                  </div>
              <!-- /.box-body -->



          </div>
          <!-- /.box -->

        
        </div>
        <!--/.col (left) -->
     
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


 @include('layouts.bottom-footer')

<script>
   var app_url = "{{config('app.url')}}";  
</script>

<script>
   $('#booking_date').datepicker('setDate', 'today');
</script>

<script>
  $(function(){


   


     $('#vehicle_type').on('change', function() {

           //  alert(app_url);

            var vehicle_type = $("#vehicle_type").val();
           
           //   alert("On Change" + $("#model_id").val()  + $("#color_id").val() );

              $.ajax({
                type: "POST",
                url: app_url+'/fetch_dealer_stock_model_list',
                data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type },
                success: function( msg ) {
                     
                            if(msg.length>0)
                            { 
                              $('#model_id').empty();
                              $('#model_id').append(`<option value=""> 
                                       Select
                                  </option>`); 

                              for(var i=0; i<msg.length; i++){

                                 $('#model_id').append(`<option value="${msg[i].id}"> 
                                       ${msg[i].model}
                                  </option>`); 
                               }                              
                                                     
                             }
                             else
                             {
                              $('#model_id').empty();
                                $('#model_id').append(`<option value=""> 
                                       Select
                                  </option>`); 


                               $('#model_id').append(`<option value=""> 
                                       In this type model not available in stock!!
                                  </option>`); 

                            
                             }

                }
            });
     });



         $('#color_id').on('change', function() {

            var vehicle_type = $("#vehicle_type").val();
            var model_id = $("#model_id").val();
              $.ajax({
                type: "POST",
                url: app_url+'/fetch_dealer_stock_chassis_no_list',
                data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type,"model_id":model_id },
                success: function( msg ) {
                     
                            if(msg.length>0)
                            { 
                              $('#chassis_no').empty();
                              $('#chassis_no').append(`<option value=""> 
                                       Select
                                  </option>`); 

                              for(var i=0; i<msg.length; i++){

                                 $('#chassis_no').append(`<option value="${msg[i].chassis_no}"> 
                                       ${msg[i].chassis_no}
                                  </option>`); 
                               }                              
                                                     
                             }
                             else
                             {
                              $('#chassis_no').empty();

                               $('#chassis_no').append(`<option value=""> 
                                       Select
                                  </option>`); 

                               $('#chassis_no').append(`<option value=""> 
                                       In this type model not available in stock!!
                                  </option>`); 

                            
                             }

                }
            });
     });


           $('#chassis_no').on('change', function() {

           //  alert(app_url);
            var dealer_id = $("#dealer_id").val();
            var vehicle_type = $("#vehicle_type").val();
            var model_id = $("#model_id").val();
            var color_id = $("#color_id").val();
           
           //   alert("On Change" + $("#model_id").val()  + $("#color_id").val() );

              $.ajax({
                type: "POST",
                url: app_url+'/fetch_dealer_stock_amount',
                data: {"_token": "{{ csrf_token() }}", "dealer_id":dealer_id,"vehicle_type":vehicle_type,"model_id":model_id, "color_id":color_id },
                success: function( msg ) {
                     
                            if(msg.length>0)
                            { 
                            
                                for(var i=0; i<msg.length; i++)
                                {
                                 $('#vehicle_amount').val(msg[i].dealer_sale_rate);
                                }                              
                                                     
                             }
                             else
                             {
                              $('#vehicle_amount').empty();
                              $('#vehicle_amount').val(0);
                             }
                }
            });
     });


        /*  Temp Vehicle List */
        var temp_vehicle = function(){



              var dealer_id = $("#dealer_id").val();
              var order_id = $("#order_id").val();

                $.ajax({
                type: "POST",
                url: app_url+'/get_vehicle_list', 
                 data: {"_token": "{{ csrf_token() }}", "order_id":order_id, "dealer_id":dealer_id},             
                success: function( msg ) {

                    if(msg.length>0)
                    {
                        var temp_vehicle = '<ul>';
                          var count=1; 
                        for(var i=0; i<msg.length; i++){

                            temp_vehicle +='<tr><td>'+count+'</td><td>'+msg[i].type_of_vehicle+' </td><td>'+msg[i].model+' </td><td>'+msg[i].type_of_color+'</td><td>'+msg[i].vehicle_amount+'</td><td>'+msg[i].chassis_no+' </td><td>'+msg[i].book_no+' </td></tr>';

                            count++;

                        }

                        temp_vehicle +='</ul>';

                        $("#temp-vehicle-list").html(temp_vehicle);



                    }
                    else
                    {
                         $("#temp-vehicle-list").html("<div class='btn btn-block btn-primary btn-xs'>No Vehicle found, Add Vehicle.!!! </div>");
                    }
                   
                }
            });

            }
        
       
        /*End Temp Vehicle List */


        /*  Add  vehicle */
        $("#add-vehile").click(function(){

         // alert("test");

            var vehicle_type = $("#vehicle_type").val();
            var model_id = $("#model_id").val();
            var color_id = $("#color_id").val(); 
            var chassis_no = $("#chassis_no").val(); 
            var vehicle_amount = $("#vehicle_amount").val();
            var book_no = $("#book_no").val();
             var engine_no = $("#engine_no").val();
             var order_id = $("#order_id").val();
             var dealer_id = $("#dealer_id").val();
             var vehicle_qty = $("#vehicle_qty").val();
             var total_amount = $("#total_amount").val();

            $.ajax({
                type: "POST",
                url: app_url+'/insert_vehicle_list',
                data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type,  "model_id":model_id, "color_id":color_id, "chassis_no":chassis_no, "vehicle_amount":vehicle_amount, "book_no":book_no, "engine_no":engine_no, "order_id":order_id, "dealer_id":dealer_id, "vehicle_qty":vehicle_qty, "total_amount":total_amount },
                success: function( msg ) {
                     
                                if(msg.success)
                                {         
                                  temp_vehicle();
                                  find_total_amount();
                                  find_total_qty();
                                  $("#vehicle_type").val("").trigger('change');
                                  $("#model_id").val("").trigger('change');
                                  $("#color_id").val("").trigger('change');
                                  $("#chassis_no").val("").trigger('change');
                                  $("#vehicle_amount").val("").trigger('change');
                                  $("#book_no").val("").trigger('change');
                                  $("#engine_no").val("").trigger('change');                                
                                }
                                else
                                {
                                  $("#temp-veicle-list").html("<div class='alert alert-info'>No vehicle founf. Add New!! </div>");
                                }
                }
            }); 
            
        });

        /*  End Add temp vehicle */


          var find_total_amount = function(){
                // alert("50");
                 var order_id = $("#order_id").val();
                $.ajax({
                type: "POST",
                url: app_url+'/get_vehicle_total_amount_list', 
                 data: {"_token": "{{ csrf_token() }}", "order_id":order_id},             
                success: function( msg ) {

                    if(msg.length>0)
                    {
                   // console.log(msg.total_amount);        
                         $("#total_amount").val(msg);
                       
                    }
                    else
                    {
                      $("#total_amount").val("0");
                    }
                   
                }
            });

            }


              var find_total_qty = function(){
              var order_id = $("#order_id").val();
                $.ajax({
                type: "POST",
                url: app_url+'/get_vehicle_total_qty', 
                 data: {"_token": "{{ csrf_token() }}", "order_id":order_id},             
                success: function( msg ) {

                    
                    if(msg.length>0)
                    {    
                      // console.log(msg.total_qty);  
                       $("#vehicle_qty").val(msg);
                      
                    }
                    else
                    {
                      $("#vehicle_qty").val("0");
                    }
                   
                }
            });

            }


        /*End Temp Vehicle List */


         $(document). on("click", ".delete-vehicle" , function(){

                    var chassis_no = $(this).attr("data-id");
                        // var temp_chassis_no = $(this).attr("data-id");
                        // var temp_model_id = $(this).attr("data-id");


                        //alert(temp_vehicle_id);
                          var order_id = $("#order_id").val();
                          var total_amount = $("#total_amount").val();

                          var dealer_id = $("#dealer_id").val();


                     var x = confirm("Are you sure you want to delete?");
                     if (x)

                         $.ajax({
                            type: "POST",
                            url: app_url+'/delete_vehicle',
                            data: { "_token": "{{ csrf_token() }}", "chassis_no":chassis_no, "order_id":order_id, "total_amount":total_amount, "dealer_id":dealer_id },       

                            success: function( msg ) {

                              if(msg.length>0)
                              {    
                                temp_vehicle();
                                  find_total_amount();
                                  find_total_qty();
                                
                              }
                                  
                            }

                        });


            });


 temp_vehicle();
find_total_amount();
 find_total_qty();




  });
</script>