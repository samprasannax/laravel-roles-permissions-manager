  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Daily Delivery Note
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Report</li>
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
             

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Delivery Date</th>
                  <th>Customer Name</th> 
                  <th>Contact No</th> 
                  <th>Address</th>
                  <th>Sales Person Name</th>                             
                  <th>Vehicle Type</th>
                  <th>Vehicle Model</th>
                  <th>Vehicle Color</th>
                  <th>Chassis No</th>
                  <th>Print</th>
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($fetch_dsc_monthly_sales as $fdms)
                  @php($count++)
                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ date("d-m-Y", strtotime($fdms->delivery_date)) }}</td>
                          <td>{{ strtoupper($fdms->customer_name) }}</td>
                          <td>{{ $fdms->contact_no1}}</td>
                          <td>{{ $fdms->customer_address }}</td>
                          <td>{{ strtoupper($fdms->sales_person_name )}}</td>
                          <td>{{ strtoupper($fdms->type_of_vehicle) }}</td>
                          <td>{{ strtoupper($fdms->model) }} </td>
                          <td>{{ strtoupper($fdms->type_of_color) }} </td>
                          <td>{{ strtoupper($fdms->chassis_no) }} </td>
                         <td>
                                <center><a href="/customer_gate_pass_print/{{ $fdms->booking_order_id }}" target="_blank"><button class="btn btn-info"><i class="fa fa-print"title="Print"></i></button></a> </center>

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




       <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">  Filters </h4>
              </div>

              <div class="modal-body">
               <form action="/daily_delivery_note" method="POST" enctype="multipart/form-data">

                @csrf

                 <div class="box-body">
                   
                        <div class="form-group">
                          <label for="exampleName">Report from date</label>
                          <input class="form-control" type="date" name="report_from_date" id="report_from_date" value="" required="true">
                        </div>               

                 
                        <div class="form-group">
                          <label for="exampleName">Report to date</label>
                          <input class="form-control" type="date" name="report_to_date" id="report_to_date" value="" required="true">
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
