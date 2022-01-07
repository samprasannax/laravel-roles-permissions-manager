  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Vehicle Stock        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/vehicle-stock">View Vehicle Stock</a></li>
        <li class="active">Create Vehicle Stock</li>
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
            <form action="/insert_vehicle_stock" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="box-body">
                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Vehicle Type</label>                                       
                                                       <select class="form-control select2" name="vehicle_type" id="vehicle_type" required="true" required="true">
                                                        <option value="">-- Select types--</option>
                                                             @foreach($vehicle_types as $vehicle_type)
                                                                <option value="{{$vehicle_type->id}}">{{$vehicle_type->type_of_vehicle}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Model</label>                                       
                                                       <select class="form-control select2" name="model_name" id="model_name" required="true">
                                                        
                                                          <option value="">-- Select types--</option>
                                                           <!--  @foreach($models as $model)
                                                                <option value="{{$model->id}}">{{$model->model}}</option>
                                                            @endforeach -->

                                                        </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Color </label>                                       
                                                       <select class="form-control select2" name="vehicle_color" id="vehicle_color" required="true">
                                                         <option value="">-- Select color--</option>
                                                             @foreach($colors as $color)
                                                                <option value="{{$color->id}}">{{ $color->type_of_color }} </option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>
                                       
                                       

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Chassis No</label>
                                                <input type="text" class="form-control" id="chassis_no" name="chassis_no" aria-describedby="emailHelp" placeholder="Chassis No" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Engine No</label>
                                                <input type="text" class="form-control" id="engine_no" name="engine_no" aria-describedby="emailHelp" placeholder="Engine No" required="true">
                                            </div>
                                        </div>

                                         <div class="col-sm-3">
                                             <div class="form-group">
                                                <label for="exampleName">Date</label>
                                                  <input class="form-control" type="text" name="stock_date" id="stock_date" >
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


    $('#stock_date').datepicker('setDate', 'today');
    
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


