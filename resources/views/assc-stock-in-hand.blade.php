  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
      Stock In Hand (Dealer) 
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active"> Stock In Hand (Dealer) </li>
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
               <form method="post" action="/export_assc_stock_in_hand" style="float:right;padding-right: 15px;">
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
                  <th>Booking Date</th>
                  <th>Vehicle Type</th> 
                  <th>Vehicle Model</th> 
                  <th>Vehicle Color</th>  
                  
                  <th>Chassis No</th>
                  <th>Dealer Name</th>
                </tr>
                </thead>
                <tbody>
                   @php($count=0)
                              @foreach ($assc_stock_in_hands as $vehicle_stock)
                              @php($count++)
                  <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $vehicle_stock->booking_date }}</td>
                    <td>{{ strtoupper($vehicle_stock->type_of_vehicle) }}</td> 
                    <td>{{ strtoupper($vehicle_stock->model) }}</td>
                    <td>{{ strtoupper($vehicle_stock->type_of_color) }}</td>            
                    <td>{{ strtoupper($vehicle_stock->chassis_no) }}</td>  
                    <td>{{ strtoupper($vehicle_stock->dealer_name) }}</td>
                    
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
