  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Vehicle Model Rate         
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Vehicle Model Rate</li>
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
                <a class="btn btn-success" href="/new-vehicle-model">
                  Add Vehicle Model Rate
                </a>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Type</th>
                  <th>Model</th> 
             
                  <th>Customer Sale Rate</th>
                  <th>ASSC Sale Rate</th>
                  <th>Extra Fitting Charge</th>                                
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($vehicle_models as $vehicle_model)
                  @php($count++)
                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ strtoupper($vehicle_model->type_of_vehicle) }}</td>
                          <td>{{ strtoupper($vehicle_model->model) }}</td>
                          <td>{{ $vehicle_model->self_sale_rate }}</td>
                          <td>{{ $vehicle_model->dealer_sale_rate }}</td>
                          <td>{{ $vehicle_model->extra_fitting_charge }}</td>

                          <td>
                             <center><a onclick="return confirm('Are you sure want to edit?')" href="/edit_vehicle_model/{{ $vehicle_model->id }}"><button type="button" class="btn btn-warning btn-circle m-rb-5"><i class="fa fa-edit"title="Edit"></i></button></a>
                              <a onclick="return confirm('Are you sure want to delete?')" href="/delete_vehicle_model/{{ $vehicle_model->id }}"><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a></center> 
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
