  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Cash In Hand Credit        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/voucher-credit-list">View Cash In Hand Credit</a></li>
        <li class="active">Edit Cash In Hand Credit</li>
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
            <form action="/update_voucher_credit" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="box-body">
              
                <input type="hidden" name="voucher_receipt_unique_id" id="voucher_receipt_unique_id" value="{{ $edit_voucher_receipt[0]->id }}">

                <input type="hidden" name="unique_id" id="unique_id" value="{{ $edit_voucher_receipt[0]->unique_id }}">
                 <input type="hidden" name="order_id" id="order_id" value="{{ $edit_voucher_receipt[0]->order_id }}">

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Credit No</label>
                                                <input type="text" class="form-control" id="voucher_no" name="voucher_no" aria-describedby="emailHelp" placeholder="Voucher No" value="{{ $edit_voucher_receipt[0]->voucher_no }}" readonly="true">
                                            </div>
                                        </div> 

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Date</label>
                                                <input type="date" class="form-control" id="voucher_date" name="voucher_date" aria-describedby="emailHelp" value="{{ $edit_voucher_receipt[0]->voucher_date }}" required="true">
                                            </div>
                                        </div>
 
                                   


                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName"> Person Name</label>
                                                <input type="text" class="form-control" id="person_name" name="person_name" aria-describedby="emailHelp" placeholder="person Name" value="{{ $edit_voucher_receipt[0]->person_name }}">
                                            </div>
                                        </div>

                                    


                                        <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                                          <h3 class="box-title">Payment</h3>
                                        </div>



                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="exampleName">Amount</label>
                                                <input type="text" class="form-control" id="voucher_amount" name="voucher_amount" aria-describedby="emailHelp" placeholder="Voucher Amount" onkeypress="javascript:return isNumber(event)"  required="true" value="{{ $edit_voucher_receipt[0]->voucher_amount }}">
                                            </div>
                                        </div>

                                         <div class="col-sm-2">
                                             <div class="form-group">
                                                  <label for="exampleName">Payment Mode</label>
                                                 <select class="form-control select2" name="payment_mode" id="payment_mode" required="true">
                                                  <option value="">Select Payment Mode</option>
                                                  <option value="1"  @if($edit_voucher_receipt[0]->payment_mode==1) selected @endif >Cash</option>
                                                  <option value="2" @if($edit_voucher_receipt[0]->payment_mode==2) selected @endif>Bank</option>
                                                  <option value="3" @if($edit_voucher_receipt[0]->payment_mode==3) selected @endif>Cheque</option>
                                                  <option value="4" @if($edit_voucher_receipt[0]->payment_mode==4) selected @endif>Credit Card</option>
                                                  <option value="5" @if($edit_voucher_receipt[0]->payment_mode==5) selected @endif>Debit Card</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="cheque1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Cheque No</label>
                                            <input type="text" class="form-control" id="cheque_no" name="cheque_no" aria-describedby="emailHelp" placeholder="Cheque No" value="{{ $edit_voucher_receipt[0]->cheque_no }}">
                                          </div>                                            
                                        </div>
                                        <div id="cheque2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Bank Name</label>
                                            <input type="text" class="form-control" id="cheque_bank_name" name="cheque_bank_name" aria-describedby="emailHelp" placeholder="Bank Name" value="{{ $edit_voucher_receipt[0]->cheque_bank_name }}">
                                          </div>                                            
                                        </div>


                                         <div id="credit_card1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Transaction No</label>
                                            <input type="text" class="form-control" id="credit_card_transaction_no" name="credit_card_transaction_no" aria-describedby="emailHelp" placeholder="Transaction No" value="{{ $edit_voucher_receipt[0]->credit_card_transaction_no }}">
                                          </div>                                            
                                        </div>
                                        <div id="credit_card2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Bank Name</label>
                                            <input type="text" class="form-control" id="credit_card_bank_name" name="credit_card_bank_name" aria-describedby="emailHelp" placeholder="Bank Name" value="{{ $edit_voucher_receipt[0]->credit_card_bank_name }}">
                                          </div>                                            
                                        </div>

                                         <div id="debit_card1" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Transaction No</label>
                                            <input type="text" class="form-control" id="debit_card_transaction_no" name="debit_card_transaction_no" aria-describedby="emailHelp" placeholder="Transaction No" value="{{ $edit_voucher_receipt[0]->debit_card_transaction_no }}">
                                          </div>                                            
                                        </div>
                                        <div id="debit_card2" class="col-sm-2" style="display:none;">
                                          <div class="form-group">
                                            <label for="exampleName">Bank Name</label>
                                            <input type="text" class="form-control" id="debit_card_bank_name" name="debit_card_bank_name" aria-describedby="emailHelp" placeholder="Bank Name" value="{{ $edit_voucher_receipt[0]->debit_card_bank_name }}">
                                          </div>                                            
                                        </div>



                                        <div class="col-sm-3">
                                         <div class="form-group">
                                                <label for="exampleName">Description</label>
                                                
                                                  <textarea class="form-control" id="voucher_description" rows="6" name="voucher_description" >{{ $edit_voucher_receipt[0]->voucher_description }}</textarea>
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
$(function(){

var payment_mode1 =  $("#payment_mode").val();

  if (payment_mode1 == "3")
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

});

 </script>
