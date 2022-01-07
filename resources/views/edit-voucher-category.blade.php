  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Voucher Category
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/voucher-category">View Voucher Category</a></li>
        <li class="active">Edit Voucher Category</li>
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
            <form action="/update_voucher_category" method="POST" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" name="voucher_category_unique_id" id="voucher_category_unique_id" value="{{ $edit_voucher_lists[0]->id }}">
                                        
                  <div class="box-body">
                      <div class="form-group">
                        <label for="exampleName">Voucher Category</label>
                        <input type="text" class="form-control" id="voucher_category" name="voucher_category" aria-describedby="emailHelp" placeholder="Voucher Category" value="{{ $edit_voucher_lists[0]->voucher_name }}">
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
