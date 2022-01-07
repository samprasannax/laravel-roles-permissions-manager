  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Dealers Rate
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/dealer-rate">View Dealers Rate</a></li>
        <li class="active">Create Dealers Rate</li>
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
            <form action="/insert_dealer_rate_info" method="POST" enctype="multipart/form-data">
                @csrf

                 <div class="box-body">

                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Dealers Name</label>                                       
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
                                                        <option value="">-- Select Model--</option>
                                                            <!--  @foreach($models as $model)
                                                                <option value="{{$model->id}}">{{$model->model}} </option>
                                                            @endforeach -->
                                                        </select>
                                            </div>
                                        </div>

                                     
                                        

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Sale Rate</label>
                                                <input type="text" class="form-control" id="sale_rate" name="sale_rate" aria-describedby="emailHelp" placeholder=" Sale Rate" onkeypress="javascript:return isNumber(event)" required="true">
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


