  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Vehicle Model Rate       
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/vehicle-model">View Vehicle Model Rate</a></li>
        <li class="active">Edit Vehicle Model Rate</li>
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
            <form action="/update_vehicle_model" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="vehicle_model_id" id="vehicle_model_id" value="{{ $edit_vehicle_model[0]->id }}">
                 <div class="box-body">
                                       <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Vehicle Type</label>                                       
                                                       <select class="form-control select2" name="vehicle_type" id="vehicle_type" required="true">
                                                       <option value="">-- Select types--</option>
                                                             @foreach($vehicle_types as $vehicle_type)
                                                                <option value="{{$vehicle_type->id}}" @if($vehicle_type->id==$edit_vehicle_model[0]->vehicle_type) selected @endif >{{strtoupper($vehicle_type->type_of_vehicle)}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>

                                         <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Model Name</label>                                       
                                                       <select class="form-control select2" name="model_name" id="model_name" required="true">
                                                       <option value="">-- Select Model--</option>
                                                             @foreach($models as $model)
                                                                <option value="{{$model->id}}" @if($model->id==$edit_vehicle_model[0]->model_name) selected @endif>{{ strtoupper($model->model) }} </option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>



                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Self Sale Rate</label>
                                                <input type="text" class="form-control" id="self_sale_rate" name="self_sale_rate" aria-describedby="emailHelp" placeholder="Self Sale Rate" value="{{ $edit_vehicle_model[0]->self_sale_rate }}" onkeypress="javascript:return isNumber(event)" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Dealer Sale Rate</label>
                                                <input type="text" class="form-control" id="dealer_sale_rate" name="dealer_sale_rate" aria-describedby="emailHelp" placeholder="Dealer Sale Rate" value="{{ $edit_vehicle_model[0]->dealer_sale_rate }}" onkeypress="javascript:return isNumber(event)" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Extra Fitting Charge</label>
                                                <input type="text" class="form-control" id="extra_fitting_charge" name="extra_fitting_charge" aria-describedby="emailHelp" placeholder="Extra Fitting Charge" value="{{ $edit_vehicle_model[0]->extra_fitting_charge }}" onkeypress="javascript:return isNumber(event)" required="true">
                                            </div>
                                        </div>
                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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
</script>


<script>
  $(function(){
    
     $('#vehicle_type').on('change', function() {

           //  alert(app_url);

            var vehicle_type = $("#vehicle_type").val();
           
           //   alert("On Change" + $("#model_id").val()  + $("#color_id").val() );

              $.ajax({
                type: "POST",
                url: app_url+'/fetch_model',
                data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type },
                success: function( msg ) {
                     
                            if(msg.length>0)
                            { 
                              $('#model_name').empty();
                              $('#model_name').append(`<option value=""> 
                                       Select
                                  </option>`); 

                              for(var i=0; i<msg.length; i++){

                                 $('#model_name').append(`<option value="${msg[i].id}"> 
                                       ${msg[i].model}
                                  </option>`); 
                               }                              
                                                     
                             }
                             else
                             {

                            
                             }

                }
            });
     });




  });
</script>