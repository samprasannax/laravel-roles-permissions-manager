  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>
       Receipt     
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/sales-booking">View Booking</a></li>
        <li class="active">Receipt</li>
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

        <!-- left column -->
        <div id="add-receipt" class="col-md-12" >
          <!-- general form elements -->
          <div class="box box-primary">           
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/insert_receipt" method="POST" enctype="multipart/form-data">

                @csrf

                 <div class="box-body">

                  <input type="hidden" name="order_id" id="order_id" value="{{ $fetch_sale_bookings[0]->order_id }}">

                  <input type="hidden" name="customer_id" id="customer_id" value="{{ $fetch_sale_bookings[0]->customer_id }}">

                  
                  <!-- Receipt Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Receipt</h3>
                  </div>





                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="exampleName">Receipt No</label>
                                                <input type="text" class="form-control" id="receipt_no" name="receipt_no" aria-describedby="emailHelp" placeholder="Receipt No" value="{{ $receipt_no }}" readonly="true">
                                            </div>
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Date</label>
                                                  <input class="form-control" type="text" name="receipt_date" id="receipt_date" >
                                            </div>
                                            
                                        </div>

                                      


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Total</label>
                                                 <input type="text" class="form-control" id="total_amount" name="total_amount" aria-describedby="emailHelp" placeholder="Total Amount" readonly="true" value="{{ $fetch_sale_bookings[0]->grand_total }}">
                                            </div>
                                            
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Total Paid</label>
                                                 <input type="text" class="form-control" id="total_paid" name="total_paid" aria-describedby="emailHelp" placeholder="Total Paid" readonly="true" value="{{ $fetch_sale_bookings[0]->total_paid }}">
                                            </div>                                            
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Total Remaining</label>
                                                <input type="text" class="form-control" id="total_remaining" name="total_remaining" aria-describedby="emailHelp" placeholder="Total Remaining" readonly="true" value="{{ $fetch_sale_bookings[0]->total_remaining }}">
                                            </div>
                                            
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Amount to Pay</label>
                                                <input type="text" class="form-control" id="amount_to_pay" name="amount_to_pay" aria-describedby="emailHelp" placeholder="Amount to pay" onkeypress="javascript:return isNumber(event)">
                                            </div>
                                            
                                        </div>

                                         <div class="col-sm-2">
                                             <div class="form-group">
                                                  <label for="exampleName">Payment Mode</label>
                                                 <select class="form-control select2" name="payment_mode" id="payment_mode" required="true">
                                                  <option  value="">Select Payment Mode</option>
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
                                               <textarea class="form-control" id="exampleTextarea" name="payment_description" rows="3"></textarea>
                                            </div>
                                            
                                        </div>



                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="submit" class="btn btn-success">Save & Print</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>



         <div class="col-xs-12">

            <div class="box">
            <div class="box-header">
              <h3 class="box-title"> 
               
                  Receipt List ( <span style="color:red">Notes : Only this particular cusotmer <span>)
               
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Receipt No</th>
                  <th>Date</th> 
                  <th>Paid</th> 
                  <th>Payment Mode</th>
                  <th>Description</th>                           
                  <th>Action</th>                 
                  <th>Print</th>
                </tr>
                </thead>

                <tbody>
                  @php($count=0)
                  @foreach ($fetch_sale_receipts as $fetch_sale_receipt)
                  @php($count++)

                   <tr>                      
                      <td>{{ $count }}</td>
                      <td>{{ $fetch_sale_receipt->receipt_no }}</td>
                      <td>{{ date("d-m-Y", strtotime($fetch_sale_receipt->receipt_date)) }}</td>                    
                      <td>{{ $fetch_sale_receipt->amount_to_pay }}</td>
                      <td>
                        <?php

                        $payment_mode = $fetch_sale_receipt->payment_mode;

                        if($payment_mode==1)
                        {
                          echo" Payment Mode : Cash";
                        }

                        if($payment_mode==2)
                        {
                          echo" Payment Mode : Bank";
                        }
                        if($payment_mode==3)
                        {
                           echo" Payment Mode : Cheque";
                           echo" <br> Cheque No : " .  $fetch_sale_receipt->cheque_no;
                           echo" <br> Bank Name : " .  $fetch_sale_receipt->cheque_bank_name;
                        }
                        if($payment_mode==4)
                        {
                           echo" <br> Payment Mode : Credit Card";
                           echo" <br> Transaction No : " . $fetch_sale_receipt->credit_card_transaction_no;
                           echo" <br> Bank Name : " .  $fetch_sale_receipt->credit_card_bank_name;
                        }
                        if($payment_mode==5)
                        {
                           echo" <br> Payment Mode : Debit Card";
                           echo" <br> Transaction No : " . $fetch_sale_receipt->debit_card_transaction_no;
                           echo" <br> Bank Name : " . $fetch_sale_receipt->debit_card_bank_name;
                        }
                        ?>
                      </td>

                      <td>
                        {{ $fetch_sale_receipt->payment_description }}
                      </td>

                      <td>

                        <center><a href="/edit_receipt/1/{{ $fetch_sale_receipt->id }}/{{ $fetch_sale_receipt->balance_sheet_unique_id }}/{{ $fetch_sale_receipt->customer_id }}"><button type="button" class="btn btn-warning btn-circle m-rb-5"><i class="fa fa-edit" title="Edit"></i></button></a>


                        <a href="/delete_receipt/delete/{{ $fetch_sale_receipt->booking_order_id }}/{{ $fetch_sale_receipt->balance_sheet_unique_id }}/{{ $fetch_sale_receipt->customer_id }}"><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a></center>


                      </td>

                     

                      <td>
                       <center><a href="/print-customer-receipt/{{ $fetch_sale_receipt->id }}" target="_blank"><button type="button" class="btn btn-success" >Print</button></a></center>
                      </td>

                    </tr>
                    @endforeach


                                            
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>



         <div class="col-xs-3">

            <div class="box">
            <div class="box-header">
              <h3 class="box-title"> 
               
                  Over all Summary
               
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
               
                <tbody>
                   <tr>                      
                      <td>Actuall Amount</td>
                      <td>Rs : {{ $fetch_sale_bookings[0]->grand_total }}</td>
                    </tr>
                    <tr>                      
                      <td>Paid Amount</td>
                      <td>Rs : {{ $fetch_sale_bookings[0]->total_paid }}</td>
                    </tr>
                    <tr>                      
                      <td>Remaining Amount</td>
                      <td>Rs : {{ $fetch_sale_bookings[0]->total_remaining }}</td>
                    </tr>
                                            
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>



       





     
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

$('#receipt_date').datepicker('setDate', 'today');


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



</script>
<script>
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


    



</script>