 @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Daily Account Close        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Daily Account Close</li>
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
                <a class="btn btn-success" href="/new-daily-account-close">
                 Create Daily Account Close
                </a>
              </h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Date</th>
                  <th>Closed By</th>
                  <th>Note Count/ Value</th>
                  <th>Total Note Value</th> 
                  <th>Daily Closing Balance</th>  
                  <th>Result</th>                
                  <th>Action</th> 
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($daily_account_close as $dac)
                  @php($count++)
                    <tr>
                          <td>{{ $count }}</td>
                          <td>
                          {{ date("d-m-Y", strtotime($dac->close_date)) }}
                        </td>
                          <td>{{ $dac->close_by }}</td>
                          <td>
                            <table class="table table-bordered">
                              <tr>
                                  <td><?php echo $dac->note_two_thousand; ?></td>
                                  <td><?php echo $dac->two_thousand_count; ?></td>
                                  <td><?php echo $dac->two_thousand_value; ?></td>
                              </tr>
                              <tr>
                                  <td><?php echo $dac->note_five_hundred; ?></td>
                                  <td><?php echo $dac->five_hundred_count; ?></td>
                                  <td><?php echo $dac->five_hundred_value; ?></td>
                              </tr>
                              <tr>
                                  <td><?php echo $dac->note_two_hundred; ?></td>
                                  <td><?php echo $dac->two_hundred_count; ?></td>
                                  <td><?php echo $dac->two_hundred_value; ?></td>
                              </tr>
                              <tr>
                                  <td><?php echo $dac->note_one_hundred; ?></td>
                                  <td><?php echo $dac->one_hundred_count; ?></td>
                                  <td><?php echo $dac->one_hundred_value; ?></td>
                              </tr>
                               <tr>
                                  <td><?php echo $dac->note_fifty; ?></td>
                                  <td><?php echo $dac->fifty_count; ?></td>
                                  <td><?php echo $dac->fifty_value; ?></td>
                              </tr>
                              <tr>
                                  <td><?php echo $dac->note_twenty; ?></td>
                                  <td><?php echo $dac->twenty_count; ?></td>
                                  <td><?php echo $dac->twenty_value; ?></td>
                              </tr>
                               <tr>
                                  <td><?php echo $dac->note_ten; ?></td>
                                  <td><?php echo $dac->ten_count; ?></td>
                                  <td><?php echo $dac->ten_value; ?></td>
                              </tr>
                              <tr>
                                  <td><?php echo $dac->note_five; ?></td>
                                  <td><?php echo $dac->five_count; ?></td>
                                  <td><?php echo $dac->five_value; ?></td>
                              </tr>
                              <tr>
                                  <td><?php echo $dac->note_two; ?></td>
                                  <td><?php echo $dac->two_count; ?></td>
                                  <td><?php echo $dac->two_value; ?></td>
                              </tr>
                               <tr>
                                  <td><?php echo $dac->note_one; ?></td>
                                  <td><?php echo $dac->one_count; ?></td>
                                  <td><?php echo $dac->one_value; ?></td>
                              </tr>
                            </table>
                          </td>
                          <td>
                            {{ $dac->total_note_amount }}
                          </td>

                           <td>
                            {{ $dac->total_soft_amount }}
                          </td>
                           <td>
                            {{ $dac->tally_amount }}
                          </td>
                                                    
                          <td>                          
                          <center>                          
                            <a onclick="return confirm('Are you sure want to delete?')"  href="/delete_daily_account_close/{{ $dac->id }}" ><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a>
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


