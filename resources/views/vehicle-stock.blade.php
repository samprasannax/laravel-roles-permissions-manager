  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Vehicle Stock        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Vehicle Stock</li>
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





     <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">           
            <!-- /.box-header -->
            
            <!-- form start -->
            <form action="/vehicle-stock" method="GET" enctype="multipart/form-data">
               
                  <div class="box-body">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleName">From Date</label>
                            <input type="date" class="form-control" id="report_from_date" name="report_from_date"   required="true">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleName">To Date</label>                            
                            <input type="date" class="form-control" id="report_to_date" name="report_to_date"   required="true">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group filter-btn">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>


                  </div>
              <!-- /.box-body -->

            </form>
          </div>
          <!-- /.box -->

        
        </div>
        
        
        

        <div class="col-xs-12">

            <div class="box">
            <div class="box-header">
              <h3 class="box-title"> 
                <a class="btn btn-success" href="/new-vehicle-stock">
                  Add Vehicle Stock
                </a>  <a class="btn btn-info" href="/import-stock">
                  Import Stock
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
                  <th>Type</th>
                  <th>Model</th> 
                  <th>Color</th> 
                  <th>Chassis No</th>
                  <th>Engine No</th>
                  <th>Status</th>             
                  <th>Action</th>
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
                              $sale_type=$vehicle_stock->sale_type;
                              if($sale_type=='dealer')
                              {
                                  ?>
                                   <button type="button" class="btn btn-primary"  data-id="{{ $vehicle_stock->id }}" data-toggle="modal" data-target="#modal-default" onclick="fetch_dealer_sold_details(this)"><i class="fa fa-eye" title="View ASSC Vehicle Stock"></i></button>
                                  
                                  <?php
                              }else
                              {
                                  ?>
                                   <button type="button" class="btn btn-primary"  data-id="{{ $vehicle_stock->id }}" data-toggle="modal" data-target="#modal-default" onclick="fetch_customer_sold_details(this)"><i class="fa fa-eye" title="View Customer Vehicle Stock"></i></button>
                                  <?php
                              }
                              
                              
                            }

                            ?>
                          </td>
                                                    
                          <td>
                          
                          <center><a onclick="return confirm('Are you sure want to edit?')" href="/edit_vehicle_stock/{{ $vehicle_stock->id }}"><button type="button" class="btn btn-warning btn-circle m-rb-5"><i class="fa fa-edit"title="Edit"></i></button></a>
                            
                          <a onclick="return confirm('Are you sure want to delete?')" href="/delete_vehicle_stock/{{ $vehicle_stock->id }}"><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a></center>
                          
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
      
      
      
      
       <div class="modal fade" id="modal-default" >
          <div class="modal-dialog">


            <div id="rto_check"  class="modal-content"  style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Sold Details</h4>
              </div>

            <div class="modal-body">
                   <table id="example1" class="table table-bordered table-striped">                
                  <tbody>                
                      <tr><td>ASSC / Customer</td> <td><span id="ac1"> </span>  </td></tr>
                      <tr><td>Name </td> <td>  <span id="ac_name1"> </span> </td></tr>


                  </tbody>
                </table>


            </div>
            <!-- /.box-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
             
              </div>
                                
                                
            
            </div>



  <div id="rto_check1"  class="modal-content"  style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Sold Details</h4>
              </div>

            <div class="modal-body">
                   <table id="example1" class="table table-bordered table-striped">                
                  <tbody>                
                      <tr><td>ASSC / Customer</td> <td><span id="ac"> </span>  </td></tr>
                      <tr><td>Name </td> <td>  <span id="ac_name"> </span> </td></tr>


                  </tbody>
                </table>


            </div>
            <!-- /.box-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
             
              </div>
                                
                                
            
            </div>



            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 @include('layouts.bottom-footer')


 <script>
   var app_url = "{{config('app.url')}}";  
</script>

 <script>
 
 
     function fetch_dealer_sold_details(ths){

            var unique_id = $(ths).attr('data-id');
            
           // alert(unique_id);

            $("#rto_check").css("display", "none");
            
            $("#rto_check1").css("display", "none");

               $.ajax({


                                  type: "POST",
                                  url: app_url+'/fetch_dealer_sold_details',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {

                                     if(msg.length>0)
                                      {
                                        // alert(msg.length);

                                                $("#rto_check").css("display", "block"); 
                                                $("#rto_check1").css("display", "none");
                                               
                                              
                                                    $("#ac1").text("");
                                                    $("#ac_name1").text("");
                                                     $("#ac1").text('DEALER');
                                                    $("#ac_name1").text(msg[0].dealer_name);
                                                   
                                            

                                       
                                      }
                                      else
                                      {

                                                $("#rto_check").css("display", "none");  
                                                $("#rto_check1").css("display", "none");

                                                 $("#ac_name1").text("");
                                                 $("#ac1").text("");
                                              

                                      }
                                     
                                     
                                  }

                             });
          
                                           

     }
     
     
      
     function fetch_customer_sold_details(ths){

            var unique_id = $(ths).attr('data-id');
            
           // alert(unique_id);

            $("#rto_check").css("display", "none");
            
            $("#rto_check1").css("display", "none");

               $.ajax({


                                  type: "POST",
                                  url: app_url+'/fetch_customer_sold_details',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {

                                     if(msg.length>0)
                                      {
                                      //  alert(msg.length);

                                                $("#rto_check1").css("display", "block"); 
                                                $("#rto_check").css("display", "none");
                                                
                                              
                                                    $("#ac").text("");
                                                    $("#ac_name").text("");
                                                     $("#ac").text('CUSTOMER');
                                                    $("#ac_name").text(msg[0].customer_name);
                                                   
                                            
                                                

                                       
                                      }
                                      else
                                      {

                                                $("#rto_check1").css("display", "none");  
                                                $("#rto_check").css("display", "none");

                                                 $("#ac_name").text("");
                                                 $("#ac").text("");
                                              

                                      }
                                     
                                     
                                  }

                             });
          
                                           

     }
     
     
     
     
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
