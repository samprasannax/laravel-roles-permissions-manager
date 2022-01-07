  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dealers Rate Info         
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dealers Rate Info</li>
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
                <a class="btn btn-success" href="/new-dealer-rate-info">
                  Add Dealer Rate
                </a>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Dealer Name</th>
                  <th>Type</th>
                  <th>Model</th> 
                  <th>Rate</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($dealer_rates as $dealer_rate)
                  @php($count++)
                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ $dealer_rate->dealer_name }}</td>
                          <td>{{ strtoupper($dealer_rate->type_of_vehicle) }}</td>
                          <td>{{ strtoupper($dealer_rate->model) }}</td>
                          <td>{{ $dealer_rate->dealer_sale_rate }}</td>
                          <td>
                          <center><a onclick="return confirm('Are you sure want to edit?')" href="/edit_dealer_rate_info/{{ $dealer_rate->id }}"><button type="button" class="btn btn-warning btn-circle m-rb-5"><i class="fa fa-edit"title="Edit"></i></button></a>
                          <a onclick="return confirm('Are you sure want to delete?')" href="/delete_dealer_rate_info/{{ $dealer_rate->id }}"><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a></center> 
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
