  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Offers
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/offers">View Offers</a></li>
        <li class="active">Edit Offers</li>
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
            <form action="/update_offer" method="POST" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" name="offer_unique_id" id="offer_unique_id" value="{{ $edit_offer[0]->id }}">
                                        
                  <div class="box-body">
                      <div class="form-group">
                        <label for="exampleName">Offer Name</label>
                        <input type="text" class="form-control" id="offer_name" name="offer_name" aria-describedby="emailHelp" placeholder="Offer Name" value="{{ $edit_offer[0]->offer_name }}" required="true">
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
