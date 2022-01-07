  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Vehicle Stock        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/vehicle-stock">View Vehicle Stock</a></li>
        <li class="active">Edit Vehicle Stock</li>
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
            <form action="/update_vehicle_stock" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="box-body">
                   <input type="hidden" name="vehicle_stock_id" id="vehicle_stock_id" value="{{ $edit_vehicle_stock[0]->id }}">
                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Vehicle Type</label> 
                                                 <input type="hidden" name="old_vehicle_type" id="old_vehicle_type" value="{{ $edit_vehicle_stock[0]->vehicle_type }}" >           
                                                       <select class="form-control select2" name="vehicle_type" id="vehicle_type" required="true">
                                                      
                                                        <option value="">-- Select types--</option>
                                                             @foreach($vehicle_types as $vehicle_type)
                                                                <option value="{{$vehicle_type->id}}" @if($vehicle_type->id==$edit_vehicle_stock[0]->vehicle_type) selected @endif >{{ strtoupper($vehicle_type->type_of_vehicle)}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>


                                          <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Model</label>         
                                                <input type="hidden" name="old_vehicle_model" id="old_vehicle_model" value="{{ $edit_vehicle_stock[0]->model_name }}">                                
                                                       <select class="form-control select2" name="model_name" id="model_name" required="true">

                                                       
                                                        
                                                           <option value="">-- Select types--</option>
                                                           @foreach($vehicle_models as $vehicle_model)
                                                                <option value="{{$vehicle_model->id}}" @if($vehicle_model->id==$edit_vehicle_stock[0]->model_name) selected @endif>{{strtoupper($vehicle_model->model)}}</option>
                                                            @endforeach


                                                        </select>
                                            </div>
                                        </div>


                                          <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Color </label>
                                                
                                                         <input type="hidden" name="old_vehicle_color" id="old_vehicle_color" value="{{ $edit_vehicle_stock[0]->vehicle_color }}">                                       
                                                       <select class="form-control select2" name="vehicle_color" id="vehicle_color" required="true">

                                                         <option value="">-- Select color--</option>
                                                             @foreach($colors as $color)
                                                                <option value="{{$color->id}}" @if($color->id==$edit_vehicle_stock[0]->vehicle_color) selected @endif>{{ strtoupper($color->type_of_color) }} </option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>
                                       
                                       

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Chassis No</label>
                                                <input type="text" class="form-control" id="chassis_no" name="chassis_no" aria-describedby="emailHelp" placeholder="Chassis No" value="{{ strtoupper($edit_vehicle_stock[0]->chassis_no) }}" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Engine No</label>
                                                <input type="text" class="form-control" id="engine_no" name="engine_no" aria-describedby="emailHelp" placeholder="Engine No" value="{{ strtoupper($edit_vehicle_stock[0]->engine_no) }}" required="true">
                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                             <div class="form-group">
                                                <label for="exampleName">Date</label>
                                                  <input class="form-control" type="date" name="stock_date" id="example-date-input" value="{{ $edit_vehicle_stock[0]->stock_date }}" required="true">
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
                url: app_url+'/fetch_stock_model',
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
                               
                              $('#model_name').empty();
                              $('#model_name').append(`<option value=""> 
                                       None.Please check it.!!!
                                  </option>`); 

                            
                             }

                }
            });
     });


     // $('#model_name').on('change', function() {

     //        var vehicle_type = $("#vehicle_type").val();
     //        var model_name1 = $("#model_name").val();
           
     //          // alert("On Change" + $("#model_id").val()  + $("#color_id").val() );

     //          $.ajax({
     //            type: "POST",
     //            url: app_url+'/fetch_stock_color',
     //            data: {"_token": "{{ csrf_token() }}", "vehicle_type":vehicle_type, "model_name1":model_name1 },
     //            success: function( msg ) {
                     
     //                        if(msg.length>0)
     //                        { 
     //                           $('#vehicle_color').empty();
     //                           $('#vehicle_color').append(`<option value=""> 
     //                                   Select
     //                              </option>`); 
     //                          for(var i=0; i<msg.length; i++){


     //                             $('#vehicle_color').append(`<option value="${msg[i].id}"> 
     //                                   ${msg[i].type_of_color}
     //                              </option>`); 
     //                           }                              
                                                     
     //                         }
     //                         else
     //                         {
                               
     //                          $('#vehicle_color').empty();
     //                          $('#vehicle_color').append(`<option value=""> 
     //                                   None.Please check it.!!!
     //                              </option>`); 

     //                         }

     //            }
     //        });
     // });




  });
</script>



