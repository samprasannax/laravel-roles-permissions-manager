  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Assc Opening Balance   
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Assc Opening Balance</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
                    

        <div class="col-xs-12">

            <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Assc Opening Balance
              </h3>
              
              
               <form method="post" action="/export_assc_opening_balance" style="float:right;padding-right: 15px;">
                                  @csrf

                               
                                 <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>

                                 
                            </form>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Dealer Name</th>
                  <th>Balance</th>
                  <th>Unclear</th>
                </tr>
                
                </thead>
                <tbody>
                    @php($count=0)
                    @foreach ($dealer_open as $dob)
                    @php($count++)
                    <tr>

                          <td>{{ $count }}</td>
                          <td>{{ strtoupper($dob->dealer_name) }}</td>
                          <td><?php 
                          $opening_balance = $dob->total_remaining;
                          if($opening_balance < 0)
                          {
                              echo $opening_balance;
                          }
                          else
                          {
                              echo"0";
                          }
                          ?></td>
                          <td><?php 
                           if($opening_balance > 0)
                          {
                              echo $opening_balance;
                          }
                          else
                          {
                              echo"0";
                          }
                          ?></td>
                      </tr>
                      
                  @endforeach
                  <tr>
                          <td></td>
                          <td>Pending / Unclear</td>
                          <td><?php echo $negative_total; ?></td>
                          <td><?php echo $passitive_total; ?></td>
                          
                      </tr>
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
