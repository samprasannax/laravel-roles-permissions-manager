  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Vehicle Type
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/vehicle-type">View Vehicle Type</a></li>
        <li class="active">Edit Vehicle Type</li>
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
            <form action="/update_vehicle_type" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="vehicle_type_id" id="vehicle_type_id" value="{{ $edit_vehicle_type[0]->id }}">
                  <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleName">Vehicle Type</label>
                                            <input type="text" class="form-control" id="type_of_vehicle" name="type_of_vehicle" aria-describedby="emailHelp" placeholder="" value="{{ strtoupper($edit_vehicle_type[0]->type_of_vehicle) }}" required="true">
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
