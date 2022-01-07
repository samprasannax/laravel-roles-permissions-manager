  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

<style>
.check-status-rto{
    
}
</style>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Rto Check Completed         
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Rto Check Completed</li>
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
                
                  RTO CHECK LIST
              </h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Date</th>
                  <th>Customer Details</th>
                  <th>DSC</th>
                  <th>Vehicle Detials</th>
                  <th>Check Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($fsbs as $fsb)
                  @php($count++)

                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ date("d-m-Y", strtotime($fsb->account_close_date)) }}</td>
                          <td>
                            Name : {{ strtoupper($fsb->customer_name) }} <br>
                            Contact No : {{ strtoupper($fsb->contact_no1) }}
                          </td>
                          <td>{{ strtoupper($fsb->sales_person_name) }}</td>
                         
                          <td>
                            Type : {{ strtoupper($fsb->type_of_vehicle) }}<br>
                            Model : {{ strtoupper($fsb->model) }} <br>
                            Color : {{ strtoupper($fsb->type_of_color) }}<br>
                            Chassis No: {{ strtoupper($fsb->chassis_no) }}
                          </td>
                        
                        
                        
                        
                      
                            
                            
                            
                          <td>
                              <table class="table table-bordered table-striped"> 
                              
                             <?php
                             $insurance = $fsb->insurance;
                             
                             if($insurance==1)
                             {
                                 ?>
                                 <tr>
                                 <td>Insurance </td> <td><span class="label label-success">Checked</span> </td> 
                                 </tr>
                                 <tr>
                                 <td> Insurance Date  </td> <td> <?php echo date("d-m-Y", strtotime($fsb->insurance_date)) ?></td>
                                 </tr>
                                 <?php
                             }
                             else
                             {
                                 ?>
                                 <tr>
                                    <td>Insurance </td> <td> <span class="label label-danger">Not Checked</span> </td>
                                  </tr>
                                 <?php
                             }
                             
                             ?>
                             
                             
                              <?php
                              $rto = $fsb->rto;
                              
                             if($rto==1)
                             {
                                 ?>
                                 <tr>
                                 <td>RTO </td> <td><span class="label label-success">Checked</span> </td> 
                                 </tr>
                                 <tr>
                                 <td> RTO Date  </td> <td> <?php echo date("d-m-Y", strtotime($fsb->rto_date)) ?></td>
                                 </tr>
                                 <?php
                             }
                             else
                             {
                                 ?>
                                 <tr>
                                    <td>RTO </td> <td> <span class="label label-danger">Not Checked</span> </td>
                                  </tr>
                                 <?php
                             }
                             
                             ?>
                             
                             
                               <?php
                               $number_plate = $fsb->number_plate;
                             if($number_plate==1)
                             {
                                 ?>
                                 <tr>
                                 <td>Number Plate </td> <td><span class="label label-success">Checked</span> </td> 
                                 </tr>
                                 <tr>
                                 <td> Number Plate Check Date  </td> <td> <?php echo date("d-m-Y", strtotime($fsb->plate_checked_date)) ?></td>
                                 </tr>
                                 <?php
                             }
                             else
                             {
                                 ?>
                                 <tr>
                                    <td>Number Plate </td> <td> <span class="label label-danger">Not Checked</span> </td>
                                  </tr>
                                 <?php
                             }
                             
                             ?>
                             
                             
                                 <?php
                                 $rc_book = $fsb->rc_book;
                             if($rc_book==1)
                             {
                                 ?>
                                 <tr>
                                 <td> RC Book</td> <td><span class="label label-success">Checked</span> </td> 
                                 </tr>
                                 <tr>
                                 <td> Rc Book Date  </td> <td> <?php echo date("d-m-Y", strtotime($fsb->rc_book_checked_date)) ?></td>
                                 </tr>
                                 <?php
                             }
                             else
                             {
                                 ?>
                                 <tr>
                                    <td> RC Book </td> <td> <span class="label label-danger">Not Checked</span> </td>
                                  </tr>
                                 <?php
                             }
                             
                             ?>
                             
                             
                              <?php
                              $rto_check_status = $fsb->rto_check_status;

                              if($rto_check_status==0)
                              {
                                ?>
                                <tr>
                                <td>Status  </td> <td><span class="label label-warning">Not Checked!</span></td>
                                <tr>
                                <?php
                              }
                              else
                              {
                                ?>
                                <tr>
                                 <td>Status </td> <td><span class="label label-info"> Checked!</span></td>
                                 </tr>

                                <?php
                              }
                            ?>
                            
                            
                             
                             
                             
                           
                          
                             
                           </table>
                            
                            
                           
                            
                          </td>                       
                          <td>
                             <center>

                              <button type="button" class="btn btn-success rto_check_status"  data-id="{{ $fsb->id }}" data-toggle="modal" data-target="#modal-default" onclick="rto_check_status(this)">Check</button>

                              <!-- <button type="button" class="btn btn-info view_rto_check_status" onclick="return confirm('Do you want to view check list?')"  data-id="{{ $fsb->id }}" data-toggle="modal" data-target="#modal-default1"><i class="fa fa-eye"title="View"></i></button> -->
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


            <div id="rto_check"  class="modal-content"  style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Rto Check </h4>
              </div>

              <div class="modal-body">

                        
                                  <!-- form start -->
                                  <form action="/update_rto_check_list" method="POST" enctype="multipart/form-data">
                                      @csrf

                                      <input type="text" name="unique_id" id="unique_id">
                                      <input type="text" name="booking_order_id" id="booking_order_id">


                                                <div class="box-body">
                                                 <div class="form-group">
                                                    <label for="exampleName">Insurance</label><br>
                                                    <input type="radio" name="insurance" id="insurance1" value="0"> No
                                                    <input type="radio" name="insurance" id="insurance2" value="1" > Yes
                                                    
                                                  </div>
    `                                       
                                                <div class="form-group">
                                                    <label for="exampleName">Insurance Checked Date</label>
                                                    <input type="date" class="form-control is-invalid" id="insurance_date" name="insurance_date" aria-describedby="exampleInputEmail1-error" placeholder="" >
                                                </div>
                                                
                                                
                                                
                                                
                                                 <div class="form-group">
                                                    <label for="exampleName">RTO</label><br>
                                                     <input type="radio" name="rto" id="rto1" value="0" > No
                                                    <input type="radio" name="rto" id="rto2" value="1" > Yes
                                                   
                                                  </div>
    `                                       
                                                <div class="form-group">
                                                    <label for="exampleName">Rto Checked Date</label>
                                                    <input type="date" class="form-control is-invalid" id="rto_checked_date" name="rto_checked_date" aria-describedby="exampleInputEmail1-error" placeholder="" >
                                                </div>
                                                
                                                
                                                
                                                 
                                                 <div class="form-group">
                                                    <label for="exampleName">Number Plate</label><br>
                                                    <input type="radio" name="number_plate" id="number_plate1" value="0" > No
                                                    <input type="radio" name="number_plate" id="number_plate2" value="1"> Yes
                                                    
                                                  </div>
    `                                       
                                                <div class="form-group">
                                                    <label for="exampleName">Checked Date</label>
                                                    <input type="date" class="form-control is-invalid" id="plate_checked_date" name="plate_checked_date" aria-describedby="exampleInputEmail1-error" placeholder="" >
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="exampleName">Vehicle No</label>
                                                    <input type="text" class="form-control is-invalid" id="vehicle_no" name="vehicle_no" aria-describedby="exampleInputEmail1-error" placeholder="" >
                                                </div>
                                            
                                             <div class="form-group">
                                                    <label for="exampleName">RC Book</label><br>
                                                      <input type="radio" name="rc_book" id="rc_book1" value="0" > No
                                                    <input type="radio" name="rc_book" id="rc_book2" value="1" > Yes
                                                  
                                                  </div>


    `                                       
                                                <div class="form-group">
                                                    <label for="exampleName">RC Book Checked Date</label>
                                                    <input type="date" class="form-control is-invalid" id="rc_book_checked_date" name="rc_book_checked_date" aria-describedby="exampleInputEmail1-error" placeholder="" >
                                                </div>

                                                 <div class="form-group">
                                                    <label for="exampleName">RC Book No</label>
                                                    <input type="text" class="form-control is-invalid" id="rc_book_no" name="rc_book_no" aria-describedby="exampleInputEmail1-error" placeholder="Rc Book No" >
                                                </div>
                                          

                                           <div class="form-group">
                                            <label for="exampleName">Checked By</label>
                                            <input type="text" class="form-control is-invalid" id="checked_by" name="checked_by" aria-describedby="exampleInputEmail1-error" placeholder="Checked By" >
                                          </div>



                                                <div class="form-group">
                                                    <label for="exampleName"><b style="color:red;font-size:20px;">Do you want to update the status?</b></label><br>
                                                      <input type="radio" name="confim_status_update" id="confim_status_update1" value="0" > No
                                                    <input type="radio" name="confim_status_update" id="confim_status_update2" value="1" > Yes
                                                  
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

            <div id="rto_check_view"  class="modal-content"  style="display:none;">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Rto Check Details </h4>
              </div>

              <div class="modal-body">
                 <table id="example1" class="table table-bordered table-striped">                
                  <tbody>                
                      <tr><td>Rc Book No</td> <td><span id="rcb"> </span>  </td></tr>

                      <tr><td>DSC </td> <td>  <span id="dsc"> </span> </td></tr>

                      <tr><td>Extra Fitting</td> <td><span id="ef"> </span>  </td></tr>
                      <tr><td>Vehicle No</td> <td> <span id="vn"> </span> </td></tr>
                      <tr><td>Checked By</td> <td> <span id="cb"> </span>  </td></tr>
                      <tr><td>Finance </td> <td>  <span id="fd"> </span></td></tr>

              

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
 
 
 
 function rto_check_status(ths){

           var unique_id = $(ths).attr('data-id');

           //alert(unique_id);

                         $("#rto_check").css("display", "none");
                                           

                              $.ajax({


                                  type: "POST",
                                  url: app_url+'/fetch_rto_check_status',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {

                                     if(msg.length>0)
                                      {
                                     //   alert(msg[0].booking_order_id);

                                          for(var i=0; i<msg.length; i++){                                           
                                                
                                                $("#rto_check").css("display", "block");                                             

                                                $("#unique_id").val(msg[i].id);

                                                $("#booking_order_id").val(msg[i].booking_order_id);

                                                if(msg[i].insurance==0)
                                                {                                                  
                                                   $('#insurance1').val(0).attr('checked', 'checked');
                                                }
                                                else
                                                {
                                                  $('#insurance2').val(1).attr('checked', 'checked');
                                                }

                                                $("#insurance_date").val(msg[i].insurance_date);

                                                 if(msg[i].rto==0)
                                                {
                                                  
                                                   $('#rto1').val(0).attr('checked', 'checked');
                                                }
                                                else
                                                {
                                                  $('#rto2').val(1).attr('checked', 'checked');
                                                }
                                                 $("#rto_checked_date").val(msg[i].rto_date);



                                                if(msg[i].number_plate==0)
                                                {
                                                 $('#number_plate1').val(0).attr('checked', 'checked');
                                                }
                                                else
                                                {
                                                  $('#number_plate2').val(1).attr('checked', 'checked');
                                                }

                                                 $("#plate_checked_date").val(msg[i].plate_checked_date);
                                                 $("#vehicle_no").val(msg[i].vehicle_no);



                                                if(msg[i].rc_book==0)
                                                {
                                                  $('#rc_book1').val(0).attr('checked', 'checked');
                                                }
                                                else
                                                {
                                                  $('#rc_book2').val(1).attr('checked', 'checked');
                                                }

                                                $("#rc_book_checked_date").val(msg[i].rc_book_checked_date);
                                                $("#rc_book_no").val(msg[i].rc_book_no);
                                                $("#checked_by").val(msg[i].checked_by);

                                                if(msg[i].rto_check_status==0)
                                                {
                                                   $('#confim_status_update1').val(0).attr('checked', 'checked');
                                                   $('#confim_status_update2').val(1);
                                                }
                                                else
                                                {
                                                  $('#confim_status_update2').val(1).attr('checked', 'checked');
                                                   $('#confim_status_update1').val(0);
                                                }


                                          }

                                      }
                                      else
                                      {

                                                $("#rto_check").css("display", "block");                                            

                                                // $("#unique_id").val("");
                                                // $("#booking_order_id").val("");

                                                $("#insurance1").val(0).attr('checked', 'checked');
                                                $("#insurance_date").val("");

                                                 $("#rto1").val(0).attr('checked', 'checked');
                                                $("#rto_date").val("");


                                                $("#number_plate1").val(0).attr('checked', 'checked');
                                                $("#plate_checked_date").val("");
                                                $("#vehicel_no").val("");



                                              $("#rc_book1").val(0).attr('checked', 'checked');
                                                $("#rc_book_checked_date").val("");
                                                $("#checked_by").val("");



                                                
                                                $("#confim_status_update1").val(0).attr('checked', 'checked');
                                                $('#confim_status_update2').val(1);

                                      }
                                     
                                     
                                  }

                             });
     }


     function rto_check_view(){

            var unique_id = $(this).attr('data-id');

            $("#rto_check_view").css("display", "none");

               $.ajax({


                                  type: "POST",
                                  url: app_url+'/fetch_rto_view',
                                  data: {"_token": "{{ csrf_token() }}","unique_id":unique_id },

                                  success: function( msg ) {

                                     if(msg.length>0)
                                      {
                                        // alert(msg.length);

                                          for(var i=0; i<msg.length; i++){                                           
                                                
                                                $("#rto_check_view").css("display", "block");                                             

                                                 $("#rcb").text(msg[i].rc_book_no);
                                                 $("#dsc").text(msg[i].sales_person_name);
                                                 $("#ef").text(msg[i].extra_fitting);
                                                 $("#vn").text(msg[i].vehicle_no);
                                                 $("#cb").text(msg[i].checked_by);
                                                 $("#fd").text(msg[i].finance_date);


                                          }

                                      }
                                      else
                                      {

                                                $("#rto_check").css("display", "block");                                             

                                                 $("#rcb").text("");
                                                 $("#dsc").text("");
                                                 $("#ef").text("");
                                                 $("#vn").text("");
                                                 $("#cb").text("");
                                                 $("#fd").text("");

                                      }
                                     
                                     
                                  }

                             });
          
                                           

     }
     
     
  $(function () {

    $('#finance_date').datepicker('setDate', 'today');

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


