  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
      Cancel Receipt List
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active">Cancel Receipt List </li>
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
               <form method="post" action="/export_cancel_receipt_report" style="float:right;padding-right: 15px;">
                                  @csrf

                                 <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>

                                 
                            </form>
                          </div>
                          
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Receipt No</th> 
                  <th>Receipt Date</th> 
                  <th>Dealer Name</th>                                   
                  <th>Customer Name</th>
                  <th>Paid Amount</th>
                  <th>Payment Mode</th>
                </tr>
                </thead>
                <tbody>
                   @php($count=0)
                              @foreach ($cancel_receipt_reports as $cancel_receipt_report)
                              @php($count++)
                  <tr>
                    <td>{{ $count }}</td>
                    <td>{{ strtoupper($cancel_receipt_report->receipt_no) }}</td>
                    <td>{{ date("d-m-Y", strtotime($cancel_receipt_report->receipt_date)) }}</td>
                    <td>{{ $cancel_receipt_report->dealer_name }}</td> 
                    <td>{{ $cancel_receipt_report->customer_name }}</td>
                    <td>{{ $cancel_receipt_report->amount_to_pay }}</td>
                    <td>

                        <?php

                        $payment_mode = $cancel_receipt_report->payment_mode;

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
                           echo" <br> Cheque No : " .  $cancel_receipt_report->cheque_no;
                           echo" <br> Bank Name : " .  $cancel_receipt_report->cheque_bank_name;
                        }
                        if($payment_mode==4)
                        {
                           echo" <br> Payment Mode : Credit Card";
                           echo" <br> Transaction No : " . $cancel_receipt_report->credit_card_transaction_no;
                           echo" <br> Bank Name : " .  $cancel_receipt_report->credit_card_bank_name;
                        }
                        if($payment_mode==5)
                        {
                           echo" <br> Payment Mode : Debit Card";
                           echo" <br> Transaction No : " . $cancel_receipt_report->debit_card_transaction_no;
                           echo" <br> Bank Name : " . $cancel_receipt_report->debit_card_bank_name;
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 @include('layouts.bottom-footer')

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
    })
  })
</script>
