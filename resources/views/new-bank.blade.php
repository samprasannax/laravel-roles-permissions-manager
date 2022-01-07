  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Finance Bank
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/bank">View Finance Bank</a></li>
        <li class="active">Create Finance Bank</li>
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
            <form action="/insert_bank" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">
                   <div class="form-group">
                                            <label for="exampleName">Finance Bank</label>
                                            <input type="text" class="form-control is-invalid" id="bank_name" name="bank_name" aria-describedby="exampleInputEmail1-error" placeholder="Finance Bank Name" required="true">

                                        </div>
                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit"  value="save" name="save" id="save" class="btn btn-primary">Save</button>
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
