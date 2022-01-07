  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Dealers        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/sub-dealer">View Dealers</a></li>
        <li class="active">Edit Dealers</li>
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
            <form action="/update_sub_dealers" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="box-body">
                                      <input type="hidden" name="dealer_unique_id" id="dealer_unique_id" value="{{ $edit_sub_dealers[0]->id }}">

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Dealers Code</label>
                                                <input type="text" class="form-control" id="dealer_code" name="dealer_code" aria-describedby="emailHelp" readonly="true" placeholder="Dealers Code" value="{{ $edit_sub_dealers[0]->dealer_code }}" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Dealers Name</label>
                                                <input type="text" class="form-control" id="dealer_name" name="dealer_name" aria-describedby="emailHelp" placeholder="Dealers Name" value="{{ $edit_sub_dealers[0]->dealer_name }}" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Contact No1</label>
                                                <input type="text" class="form-control" id="contact_no1" name="contact_no1" aria-describedby="emailHelp" placeholder="Contact No1"  value="{{ $edit_sub_dealers[0]->contact_no1 }}" onkeypress="javascript:return isNumber(event)" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Contact No2</label>
                                                <input type="text" class="form-control" id="contact_no2" name="contact_no2" aria-describedby="emailHelp" placeholder="Contact No2"  value="{{ $edit_sub_dealers[0]->contact_no2 }}" onkeypress="javascript:return isNumber(event)">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                         <div class="form-group">.
                                                <label for="exampleName">Address</label>
                                                
                                                  <textarea class="form-control" id="textarea" rows="6" name="dealer_address"> {{ $edit_sub_dealers[0]->dealer_address }}</textarea>
                                            </div>
                                        </div>

                                         <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Opening Balance</label>
                                                <input type="text" class="form-control" id="initial_balance" name="initial_balance" aria-describedby="emailHelp" placeholder="Opening Balance"  value="{{ $edit_sub_dealers[0]->initial_balance }}"  required="true" readonly="true">
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
