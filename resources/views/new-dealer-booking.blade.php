  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       New  Dealers Booking  
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/dealer-booking">View Dealers Booking</a></li>
        <li class="active">New Dealers Booking</li>
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
            <form action="/insert_dealer_booking" method="POST" enctype="multipart/form-data">
                @csrf

                 <div class="box-body">
                  <input type="hidden" name="booking_unique_value" id="booking_unique_value" value="{{ $booking_unique_value }}">


                  <!-- Booking Info -->

                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Booking Info</h3>
                  </div>
                 <!-- 
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Booking No</label>-->
                        <input type="hidden" class="form-control" id="booking_no" name="booking_no" aria-describedby="emailHelp" placeholder="Booking No" value="{{ $booking_no }}" readonly="true">
                     <!-- </div>
                    </div> -->

                    <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleName">Date</label>
                          <input class="form-control" type="text" name="booking_date" id="booking_date" required="true">
                        </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Dealers Name</label>
                        <select class="form-control select2" name="dealer_id" id="dealer_id"  required="true">
                          <option value="">Select </option>

                            @foreach($sub_dealers as $sub_dealer)
                            <option value="{{$sub_dealer->id}}">{{$sub_dealer->dealer_name}}</option>
                            @endforeach
                          
                        </select>
                      </div>
                    </div>

                     <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Total Qty</label>
                         <input class="form-control" type="text" name="vehicle_qty" id="vehicle_qty" value="0" readonly="true" onkeypress="javascript:return isNumber(event)"  required="true">
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Total Amount</label>
                         <input class="form-control" type="text" name="total_amount" id="total_amount" value="0" readonly="true" onkeypress="javascript:return isNumber(event)"  required="true">
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleName">Gate Pass Person Name</label>
                          <input class="form-control" type="text" name="person_name" id="person_name"  placeholder="Gate Pass Person Name" required="true">
                        </div>
                    </div>
                    
                    

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Description</label>
                          <textarea class="form-control" id="dealer_booking_description" rows="3" name="dealer_booking_description"></textarea>
                      </div>
                    </div>



                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Vehicle Info</h3>
                    <span id="error-validate" style="color:red;"> </span>
                  </div>
                  
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Vehicle Type</label>
                        <select class="form-control select2" name="vehicle_type" id="vehicle_type"  >
                          <option value="">Select </option>

                            @foreach($vehicle_types as $vehicle_type)
                            <option value="{{$vehicle_type->id}}">{{$vehicle_type->type_of_vehicle}}</option>
                            @endforeach
                          
                          
                        </select>
                      </div>
                    </div>
                    
                     <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Chassis No</label>
                        <select class="form-control select2" name="chassis_no" id="chassis_no" >
                          <option value="">Select </option>
                          
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Model Name</label>
                        <select class="form-control select2" name="model_id" id="model_id" >
                          <option value="">Select</option>
                          
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Color</label>
                        <select class="form-control select2" name="color_id" id="color_id"  >
                          <option value="">Select </option>

                           @foreach($vehicle_colors as $vehicle_color)
                            <option value="{{$vehicle_color->id}}">{{$vehicle_color->type_of_color}}</option>
                            @endforeach
                          
                        </select>
                      </div>
                    </div>

                   

                    <input type="hidden" name="engine_no" id="engine_no" value="0" onkeypress="javascript:return isNumber(event)"  required="true" > 

                     <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Amount</label>
                         <input class="form-control" type="text" name="vehicle_amount" id="vehicle_amount" value="0" onkeypress="javascript:return isNumber(event)"  >
                      </div>
                    </div>


                    <div class="col-sm-1">
                      <div class="form-group">
                        <label for="exampleName">Book No</label>
                         <input class="form-control" type="text" name="book_no" id="book_no" >
                      </div>
                    </div>

                    <div class="col-sm-1">
                      <div class="form-group">

                        <button type="button"  name="add-temp-vehile" id="add-temp-vehile" class="btn btn-primary">Add</button>
                      </div>
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
                              <th>Action</th>
                              <!-- <th>Return</th> -->
                            </tr>
                            </thead>
                            <tbody id="temp-vehicle-list">
                              
                                                        
                            </tbody>
                           
                          </table>
            


                                      


                  </div>
              <!-- /.box-body -->

              


          

                   





              <div class="box-footer">
                <button type="submit" class="btn btn-primary"  id="booking_save" name="booking_save" value="save">Save</button>

                <button type="submit" class="btn btn-success" id="booking_save"   name="booking_save" value="print_and_save">Save and Print</button>
              </div>
            </form>
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

    var find_vehicle_type = function() {

            var vehicle_type = $("#vehicle_type").val();      
               $.ajax({
                type: "POST",
                url: app_url+'/fetch_dealer_stock_chassis_no',
                data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type},
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
     }



         var find_vehicle_model = function() {

            var vehicle_type = $("#vehicle_type").val();
            var chassis_no = $("#chassis_no").val();
              $.ajax({
                type: "POST",
                url: app_url+'/fetch_dealer_stock_model',
                data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type,"chassis_no":chassis_no },
                success: function( msg ) {
                     
                            if(msg.length>0)
                            { 
                              $('#model_id').empty();
                             
                              for(var i=0; i<msg.length; i++){

                                 $('#model_id').append(`<option value="${msg[i].model_name}"> 
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
                       find_color_id();
                }
            });
     }




         var find_color_id = function() {

            var vehicle_type = $("#vehicle_type").val();
            var model_id = $("#model_id").val();
            var chassis_no = $("#chassis_no").val();
          
              $.ajax({
                type: "POST",
                url: app_url+'/fetch_dealer_stock_color',
                data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type,"chassis_no":chassis_no,"model_id":model_id },
                success: function( msg ) {
                     
                            if(msg.length>0)
                            { 
                              $('#color_id').empty();
                             

                              for(var i=0; i<msg.length; i++){

                                 $('#color_id').append(`<option value="${msg[i].vehicle_color}"> 
                                       ${msg[i].type_of_color}
                                  </option>`); 
                               }                              
                                                     
                             }
                             else
                             {
                              $('#color_id').empty();

                               $('#color_id').append(`<option value=""> 
                                       Select
                                  </option>`); 

                               $('#color_id').append(`<option value=""> 
                                       In this type color not available in stock!!
                                  </option>`); 

                            
                             }
                find_vehicle_amount();
                }
            });
     }


 $('#vehicle_type').on('change', function() {
      find_vehicle_type();

     });



 $('#color_id').on('change', function() {
      find_vehicle_amount();
     });


 $('#chassis_no').on('change', function() {
     find_vehicle_model();
      find_vehicle_amount();

     });


$('#model_id').on('change', function() {
    
find_vehicle_amount();
     });

 
 $('#dealer_id').on('change', function() {
      find_vehicle_amount();


     });



          var find_vehicle_amount = function() {

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
     }


        /*  Temp Vehicle List */
        var temp_vehicle = function(){
             
                $.ajax({
                type: "POST",
                url: app_url+'/get_temp_vehicle_list', 
                 data: {"_token": "{{ csrf_token() }}", "is_deleted":'0'},             
                success: function( msg ) {

                    if(msg.length>0)
                    {
                        var temp_vehicle = '<ul>';
                          var count=1; 
                        for(var i=0; i<msg.length; i++){

                            temp_vehicle +='<tr><td>'+count+'</td><td>'+msg[i].type_of_vehicle+' </td><td>'+msg[i].model+' </td><td>'+msg[i].type_of_color+'</td><td>'+msg[i].vehicle_amount+'</td><td>'+msg[i].chassis_no+' </td><td>'+msg[i].book_no+' </td><td><a class="delete-temp-vehicle btn btn-danger"  data-id="'+msg[i].chassis_no+'"><i class="fa fa-trash"></i></a> </td></tr>';

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
        
        temp_vehicle();

        /*End Temp Vehicle List */


        /*  Add temp vehicle */
        $("#add-temp-vehile").click(function(){

            var vehicle_type = $("#vehicle_type").val();
            var model_id = $("#model_id").val();
            var color_id = $("#color_id").val(); 
            var chassis_no = $("#chassis_no").val(); 
            var vehicle_amount = $("#vehicle_amount").val();
            var book_no = $("#book_no").val();
            var engine_no = $("#engine_no").val();
             //alert("success");

            if(vehicle_type !='' && model_id !='' && color_id !='' && chassis_no !='' && vehicle_amount !='' && book_no !='')
            {


               $.ajax({
                type: "POST",
                url: app_url+'/insert_temp_vehicle_list',
                data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type,  "model_id":model_id, "color_id":color_id, "chassis_no":chassis_no, "vehicle_amount":vehicle_amount, "book_no":book_no, "engine_no":engine_no },
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



            }
            else
            {
              $("#error-validate").html("Please select vehicle type, Model Name, Color, Chassis No and Book No..!! ");
            }

           
            
        });

        /*  End Add temp vehicle */


          var find_total_amount = function(){
                // alert("50");
                $.ajax({
                type: "POST",
                url: app_url+'/get_total_amount', 
                 data: {"_token": "{{ csrf_token() }}", "is_deleted":'0'},             
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
             
                $.ajax({
                type: "POST",
                url: app_url+'/get_total_qty', 
                 data: {"_token": "{{ csrf_token() }}", "is_deleted":'0'},             
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


         $(document). on("click", ".delete-temp-vehicle" , function(){

                        var chassis_no = $(this).attr("data-id");
                        // var temp_chassis_no = $(this).attr("data-id");
                        // var temp_model_id = $(this).attr("data-id");


                        //alert(temp_vehicle_id);

                     var x = confirm("Are you sure you want to delete?");
                     if (x)

                         $.ajax({
                            type: "POST",
                            url: app_url+'/delete_temp_vehicle',
                            data: { "_token": "{{ csrf_token() }}", "chassis_no":chassis_no },       

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







  });
</script>