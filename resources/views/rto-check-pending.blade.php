  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
      RTO Check Pending
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active"> RTO Check Pending </li>
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
                  <th>Customer</th>
                  <th>DSC</th>
                  <th>Mechanic</th>                 
                  <th>Vehicle Type</th>
                  <th>Model</th>
                  <th>Color</th>
                  <th>Chassis No</th>
                  <th>Delivery Date</th>
                </tr>
                </thead>
                <tbody>
                   @php($count=0)
                              @foreach ($rto_check_pendings as $rto_check_pending)
                              @php($count++)
                  <tr>
                    <td>{{ $count }}</td>
                    <td>{{ strtoupper($rto_check_pending->customer_name) }}</td>
                    <td>{{ strtoupper($rto_check_pending->sales_person_name) }}</td>
                    <td>{{ strtoupper($rto_check_pending->mechanic_name) }}</td>
                    <td>{{ strtoupper($rto_check_pending->type_of_vehicle) }}</td>
                    <td>{{ strtoupper($rto_check_pending->model) }}</td>
                    <td>{{ strtoupper($rto_check_pending->type_of_color) }}</td>
                    <td>{{ strtoupper($rto_check_pending->chassis_no) }}</td>
                    <td>{{ date("d-m-Y", strtotime($rto_check_pending->delivery_date)) }}</td>                      
                   
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
