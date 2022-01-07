  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Finance Bank
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/bank">View Finance Bank</a></li>
        <li class="active">Edit Finance Bank</li>
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
            <form action="/update_bank" method="POST" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" name="bank_unique_id" id="bank_unique_id" value="{{ $edit_bank[0]->id }}">
                                        
                  <div class="box-body">
                      <div class="form-group">
                        <label for="exampleName">Finance Bank</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" aria-describedby="emailHelp" placeholder="Finance Bank Name" value="{{ $edit_bank[0]->bank_name }}" required="true">
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
