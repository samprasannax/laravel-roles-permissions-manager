  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Monthly Imported Vehicle Stock        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Monthly Imported Vehicle Stock</li>
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
              <h3 class="box-title"> Monthly Imported Vehicle List
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Date</th>
                  <th>Type</th>
                  <th>Model</th> 
                  <th>Color</th> 
                  <th>Chassis No</th>
                  <th>Engine No</th>
                  <th>Status</th> 
                </tr>
                
                </thead>
                <tbody>
                    @php($count=0)
                    @foreach ($vehicle_stocks as $vehicle_stock)
                    @php($count++)
                    <tr>

                          <td>{{ $count }}</td>
                          <td>{{ date("d-m-Y", strtotime($vehicle_stock->stock_date)) }}</td>
                          <td>{{ strtoupper($vehicle_stock->type_of_vehicle) }}</td>
                          <td>{{ strtoupper($vehicle_stock->model) }}</td>
                          <td>{{ strtoupper($vehicle_stock->type_of_color) }}</td>
                          <td>{{ strtoupper($vehicle_stock->chassis_no) }}</td>
                          <td>{{ strtoupper($vehicle_stock->engine_no) }}</td>

                          <td>
                            <?php
                             $status_val = $vehicle_stock->status;

                            if($status_val==0)
                            {
                              ?>
                              <button class="btn btn-info">In Stock </button>

                              <?php
                            }
                            else
                            {
                              ?>
                              <button class="btn btn-warning"> Sold </button>
                              
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
        <!-- /.col -->
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
