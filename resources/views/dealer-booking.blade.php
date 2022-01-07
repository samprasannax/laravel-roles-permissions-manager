  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dealer Booking        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dealer Booking </li>
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
            <form action="/dealer-booking" method="GET" enctype="multipart/form-data">
               
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
                        <div class="form-group">
                            <label for="exampleName">Dealers</label>                            
                            <select class="form-control select2" name="dealer_id" id="dealer_id"   style="width:100%">
                              <option value="">Select </option>
                              @foreach ($dealers as $dealer)
                              <option value="{{ $dealer->id }}">{{ $dealer->dealer_name }} </option>
                              @endforeach
                            </select>
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
                <a class="btn btn-success" href="/new-dealer-booking" style="float: left;margin-right: 9px;">
                  New Booking
                </a>
                
                
                
               <form action="/export_dealer_booking" method="POST" enctype="multipart/form-data" style="float: left;">
                  @csrf
                <input type="hidden" id="report_from_date" name="report_from_date" value="{{ $rfrom_date }}">
                 <input type="hidden" id="report_to_date" name="report_to_date" value="{{ $rto_date }}"> 
                 <input type="hidden" id="dealer_id" name="dealer_id" value="{{ $dealer_id }}"> 
                 <button type="submit" name="submit" class="btn btn-primary">Export</button>
               </form>
               
               
                  @if(session()->get('booking_order_id'))                                              
                              <a href="/dealer_gate_pass_print/{{session()->get('booking_order_id')}}" target="_blank"><button class="btn btn-success"  id="assc-print">Print </button></a>                           
                          @endif 
                          
                          
                            
                          
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Date</th> 
                  <th>Dealer</th> 
                  <th>Total Qty</th>               
                  <th>Total Amount</th>
                  <th>Delivery Status</th>
                  <th>Gate Pass</th>                       
                  <th>Action</th>
                </tr> 
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($dealer_booking_lists as $dealer_booking_list)
                  @php($count++)
                    <tr>                      
                      <td>{{ $count }}</td>
                      <td>{{ date("d-m-Y", strtotime($dealer_booking_list->booking_date)) }}</td>
                      <td>{{ $dealer_booking_list->dealer_name }}</td>
                      <td>{{ $dealer_booking_list->total_qty }}</td>
                      <td>{{ $dealer_booking_list->total_amount }}</td>
                      
                      <td>
                        <center>
                          <?php
                          $delivery_status = $dealer_booking_list->delivery_status;

                          if($delivery_status==0)
                          {
                            ?>
                            <button class="btn btn-danger" >Not Delivered!</button>
                            <?php
                          }
                          if($delivery_status==1)
                          {
                            ?>
                             <button class="btn btn-success" > Delivered!</button>

                            <?php
                          }

                          ?>
                         </center>
                      </td>
                      


                      <td>
                      
                                <button type="button" class="btn btn-success gate-pass" data-id="{{ $dealer_booking_list->order_id }}" data-toggle="modal" data-target="#modal-default" onclick="gate_pass(this)">Gate Pass</button>
                                <?php
                                if($delivery_status==1)
                                {
                                ?>
                                
                                
                                <a href="/dealer_gate_pass_print/{{ $dealer_booking_list->order_id }}" target="_blank"><button type="button" class="btn btn-info" ><i class="fa fa-print"title="Print Gate Pass"></i></button></a>
                                <?php
                                }
                                ?>
                         

                        </center>
                      </td>


                      <td>
                        <center>

                            <a onclick="return confirm('Are you sure want to view?')" href="/view_dealer_booking/{{ $dealer_booking_list->order_id }}"><button type="button" class="btn btn-primary btn-circle m-rb-5"><i class="fa fa-eye"title="View"></i></button></a> 

                            <a onclick="return confirm('Are you sure want to edit?')" href="/edit_dealer_booking/{{ $dealer_booking_list->order_id }}"><button type="button" class="btn btn-warning btn-circle m-rb-5"><i class="fa fa-edit"title="Edit"></i></button></a>

                            <a onclick="return confirm('Are you sure want to delete?')" href="/delete_dealer_booking/{{ $dealer_booking_list->order_id }}/{{ $dealer_booking_list->dealer_id }}"><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a>

                        </center>                                                    
                      </td>
                    </tr>
                    @endforeach
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total Qty</td>
                        <td>{{ $total_qty }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

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

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">


            <div id="model_new_user"  class="modal-content" style="display:block;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Dealer Gate Pass Entry</h4>
              </div>

              <div class="modal-body" >

                        
                                  <!-- form start -->
                                  <form action="/insert_dealer_gate_pass_user" method="POST" enctype="multipart/form-data">
                                      @csrf
                                        <div class="box-body">
                                             <div class="form-group">
                                          <input  class="form-control is-invalid" type="text" name="gate_pass_order_id" id="gate_pass_order_id" value="" readonly="true">
                                          </div>
                                          <div class="form-group">
                                            <label for="exampleName">Person Name</label>
                                            <input type="text" class="form-control is-invalid" id="person_name" name="person_name" aria-describedby="exampleInputEmail1-error" placeholder="Person Name" required="true">
                                          </div>

                                          <div class="form-group">
                                              <label for="exampleName">Description</label>
                                              <textarea class="form-control" id="description" rows="6" name="description" ></textarea>
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




            <div id="model_old_user"  class="modal-content" style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Dealer Gate Pass Entry</h4>
              </div>

              <div class="modal-body">

                        
                                  <!-- form start -->
                                  <form action="/update_dealer_gate_pass_user" method="POST" enctype="multipart/form-data">
                                      @csrf
                                        <div class="box-body">
                                          <input  type="hidden" name="gate_pass_order_id1" id="gate_pass_order_id1" value="">
                                          
                                          <div class="form-group">
                                            <label for="exampleName">Person Name</label>
                                            <input type="text" class="form-control is-invalid" id="person_name1" name="person_name1" aria-describedby="exampleInputEmail1-error" placeholder="Person Name" required="true">
                                          </div>

                                          <div class="form-group">
                                              <label for="exampleName">Description</label>
                                              <textarea class="form-control" id="description1" rows="6" name="description1" ></textarea>
                                          </div>
                                        </div>
                                    <!-- /.box-body -->

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                
                                  </form>
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
    
     $("#assc-print").trigger("click");
     
  });
  
  
    function gate_pass(ths){
        
       
                     $("#gate_pass_order_id").val("");
                     var order_id = $(ths).attr('data-id');
                     $("#gate_pass_order_id").val(order_id);
                            
                           
            
                            $("#model_new_user").css("display", "none");
                            $("#model_old_user").css("display", "none");

                              $.ajax({

                                  type: "POST",
                                  url: app_url+'/fetch_dealer_gate_pass_user', 
                                  data: {"_token": "{{ csrf_token() }}","order_id":order_id },

                                  success: function( msg ) {
                                     if(msg.length>0)
                                      {
                                          var count=1; 
                                          for(var i=0; i<msg.length; i++){                                     
                                            
                                               $("#model_new_user").css("display", "none");
                                               $("#model_old_user").css("display", "block");

                                               $("#gate_pass_order_id1").val(msg[i].booking_order_id);
                                               $("#person_name1").val(msg[i].person_name);
                                               $('textarea#description1').val(msg[i].description);

                                          }
                                      }
                                      else
                                      {
                                              $("#model_new_user").css("display", "block");
                                              $("#model_old_user").css("display", "none");
                                              $("#gate_pass_order_id").val(order_id);

                                      }
                                     
                                  }

                             });
     }



</script>
