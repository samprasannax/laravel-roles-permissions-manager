  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

<style>
  .book-info
  {
    border: none;
    background: none;

  }
</style>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1> 
       Sales Booking        
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Sales Booking </li>
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
            <form action="/sales-booking" method="GET" enctype="multipart/form-data">
               
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
                <a class="btn btn-success" href="/new-booking">
                  New Booking
                </a>
                
                          @if(session()->get('receipt_id'))                                              
                              <a href="/print-customer-receipt/{{session()->get('receipt_id')}}" target="_blank"><button class="btn btn-success"  id="sales-print">Print </button></a>                           
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
                  <th>Customer Name</th> 
                  <th>DSC</th> 
                  <th>Payment</th>
                  <th>Total</th>
                  <th>Remaining Amount</th>
                  <th>Total Paid</th>   
                  <th>Action</th>
                  <th>Account Status</th>
                  <th>Delete Status</th>
                  <th>Cancel Status</th>
                  <th>Gate Pass Print</th>
                </tr>
                </thead>
                <tbody>
                    
                    <?php
                    
                     $user = Auth::user()->name;
                     if($user =='Admin')
                     {
                         ?>
                         
                         
                           @php($count=0)
                  @foreach ($fetch_sales_bookings as $fetch_sales_booking)
                  @php($count++)
                  
                  @if($fetch_sales_booking->delivery_note_status == '1')
                  
                  
                   <tr>                      
                      <td>{{ $count }}</td>
                       <td>{{ date("d-m-Y", strtotime($fetch_sales_booking->booking_date)) }}</td>
                      <td>{{ $fetch_sales_booking->customer_name }}</td>
                      <td>{{ $fetch_sales_booking->sales_person_name }}</td>
                      <td>
                          <?php
                          $hyp = $fetch_sales_booking->hyp;
                          if($hyp=='no')
                          {
                              ?>
                             Cash <br>
                              <?php
                          }
                          else
                          {
                              ?>
                              
                             <?php echo $fetch_sales_booking->bank_name;  ?> <br>
                              IP : <?php echo $fetch_sales_booking->initial_balance;  ?> <br>
                              <?php
                          }
                          ?>
                      </td>
                      <td>{{ $fetch_sales_booking->grand_total }}</td>
                      <td>{{ $fetch_sales_booking->total_remaining }}</td>
                      <td>{{ $fetch_sales_booking->total_paid }}</td>

                      <td>
                           <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat">Action</button>
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a onclick="return confirm('Are you sure want to edit?')" href="/edit-sale-booking/{{ $fetch_sales_booking->order_id }}/{{ $fetch_sales_booking->balance_sheet_unique_id }}">Edit</a></li>
                              <li><a onclick="return confirm('Are you sure want to delete?')" href="/delete-booking/{{ $fetch_sales_booking->order_id }}/{{ $fetch_sales_booking->balance_sheet_unique_id }}">Delete</a></li>
                              <li><a onclick="return confirm('Are you sure want to make receipt?')" href="/receipt/{{ $fetch_sales_booking->order_id }}/{{ $fetch_sales_booking->customer_id }}">Receipt</a></li>
                              <li><a onclick="return confirm('Are you sure want to cancel this order?')" href="/cancel_booking/{{ $fetch_sales_booking->order_id }}/{{ $fetch_sales_booking->balance_sheet_unique_id }}/{{ $fetch_sales_booking->customer_id }}">Cancel Receipt</a></li>

                                <?php

                                  $order_id = $fetch_sales_booking->order_id;
                                  $booking_order_id = $fetch_sales_booking->booking_order_id;
                                  

                                  if($order_id == $booking_order_id)
                                  {
                                    ?>
                                     <li><a href="/edit_customer_sale_vehicle_info/{{ $fetch_sales_booking->order_id }}">Delivery Note</a></li>
                                    <?php
                                  }
                                  else
                                  {
                                    ?>
                                     <li><a href="/add_customer_sale_vehicle_info/{{ $fetch_sales_booking->order_id }}">Delivery Note</a></li>
                                    <?php
                                  }
                                ?>

                              @can('admin')


                              <li style="background-color:#e1e3e9;"><button class="manual-close" data-id="{{ $fetch_sales_booking->order_id }}" data-toggle="modal" data-target="#modal-default1" onclick="manual_close(this)">Manual Close </button></li>

                              @endcan

                            </ul>
                          </div>
                          <button  class="btn btn-info booking-info" data-id="{{ $fetch_sales_booking->order_id }}" data-toggle="modal" data-target="#modal-default" onclick="booking_info(this)"><i class="fa fa-eye"title="View"></i></button>
            
                      </td>

                      <td>
                        <?php
                          $account_close_status = $fetch_sales_booking->account_close_status;
                          if($account_close_status==0)
                          {
                            ?>
                             <center> <button class="btn btn-danger btn-xs"><i class="fa fa-times" title="Not Closed!"> </i></button></center>
                            <?php
                          }
                          else
                           {
                            ?>
                            <center>  <button class="btn btn-info btn-xs"><i class="fa fa-check" title="Closed!"> </i></button></a></center>
                            <?php
                          }
                        ?>

                      </td>
                       <td>
                         <?php
                          $delete_status = $fetch_sales_booking->is_deleted;
                          if($delete_status==0)
                          {
                            ?>
                             <center> <button class="btn btn-info btn-xs"><i class="fa fa-times" title="Not Deleted!"> </i></button></center>
                            <?php
                          }
                          else
                           {
                            ?>
                            <center>  <button class="btn btn-warning btn-xs"><i class="fa fa-check" title="Deleted!"> </i></button></center>
                            <?php
                          }
                        ?> 
                      </td>
                       <td>
                          <?php
                          $cancel_status = $fetch_sales_booking->cancel_status;
                          if($cancel_status==0)
                          {
                            ?>
                             <center> <button class="btn btn-info btn-xs"><i class="fa fa-times" title="Not Canceled!"> </i></button></center>
                            <?php
                          }
                          else
                          {
                            ?>

                             <center> <button class="btn btn-warning btn-xs"><i class="fa fa-check" title="Canceled!"> </i></button> <button class="btn btn-info"><a href="/reupdate_cancel/{{ $fetch_sales_booking->order_id }}" onclick="return confirm('Are you sure want to re-update this cancel order?')"><i class="fa fa-refresh"title="Re-update"></i></a></center>
                            <?php
                          }
                        ?>
                      </td>

                      <td>
                        <?php

                           if($fetch_sales_booking->delivery_note_status==1)
                          { 
                        ?>

                        <center><a href="/customer_gate_pass_print/{{ $fetch_sales_booking->order_id }}" target="_blank"><button class="btn btn-info"><i class="fa fa-print"title="Print"></i></button></a> </center>

                        <?php
                      }
                        ?>
                      </td>
                    </tr>
                    
                    @endif
                    
                      @endforeach  
                      
                         
                         <?php
                     }
                     else
                     {
                         ?>
                           @php($count=0)
                  @foreach ($fetch_sales_bookings as $fetch_sales_booking)
                  @php($count++)
                  
                  
                   <tr>                      
                      <td>{{ $count }}</td>
                       <td>{{ date("d-m-Y", strtotime($fetch_sales_booking->booking_date)) }}</td>
                      <td>{{ $fetch_sales_booking->customer_name }}</td>
                      <td>{{ $fetch_sales_booking->sales_person_name }}</td>
                      <td>
                          <?php
                          $hyp = $fetch_sales_booking->hyp;
                          if($hyp=='no')
                          {
                              ?>
                             Cash <br>
                              <?php
                          }
                          else
                          {
                              ?>
                              
                             <?php echo $fetch_sales_booking->bank_name;  ?> <br>
                              IP : <?php echo $fetch_sales_booking->initial_balance;  ?> <br>
                              <?php
                          }
                          ?>
                      </td>
                      <td>{{ $fetch_sales_booking->grand_total }}</td>
                      <td>{{ $fetch_sales_booking->total_remaining }}</td>
                      <td>{{ $fetch_sales_booking->total_paid }}</td>

                      <td>
                           <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat">Action</button>
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a onclick="return confirm('Are you sure want to edit?')" href="/edit-sale-booking/{{ $fetch_sales_booking->order_id }}/{{ $fetch_sales_booking->balance_sheet_unique_id }}">Edit</a></li>
                              <li><a onclick="return confirm('Are you sure want to delete?')" href="/delete-booking/{{ $fetch_sales_booking->order_id }}/{{ $fetch_sales_booking->balance_sheet_unique_id }}">Delete</a></li>
                              <li><a onclick="return confirm('Are you sure want to make receipt?')" href="/receipt/{{ $fetch_sales_booking->order_id }}/{{ $fetch_sales_booking->customer_id }}">Receipt</a></li>
                              <li><a onclick="return confirm('Are you sure want to cancel this order?')" href="/cancel_booking/{{ $fetch_sales_booking->order_id }}/{{ $fetch_sales_booking->balance_sheet_unique_id }}/{{ $fetch_sales_booking->customer_id }}">Cancel Receipt</a></li>

                                <?php

                                  $order_id = $fetch_sales_booking->order_id;
                                  $booking_order_id = $fetch_sales_booking->booking_order_id;
                                  

                                  if($order_id == $booking_order_id)
                                  {
                                    ?>
                                     <li><a href="/edit_customer_sale_vehicle_info/{{ $fetch_sales_booking->order_id }}">Delivery Note</a></li>
                                    <?php
                                  }
                                  else
                                  {
                                    ?>
                                     <li><a href="/add_customer_sale_vehicle_info/{{ $fetch_sales_booking->order_id }}">Delivery Note</a></li>
                                    <?php
                                  }
                                ?>

                              @can('admin')


                              <li style="background-color:#e1e3e9;"><button class="manual-close" data-id="{{ $fetch_sales_booking->order_id }}" data-toggle="modal" data-target="#modal-default1" onclick="manual_close(this)">Manual Close </button></li>

                              @endcan

                            </ul>
                          </div>
                          <button  class="btn btn-info booking-info" data-id="{{ $fetch_sales_booking->order_id }}" data-toggle="modal" data-target="#modal-default" onclick="booking_info(this)"><i class="fa fa-eye"title="View"></i></button>
            
                      </td>

                      <td>
                        <?php
                          $account_close_status = $fetch_sales_booking->account_close_status;
                          if($account_close_status==0)
                          {
                            ?>
                             <center> <button class="btn btn-danger btn-xs"><i class="fa fa-times" title="Not Closed!"> </i></button></center>
                            <?php
                          }
                          else
                           {
                            ?>
                              <center><button class="btn btn-info btn-xs"><i class="fa fa-check" title="Closed!"> </i></button></a></center>
                            <?php
                          }
                        ?>

                      </td>
                       <td>
                         <?php
                          $delete_status = $fetch_sales_booking->is_deleted;
                          if($delete_status==0)
                          {
                            ?>
                             <center> <button class="btn btn-info btn-xs"><i class="fa fa-times" title="Not Deleted!"> </i></button></center>
                            <?php
                          }
                          else
                           {
                            ?>
                              <center><button class="btn btn-warning btn-xs"><i class="fa fa-check" title="Deleted!"> </i></button></center>
                            <?php
                          }
                        ?> 
                      </td>
                       <td>
                          <?php
                          $cancel_status = $fetch_sales_booking->cancel_status;
                          if($cancel_status==0)
                          {
                            ?>
                             <center> <button class="btn btn-info btn-xs"><i class="fa fa-times" title="Not Canceled!"> </i></button></center>
                            <?php
                          }
                          else
                          {
                            ?>

                              <center><button class="btn btn-warning btn-xs"><i class="fa fa-check" title="Canceled!"> </i></button> <button class="btn btn-info"><a href="/reupdate_cancel/{{ $fetch_sales_booking->order_id }}" onclick="return confirm('Are you sure want to re-update this cancel order?')"><i class="fa fa-refresh"title="Re-update"></i></a></center>
                            <?php
                          }
                        ?>
                      </td>

                      <td>
                        <?php

                           if($fetch_sales_booking->delivery_note_status==1)
                          { 
                        ?>

                        <center><a href="/customer_gate_pass_print/{{ $fetch_sales_booking->order_id }}" target="_blank"><button class="btn btn-info"><i class="fa fa-print"title="Print"></i></button></a> </center>

                        <?php
                      }
                        ?>
                      </td>
                    </tr>
                    
                      @endforeach  
                      
                         
                         <?php
                     }
                    ?>
                    
                
                      
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>


      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Booking Info </h4>
              </div>

              <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped">                
                <tbody>                
                    <tr><td>Customer Name </td> <td> <input class="book-info" name="customer_name" id="customer_name" value=""> </td></tr>

                    <tr><td>DSC </td> <td> <input class="book-info"  name="sales_person" id="sales_person" value="">  </td></tr>

                    <tr><td>Mechanic </td> <td> <input class="book-info"  name="mechanic_name" id="mechanic_name" value="">  </td></tr>

                    <tr><td>Vehicle Type </td> <td> <input class="book-info"  name="vehicle_type" id="vehicle_type" value="">  </td></tr>

                    <tr><td>Vehicle Model </td> <td> <input class="book-info"  name="vehicle_model" id="vehicle_model" value=""></td></tr>

                    <tr><td>Vehicle Color </td> <td> <input class="book-info"  name="vehicle_color" id="vehicle_color" value=""></td></tr>

                    <tr><td>Chassis No </td> <td> <input class="book-info"  name="chassis_no" id="chassis_no" value="">  </td></tr>

                    <tr><td>Engine No </td> <td> <input class="book-info"  name="engine_no" id="engine_no" value="">  </td></tr>

                 
                </tbody>
               
              </table>

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



        <div class="modal fade" id="modal-default1">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Manual close the Account</h4>
              </div>

              <div class="modal-body">
                   <!-- form start -->
                                  <form action="/update_account_close_status" method="POST" enctype="multipart/form-data">
                                      @csrf

                                      <input type="hidden" name="booking_order_id_close" id="booking_order_id_close">
                                        <div class="box-body">                                        
                                          <div class="form-group">
                                            <label for="exampleName">Date</label>
                                            <input type="date" class="form-control is-invalid" id="account_close_date" name="account_close_date" aria-describedby="exampleInputEmail1-error" required="true">
                                          </div>

                                          <div class="form-group">
                                              <label for="exampleName">Description</label>
                                              <textarea class="form-control" id="account_close_description" rows="6" name="account_close_description" ></textarea>
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






      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <script>
   var app_url = "{{config('app.url')}}";  
