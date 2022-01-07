  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Cash In Hand Credit        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/voucher-credit-list">View Cash In Hand Credit</a></li>
        <li class="active">Create Cash In Hand Credit</li>
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
            <form action="/insert_voucher_credit" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="box-body">
              
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Credit No</label>
                                                <input type="text" class="form-control" id="voucher_no" name="voucher_no" aria-describedby="emailHelp" placeholder="Voucher No" value="{{ $voucher_no }}" readonly="true" required="true">
                                            </div>
                                        </div> 

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Date</label>
                                                <input type="text" class="form-control" id="voucher_date" name="voucher_date" aria-describedby="emailHelp" placeholder="Voucher Date" onkeypress="javascript:return isNumber(event)"  required="true">
                                            </div>
                                        </div>



                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName"> Person Name </label>
                                                <input type="text" class="form-control" id="person_name" name="person_name" aria-describedby="emailHelp" placeholder="person Name"  required="true">
                                            </div>
                                        </div>

                                       

                                        <div class="box-header with-border" style="clear:both;display:block;margin-bottom:20px;">
                                          <h3 class="box-title">Payment</h3>
                                        </div>



                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="exampleName">Amount</label>
                                                <input type="text" class="form-control" id="voucher_amount" name="voucher_amount" aria-describedby="emailHelp" placeholder="Voucher Amount" onkeypress="javascript:return isNumber(event)"  required="true" value="0">
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




                                        <div class="col-sm-2">
                                         <div class="form-group">
                                                <label for="exampleName">Description</label>
                                                
                                                  <textarea class="form-control" id="voucher_description" rows="6" name="voucher_description" ></textarea>
                                            </div>
                                        </div>
                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" value="save"   name="btn_click"  id="btn_click" class="btn btn-primary">Save</button>
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

$('#voucher_date').datepicker('setDate', 'today');


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
