  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Return Vehicle Manual        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Return Vehicle Manual</li>
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
                <a class="btn btn-success" href="/add-return-vehicle-manual">
                  Add Return Vehicle Manual
                </a>
              </h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Return Date</th>
                  <th>Dealer Name</th>
                  <th>Vehicle Type</th>
                  <th>Vehicle Model</th>   
                  <th>Vehicle Color</th> 
                  <th>Chassis No</th>
                  <th>Vehicle Amount</th>     
                  <th>Warranty Amount</th>  
                  <th>Total Amount</th>             
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($fetch_return_vehicles as $fetch_return_vehicle)
                  @php($count++)
                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ $fetch_return_vehicle->return_date }}</td>   
                          <td>{{ strtoupper($fetch_return_vehicle->dealer_name) }}</td>                       
                          <td>{{ strtoupper($fetch_return_vehicle->type_of_vehicle) }}</td>
                          <td>{{ strtoupper($fetch_return_vehicle->model) }}</td>
                          <td>{{ strtoupper($fetch_return_vehicle->type_of_color) }}</td>
                          <td>{{ strtoupper($fetch_return_vehicle->chassis_no) }}</td>
                       
                          <td>{{ $fetch_return_vehicle->vehicle_amount }}</td>
                          <td>{{ $fetch_return_vehicle->warranty_amount }}</td>
                             <td>{{ $fetch_return_vehicle->total_amount }}</td>

                                                    
                          <td>                          
                          <center>
                           
                            <a onclick="return confirm('Are you sure want to delete?')"  href="/delete_return_vehicle_manual/{{ $fetch_return_vehicle->id }}" ><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a>
                          </center>
                          
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


