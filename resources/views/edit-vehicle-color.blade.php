  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Vehicle Color
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/vehicle-color">View Vehicle Color</a></li>
        <li class="active">Edit Vehicle Color</li>
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
            <form action="/update_vehicle_color" method="POST" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" name="vehicle_color_id" id="vehicle_color_id" value="{{ $edit_color[0]->id }}">
                  <div class="box-body">
                    <div class="form-group">
                        <label for="exampleName">Vehicle color</label>
                        <input type="text" class="form-control" id="vehicle_color" name="vehicle_color" aria-describedby="emailHelp" placeholder="" value="{{ strtoupper($edit_color[0]->type_of_color) }}" required="true">
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
