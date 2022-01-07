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
                 Feed Back List
              </h3>

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
                  <th>Status</th>
                  <th>Action</th>
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

                              ?> <br>
                              
                                RC: <?php 
                             if($feedback->rc_book == 0)
                              { 
                                echo "<b>NO</b>";
                              }
                            else 
                            {
                                echo "<b>YES</b>";
                            }

                              ?> <br>
                              
                              
                                Checked : {{ $feedback->checked_by }} <br>

                          </td>



                          <td>
                            <?php
                              $feed_back_status = $feedback->feed_back_status;

                              if($feed_back_status == 0)
                              {
                                ?>
                                <span class="label label-warning">Not Checked!</span>
                                <?php
                              }
                              else
                              {
                                ?>
                                 <span class="label label-success"> Checked!</span>

                                <?php
                              }
                            ?>
                            
                          </td>                       
                          <td>

                             <center>

                              <button type="button" class="btn btn-success rto_feed_status" onclick="rto_feed_status(this)"  data-id="{{ $feedback->order_id }}" data-toggle="modal" data-target="#modal-default">Check Status</button>

                              <button type="button" class="btn btn-info rto_feed_view" onclick="rto_feed_view(this)"  data-id="{{ $feedback->order_id }}" data-toggle="modal" data-target="#modal-default1"><i class="fa fa-eye"title="View"></i></button>

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





       <div class="modal fade" id="modal-default" >
          <div class="modal-dialog">


            <div id="insert_rto_feed_status"  class="modal-content"  style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Feed Back Status </h4>
              </div>

              <div class="modal-body">

                        
                                  <!-- form start -->
                                  <form action="/insert_rto_feed_status" method="POST" enctype="multipart/form-data">
                                      @csrf

                                      <input type="hidden" name="booking_order_id1" id="booking_order_id1">


                                           <div class="box-body">


                                          
                                          <div class="form-group">
                                            <label for="exampleName">Date</label>
                                            <input type="text" class="form-control is-invalid" id="feed_back_date1" name="feed_back_date1"  >
                                          </div>

                                         

                                          <div class="form-group">
                                            <label for="exampleName">Star Rate( 5 )</label>
                                            <select class="form-control select2" name="star_rate1" id="star_rate1" required="true" style="width:100%">
                                              <option  value="">Select </option>
                                              <option value="0">0</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                            </select>
                        
                                            
                                          </div>

                                      

                                          <div class="form-group">
                                                <label for="exampleName">Reason</label>                                                
                                                  <textarea class="form-control" id="reason1" rows="2" name="reason1" ></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleName">DSC Performance</label>                                                
                                                  <textarea class="form-control" id="dsc_performance1" rows="2" name="dsc_performance1" ></textarea>
                                            </div>



                                            <div class="form-group">
                                                <label for="exampleName">Description</label>                                                
                                                  <textarea class="form-control" id="feed_description1" rows="2" name="feed_description1" ></textarea>
                                            </div>





                                          <div class="form-group">
                                            <input type="checkbox" name="feed_back_status1" id="feed_back_status1" value="1"> Do you want update the status?
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


             <div id="update_rto_feed_status"  class="modal-content"  style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Feed Back Status </h4>
              </div>

              <div class="modal-body">

                        
                                  <!-- form start -->
                                  <form action="/update_rto_feed_status" method="POST" enctype="multipart/form-data">
                                      @csrf

                                      <input type="hidden" name="unique_id" id="unique_id">
                                      <input type="hidden" name="booking_order_id" id="booking_order_id">


                                        <div class="box-body">                                     

                                     
                                          <div class="form-group">
                                            <label for="exampleName">Date</label>
                                            <input type="text" class="form-control" id="feed_back_date" name="feed_back_date">
                                          </div>

                                          
                                          <div class="form-group">
                                            <label for="exampleName">Star Rate( 5 )</label>
                                            
                                              <select class="form-control select2" name="star_rate" id="star_rate" required="true" style="width:100%">
                                              <option  value="">Select </option>
                                              <option value="0">0</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                            </select>
                                            
                                            
                                          </div>

                                     

                                            <div class="form-group">
                                                <label for="exampleName">Reason</label>                                                
                                                  <textarea class="form-control" id="reason" rows="2" name="reason" ></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleName">DSC Performance</label>                                                
                                                  <textarea class="form-control" id="dsc_performance" rows="2" name="dsc_performance" ></textarea>
                                            </div>


                                             <div class="form-group">
                                                <label for="exampleName">Description</label>                                                
                                                  <textarea class="form-control" id="feed_description" rows="2" name="feed_description" ></textarea>
                                            </div>


                                          <div class="form-group">
                                            <input type="checkbox" name="feed_back_status" id="feed_back_status" value="1"> Do you want update the status?
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


        <div class="modal fade" id="modal-default1" >

          <div class="modal-dialog">

            <div id="rto_feed_view"  class="modal-content"  style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Feed Back Details </h4>
              </div>

              <div class="modal-body">
                 <table id="example1" class="table table-bordered table-striped">                
                  <tbody>                
                      <tr><td>Dsc Performance </td> <td>  <span id="dscp"> </span></td></tr>
                      <tr><td>Reason </td> <td>  <span id="rn"> </span> </td></tr>
                      <tr><td>Feed Description</td> <td><span id="fd"> </span>  </td></tr>
                      <tr><td>Star Rate </td> <td>  <span id="sr"> </span></td></tr>
                      

              

                  </tbody>
                </table>
                                       
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

  });
  
  
 function rto_feed_status(ths){

           var unique_id = $(ths).attr('data-id');
         
            $("#insert_rto_feed_status").css("display", "none");
            $("#update_rto_feed_status").css("display", "none");
                                           

                              $.ajax({


                                  type: "POST",
                                  url: app_url+'/fetch_rto_feed_status',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {



                                     if(msg.length>0)
                                      {
                                
                                                
                                                $("#update_rto_feed_status").css("display", "block");

                                                $("#unique_id").val(msg[0].id);
                                                $("#booking_order_id").val(msg[0].booking_order_id);
                                                $("#feed_back_date").val(msg[0].feed_back_date);
                                                $('#star_rate').val(msg[0].star_rate).trigger('change');
                                                
                                                $('textarea#reason').val(msg[0].reason)
                                                $('textarea#dsc_performance').val(msg[0].dsc_performance)
                                                $('textarea#feed_description').val(msg[0].feed_description)

                                               if(msg[0].feed_back_status==1)
                                               {
                                                 $("#feed_back_status").prop("checked", true);
                                               }
                                         

                                      }
                                      else
                                      {

                                         //alert(msg.length);

                                                $("#insert_rto_feed_status").css("display", "block"); 
                                                
                                                $("#booking_order_id1").val(unique_id);
                                              

                                               
                                                $("#feed_back_status1").prop("checked", false);

                                      }
                                     
                                     
                                  }

                             });
     }


  function rto_feed_view(ths){

            var unique_id = $(ths).attr('data-id');

            $("#rto_feed_view").css("display", "none");

               $.ajax({


                                  type: "POST",
                                  url: app_url+'/view_rto_feed_status',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {
                                    


                                     if(msg.length>0)
                                      {
                                     

                                          for(var i=0; i<msg.length; i++){                                           
                                                
                                                $("#rto_feed_view").css("display", "block");                                             
                                                 $("#dscp").text(msg[i].dsc_performance);
                                                 $("#rn").text(msg[i].reason);
                                                 $("#fd").text(msg[i].feed_description);
                                                 $("#sr").text(msg[i].star_rate);
                                                

                                          }

                                      }
                                      else
                                      {

                                                $("#rto_feed_view").css("display", "block");                                             

                                                 $("#dscp").text("");
                                                 $("#rn").text("");
                                                 $("#fd").text("");
                                                 $("#sr").text("");
                                                
                                      }
                                     
                                     
                                  }

                             });
          
                                           

     }



</script>