</script>


 @include('layouts.bottom-footer')

 <script>
 
 
 
     function manual_close(ths){
           var order_id = $(ths).attr('data-id');
           $("#booking_order_id_close").val(order_id);
           
                    $.ajax({
                                  type: "POST",
                                  url: app_url+'/fetch_account_close_details',
                                  data: {"_token": "{{ csrf_token() }}","order_id":booking_order_id_close },

                                  success: function( msg ) {
                                     if(msg.length>0)
                                      {

                                       
                                          var count=1; 

                                          for(var i=0; i<msg.length; i++){ 

                                              $("#account_close_date").val(msg[i].account_close_date);
                                              $("textarea#account_close_description").val(msg[i].account_close_description);
                                             
                                          }
                                      }
                                      else
                                      {
                                              $("#account_close_date").val('');
                                              $("textarea#account_close_description").val('');
                                      }
                                     
                                  }

                             });
           
           
           
         
     }





  function booking_info(ths){

           var order_id = $(ths).attr('data-id');
                               
                              $.ajax({
                                  type: "POST",
                                  url: app_url+'/fetch_sale_booking_info',
                                  data: {"_token": "{{ csrf_token() }}","order_id":order_id },

                                  success: function( msg ) {
                                     if(msg.length>0)
                                      {

                                       
                                          var count=1; 

                                          for(var i=0; i<msg.length; i++){ 

                                              $("#customer_name").val(msg[i].customer_name);
                                              $("#sales_person").val(msg[i].sales_person_name);
                                              $("#mechanic_name").val(msg[i].mechanic_name);
                                              $("#vehicle_type").val(msg[i].type_of_vehicle);
                                              $("#vehicle_model").val(msg[i].model);
                                              $("#vehicle_color").val(msg[i].type_of_color);
                                              $("#chassis_no").val(msg[i].chassis_no);
                                              $("#engine_no").val(msg[i].engine_no);
                                              $("#total_amount").val(msg[i].grand_total);

                                          }
                                      }
                                      else
                                      {
                                                
                                      }
                                     
                                  }

                             });
     }





  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
    
     $("#sales-print").trigger("click");
     
     
  });






</script>
