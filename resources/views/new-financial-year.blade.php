  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Financial Year
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/financial-year">View Financial Year</a></li>
        <li class="active">Create Financial Year</li>
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
            <form action="/insert_financial_year" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">
                                        <div class="col-sm-3">
                                             <div class="form-group">
                                                <label for="exampleName">Start Date</label>
                                                  <input class="form-control" type="date" name="start_date" id="example-date-input" required="true">
                                            </div>                                            
                                        </div>

                                         <div class="col-sm-3">
                                             <div class="form-group">
                                                <label for="exampleName">End  Date</label>
                                                  <input class="form-control" type="date" name="end_date" id="example-date-input" required="true">
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
