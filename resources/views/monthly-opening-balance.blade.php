  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
       Dealers Ledger       
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active"> Dealers Ledger   </li>
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
                Dealers Opening Balance <button class="btn btn-success" data-toggle="modal" data-target="#modal-default"> Filters</button>

                 
              </h3>
              <form method="post" action="/export_assc_ledger" style="float:right;padding-right: 15px;">
                                  @csrf

                                <input type="hidden" name="report_from_date" id="report_from_date" value="{{ $report_from_date }}">
                                <input type="hidden" name="report_to_date" id="report_to_date" value="{{ $report_to_date }}">
                                <input type="hidden" name="dealer_id" id="dealer_id" value="{{ $dealer_id }}">

                                 <button type="submit"  class="btn btn-primary save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>

                                 
                            </form>

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th>DATE</th>
                    <th>R.NO</th>                 
                    <th>PARTICULAR</th>
                    <th>CREDIT</th>
                    <th>DEBIT</th>
                    <th>OB</th>
                  </tr>
                </thead>

                <tbody>
                  @php($count=0)
                  @foreach ($ledger_report_items as $ledger_report_item)
                  @php($count++)
                  <tr style="background-color:#{{ $ledger_report_item->bgColor }}">                   
                    <td>
                      <?php
                      if($ledger_report_item->reportDate !='')
                      {
                        echo $ledger_report_item->reportDate;
                      }
                      else
                      {
                        echo "";
                      }
                      ?>
                    </td>
                    <td>{{ $ledger_report_item->receiptNo }}</td>
                    <td>{{ $ledger_report_item->particular }}</td>
                    <td>{{ $ledger_report_item->credit }}</td>
                    <td>{{ $ledger_report_item->debit }}</td>
                    <td>{{ $ledger_report_item->openingBalance }}</td>
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


         <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Dealers Ledger Filter </h4>
              </div>

              <div class="modal-body">
               <form action="/monthly_opening_balance" method="POST" enctype="multipart/form-data">

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
                        <label for="exampleName">Dealers Name</label>
                        <select class="form-control select2" name="dealer_id" id="dealer_id"  required="true" style="width:100%">
                          <option>Select </option>
                          @foreach ($dealer_lists as $dealer_list)
                          <option value="{{ $dealer_list->id }}">{{ $dealer_list->dealer_name }} </option>
                          @endforeach
                        </select>
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




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 @include('layouts.bottom-footer')

 <script>
  $(function () {

    $('#example1').DataTable();

    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

  });
</script>
