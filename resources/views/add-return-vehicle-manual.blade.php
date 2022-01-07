  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Return Vehicle Manual  
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/return-vehicle-manual">View Return Vehicle Manual</a></li>
        <li class="active">Add Return Vehicle Manual</li>
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
            <form action="/insert_return_vehicle_manual" method="POST" enctype="multipart/form-data">
                @csrf

                 <div class="box-body">
                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Dealers</label>                                       
                                                       <select class="form-control select2" name="dealer_id" id="dealer_id" required="true">
                                                        <option value="">-- Select Dealers--</option>
                                                             @foreach($dealers as $dealer)
                                                                <option value="{{$dealer->id}}">{{$dealer->dealer_name}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>

                                       <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Vehicle Type</label>                                       
                                                       <select class="form-control select2" name="vehicle_type" id="vehicle_type" required="true">
                                                        <option value="">-- Select types--</option>
                                                             @foreach($vehicle_types as $vehicle_type)
                                                                <option value="{{$vehicle_type->id}}">{{$vehicle_type->type_of_vehicle}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Model Name</label>                                       
                                                       <select class="form-control select2" name="model_name" id="model_name" required="true">
                                                            <!--  @foreach($models as $model)
                                                                <option value="{{$model->id}}">{{$model->model}} </option>
                                                            @endforeach -->
                                                        </select>
                                            </div>
                                        </div>

                                         <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Colors</label>                                       
                                                       <select class="form-control select2" name="vehicle_color_id" id="vehicle_color_id" required="true">
                                                        <option value="">-- Select Color--</option>
                                                             @foreach($colors as $color)
                                                                <option value="{{$color->id}}">{{$color->type_of_color}} </option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Chassis No</label>
                                                <input type="text" class="form-control" id="chassis_no" name="chassis_no" aria-describedby="emailHelp" placeholder="Chassis No"    required="true">
                                            </div>
                                        </div>
                                      
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Engine No</label>
                                                <input type="text" class="form-control" id="engine_no" name="engine_no" aria-describedby="emailHelp" placeholder="Engine No"    required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Vehicle Amount</label>
                                                <input type="text" class="form-control" id="vehicle_amount" name="vehicle_amount" aria-describedby="emailHelp" placeholder="vehicle_amount"  onkeypress="javascript:return isNumber(event)"   value="0"  required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Warranty Amount</label>
                                                <input type="text" class="form-control" id="warranty_amount" name="warranty_amount" aria-describedby="emailHelp" placeholder="Warranty Amount" onkeypress="javascript:return isNumber(event)"  value="0"  required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Return Date</label>
                                                <input type="date" class="form-control" id="return_date" name="return_date" aria-describedby="emailHelp" placeholder="Return Date" required="true">
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
