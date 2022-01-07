  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Feed Back     
      </h1>
 
      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Feed Back </li>
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
              Feed Back Reports <button class="btn btn-success" data-toggle="modal" data-target="#fdb"> Filters </button>
 
                 
              </h3>

                            <form method="post" action="/export_feed_back" style="float:right;padding-right: 15px;">
                                  @csrf

                                <input type="hidden" name="report_from_date" id="report_from_date" value="{{ $report_from_date }}" required="true">
                                <input type="hidden" name="report_to_date" id="report_to_date" value="{{ $report_to_date }}"  required="true">


                                 <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>

                                 
                            </form>




             

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Sr.No</th>
                 <th>Delivery Date</th>
                  <th>Customer Details</th>
                  <th>DSC</th>
                  <th>Vehicle Details</th>
                  <th>Other Details</th>
                   <th>Feed Details</th>
                 
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($feedbacks as $feedback)
                  @php($count++)

                    <tr>
                         <td>{{ $count }}</td>
                         <td>{{ date("d-m-Y", strtotime($feedback->delivery_date)) }}</td>
                          <td>
                            Name : {{ strtoupper($feedback->customer_name) }} <br> 
                            Contact No : {{ strtoupper($feedback->contact_no1) }}
                          </td>
                          <td>{{ strtoupper($feedback->sales_person_name) }}</td>
                         

                          <td>
                            Type: {{ strtoupper($feedback->type_of_vehicle) }} <br>
                            Model: {{ strtoupper($feedback->model) }} <br>
                            Color: {{ strtoupper($feedback->type_of_color) }} <br>
                            Chassis No: {{ strtoupper($feedback->chassis_no) }}

                          </td>


                           <td>
                            HYP:<?php 
                             if($feedback->hyp == 'no')
                              { 
                                echo "<b> NO </b>";
                              }
                            else 
                            {
                                echo "<b> YES</b>";
                            }

                              ?><br>

                            HYP BANK : <b>{{ $feedback->bank_name }} </b><br>
                            IP : <b>{{ $feedback->initial_balance }}</b><br>

                            Exchange: <?php 
                             if($feedback->exchange_or_new == 'new')
                              { 
                                echo "<b>NO</b>";
                              }
                            else 
                            {
                                echo "<b>YES</b>";
                            }

                              ?> <br>
                            EX Model : <b>{{ strtoupper($feedback->model_name ) }} </b><br>
                            valuable Amount: <b>{{ strtoupper($feedback->valuable_amount) }} </b><br>
                             Helmat: <?php 
                             if($feedback->helmat_status == 0)
                              { 
                                echo "<b>NO</b>";
                              }
                            else 
                            {
                                echo "<b>YES</b>";
                            }

                              ?> <br>
                              RTO: <?php 
                             if($feedback->rto == 0)
                              { 
                                echo "<b>NO</b>";
                              }
                            else 
                            {
                                echo "<b>YES</b>";
                            }

                              ?>
                              <br>
                              RC: <?php 
                             if($feedback->rc_book == 0)
                              { 
                                echo "<b>NO</b>";
                              }
                            else 
                            {
                                echo "<b>YES</b>";
                            }

                              ?><br>
                                Checked : {{ $feedback->checked_by }} <br>

                          </td>



                          <td>
                             Star: 5 / {{ $feedback->star_rate }} <br>
                             Reason: {{ $feedback->reason }} <br>
                             Dsc Performance: {{ $feedback->dsc_performance }} <br>
                             Description: {{ $feedback->feed_description }} <br>                            
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







         <div class="modal fade" id="fdb">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Receipt Filters </h4>
              </div>

              <div class="modal-body">
               <form action="/feed_back_report_list" method="POST" enctype="multipart/form-data">

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



    $('#feed_back_date').datepicker('setDate', 'today');
    $('#feed_back_date1').datepicker('setDate', 'today');


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


      $('.rto_feed_status').click(function(){

           var unique_id = $(this).attr('data-id');
         
            $("#insert_rto_feed_status").css("display", "none");
            $("#update_rto_feed_status").css("display", "none");
                                           

                              $.ajax({


                                  type: "POST",
                                  url: app_url+'/fetch_rto_feed_status',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {

                                     if(msg.length>0)
                                      {
                                        

                                          for(var i=0; i<msg.length; i++){                                           
                                                
                                                $("#update_rto_feed_status").css("display", "block");

                                                $("#unique_id").val(msg[i].id);
                                                $("#booking_order_id").val(msg[i].booking_order_id);
                                                $("#feed_back_date").val(msg[i].feed_back_date);
                                                $("#helmat").val(msg[i].helmat).trigger('change');
                                                 $("#rto_check").val(msg[i].rto).trigger('change');
                                                $("#exchange_vehicle").val(msg[i].exchange_vehicle).trigger('change');
                                                $("#exchange_amount").val(msg[i].exchange_amount);
                                                $("#star_rate").val(msg[i].star_rate);
                                                $("#vehicle_no").val(msg[i].vehicle_no);

                                                 $('textarea#reason').val(msg[i].reason)
                                                  $('textarea#dsc_performance').val(msg[i].dsc_performance)

                                               if(msg[i].feed_back_status==1)
                                               {
                                                 $("#feed_back_status").prop("checked", true);
                                               }
                                          }

                                      }
                                      else
                                      {

                                         //alert(msg.length);

                                                $("#insert_rto_feed_status").css("display", "block"); 
                                                
                                                $("#booking_order_id1").val(unique_id);
                                               
                                                $("#helmat1").val("").trigger('change');
                                                ("#rto_check1").val("").trigger('change');
                                                $("#exchange_vehicle1").val("").trigger('change');
                                                $("#exchange_amount1").val("");
                                                $("#star_rate1").val("");
                                                $("#vehicle_no1").val("");
                                                $('textarea#reason1').val("")
                                                $('textarea#dsc_performance1').val("")                                            

                                               
                                                $("#feed_back_status1").prop("checked", false);

                                      }
                                     
                                     
                                  }

                             });
     });


      $('.rto_feed_view').click(function(){

            var unique_id = $(this).attr('data-id');

            $("#rto_feed_view").css("display", "none");

               $.ajax({


                                  type: "POST",
                                  url: app_url+'/view_rto_feed_status',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {

                                     if(msg.length>0)
                                      {
                                        // alert(msg.length);

                                          for(var i=0; i<msg.length; i++){                                           
                                                
                                                $("#rto_feed_view").css("display", "block");                                             
                                                 $("#hm").text(msg[i].helmat);
                                                 $("#rn").text(msg[i].reason);
                                                 $("#df").text(msg[i].dsc_performance);
                                                 $("#rto").text(msg[i].rto);
                                                 $("#vn").text(msg[i].vehicle_no);
                                                 $("#ev").text(msg[i].exchange_vehicle);
                                                 $("#em").text(msg[i].exchange_amount);
                                                 $("#sr").text(msg[i].star_rate);
                                                 $("#fbd").text(msg[i].feed_back_date);


                                          }

                                      }
                                      else
                                      {

                                                $("#rto_feed_view").css("display", "block");                                             

                                                 $("#hm").text("");
                                                 $("#rn").text("");
                                                 $("#df").text("");
                                                 $("#rto").text("");
                                                 $("#vn").text("");
                                                 $("#ev").text("");
                                                 $("#em").text("");
                                                 $("#sr").text("");
                                                 $("#fbd").text("");

                                      }
                                     
                                     
                                  }

                             });
          
                                           

     });







  });
</script>


