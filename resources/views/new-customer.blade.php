  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Customer        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/customers">View Customers</a></li>
        <li class="active">Create Customers</li>
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
            <form action="/insert_customer_details" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="box-body">
                  <input type="hidden" name="customer_unique_value" id="customer_unique_value" value="{{ $customer_unique_value }}">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Customer Code</label>
                                                <input type="text" class="form-control" id="customer_code" name="customer_code" aria-describedby="emailHelp" placeholder="Customer Code" value="{{ $customer_code }}" readonly="true" required="true">
                                            </div>
                                        </div> 

                                          <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">S/o | W/o | D/o</label>                                       
                                                       <select class="form-control select2" name="swd_category" id="swd_category">
                                                        <option value="">-- Select --</option>
                                                          
                                                        <option value="S/o">S/o</option>
                                                        <option value="W/o">W/o</option>
                                                        <option value="D/o">D/o</option>
                                                           
                                                        </select>
                                            </div>
                                        </div>

                                      

                                          <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">S/o | W/o | D/o Name</label>
                                                <input type="text" class="form-control" id="swd_name" name="swd_name" aria-describedby="emailHelp" placeholder="Name" >
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Customer Name</label>
                                                <input type="text" class="form-control" id="customer_name" name="customer_name" aria-describedby="emailHelp" placeholder="Customer Name" required="true">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Contact No1</label>
                                                <input type="text" class="form-control" id="contact_no1" name="contact_no1" aria-describedby="emailHelp" placeholder="Contact No1" onkeypress="javascript:return isNumber(event)" required="true">
                                            </div>
                                        </div>
                                        
                                     

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Contact No2</label>
                                                <input type="text" class="form-control" id="contact_no2" name="contact_no2" aria-describedby="emailHelp" placeholder="Contact No2" onkeypress="javascript:return isNumber(event)">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Enquiry No</label>
                                                <input type="text" class="form-control" id="enquiry_no" name="enquiry_no" aria-describedby="emailHelp" placeholder="Enquiry No">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                         <div class="form-group">
                                                <label for="exampleName">Address</label>
                                                
                                                  <textarea class="form-control" id="customer_address" rows="6" name="customer_address" ></textarea>
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
