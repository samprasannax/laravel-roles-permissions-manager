  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')
 

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
       New  Sales Booking  <!-- (Notes : <span style="color:red">Fill the details carefully </span>)   --> 
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/sales-booking">View Booking</a></li>
        <li class="active">New Booking</li>
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
            <form action="/update_sale_booking" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="box-body">

              
                  <!-- Booking Info -->

                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Booking Info</h3>
                  </div>
                 
                
                        <input type="hidden" class="form-control" id="booking_no" name="booking_no" aria-describedby="emailHelp" placeholder="Booking No" value="{{ $edit_sales_bookings[0]->booking_no }}" readonly="true">

                          <input type="hidden" class="form-control" id="booking_order_id" name="booking_order_id" aria-describedby="emailHelp" placeholder="Booking No" value="{{ $edit_sales_bookings[0]->order_id }}" readonly="true">

                          <input type="hidden" class="form-control" id="balance_sheet_unique_id" name="balance_sheet_unique_id" aria-describedby="emailHelp" placeholder="Booking No" value="{{ $edit_sales_bookings[0]->balance_sheet_unique_id }}" readonly="true">
                

                    <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleName">Date</label>
                          <input class="form-control" type="date" name="booking_date" id="booking_date" value="{{ $edit_sales_bookings[0]->booking_date }}">
                        </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Customer Name</label>
                        <input type="hidden" name="old_customer_id" id="old_customer_id" value="{{ $edit_sales_bookings[0]->customer_id }}">
                        <select class="form-control select2" name="customer_id" id="customer_id"  required="true" disabled="true">
                          <option  value="">Select </option>
                          @foreach($customers as $customer)
                             <option value="{{$customer->id}}" @if($customer->id==$edit_sales_bookings[0]->customer_id) selected @endif >{{strtoupper($customer->customer_name)}}</option>
                          @endforeach
                        </select> 
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">DSC</label>
                        <select class="form-control select2" name="sales_person_id" id="sales_person_id" required="true">
                           <option  value="">Select </option>
                            @foreach($sales_persons as $sales_person)
                             <option value="{{$sales_person->id}}" @if($sales_person->id==$edit_sales_bookings[0]->sales_person_id) selected @endif >{{strtoupper($sales_person->sales_person_name)}}</option>
                            @endforeach


                        </select>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Mechanic</label>
                        <select class="form-control select2" name="mechanic_id" id="mechanic_id" >
                          <option  value="">Select </option>

                           @foreach($mechanics as $mechanic)
                             <option value="{{$mechanic->id}}" @if($mechanic->id==$edit_sales_bookings[0]->mechanic_id) selected @endif >{{strtoupper($mechanic->mechanic_name)}}</option>
                            @endforeach

                        </select>
                      </div>
                    </div>


                  <!-- HYP --> 

                     <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">HYP</label>
                        <select class="form-control select2" name="hyp" id="hyp"  aria-describedby="emailHelp" required="true">
                            <option value="">Select </option>                           
                                                        <?php
                                                      $hyp = $edit_sales_bookings[0]->hyp;
                                                      if($hyp == 'no')
                                                      {
                                                        ?>  
                                                        <option value="no" selected="true">No</option>
                                                         <option value="yes">Yes</option>  
                                                        <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <option value="no">No</option>
                                                         <option value="yes" selected="true">Yes</option>  
                                                        <?php
                                                      }
                                                    ?>
                                                       
                        </select>
                      </div>
                    </div>


                    <!-- HYP -->

                    <div id="hyp-bank-list" class="col-sm-2" style="display:none;">
                      <div class="form-group">
                        <label for="exampleName">HYP Bank</label>
                        <select class="form-control select2" name="bank_name" id="bank_name"  aria-describedby="emailHelp"  style="width:100%;">
                            <option value="">Select </option>                           
                            @foreach($banks as $bank)
                            <option value="{{ $bank->id }}" @if($bank->id==$edit_sales_bookings[0]->hyp_bank_name) selected @endif>{{ $bank->bank_name }}</option> 
                            @endforeach
                        </select>
                      </div>
                    </div>


                    <div id="initial-balance" class="col-sm-2" style="display:none;">
                        <div class="form-group">
                          <label for="exampleName">Initial Payment</label>
                            <input type="text" class="form-control" id="initial_balance" name="initial_balance" aria-describedby="emailHelp" placeholder="Initial Payment" value="{{ $edit_sales_bookings[0]->initial_balance }}">
                          </div>                                            
                    </div>





                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Exchange / New Details</h3>
                  </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                              <input type="hidden" name="old_exchange_new" id="old_exchange_new" value="{{ $edit_sales_bookings[0]->exchange_or_new }}"> 
                                                 <label for="exampleName">Exchange / New</label>
                                                   <select class="form-control select2" name="exchange_new" id="exchange_new" required="true">
                                                    <option  value="" >Select</option>
                                                    <?php
                                                      $exchange_or_new = $edit_sales_bookings[0]->exchange_or_new;
                                                      if($exchange_or_new == 'exchange')
                                                      {
                                                        ?>  
                                                        <option value="exchange" selected="true">Yes</option>
                                                        <option value="new">No</option>
                                                        <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <option value="exchange" >Yes</option>
                                                        <option value="new" selected="true">No</option>
                                                        <?php
                                                      }
                                                    ?>
                                                  
                                                    </select>
                                            </div>
                                        </div>





                                        <div id="exchange1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Vehicle Model Name</label>
                                            <input type="text" class="form-control" id="ex_vehicle_model_name" name="ex_vehicle_model_name" aria-describedby="emailHelp" placeholder="Model Name" value="@if(isset($edit_exchange_vehicle[0]->model_name)){{$edit_exchange_vehicle[0]->model_name}}@endif">
                                          </div>                                            
                                        </div>

                                        <div  id="exchange2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Chassis No</label>
                                            <input type="text" class="form-control" id="ex_vehicle_chassis_no" name="ex_vehicle_chassis_no" aria-describedby="emailHelp" placeholder="Chassis No" value="@if(isset($edit_exchange_vehicle[0]->chassis_no)){{$edit_exchange_vehicle[0]->chassis_no}}@endif">
                                            </div>                                            
                                        </div>

                                        <div  id="exchange3" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                 <label for="exampleName">Engine No</label>
                                                   <input type="text" class="form-control" id="ex_vehicle_engine_no" name="ex_vehicle_engine_no" aria-describedby="emailHelp" placeholder="Engine No" value="@if(isset($edit_exchange_vehicle[0]->engine_no)){{$edit_exchange_vehicle[0]->engine_no}}@endif">
                                            </div>                                            
                                        </div>

                                        <div  id="exchange6" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                 <label for="exampleName">Vehicle No</label>
                                                   <input type="text" class="form-control" id="ex_vehicle_no" name="ex_vehicle_no" aria-describedby="emailHelp" placeholder="Vehicle No" value="@if(isset($edit_exchange_vehicle[0]->vehicle_no)){{$edit_exchange_vehicle[0]->vehicle_no}}@endif">
                                            </div>                                            
                                        </div>


                                        
                                        <div  id="exchange4" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                 <label for="exampleName">Exchange Amount</label>
                                                   <input type="text" class="form-control" id="ex_vehicle_amount" name="ex_vehicle_amount" aria-describedby="emailHelp" value="@if(isset($edit_exchange_vehicle[0]->valuable_amount)){{ $edit_exchange_vehicle[0]->valuable_amount}}@endif">
                                            </div>                                            
                                        </div>


                                        <div  id="exchange5" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName">Year</label>
                                                <input class="form-control" type="text" name="ex_vehicle_date" id="ex_vehicle_date" value="@if(isset($edit_exchange_vehicle[0]->exchange_date)){{$edit_exchange_vehicle[0]->exchange_date}}@endif">
                                            </div>                                            
                                        </div>



                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">New Vehicle Info</h3>
                  </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Vehicle Type</label>
                                                   <select class="form-control select2" name="vehicle_type" id="vehicle_type" required="true">
                                                   <option  value="">Select </option>
                                                       @foreach($vehicle_types as $vehicle_type)
                                                           <option value="{{$vehicle_type->id}}" @if($vehicle_type->id==$edit_sales_bookings[0]->vehicle_type_id) selected @endif >{{strtoupper($vehicle_type->type_of_vehicle)}}</option>
                                                          @endforeach
                                                   
                                                    </select> 
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">New Vehicle Model</label>
                                                   <select class="form-control select2" name="model_id" id="model_id" required="true">
                                                   <option value="">Select  </option>

                                                     @foreach($vehicle_models as $vehicle_model)
                                                           <option value="{{$vehicle_model->id}}" @if($vehicle_model->id==$edit_sales_bookings[0]->vehicle_model_id) selected @endif >{{strtoupper($vehicle_model->model)}}</option>
                                                          @endforeach


                                                   
                                                    </select> 
                                            </div>
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Color</label>
                                                   <select class="form-control select2" name="color_id" id="color_id" required="true">
                                                    <option value="">Select </option>

                                                     @foreach($colors as $color)
                                                      <option value="{{$color->id}}" @if($color->id==$edit_sales_bookings[0]->vehicle_color_id) selected @endif >{{strtoupper($color->type_of_color)}}</option>
                                                     @endforeach 
                                                  
                                                    </select>  
                                            </div>
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName"> Customer Sale Rate</label>
                                                   <input type="text" class="form-control" id="self_sale_rate" name="self_sale_rate" aria-describedby="emailHelp" placeholder="Self Sale Rate" readonly="true" value="{{ $edit_sales_bookings[0]->vehicle_sale_rate }}">
                                            </div>
                                            
                                        </div>

                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Extra Charges</h3>
                  </div>


                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                 <label for="exampleName">Extra Fitting</label>
                                                   <select class="form-control select2" name="extra_fitting" id="extra_fitting">
                                                     <?php
                                                      $extra_fitting = $edit_sales_bookings[0]->extra_fitting;
                                                      if($extra_fitting == 'no')
                                                      {
                                                        ?>  
                                                        <option value="no" selected="true">No</option>
                                                         <option value="yes">Yes</option>  
                                                        <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <option value="no">No</option>
                                                         <option value="yes" selected="true">Yes</option>  
                                                        <?php
                                                      }
                                                    ?>
                                                       

                                                    </select>
                                            </div>
                                        </div>

                                        <div  id="extra_fitting1" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName">Extra Fitting Charge(+)</label>
                                                <input class="form-control" type="text"  id="extra_fitting_charge" name="extra_fitting_charge" value="{{ $edit_sales_bookings[0]->extra_fitting_charge }}">
                                            </div>
                                            
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Mechanic Charge</label>
                                                   <select class="form-control select2" name="mechanic_charge" id="mechanic_charge" >                                                       
                                                         <?php
                                                      $mechanic_charge = $edit_sales_bookings[0]->mechanic_charge;
                                                      if($mechanic_charge == 'no')
                                                      {
                                                        ?>  
                                                        <option value="no" selected="true">No</option>
                                                         <option value="yes">Yes</option>  
                                                        <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <option value="no">No</option>
                                                         <option value="yes" selected="true">Yes</option>  
                                                        <?php
                                                      }
                                                    ?>
                                                       


                                                    </select>
                                            </div>
                                            
                                        </div>

                                        <div  id="mechanic_charge1" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName">Mechanic Amount(+)</label>
                                                <input class="form-control" type="text" id="mechanic_amount" name="mechanic_amount"  value="{{ $edit_sales_bookings[0]->mechanic_amount }}">
                                            </div>
                                            
                                        </div>



                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Insurance</label>
                                                   <select class="form-control select2" name="insurance" id="insurance" >                                                                     
                                                         <?php
                                                      $insurance = $edit_sales_bookings[0]->insurance;
                                                      if($insurance == 'no')
                                                      {
                                                        ?>  
                                                        <option value="no" selected="true">No</option>
                                                         <option value="yes">Yes</option>  
                                                        <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <option value="no">No</option>
                                                         <option value="yes" selected="true">Yes</option>  
                                                        <?php
                                                      }
                                                    ?>             
                                                    </select>
                                            </div>
                                            
                                        </div>

                                        <div  id="insurance1" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName">Insurance Amount(-)</label>
                                                <input class="form-control" type="text" id="insurance_amount"  name="insurance_amount" value="{{ $edit_sales_bookings[0]->insurance_amount }}">
                                            </div>
                                            
                                        </div>

                                        <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Discount(In Rupees)</label>
                                                <input class="form-control" type="text"  id="discount" name="discount" value="{{ $edit_sales_bookings[0]->discount }}">
                                            </div>
                                            
                                        </div>
                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Calculation</h3>
                  </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Gross Total</label>
                                                 <input type="text" class="form-control" id="gross_total" name="gross_total" aria-describedby="emailHelp" placeholder="Total Amount" readonly value="{{ $edit_sales_bookings[0]->gross_total }}">
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Grand Total</label>
                                                 <input type="text" class="form-control" id="grand_total" name="grand_total" aria-describedby="emailHelp" placeholder="Total Amount" readonly value="{{ $edit_sales_bookings[0]->grand_total }}">
                                            </div>
                                            
                                        </div>

                                        <input type="hidden" name="old_total_paid" id="old_total_paid" value="{{ $edit_sales_bookings[0]->total_paid }}">
                                          <input type="hidden" name="old_grand_total" id="old_grand_total" value="{{ $edit_sales_bookings[0]->grand_total }}">

                                        <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Description</label>
                                               <textarea class="form-control" id="description" name="description" rows="3">{{ $edit_sales_bookings[0]->description }}</textarea>
                                            </div>
                                            
                                        </div>




                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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


 $( document ).ready(function() {


  $('#hyp').on('change', function(){

    if ($(this).val() == "no")
    { 
      $('#bank_name') .val('').trigger('change');
      $("#initial_balance").val('0');   

      $("#hyp-bank-list").hide();
      $("#initial-balance").hide();
    }
    else
    {
    
      $("#hyp-bank-list").show();
      $("#initial-balance").show();
    }


  });


       var hyp = $('#hyp').val();

       if(hyp == "yes")
       {
        $("#hyp-bank-list").show();
        $("#initial-balance").show();      
       }





       var exchange_new = $('#exchange_new').val();

       if(exchange_new == "exchange")
       {
         $("#exchange1").show();
        $("#exchange2").show();
        $("#exchange3").show();
        $("#exchange4").show();
        $("#exchange5").show();
        $("#exchange6").show();
       }


        var extra_fitting = $('#extra_fitting').val();

       if(extra_fitting == "yes")
       {
         $("#extra_fitting1").show();
       }


       var mechanic_charge = $('#mechanic_charge').val();

       if(mechanic_charge == "yes")
       {
         $("#mechanic_charge1").show();
       }

        var insurance = $('#insurance').val();

       if(insurance == "no")
       {
         $("#insurance1").show();
       }


$('#exchange_new').on('change', function() {

  if ($(this).val() == "exchange")
  {
    $("#exchange1").show();
    $("#exchange2").show();
    $("#exchange3").show();
    $("#exchange4").show();
    $("#exchange5").show();
    $("#exchange6").show();
  }
  else
  {
    $("#exchange1").hide();
    $("#exchange2").hide();
    $("#exchange3").hide();
    $("#exchange4").hide();
    $("#exchange5").hide();
    $("#exchange6").hide();
  }
});



$('#payment_mode').on('change', function() {

  if ($(this).val() == "3")
  {

    

    $("#cheque1").show();
    $("#cheque2").show();    
  }
  else
  { 
    $("#cheque1").hide();
    $("#cheque2").hide();
  }

  if ($(this).val() == "4")
  {
 

    $("#credit_card1").show();
    $("#credit_card2").show();    
  }
  else
  { 
    $("#credit_card1").hide();
    $("#credit_card2").hide();
  }


  if ($(this).val() == "5")
  {
  

    $("#debit_card1").show();
    $("#debit_card2").show();    
  }
  else
  { 
    $("#debit_card1").hide();
    $("#debit_card2").hide();
  }

});



$('#extra_fitting').on('change', function() {

  if ($(this).val() == "yes")
  {     
    $("#extra_fitting1").show();   
  }
  else
  {
    $('#extra_fitting_charge').val('0');   
    $("#extra_fitting1").hide();
  }
  calculate_total();
  calculate_paid_total();
   
});


$('#mechanic_charge').on('change', function() {

  if ($(this).val() == "yes")
  {
    $("#mechanic_charge1").show(); 
  }
  else
  {
    $('#mechanic_amount').val('0');  
    $("#mechanic_charge1").hide();
  }
  calculate_total();
  calculate_paid_total();
});




$('#insurance').on('change', function() {

  if ($(this).val() == "no")
  {

    $("#insurance1").show();  
    
  }
  else
  {
  $('#insurance_amount').val('0');
    $("#insurance1").hide();
  }
   calculate_total();
  calculate_paid_total();

 });

    

    $("#ex_vehicle_date").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });

    

     $('#vehicle_type').on('change', function() {

           //  alert(app_url);

            var vehicle_type = $("#vehicle_type").val();
           
           //   alert("On Change" + $("#model_id").val()  + $("#color_id").val() );

              $.ajax({
                type: "POST",
                url: app_url+'/fetch_stock_model',
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
                                       None.Please check it.!!!
                                  </option>`); 

                            
                             }

                }
            });
     });


     $('#model_id').on('change', function() {


//alert("Test");
            var vehicle_type = $("#vehicle_type").val();
            var model_name1 = $("#model_id").val();
           
              // alert("On Change" + $("#model_id").val()  + $("#color_id").val() );

              $.ajax({
                type: "POST",
                url: app_url+'/fetch_vehicle_amount',
                data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type, "model_name1":model_name1 },
                success: function( msg ) {
                     
                            if(msg.length>0)
                            { 
                              for(var i=0; i<msg.length; i++){
                               
                                 $('#self_sale_rate').val(msg[i].self_sale_rate);
                                 $('#gross_total').val(msg[i].self_sale_rate);
                                 $('#grand_total').val(msg[i].self_sale_rate);
                                 $('#total_amount').val(msg[i].self_sale_rate);
                                 $('#total_paid').val(0);
                                 $('#total_remaining').val(msg[i].self_sale_rate);
                              }
                                calculate_total();
                                calculate_paid_total();          
                                                     
                             }
                             else
                             {

                              $('#self_sale_rate').val(0);
                              $('#gross_total').val(0);
                              $('#grand_total').val(0);
                              $('#total_amount').val(0);
                              $('#total_paid').val(0);
                              $('#total_remaining').val(0);
                               calculate_total();
                               calculate_paid_total();                              
                             }

                }
            });
     });



     $('#extra_fitting_charge').on('change', function() {
      calculate_total();
     calculate_paid_total();
     });

     $('#mechanic_amount').on('change', function() {
      calculate_total();
      calculate_paid_total();
     });

      $('#discount').on('change', function() {
      calculate_total();
       calculate_paid_total();
     });

       $('#insurance_amount').on('change', function() {
      calculate_total();
       calculate_paid_total();
     });


     var calculate_total = function(){

      //var ex_vehicle_amount = 0;
      var self_sale_rate = 0;
      var extra_fitting_charge = 0;
      var mechanic_amount = 0;
      var insurance_amount = 0;
      var discount = 0;
      var selfsalerate = 0;
      var selfsaleratemin = 0;
      var totalval = 0;


      //var ex_vehicle_amount = parseFloat($("#ex_vehicle_amount").val()) || 0; // (- self sale rate)  
     // alert(ex_vehicle_amount);    
      var self_sale_rate = parseFloat($("#self_sale_rate").val()) || 0; // (self sale rate)
      var extra_fitting_charge = parseFloat($("#extra_fitting_charge").val()) || 0; // (+ self sale rate)
      var mechanic_amount = parseFloat($("#mechanic_amount").val()) || 0; // (+ self sale rate)
      var insurance_amount = parseFloat($("#insurance_amount").val()) || 0; // (- self sale rate)
      var discount = parseFloat($("#discount").val()) || 0; // (- self sale rate)



      var selfsalerate = parseFloat(self_sale_rate) + parseFloat(extra_fitting_charge) + parseFloat(mechanic_amount); 
      //alert(selfsalerate);
      var selfsaleratemin = parseFloat(discount) +  parseFloat(insurance_amount);
      var totalval =  parseFloat(selfsalerate) - parseFloat(selfsaleratemin);

       //alert(mechanic_amount);

      $('#grand_total').val(totalval);
      $('#gross_total').val(totalval);
      $('#total_amount').val(totalval);
      $('#total_paid').val(0);
      $('#total_remaining').val(totalval);

     }

     $('#amount_to_pay').on('change', function() {
      calculate_paid_total();


     });

      var calculate_paid_total = function(){
         var total_paid = 0;
         var total_remaining = 0;
         var amount_to_pay = 0;
         var total_remaining_replace = 0;
         var paid_replace = 0;
    
        var total_paid = parseFloat($("#total_paid").val()) || 0; 
        var total_remaining = parseFloat($("#total_remaining").val()) || 0; 
        var amount_to_pay = parseFloat($("#amount_to_pay").val()) || 0;


        var total_remaining_replace = parseFloat(total_remaining) - parseFloat(amount_to_pay);
        var paid_replace = parseFloat(total_paid) + parseFloat(amount_to_pay);

        $('#total_paid').val(paid_replace);
        $('#total_remaining').val(total_remaining_replace);
      
     }




  });
</script>


