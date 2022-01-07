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
        <div id="add-receipt" class="col-md-12" style="display:block;" >
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
                                                     <input type="hidden" name="total_paid_old" id="total_paid_old" value="{{ $fetch_sale_bookings[0]->total_paid }}">
                                                 <input type="text" class="form-control" id="total_paid" name="total_paid" aria-describedby="emailHelp" placeholder="Total Paid" readonly="true" value="{{ $fetch_sale_bookings[0]->total_paid }}">
                                            </div>                                            
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Total Remaining</label>
                                                   <input type="hidden" name="total_remaining_old" id="total_remaining_old" value="{{ $fetch_sale_bookings[0]->total_remaining }}">
                                                   
                                                <input type="text" class="form-control" id="total_remaining" name="total_remaining" aria-describedby="emailHelp" placeholder="Total Remaining" readonly="true" value="{{ $fetch_sale_bookings[0]->total_remaining }}">
                                            </div>
                                            
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Amount to Pay</label>
                                                <input type="text" class="form-control" id="amount_to_pay" name="amount_to_pay" aria-describedby="emailHelp" placeholder="Amount to pay"  value="0"  onkeypress="javascript:return isNumber(event)" required="true">
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
                                        
                                        
                                         <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName"><b style="color:red;">Is this amount finance Payment?</b> </label><br>
                                              
                                               <input type="radio" name="finance_status" id="finance_status_no" value="0" checked="true"> No<br>
                                               <input type="radio" name="finance_status" id="finance_status_yes" value="1" > Yes

                                            </div>
                                        </div>
                                        
                                        
                                        <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName"><b style="color:red;">Is this amount Exchange Payment?</b> </label><br>
                                              
                                               <input type="radio" name="exchange_status" id="exchange_status_no" value="0" checked="true"> No<br>
                                               <input type="radio" name="exchange_status" id="exchange_status_yes" value="1" > Yes

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
                <button type="submit" value="save" class="btn btn-primary">Save</button>
                <button type="submit"  value="save-and-print"class="btn btn-success">Save & Print</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>




        <!-- left column -->
        <div id="update-receipt" class="col-md-12" style="display:none;" >
          <!-- general form elements -->
          <div class="box box-primary">           
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/update_receipt" method="POST" enctype="multipart/form-data">

                @csrf

                 <div class="box-body">

                  <input type="hidden" name="uorder_id" id="uorder_id" value="{{ $fetch_sale_bookings[0]->order_id }}">

                  <input type="hidden" name="ucustomer_id" id="ucustomer_id" value="{{ $fetch_sale_bookings[0]->customer_id }}">

                   <input type="hidden" name="ubalance_sheet_unique_id" id="ubalance_sheet_unique_id" value="0">
                   <input type="hidden" name="ureceipt_id" id="ureceipt_id" value="0">

                  
                  <!-- Receipt Info -->
                  <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                    <h3 class="box-title">Update Receipt</h3>
                  </div>





                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="exampleName">Receipt No</label>
                                                <input type="text" class="form-control" id="ureceipt_no" name="ureceipt_no" aria-describedby="emailHelp" placeholder="Receipt No" value="{{ $receipt_no }}" readonly="true">
                                            </div>
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Date</label>
                                                  <input class="form-control" type="date" name="ureceipt_date" id="ureceipt_date" >
                                            </div>
                                            
                                        </div>

                                      


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                    
                                                 <label for="exampleName">Total</label>
                                                 <input type="text" class="form-control" id="utotal_amount" name="utotal_amount" aria-describedby="emailHelp" placeholder="Total Amount" readonly="true" value="{{ $fetch_sale_bookings[0]->grand_total }}">
                                            </div>
                                            
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                  <input type="hidden" name="utotal_paid_old"  id="utotal_paid_old" value="{{ $fetch_sale_bookings[0]->total_paid }}">
                                                <label for="exampleName">Total Paid</label>
                                                 <input type="text" class="form-control" id="utotal_paid" name="utotal_paid" aria-describedby="emailHelp" placeholder="Total Paid" readonly="true" value="{{ $fetch_sale_bookings[0]->total_paid }}">
                                            </div>                                            
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Total Remaining</label>
                                                  <input type="hidden" name="utotal_remaining_old"  id="utotal_remaining_old" value="{{ $fetch_sale_bookings[0]->total_remaining }}">
                                                <input type="text" class="form-control" id="utotal_remaining" name="utotal_remaining" aria-describedby="emailHelp" placeholder="Total Remaining" readonly="true" value="{{ $fetch_sale_bookings[0]->total_remaining }}">
                                            </div>
                                            
                                        </div>


                                        <div class="col-sm-2">
                                             <div class="form-group">
                                              <input type="hidden" name="old_uamount_to_pay" id="old_uamount_to_pay" >
                                                 <label for="exampleName">Amount to Pay</label>
                                                <input type="text" class="form-control" id="uamount_to_pay" name="uamount_to_pay" aria-describedby="emailHelp" placeholder="Amount to pay" onkeypress="javascript:return isNumber(event)">
                                            </div>
                                            
                                        </div>
                                        
                                      
                                        

                                         <div class="col-sm-2">
                                             <div class="form-group">

                                                  <label for="exampleName">Payment Mode</label>
                                                 <select class="form-control select-mul" name="upayment_mode" id="upayment_mode" style="width:230px" required="true">
                                                  <option value="">Select Payment Mode</option>
                                                  <option value="1">Cash</option>
                                                  <option value="2">Bank</option>
                                                  <option value="3">Cheque</option>
                                                  <option value="4">Credit Card</option>
                                                  <option value="5">Debit Card</option>
                                                </select>
                                            </div>
                                        </div>

                                         <div id="ucheque1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Cheque No</label>
                                            <input type="text" class="form-control" id="ucheque_no" name="ucheque_no" aria-describedby="emailHelp" placeholder="Cheque No">
                                          </div>                                            
                                        </div>
                                        <div id="ucheque2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Bank Name</label>
                                            <input type="text" class="form-control" id="ucheque_bank_name" name="ucheque_bank_name" aria-describedby="emailHelp" placeholder="Bank Name">
                                          </div>                                            
                                        </div>


                                         <div id="ucredit_card1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Transaction No</label>
                                            <input type="text" class="form-control" id="ucredit_card_transaction_no" name="ucredit_card_transaction_no" aria-describedby="emailHelp" placeholder="Transaction No">
                                          </div>                                            
                                        </div>
                                        <div id="ucredit_card2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Bank Name</label>
                                            <input type="text" class="form-control" id="ucredit_card_bank_name" name="ucredit_card_bank_name" aria-describedby="emailHelp" placeholder="Bank Name">
                                          </div>                                            
                                        </div>

                                         <div id="udebit_card1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Transaction No</label>
                                            <input type="text" class="form-control" id="udebit_card_transaction_no" name="udebit_card_transaction_no" aria-describedby="emailHelp" placeholder="Transaction No">
                                          </div>                                            
                                        </div>
                                        <div id="udebit_card2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Bank Name</label>
                                            <input type="text" class="form-control" id="udebit_card_bank_name" name="udebit_card_bank_name" aria-describedby="emailHelp" placeholder="Bank Name">
                                          </div>                                            
                                        </div>

                                        <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Payment Description</label>
                                               <textarea class="form-control" id="upayment_description" name="upayment_description" rows="3"></textarea>
                                            </div>
                                            
                                        </div>

                                        <div class="col-sm-2">
                                             <div class="form-group">
                                                 <label for="exampleName">Payee Name</label>
                                                <input type="text" class="form-control" id="upayee_name" name="upayee_name" aria-describedby="emailHelp" placeholder="Payee Name" required="true">
                                            </div>
                                        </div>
                                        
                                          <div class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName">Creator Name</label>
                                                  <input class="form-control" type="text" name="ucreator_name" id="ucreator_name" >
                                            </div>
                                            
                                        </div>
                                        
                                         <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName"><b style="color:red;">Is this amount finance Payment?</b> </label><br>
                                              
                                               <input type="radio" name="ufinance_status" id="ufinance_status_no" value="0" checked="true"> No<br>
                                               <input type="radio" name="ufinance_status" id="ufinance_status_yes" value="1" > Yes

                                            </div>
                                        </div>
                                        
                                        
                                          <div  class="col-sm-2">
                                             <div class="form-group">
                                                <label for="exampleName"><b style="color:red;">Is this amount Exchange Payment?</b> </label><br>
                                              
                                               <input type="radio" name="uexchange_status" id="uexchange_status_no" value="0" checked="true"> No<br>
                                               <input type="radio" name="uexchange_status" id="uexchange_status_yes" value="1" > Yes

                                            </div>
                                        </div>
                                        
                                        


                                       <div  class="col-sm-12" style="display:none;">
                                             <div class="form-group">
                                                <label for="exampleName"><b style="color:red;font-size:20px;">If you dont want to add this amount to opening balance. Please select 'yes' here!!!!</b> </label><br>
                                              
                                               <input type="radio" name="uamount_status" id="uamount_status_no" value="0" > No<br>
                                               <input type="radio" name="uamount_status" id="uamount_status_yes" value="1" > Yes

                                            </div>
                                        </div>


                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" value="update" class="btn btn-primary">Update</button>
                <button type="submit"  value="update-and-print"class="btn btn-success">Update & Print</button>
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
                  <th>Creator Name</th>
                  <th>Receipt No</th>
                  <th>Date</th> 
                  <th>Paid</th> 
                  <th>Payment Mode</th>
                  <th>Description</th>
                  <th>Delete Status</th>
                  <th>Cancel Status</th>
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
                      <td>{{ $fetch_sale_receipt->creator_name }}</td>
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
                        <?php 
                        $delete_status =  $fetch_sale_receipt->is_deleted;

                        if($delete_status == 0)
                        {
                          ?>
                          <center><button type="button" class="btn btn-info">Not Deleted!</button></center>

                          <?php
                        }
                        else
                        {
                          ?>
                          <center><button type="button" class="btn btn-danger">Deleted!</button></center>

                          <?php
                        }

                        ?>

                      </td>


                       <td>
                        <?php 

                        $cancel_status =  $fetch_sale_receipt->cancel_status;

                        if($cancel_status == 0)
                        {

                          ?>
                          <center><button type="button" class="btn btn-info">Not Cancel!</button></center>

                          <?php

                        }
                        else
                        {
                          ?>
                          <center><button type="button" class="btn btn-danger">Canceled!</button></center>

                          <?php
                        }

                        ?>

                      </td>

                      


                      <td>
                        <center>
                          <?php
                          if($delete_status == 0 && $cancel_status == 0)
                          {

                          ?>
                            <button type="button"  onclick="return confirm('Are you sure want to edit this receipt?')"  name="edit-single-receipt" id="edit-single-receipt" class="btn btn-primary btn-circle m-rb-5 edit-single-receipt" data-id="{{ $fetch_sale_receipt->id }}"><i class="fa fa-edit" title="Edit"></i></button>

                          <a href="/delete_single_receipt/{{ $fetch_sale_receipt->id }}/{{ $fetch_sale_receipt->booking_order_id }}/{{ $fetch_sale_receipt->balance_sheet_unique_id }}/{{ $fetch_sale_receipt->customer_id }}"> <button type="button"  onclick="return confirm('Are you sure want to delete? If you delete this receipt. This receipt no will not continue!!!')" name="delete-single-receipt" id="delete-single-receipt" class="btn btn-warning btn-circle m-rb-5 delete-single-receipt" ><i class="glyphicon glyphicon-trash" title="delete"></i></button> </a>
                        </center>

                        <?php
                          }
                        ?>
                      </td>

                     

                      <td>
                        <?php
                          if($delete_status == 0 && $cancel_status == 0)
                          {

                          ?>
                       <center><a href="/print-customer-receipt/{{ $fetch_sale_receipt->id }}" target="_blank"><button type="button" class="btn btn-success" >Print</button></a></center>
                       <?php
                     }
                       ?>
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
                      <td>HYP</td>
                      <td>Rs : {{ $fetch_sale_bookings[0]->bank_name ?: 'No' }}</td>
                    </tr>
                    <tr>                      
                      <td>IP</td>
                      <td>Rs : {{ $fetch_sale_bookings[0]->initial_balance ?: '0' }}</td>
                    </tr>
                    <tr>                      
                      <td>Exchange value</td>
                      <td>Rs : {{ $fetch_sale_bookings[0]->valuable_amount ?: '0' }}</td>
                    </tr>
                    
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
//$('#ureceipt_date').datepicker('setDate', 'today');


