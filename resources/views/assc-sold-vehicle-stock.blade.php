  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
      Sold Vehicle Stock
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active">Dealer Sold Vehicle Stock </li>
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
                    <button class="btn btn-success" data-toggle="modal" data-target="#modal-default1"> Filters</button>
                </h3>
            
                          <form method="post" action="/export_assc_sold_vehicle_stock" style="float:right;padding-right: 15px;">
                                  @csrf
                                  
                                  
                                <input type="hidden" name="report_from_date" id="report_from_date" value="{{ $report_from_date }}" required="true">
                                <input type="hidden" name="report_to_date" id="report_to_date" value="{{ $report_to_date }}"  required="true">

                                 <input type="hidden" name="dealer_id" id="dealer_id" value="{{ $dealer_id }}">
                                 
                                 <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>
                          </form>


            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                   <th>Purchase Date</th> 
                     <th>Booking Date</th> 
                  <th>Delivery Date</th> 
                  <th>Vehicle Type</th> 
                  <th>Vehicle Model</th> 
                  <th>Vehicle Color</th>  
                  
                  <th>Chassis No</th>
                  <th>Engine No</th>
                  <th>Customer Name</th>
                  <th>Contact No</th>
                  <th>Dealer Name</th>
                  <th>RTO Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                   @php($count=0)
                              @foreach ($vehicle_stocks as $vehicle_stock)
                              @php($count++)
                  <tr>
                    <td>{{ $count }}</td>
                    <td><?php
                      if($vehicle_stock->stock_date !='')
                    {
                       echo   date("d-m-Y", strtotime($vehicle_stock->stock_date));
                    }
                    ?></td>
                        <td><?php
                      if($vehicle_stock->booking_date !='')
                    {
                       echo   date("d-m-Y", strtotime($vehicle_stock->booking_date));
                    }
                    ?></td>
                    
                    <td><?php
                      if($vehicle_stock->delivery_date !='')
                    {
                       echo   date("d-m-Y", strtotime($vehicle_stock->delivery_date));
                    }
                    ?></td>
                    <td>{{ strtoupper($vehicle_stock->type_of_vehicle) }}</td> 
                    <td>{{ strtoupper($vehicle_stock->model) }}</td>
                    <td>{{ strtoupper($vehicle_stock->type_of_color) }}</td>            
                    <td>{{ strtoupper($vehicle_stock->chassis_no) }}</td> 
                    <td>{{ strtoupper($vehicle_stock->engine_no) }}</td>
                    <td>{{ strtoupper($vehicle_stock->assc_customer_name) }}</td>
                    <td>{{ strtoupper($vehicle_stock->contact_no) }}</td>
                    <td>{{ strtoupper($vehicle_stock->dealer_name) }}</td>
                     <td><?php
                    if($vehicle_stock->rto_date !='')
                    {
                       echo   date("d-m-Y", strtotime($vehicle_stock->rto_date));
                    }
                   
                    
                    ?></td>
                     <td>
                         <button type="button"  onclick="update_rto(this)" class="btn btn-primary update-assc" data-id="{{ $vehicle_stock->id }}" data-toggle="modal" data-target="#modal-default" >Add RTO Date</button>
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
      
      
      

       <div class="modal fade" id="modal-default">
          <div class="modal-dialog">


            <div id="assc_new_user"  class="modal-content" style="display:block;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Dealer Sale Deatils</h4>
              </div>

              <div class="modal-body">

                        
                                  <!-- form start -->
                                  <form action="/update_assc_rto_date" method="POST" enctype="multipart/form-data">
                                      @csrf
                                          <div class="box-body">
                                          <input  type="hidden" name="unique_id" id="unique_id">
                                          
                                          <div class="form-group">
                                            <label for="exampleName">RTO Date</label>
                                            <input type="date" class="form-control is-invalid" id="rto_date" name="rto_date" aria-describedby="exampleInputEmail1-error"  >
                                          </div>

                                        </div>
                                    <!-- /.box-body -->
                                     <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                      </div>
                                
                                  </form>
                                
                
              </div>

             
            </div>


            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
        
        <div class="modal fade" id="modal-default1">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Dealer Filters </h4>
              </div>

              <div class="modal-body">
               <form action="/assc_sold_vehicle_stock" method="POST" enctype="multipart/form-data">

                @csrf

                 <div class="box-body">
                   
                        <div class="form-group">
                          <label for="exampleName">Report From Date</label>
                          <input class="form-control" type="date" name="report_from_date" id="report_from_date" required="true">
                        </div>
                   

                 
                        <div class="form-group">
                          <label for="exampleName">Report To Date</label>
                          <input class="form-control" type="date" name="report_to_date" id="report_to_date" required="true">
                        </div>
                 

                   
                      <div class="form-group">
                        <label for="exampleName">Dealer Name</label>
                        <select class="form-control select2" name="dealer_id" id="dealer_id"   style="width:100%">
                          <option value="">Select </option>
                          @foreach ($dealer_lists as $dealer_list)
                          <option value="{{ $dealer_list->id }}">{{ $dealer_list->dealer_name }} </option>
                          @endforeach
                        </select>
                      </div>
                  

                   
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Filter</button>
                      </div>
                   

                  </div>
              <!-- /.box-body -->
            </form>
             
              </div>
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
  
  
     function update_rto(ths){
           var unique_id = $(ths).attr('data-id');
                                               $("#assc_new_user").css("display", "block");
                              $.ajax({


                                  type: "POST",
                                  url: app_url+'/fetch_assc_user_details_for_rto',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {
                                     if(msg.length>0)
                                      {
                                      
                                                $("#assc_new_user").css("display", "block");
                                              

                                                $("#unique_id").val(msg[0].id);
                                                
                                                $("#rto_date").val(msg[0].rto_date);
                                            
                                         
                                      }
                                      else
                                      {


                                              $("#assc_new_user").css("display", "block");

                                      }
                                     
                                  }

                             });
     }


</script>
