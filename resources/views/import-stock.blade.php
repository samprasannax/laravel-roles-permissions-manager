  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Import Stock
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/vehicle-stock">View Stock</a></li>
        <li class="active">Import Stock</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">  
            <div class="box-header">
              <h3 class="box-title"> 
                <a class="btn btn-success" href="{{ asset('storage/import_stock/import_stock.csv') }}">
                  Downlod Template
                </a>
              </h3>

            </div>
         
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/insert_import_stock" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">
                    <div class="form-group">
                        <label for="exampleName">File</label>
                        <input type="file" class="form-control" id="import_file" name="import_file" aria-describedby="emailHelp" placeholder="Select File">
                    </div>
                  </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
