  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
      Daily Expense Ledger 
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active">  Daily Expense Ledger </li>
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
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-default"> Filters</button>

              </h3>
               <form method="post" action="/export_daily_ledger" style="float:right;padding-right: 15px;">
                                  @csrf

                                <input type="hidden" name="report_from_date" id="report_from_date" value="{{ $report_from_date }}">
                                <input type="hidden" name="report_to_date" id="report_to_date" value="{{ $report_to_date }}">

                                 <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>

                                 
                            </form>

             

            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>DATE</th>
                  <th>DESCRIPTION</th>                 
                  <th>PERSON NAME</th>
                  <th>VOUCHER TYPE</th>
                  <th>CREDIT</th>
                  <th>DEBIT</th>
                  <th>OB</th>
                </tr>
                </thead>
                <tbody>
                   @php($count=0)
                   @foreach ($voucher_report_items as $voucher_report_item)
                   @php($count++)
                  <tr style="background-color:#{{ $voucher_report_item->colors }}">
                    <td>{{ $voucher_report_item->reportDate }}</td>
                    <td>{{ $voucher_report_item->description }}</td>
                    <td>{{ $voucher_report_item->personName }}</td>
                    <td>{{ $voucher_report_item->voucherType }}</td>
                    <td>{{ $voucher_report_item->credit }}</td>
                    <td>{{ $voucher_report_item->debit }}</td>
                    <td>{{ $voucher_report_item->openingBalance }}</td>
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



       <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">  Filters </h4>
              </div>

              <div class="modal-body">
               <form action="/daily_expense_ledger" method="POST" enctype="multipart/form-data">

                @csrf

                 <div class="box-body">
                   
                        <div class="form-group">
                          <label for="exampleName">Report From Date</label>
                          <input class="form-control" type="date" name="report_from_date" id="report_from_date" required="true">
                        </div>                   

                 
                        <div class="form-group">
                          <label for="exampleName">Report To Date</label>
                          <input class="form-control" type="date" name="report_to_date" id="report_to_date" required="true">
                        </div>
             

                   
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Filter</button>
                      </div>
                   

                  </div>
              <!-- /.box-body -->
            </form>
             
              </div>
               <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      
                                    </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->




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
