  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Mechanic Reports
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active">Mechanic Reports </li>
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
                Mechanic Reports
                <!-- <button class="btn btn-success" data-toggle="modal" data-target="#modal-default"> Filters</button> -->
                 
              </h3>

               <form method="post" action="/export_mechanic_report" style="float:right;padding-right: 15px;">
                                  @csrf

                                <!-- <input type="hidden" name="report_from_date" id="report_from_date" value="" required="true">
                                <input type="hidden" name="report_to_date" id="report_to_date" value=""  required="true">

                                 <input type="hidden" name="dsc_id" id="dsc_id" value=""> -->

                                 <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>

                                 
                            </form>
            </div>
            
                     
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Mechanic Name</th> 
                  <th>Contact Number</th> 
                  <!-- <th>Address</th> --> 
                  <th>Vehicle Type</th> 
                  <th>Vehicle Model</th>  
                  <th>Vehicle Color</th>  
                  <th>Booking Date</th> 
                  <th>Mechanic Amount</th>
                  <th>Customer Name</th>
                  <!-- <th>Contact No</th>
                  <th>Sales Executive Name</th> -->
                </tr>
                </thead>
                <tbody>
                        @php($count=0)
                              @foreach ($meachanic_lists as $meachanic_list)
                              @php($count++)
                  <tr>
                    <td>{{ $count }}</td>
                    <td>{{ strtoupper($meachanic_list->mechanic_name) }}</td>
                    <td>{{ $meachanic_list->contact_no1 }}</td> 
                    <!-- <td>{{ strtoupper($meachanic_list->mechanic_address) }}</td> -->
                    <td>{{ strtoupper($meachanic_list->type_of_vehicle) }}</td>
                    <td>{{ strtoupper($meachanic_list->model) }}</td>
                    <td>{{ strtoupper($meachanic_list->type_of_color) }}</td>
                    <td>{{ date("d-m-Y", strtotime($meachanic_list->booking_date)) }}</td>
                    <td>{{ $meachanic_list->mechanic_amount }}</td> 
                    <td>{{ strtoupper($meachanic_list->customer_name) }}</td>
                    <!-- <td>{{ strtoupper($meachanic_list->custno) }}</td>
                    <td>{{ strtoupper($meachanic_list->sales_person_name) }}</td> -->
                   
                    
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
                <h4 class="modal-title">  Sales Executive Filters </h4>
              </div>

              <div class="modal-body">
               <form action="/sold_vehicle_stock" method="POST" enctype="multipart/form-data">

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
                        <label for="exampleName"> Sales Executive Name</label>
                        <select class="form-control select2" name="dsc_id" id="dsc_id"   style="width:100%">
                          <option value="">Select </option>
                          
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
