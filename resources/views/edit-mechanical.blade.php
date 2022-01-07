  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Mechanic        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/mechanical">View Mechanic</a></li>
        <li class="active">Edit Mechanic</li>
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
            <form action="/update_mechanical" method="POST" enctype="multipart/form-data">
                @csrf
                 <input type="hidden" name="mechanic_unique_id" id="mechanic_unique_id" value="{{ $edit_mechanic[0]->id }}">
                 <div class="box-body">                                            
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Mechanic Code</label>
                                                <input type="text" class="form-control" id="mechanic_code" name="mechanic_code" aria-describedby="emailHelp" placeholder="Mechanic Code" value="{{ $edit_mechanic[0]->mechanic_code }}" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Mechanic Name</label>
                                                <input type="text" class="form-control" id="mechanic_name" name="mechanic_name" aria-describedby="emailHelp" placeholder="Mechanic Name" value="{{ $edit_mechanic[0]->mechanic_name }}" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Contact No1</label>
                                                <input type="text" class="form-control" id="contact_no1" name="contact_no1" aria-describedby="emailHelp" placeholder="Contact No1" value="{{ $edit_mechanic[0]->contact_no1 }}" onkeypress="javascript:return isNumber(event)" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Contact No2</label>
                                                <input type="text" class="form-control" id="contact_no2" name="contact_no2" aria-describedby="emailHelp" placeholder="Contact No2" value="{{ $edit_mechanic[0]->contact_no2 }}" onkeypress="javascript:return isNumber(event)" >
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Address</label>
                                                <textarea class="form-control" id="textarea" rows="6" name="mechanic_address">{{ $edit_mechanic[0]->mechanic_address }}</textarea>
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