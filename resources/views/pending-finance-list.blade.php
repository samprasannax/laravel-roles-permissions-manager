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
       Pending Finance List
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Pending Finance List </li>
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
                
                 Pending Finance List
                
              </h3>
              
                <form method="post" action="/export_pending_finance_list" style="float:right;padding-right: 15px;">
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
                  <th>Date</th> 
                  <th>Customer Name</th> 
                  <th>Sales Executive</th> 
                  <th>Payment</th>
                  <th>Total</th>
                  <th>Remaining Amount</th>
                  <th>Total Paid</th>  
                </tr>
                </thead>
                <tbody>
                    
                  @php($count=0)
                  @foreach ($fetch_sales_bookings as $fetch_sales_booking)
                  @php($count++)
                  
           
                   <tr>                      
                      <td>{{ $count }}</td>
                       <td>
                       <?php
                       if($fetch_sales_booking->delivery_date !='')
                       { 
                           echo date("d-m-Y", strtotime($fetch_sales_booking->delivery_date));
                       } 
                       ?></td>
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

                    
                    </tr>
                    
                      @endforeach  
                      
                      
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $total_fianace_amount }}</td>
                        <td>{{ $total_remaining_amount }}</td>
                        <td>{{ $total_paid_amount }}</td>
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
 <script>
   var app_url = "{{config('app.url')}}";  
</script>


 @include('layouts.bottom-footer')

 <script>
 
 
 
     function manual_close(ths){
           var order_id = $(ths).attr('data-id');
           $("#booking_order_id_close").val(order_id);
         
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
  });

 $('#account_close_date').datepicker('setDate', 'today');






</script>
