  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Edit Cash In Hand Opening Balance
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/cash-in-hand">View Cash In Hand Opening Balance</a></li>
        <li class="active">Edit Cash In Hand Opening Balance</li>
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

            <form action="/update_cash_in_hand" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="cash_in_hand_id" id="cash_in_hand_id" value="{{ $edit_cash_in_hand[0]->id }}">
                  <div class="box-body">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleName">Opening Balance</label>
                                            <input type="text" class="form-control" id="opening_balance" name="opening_balance" aria-describedby="emailHelp"  placeholder="" value="{{ $edit_cash_in_hand[0]->opening_balance }}" onkeypress="javascript:return isNumber(event)" required="true">
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
