  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dealers     
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dealers</li>
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
                <a class="btn btn-success" href="/new-sub-dealer">
                  Add Dealers
                </a>
              </h3>


              

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Dealers Code</th>
                  <th>Dealers Name</th> 
                  <th>Contact No1</th> 
                  <th>Dealers Address</th>                   
                  <th>Opening Balance</th>
                  <th>Action</th>
                  <th>Receipt</th>
                  <th>Return</th>
                  <th>Warranty</th>
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($dealers as $dealer)
                  @php($count++)
                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ $dealer->dealer_code }}</td>
                          <td>{{ $dealer->dealer_name }}</td>
                          <td>{{ $dealer->contact_no1 }}</td>
                          <td>{!! nl2br($dealer->dealer_address)  !!} </td>
                          <td>{{ $dealer->total_remaining }}</td>
                                                    
                          <td>
                              <center><a onclick="return confirm('Are you sure want to edit?')" href="/edit_sub_dealer/{{ $dealer->id }}"><button type="button" class="btn btn-warning btn-circle m-rb-5"><i class="fa fa-edit"title="Edit"></i></button></a>

                              <a onclick="return confirm('Are you sure want to delete?')" href="/delete_sub_dealer/{{ $dealer->id }}"><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a></center>
                          </td>

                          <td>         
                            <center><a href="/dealer_receipt/{{ $dealer->id }}"><button type="button" class="btn btn-success" >Receipt</button></a></center>
                          </td>

                          <td>         
                            <center>
                              <a href="/dealer-stock/{{ $dealer->id }}"><button type="button" class="btn btn-primary" ><i class="fa fa-eye" title="View Dealers Vehicle Stock"></i></button></a>

                              <a href="/dealer-return/{{ $dealer->id }}"><button type="button" class="btn btn-primary" ><i class="fa fa-retweet" title="Return Vehicle Info"></i></button></a>

                            </center>
                          </td>

                          <td>         
                            <center>
                              <a href="/dealer-warranty/{{ $dealer->id }}"><button type="button" class="btn btn-success" ><i class="fa fa-eye" title="View Dealers Warranty"></i></button></a>
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
      
      
      
       <div class="modal fade" id="modal-default" >
          <div class="modal-dialog">


            <div id="rto_check"  class="modal-content"  style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Rto Check </h4>
              </div>

            <div class="modal-body">


            </div>
            <!-- /.box-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
             
              </div>
                                
                                
                
              </div>

             
            </div>



            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->




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
