  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
      Return Vehicle Stock
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active">Return Vehicle Stock </li>
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
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Return Date</th>
                  <th>Return Description</th>  
                  <th>Vehicle Type</th> 
                  <th>Vehicle Model</th> 
                  <th>Vehicle Color</th>                                   
                  <th>Chassis No</th>
                  
                </tr>
                </thead>
                <tbody>
                  @if(!empty($return_vehicle_lists))
                   @php($count=0)
                              @foreach ($return_vehicle_lists as $return_vehicle_list)
                              @php($count++)
                  <tr>
                    <td>{{ $count }}</td>
                    <td>{{ date("d-m-Y", strtotime($return_vehicle_list->return_date)) }}</td>
                    <td>{{ $return_vehicle_list->return_description }}</td> 
                    <td>{{ $return_vehicle_list->type_of_vehicle }}</td>
                    <td>{{ $return_vehicle_list->model }}</td>  
                    <td>{{ $return_vehicle_list->type_of_color }}</td>                    
                    <td>{{ $return_vehicle_list->chassis_no }}</td>
                  </tr>     


                  @endforeach
                  @endif           
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
