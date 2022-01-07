  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Vehicle Info   
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/sales-booking">View booking</a></li>
        <li class="active"> Edit Vehicle Info</li>
      </ol>

    </section> 

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">           
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/update_customer_sale_vehicle_info" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="booking_order_id" id="booking_order_id" value="{{ $fsbs[0]->order_id }}" >
                <input type="hidden" name="customer_id" id="customer_id" value="{{ $fsbs[0]->customer_id }}" >
                <input type="hidden" name="mechanic_id" id="mechanic_id" value="{{ $fsbs[0]->mechanic_id }}" >
                <input type="hidden" name="sales_person_id" id="sales_person_id" value="{{ $fsbs[0]->sales_person_id }}" >
              
            
                 <div class="box-body">
                                       <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Vehicle Type</label>                                       
                                                       <select class="form-control select2" name="vehicle_type_id" id="vehicle_type_id" required="true" readonly="true" >              
                                                             @foreach($vehicle_types as $vehicle_type)
                                                                <option value="{{$vehicle_type->id}}" @if($vehicle_type->id==$fsbs[0]->vehicle_type_id) selected @endif >{{strtoupper($vehicle_type->type_of_vehicle)}}</option>
                                                              @endforeach
                                                        </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Model Name</label>                                       
                                                        <select class="form-control select2" name="model_id" id="model_id" required="true">              
                                                             @foreach($vehicle_models as $vehicle_model)
                                                                <option value="{{$vehicle_model->id}}" @if($vehicle_model->id==$fsbs[0]->vehicle_model_id) selected @endif >{{strtoupper($vehicle_model->model)}}</option>
                                                              @endforeach
                                                        </select>
                                            </div>
                                        </div>

                                      

                                        

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Color</label>                                       
                                                        <select class="form-control select2" name="color_id" id="color_id" required="true" >              
                                                             @foreach($colors as $color)
                                                                <option value="{{$color->id}}" @if($color->id==$fsbs[0]->vehicle_color_id) selected @endif >{{strtoupper($color->type_of_color)}}</option>
                                                              @endforeach
                                                        </select>
                                            </div>
                                        </div>

                                          <div class="col-sm-3">
                                            <div class="form-group">
                                               <label for="exampleName"> Chassis No</label>
                                                  <input type="text" class="form-control" name="old_chassis_no" id="old_chassis_no" value="{{ $chassis_no_info[0]->chassis_no }}" readonly="true">

                                             </div>
                                           </div>


                                           <div class="col-sm-3">
                                             <div class="form-group">
                                                  <label for="exampleName">Want to change the Chassis No</label>
                                                 <select class="form-control select2" name="want_to_change" id="want_to_change" style="width:230px">
                                                  <option  value="" >Select </option>
                                                  <option value="no">No</option>
                                                  <option value="yes">Yes</option>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="col-sm-3" id="new_chassis_no" style="display:none;">
                                            <div class="form-group">
                                               <label for="exampleName">New Chassis No</label>
                                               <br>
                                                        <select class="form-control select2" name="chassis_no" id="chassis_no" style="width:250px">  
                                                             <option value=""> Select Chassis No </option>  

                                                               @foreach($vehicle_stock_chassis_nos as $vsc)
                                                                <option value="{{$vsc->chassis_no}}" >{{strtoupper($vsc->chassis_no)}}</option>
                                                               @endforeach
                                                        </select>
                                            </div>
                                        </div>



                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Delivery Date</label>
                                                <input type="date" class="form-control" id="delivery_date" name="delivery_date" required="true" value="{{ $chassis_no_info[0]->delivery_date }}">
                                            </div>
                                        </div>


                                         <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Service Book No</label>
                                                <input type="text" class="form-control" id="service_book_no" name="service_book_no" required="true" value="{{ $chassis_no_info[0]->service_book_no }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Helmat Status</label>                                       
                                                        <select class="form-control select2" name="helmat_status" id="helmat_status" required="true" >              
                                                           <option value=""> select</option>
                                                           <option value="1" @if($chassis_no_info[0]->helmat_status==1) selected @endif >Yes</option>
                                                           <option value="0" @if($chassis_no_info[0]->helmat_status==0) selected @endif>No</option>
                                                        </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Checked By</label>
                                                <input type="text" class="form-control" id="delivery_note_checked_by" name="delivery_note_checked_by" required="true" value="{{ $fsbs[0]->delivery_note_checked_by }}">
                                            </div>
                                        </div>
                                        

                                        <div class="col-sm-3">
                                         <div class="form-group">

                                                  <label for="exampleName">Description</label>
                                                  <textarea class="form-control" id="description" rows="6" name="description" >{{ $chassis_no_info[0]->delivery_description }}</textarea>

                                            </div>
                                        </div>
                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        
        </div>
        <!--/.col (left) -->
     
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


 @include('layouts.bottom-footer')

 <script>
   var app_url = "{{config('app.url')}}";  
//$('#delivery_date').datepicker('setDate', 'today');

$('#want_to_change').on('change', function() {

  if ($(this).val() == "yes")
  {
    $("#new_chassis_no").show();        
  }
  else
  { 
    $("#new_chassis_no").hide();    
  }

});



</script>


