  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dealers Monthly Target
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dealers Monthly Target</li>
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
                <a class="btn btn-success" href="/new-assc-monthly-target">
                  Add Dealers Target
                </a>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Dealers Name</th>
                  <th>Month / Year</th> 
                  <th>Target</th>                             
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($assc_targets as $assc_target)
                  @php($count++)
                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ strtoupper($assc_target->dealer_name) }}</td>
                          <td><?php  

                            $target_mon = number_format($assc_target->target_month);
                        
                           $month_name = date("F", mktime(0, 0, 0, $target_mon, 10));
                           echo $month_name;

                          ?> - {{ $assc_target->target_year }}</td>
                          <td>{{ $assc_target->target_qty }}</td>

                          <td>
                             <center><a onclick="return confirm('Are you sure want to edit?')" href="/edit_assc_monthly_target/{{ $assc_target->id }}"><button type="button" class="btn btn-warning btn-circle m-rb-5"><i class="fa fa-edit"title="Edit"></i></button></a>
                              <a onclick="return confirm('Are you sure want to delete?')" href="/delete_assc_monthly_target/{{ $assc_target->id }}"><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a></center> 
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
