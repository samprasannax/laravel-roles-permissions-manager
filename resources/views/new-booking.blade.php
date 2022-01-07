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
            <form action="/insert_sale_booking" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="box-body">

                  <input type="hidden" name="booking_unique_value" id="booking_unique_value" value="{{ $booking_unique_value }}">

                  <!-- Booking Info -->

                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Booking Info</h3>
                  </div>
                 
                
                        <input type="hidden" class="form-control" id="booking_no" name="booking_no" aria-describedby="emailHelp" placeholder="Booking No" value="{{ $booking_no }}" readonly="true">
                

                    <div class="col-sm-2">

                        <div class="form-group">
                          <label for="exampleName">Date</label>
                          <input type="text" class="form-control"  name="booking_date" id="booking_date" aria-describedby="emailHelp" required="true">
                        </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Customer Name</label>
                        <select class="form-control select2" name="customer_id" id="customer_id" aria-describedby="emailHelp" required="true">
                          <option value="">Select </option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{strtoupper($customer->customer_name)}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Sales Executive</label>
                        <select class="form-control select2" name="sales_person_id" id="sales_person_id" aria-describedby="emailHelp" required="true">
                           <option value="">Select </option>
                            @foreach($sales_persons as $sales_person)
                            <option value="{{$sales_person->id}}">{{strtoupper($sales_person->sales_person_name)}}</option>
                            @endforeach 
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">Mechanic</label>
                        <select class="form-control select2" name="mechanic_id" id="mechanic_id"  aria-describedby="emailHelp" >
                          <option value="">Select </option>
                            @foreach($mechanics as $mechanic)
                            <option value="{{$mechanic->id}}">{{ strtoupper($mechanic->mechanic_name) }}</option>
                            @endforeach   
                        </select>
                      </div>
                    </div>


                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="exampleName">HYP</label>
                        <select class="form-control select2" name="hyp" id="hyp"  aria-describedby="emailHelp" required="true">
                            <option value="">Select </option>                           
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
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
                            <option value="{{ $bank->id }}">{{ $bank->bank_name }} </option>
                            @endforeach
                        </select>
                      </div>
                    </div>


                    <div id="initial-balance" class="col-sm-2" style="display:none;">
                        <div class="form-group">
                          <label for="exampleName">Initial Payment</label>
                            <input type="text" class="form-control" id="initial_balance" name="initial_balance" aria-describedby="emailHelp" placeholder="Initial Payment">
                          </div>                                            
                    </div>










                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Exchange / New Details</h3>
                  </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Exchange / New</label>
                                                   <select class="form-control select2" name="exchange_new" id="exchange_new" aria-describedby="emailHelp" required="true">
                                                    <option value="">Select</option>
                                                    <option value="exchange">Yes</option>
                                                    <option value="new">No</option>
                                                    </select>
                                            </div>
                                        </div>

                                        <div id="exchange1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Vehicle Model Name</label>
                                            <input type="text" class="form-control" id="ex_vehicle_model_name" name="ex_vehicle_model_name" aria-describedby="emailHelp" placeholder="Model Name">
                                          </div>                                            
                                        </div>

                                        <div  id="exchange2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Chassis No</label>
                                            <input type="text" class="form-control" id="ex_vehicle_chassis_no" name="ex_vehicle_chassis_no" aria-describedby="emailHelp" placeholder="Chassis No">
                                            </div>                                            
                                        </div>

                                        <div  id="exchange3" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                 <label for="exampleName">Engine No</label>
                                                   <input type="text" class="form-control" id="ex_vehicle_engine_no" name="ex_vehicle_engine_no" aria-describedby="emailHelp" placeholder="Engine No">
                                            </div>                                            
                                        </div>

                                        <div  id="exchange6" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                 <label for="exampleName">Vehicle No</label>
                                                   <input type="text" class="form-control" id="ex_vehicle_no" name="ex_vehicle_no" aria-describedby="emailHelp" placeholder="Vehicle No">
                                            </div>                                            
                                        </div>


                                        
                                        <div  id="exchange4" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                 <label for="exampleName">Exchange Amount</label>
                                                   <input type="text" class="form-control" id="ex_vehicle_amount" name="ex_vehicle_amount" aria-describedby="emailHelp" placeholder="Valuable Amount" onkeypress="javascript:return isNumber(event)" value="0">
                                            </div>
                                            
                                        </div>

                                        <div  id="exchange5" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName">Year</label>
                                                <input class="form-control" type="text" name="ex_vehicle_date" id="ex_vehicle_date">
                                            </div>
                                            
                                        </div>

                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">New Vehicle Info</h3>
                  </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Vehicle Type</label>
                                                   <select class="form-control select2"  aria-describedby="emailHelp" name="vehicle_type" id="vehicle_type"  required="true">
                                                   <option value="">Select </option>
                                                    @foreach($vehicle_types as $vehicle_type)
                                                    <option value="{{$vehicle_type->id}}">{{strtoupper($vehicle_type->type_of_vehicle)}}</option>
                                                    @endforeach 
                                                   
                                                    </select> 
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">New Vehicle Model</label>
                                                   <select class="form-control select2" name="model_id" aria-describedby="emailHelp" id="model_id"  required="true">
                                                   <option value="">Select </option>
                                                   
                                                    </select> 
                                            </div>
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Color</label>
                                                   <select class="form-control select2" name="color_id" id="color_id" aria-describedby="emailHelp" required="true">
                                                    <option value="">Select </option>

                                                     @foreach($colors as $color)
                                                      <option value="{{$color->id}}">{{strtoupper($color->type_of_color)}}</option>
                                                     @endforeach 
                                                  
                                                    </select>  
                                            </div>
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName"> Customer Sale Rate</label>
                                                   <input type="text" class="form-control" id="self_sale_rate" name="self_sale_rate" aria-describedby="emailHelp" placeholder="Self Sale Rate" readonly="true" value="0" required="true">
                                            </div>
                                            
                                        </div>

                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Extra Charges</h3>
                  </div>


                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                 <label for="exampleName">Extra Fitting</label>
                                                   <select class="form-control select2" name="extra_fitting"  id="extra_fitting" aria-describedby="emailHelp"required="true"> 
                                                        <option value="no">No</option>
                                                         <option value="yes">Yes</option>  

                                                    </select>
                                            </div>
                                        </div>

                                        <div  id="extra_fitting1" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName">Extra Fitting Charge(+)</label>
                                                <input class="form-control" type="text"  id="extra_fitting_charge" name="extra_fitting_charge" value="0" onkeypress="javascript:return isNumber(event)">
                                            </div>
                                            
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Mechanic Charge</label>
                                                   <select class="form-control select2" name="mechanic_charge" id="mechanic_charge" aria-describedby="emailHelp"required="true">                                                       
                                                        
                                                        <option value="no">No</option> 
                                                         <option value="yes">Yes</option>     
                                                    </select>
                                            </div>
                                            
                                        </div>

                                        <div  id="mechanic_charge1" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName">Mechanic Amount(+)</label>
                                                <input class="form-control" type="text" id="mechanic_amount" name="mechanic_amount"  value="0" onkeypress="javascript:return isNumber(event)">
                                            </div>
                                            
                                        </div>



                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Insurance</label>
                                                   <select class="form-control select2" name="insurance" id="insurance" aria-describedby="emailHelp"required="true" >                                                       
                                                        <option value="yes">Yes</option>   
                                                        <option value="no">No</option>
                                                    </select>
                                            </div>
                                            
                                        </div>

                                        <div  id="insurance1" class="col-sm-2" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName">Insurance Amount(-)</label>
                                                <input class="form-control" type="text" id="insurance_amount"  name="insurance_amount" value="0" onkeypress="javascript:return isNumber(event)">
                                            </div>
                                            
                                        </div>

                                        <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Discount(In Rupees)</label>
                                                <input class="form-control" type="text"  id="discount" name="discount" value="0" onkeypress="javascript:return isNumber(event)">
                                            </div>
                                            
                                        </div>
                  <!-- Exchange Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Calculation</h3>
                  </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Gross Total</label>
                                                 <input type="text" class="form-control" id="gross_total" name="gross_total" aria-describedby="emailHelp" placeholder="Total Amount" readonly="true" value="0">
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Grand Total</label>
                                                 <input type="text" class="form-control" id="grand_total" name="grand_total" aria-describedby="emailHelp" placeholder="Total Amount" readonly="true" value="0">
                                            </div>
                                            
                                        </div>

                                        <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Description</label>
                                               <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                            </div>
                                            
                                        </div>


                  <!-- Receipt Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Receipt</h3>
                  </div>
                                      <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="exampleName">Receipt No</label>
                                                <input type="text" class="form-control" id="receipt_no" name="receipt_no" aria-describedby="emailHelp" placeholder="Receipt No" readonly="true" value="{{ $receipt_no }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Date</label>
                                                  <input class="form-control" type="text" name="receipt_date" id="receipt_date">
                                            </div>                                            
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Total</label>
                                                 <input type="text" class="form-control" id="total_amount" name="total_amount" aria-describedby="emailHelp" placeholder="Total Amount" readonly="true" value="0">
                                            </div>                                            
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Total Paid</label>
                                                 <input type="text" class="form-control" id="total_paid" name="total_paid" aria-describedby="emailHelp" placeholder="Total Paid" readonly="true" value="0">
                                                  <input type="hidden" class="form-control" id="total_paid_old" name="total_paid_old" aria-describedby="emailHelp" placeholder="Total Paid" readonly="true" value="0">
                                            </div>                                            
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Total Remaining</label>
                                                <input type="text" class="form-control" id="total_remaining" name="total_remaining" aria-describedby="emailHelp" placeholder="Total Remaining" readonly="true" value="0">
                                                
                                                <input type="hidden" class="form-control" id="total_remaining_old" name="total_remaining_old" aria-describedby="emailHelp" placeholder="Total Remaining" readonly="true" value="0">
                                            </div>
                                            
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Amount to Pay</label>
                                                <input type="text" class="form-control" id="amount_to_pay" name="amount_to_pay" aria-describedby="emailHelp" placeholder="Amount to pay" value="0"  onkeypress="javascript:return isNumber(event)" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                  <label for="exampleName">Payment Mode</label>
                                                 <select class="form-control select2" name="payment_mode" id="payment_mode" required="true">
                                                  <option value="">Select Payment Mode</option>
                                                  <option value="1">Cash</option>
                                                  <option value="2">Bank</option>
                                                  <option value="3">Cheque</option>
                                                  <option value="4">Credit Card</option>
                                                  <option value="5">Debit Card</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div id="cheque1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Cheque No</label>
                                            <input type="text" class="form-control" id="cheque_no" name="cheque_no" aria-describedby="emailHelp" placeholder="Cheque No">
                                          </div>                                            
                                        </div>

                                        <div id="cheque2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Bank Name</label>
                                            <input type="text" class="form-control" id="cheque_bank_name" name="cheque_bank_name" aria-describedby="emailHelp" placeholder="Bank Name">
                                          </div>                                            
                                        </div>



                                         <div id="credit_card1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Transaction No</label>
                                            <input type="text" class="form-control" id="credit_card_transaction_no" name="credit_card_transaction_no" aria-describedby="emailHelp" placeholder="Transaction No">
                                          </div>                                            
                                        </div>

                                        <div id="credit_card2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Bank Name</label>
                                            <input type="text" class="form-control" id="credit_card_bank_name" name="credit_card_bank_name" aria-describedby="emailHelp" placeholder="Bank Name">
                                          </div>                                            
                                        </div>

                                         <div id="debit_card1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Transaction No</label>
                                            <input type="text" class="form-control" id="debit_card_transaction_no" name="debit_card_transaction_no" aria-describedby="emailHelp" placeholder="Transaction No">
                                          </div>                                            
                                        </div>

                                        <div id="debit_card2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Bank Name</label>
                                            <input type="text" class="form-control" id="debit_card_bank_name" name="debit_card_bank_name" aria-describedby="emailHelp" placeholder="Bank Name">
                                          </div>                                            
                                        </div>

                                        <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Payment Description</label>
                                               <textarea class="form-control" id="payment_description" name="payment_description" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <br>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Payee Name</label>
                                                <input type="text" class="form-control" id="payee_name" name="payee_name" aria-describedby="emailHelp" placeholder="Payee Name" required="true">
                                            </div>
                                            
                                        </div>
                                        
                                        
                                         
                                           <div class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Creator Name</label>
                                                  <input class="form-control" type="text" name="creator_name" id="creator_name" >
                                            </div>
                                            
                                        </div>






                                        <div  class="col-sm-12" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName"><b style="color:red;font-size:20px;">If you dont want to add this amount to opening balance. Please select 'yes' here!!!!</b> </label><br>
                                              
                                               <input type="radio" name="amount_status" id="amount_status_no" value="0" checked="true"> No<br>
                                               <input type="radio" name="amount_status" id="amount_status_yes" value="1" > Yes

                                            </div>
                                        </div>








                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"  name="booking_save"  id="booking_save" value="save">Save</button> 
                <button type="submit" class="btn btn-success"  name="booking_save"  id="booking_save" value="save_and_print">Save & Print</button>
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


  $(function(){



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





     //var val = Number.NaN;
    $('#booking_date').datepicker('setDate', 'today');
    $('#booking_date').datepicker({ dateFormat: 'dd-mm-yyyy' });

   
    $('#receipt_date').datepicker('setDate', 'today');
    $('#receipt_date').datepicker({ dateFormat: 'dd-mm-yyyy' });




    $("#ex_vehicle_date").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });

    // $( "input[type='text']" ).on( "blur", function() {
    //   if( !this.value ) {
    //     alert( "Please enter some text!" );
    //   }
    // });



    

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
      
      $('#total_paid_old').val(0);
      $('#total_remaining_old').val(totalval);

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
         
        
          var total_paid_old = parseFloat($("#total_paid_old").val()) || 0; 
          var total_remaining_old = parseFloat($("#total_remaining_old").val()) || 0; 
         
        var total_amount = parseFloat($("#total_amount")) || 0;
        var total_paid = 0; 
        var total_remaining = parseFloat($("#total_remaining").val()) || 0; 
        var amount_to_pay = parseFloat($("#amount_to_pay").val()) || 0;


        var total_remaining_replace = parseFloat(total_remaining_old) - parseFloat(amount_to_pay);
        var paid_replace =  parseFloat(total_paid_old) + parseFloat(amount_to_pay);


        $('#total_paid').val(paid_replace);
        $('#total_remaining').val(total_remaining_replace);
      
      
     }




  });
</script>


