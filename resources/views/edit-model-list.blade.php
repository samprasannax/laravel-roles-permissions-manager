  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Model
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/model-list">View Model</a></li>
        <li class="active">Create Model</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">           
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/update_model_list" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">
  <input type="hidden" name="model_unique_id" id="model_unique_id" value="{{ $edit_model_list[0]->id }}" >
                    <div class="form-group">
                        <label for="exampleName">Vehicle Type</label>
                        <select class="form-control select2" name="vehicle_type_id" id="vehicle_type_id" required="true" >
                          <option  value="">Select </option>
                              @foreach($vehicle_types as $vehicle_type)
                                <option value="{{$vehicle_type->id}}" @if($vehicle_type->id==$edit_model_list[0]->vehicle_type_id) selected @endif >{{strtoupper($vehicle_type->type_of_vehicle)}}</option>
                              @endforeach
                        </select>
                      </div>

                    <div class="form-group">
                        <label for="exampleName">Model Name</label>
                        <input type="text" class="form-control" id="model" name="model" aria-describedby="emailHelp" placeholder="Model Name" value="{{ strtoupper($edit_model_list[0]->model) }}" required="true"> 
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