$('#payment_mode').on('change', function() {

  if ($(this).val() == "3")
  {
     $("#cheque_no").prop('required',true);
    $("#cheque_bank_name").prop('required',true);




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

    $("#credit_card_transaction_no").prop('required',true);
    $("#credit_card_bank_name").prop('required',true);

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
    $("#debit_card_transaction_no").prop('required',true);
    $("#debit_card_bank_name").prop('required',true);


    $("#debit_card1").show();
    $("#debit_card2").show();    
  }
  else
  { 
    $("#debit_card1").hide();
    $("#debit_card2").hide();
  }

});


$('#upayment_mode').on('change', function() {

  if ($(this).val() == "3")
  {
    $("#ucheque_no").prop('required',true);
    $("#ucheque_bank_name").prop('required',true);

   
    $("#ucheque1").show();
    $("#ucheque2").show();    
  }
  else
  { 
    $("#ucheque1").hide();
    $("#ucheque2").hide();
  }

  if ($(this).val() == "4")
  {
    $("#ucredit_card_transaction_no").prop('required',true);
    $("#ucredit_card_bank_name").prop('required',true);

    $("#ucredit_card1").show();
    $("#ucredit_card2").show();    
  }
  else
  { 
    $("#ucredit_card1").hide();
    $("#ucredit_card2").hide();
  }


  if ($(this).val() == "5")
  {

    $("#udebit_card_transaction_no").prop('required',true);
    $("#udebit_card_bank_name").prop('required',true);

    $("#udebit_card1").show();
    $("#udebit_card2").show();    
  }
  else
  { 
    $("#udebit_card1").hide();
    $("#udebit_card2").hide();
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
         
         var total_paid_old = 0;
         var total_remaining_old=0;

        
    
        var total_paid = parseFloat($("#total_paid").val()) || 0; 
        var total_remaining = parseFloat($("#total_remaining").val()) || 0; 
        var amount_to_pay = parseFloat($("#amount_to_pay").val()) || 0;
        
        
        var total_paid_old = parseFloat($("#total_paid_old").val()) || 0;
         var total_remaining_old = parseFloat($("#total_remaining_old").val()) || 0;


        

        var total_remaining_replace = parseFloat(total_remaining_old) - parseFloat(amount_to_pay);
        var paid_replace = parseFloat(total_paid_old) + parseFloat(amount_to_pay);

        $('#total_paid').val(paid_replace);
        $('#total_remaining').val(total_remaining_replace);
      
     }

    $('#uamount_to_pay').on('change', function() {
      ucalculate_paid_total();

     });

      var ucalculate_paid_total = function(){
         var utotal_paid = 0;
         var utotal_remaining = 0;
         var uamount_to_pay = 0;
         var utotal_remaining_replace = 0;
         var upaid_replace = 0;

         var min_total_paid =0;
         var min_total_remaining =0;
         var old_uamount_to_pay = 0;
         
         
         var utotal_paid_old = 0;
         var utotal_remaining_old=0;
         
    
        var utotal_paid = parseFloat($("#utotal_paid").val()) || 0; 
        var utotal_remaining = parseFloat($("#utotal_remaining").val()) || 0; 
        var uamount_to_pay = parseFloat($("#uamount_to_pay").val()) || 0;
        var old_uamount_to_pay = parseFloat($("#old_uamount_to_pay").val()) || 0;
        
        var utotal_paid_old = parseFloat($("#utotal_paid_old").val()) || 0; 
        var utotal_remaining_old = parseFloat($("#utotal_remaining_old").val()) || 0;
        

        var min_total_paid = parseFloat(utotal_paid_old) - parseFloat(old_uamount_to_pay);
        var min_total_remaining =  parseFloat(utotal_remaining_old) + parseFloat(old_uamount_to_pay);





        var utotal_remaining_replace = parseFloat(min_total_remaining) - parseFloat(uamount_to_pay);
        var upaid_replace = parseFloat(min_total_paid) + parseFloat(uamount_to_pay);

        $('#utotal_paid').val(upaid_replace);
        $('#utotal_remaining').val(utotal_remaining_replace);
      
     }


    /* Edit Single Receipt */
           $(document). on("click", ".edit-single-receipt" , function(){
                     

                        var receipt_id = $(this).attr("data-id");

                          if(receipt_id !='')
                          {
                              $.ajax({
                                  type: "POST",
                                  url: app_url+'/edit_single_receipt',
                                  data: {"_token": "{{ csrf_token() }}","receipt_id":receipt_id },

                                  success: function( msg ) {


                                     if(msg.length>0)
                                      {
                                          var count=1; 
                                          for(var i=0; i<msg.length; i++){
                                            
                                               $("#update-receipt").css("display", "block");
                                               $("#add-receipt").css("display", "none");

                                               $("#ureceipt_no").val(msg[i].receipt_no);
                                               $('#ureceipt_date').val(msg[i].receipt_date);
                                               $('#old_uamount_to_pay').val(msg[i].amount_to_pay);
                                               $('#uamount_to_pay').val(msg[i].amount_to_pay);
                                               $('#ucreator_name').val(msg[i].creator_name);
                                               $('#upayment_mode').val(msg[i].payment_mode).trigger('change');
                                               $('#ucheque_no').val(msg[i].cheque_no);
                                               $('#ucheque_bank_name').val(msg[i].cheque_bank_name);

                                               $('#ucredit_card_transaction_no').val(msg[i].credit_card_transaction_no);
                                               $('#ucredit_card_bank_name').val(msg[i].credit_card_bank_name);

                                               $('#udebit_card_transaction_no').val(msg[i].debit_card_transaction_no);
                                               $('#udebit_card_bank_name').val(msg[i].debit_card_bank_name);
                                               $('textarea#upayment_description').val(msg[i].payment_description);

                                             
                                               if(msg[i].amount_status == 1)
                                               {
                                                
                                                 $('#uamount_status_yes').val(1).attr('checked', 'checked');
                                               }
                                               else
                                               {
                                                 $('#uamount_status_no').val(0).attr('checked', 'checked');
                                               }
                                               
                                               
                                                 if(msg[i].finance_status == 1)
                                               {
                                                
                                                 $('#ufinance_status_yes').val(1).attr('checked', 'checked');
                                               }
                                               else
                                               {
                                                 $('#ufinance_status_no').val(0).attr('checked', 'checked');
                                               }
                                               
                                               
                                                 if(msg[i].exchange_status == 1)
                                               {
                                                
                                                 $('#uexchange_status_yes').val(1).attr('checked', 'checked');
                                               }
                                               else
                                               {
                                                 $('#uexchange_status_no').val(0).attr('checked', 'checked');
                                               }
                                               
                                               
                                               
                                                 $("#upayee_name").val(msg[i].payee_name);
                                                $("#ureceipt_id").val(msg[i].id);

                                                $("#ubalance_sheet_unique_id").val(msg[i].balance_sheet_unique_id);

                                          }
                                      }
                                     
                                  }

                             });

                          }

                       


            });
/* End Edit Single Receipt */



</script>