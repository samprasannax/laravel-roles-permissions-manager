  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dealers Warranty 
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dealers Warranty</li>
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
                  Send warranty card to Dealers              
              </h3>
            </div>

         
        <div class="col-md-12">

          <div class="box box-primary"> 

            <form action="/update_dealer_warranty_card" method="POST" enctype="multipart/form-data">
                @csrf

                  <input type="hidden" name="dealer_unique_id" id="dealer_unique_id" value="{{ $dealer_warranty_lists[0]->id }}">
                  <input type="hidden" name="dealer_id" id="dealer_id" value="{{ $dealer_warranty_lists[0]->dealer_id }}">
                  <input type="hidden" name="dealer_booking_order_id" id="dealer_booking_order_id" value="{{ $dealer_warranty_lists[0]->booking_order_id }}">
                  <div class="box-body">

                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleName"> Date </label>
                          <input type="text" class="form-control is-invalid" id="warranty_date" name="warranty_date"  placeholder="Warranty Date" required="true">
                        </div>
                    </div>

                    <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleName"> Total Remaining </label>
                            <input type="text" class="form-control is-invalid" id="warranty_qty" name="warranty_qty" aria-describedby="exampleInputEmail1-error" placeholder="Warranty Quantity" value="{{ $total_remaining_warranty }}" required="true" >
                          </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleName"> Amount( Single ) </label>
                          <input type="text" class="form-control is-invalid" id="warranty_amount" name="warranty_amount" aria-describedby="exampleInputEmail1-error" placeholder="Warranty Amount" value="0"required="true">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleName"> Grand Total </label>
                          <input type="text" class="form-control is-invalid" id="warranty_total_amount" name="warranty_total_amount" aria-describedby="exampleInputEmail1-error" value="0" placeholder="Warranty Total Amount" required="true" readonly="true">
                        </div>
                    </div>



                  </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit"  value="save" name="save" id="save" class="btn btn-primary">Send</button>
              </div>
            </form>
          </div>
          
          
          
              <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Dealers Name</th>
                    <th>Delivery Date</th>
                    <th>Vehicle Type</th>
                    <th>Color</th>
                    <th>Model Name</th>
                    <th>Chassis No</th>
                    <th>Warranty Status</th>
                  </tr>                
                </thead>
                <tbody>
                  @if(!empty($dealer_warranty_lists))
                  @php($count=0)
                  @foreach ($dealer_warranty_lists as $dealer_warranty_list)
                  @php($count++)
                  <tr>
                          <td>{{ $count }}</td>
                          <td>{{ $dealer_warranty_list->dealer_name }}</td>
                          <td>{{ $dealer_warranty_list->delivery_date }}</td>
                          <td>{{ $dealer_warranty_list->type_of_vehicle }}</td>
                          <td>{{ $dealer_warranty_list->type_of_color }}</td>
                          <td>{{ $dealer_warranty_list->model }}</td>
                          <td>{{ $dealer_warranty_list->chassis_no }}</td>
                          <td><?php 
                            $dealer_warranty_status = $dealer_warranty_list->warranty_status;
                            if($dealer_warranty_status == 0)
                            {
                              ?>
                              <button class="btn btn-warning btn-xs">Not Send!</button>
                              <?php
                            }
                            else
                            {
                              ?>
                               <button class="btn btn-info btn-xs">Send!</button>
                              <?php
                            }

                            ?></td>
                         
                  </tr>
                  @endforeach
                  @endif


                </tbody>
               
              </table>
            </div>
            
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
    });

    $('#warranty_date').datepicker('setDate', 'today');


      $('#warranty_amount').on('change', function() {
      calculate_total();


     });

      var calculate_total = function(){

         var warranty_qty = 0;
         var warranty_amount = 0;
    
        var warranty_qty = parseFloat($("#warranty_qty").val()) || 0; 
        var warranty_amount = parseFloat($("#warranty_amount").val()) || 0; 

        var total_remaining_replace = parseFloat(warranty_qty) * parseFloat(warranty_amount);
    
        $('#warranty_total_amount').val(total_remaining_replace);
      
     }




  });
</script>
