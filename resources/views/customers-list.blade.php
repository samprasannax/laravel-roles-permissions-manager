  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Customers        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Customers</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
                        <div class="col-sm-12">
                          @if(session()->get('success'))
                            <div class="alert alert-success">
                              {{ session()->get('success') }}  
                            </div>
                          @endif 
                        </div>


        <div class="col-xs-12">

            <div class="box">
            <div class="box-header">
              <h3 class="box-title"> 
                <a class="btn btn-success" href="/new-customer">
                  Add Customers
                </a>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Customer Code</th>
                  <th>Enquiry No</th>
                  <th>S/o | W/o | D/o</th>
                  <th>Customer Name</th> 
                  <th>Contact No1</th> 
                  <th>Contact No2</th>
                  <th>Customer Address</th>                   
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($customers as $customer)
                  @php($count++)

                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ $customer->customer_code }}</td>
                           <td>{{ $customer->enquiry_no }}</td>
                          <td>{{ $customer->swd_category }}.{{ $customer->swd_name }}</td>
                          <td>{{ $customer->customer_name }}</td>
                          <td>{{ $customer->contact_no1 }}</td>
                          <td>{{ $customer->contact_no2 }}</td>
                          <td>{!! nl2br($customer->customer_address)  !!} </td>
                                                    
                          <td>

                                                    
                            <center>                           
                              <a onclick="return confirm('Are you sure want to edit?')" href="/edit_customers/{{ $customer->id }}"><button type="button" class="btn btn-warning btn-circle m-rb-5"><i class="fa fa-edit"title="Edit"></i></button></a>
                              <a onclick="return confirm('If you did receipt on this customer. you should not delete this customer')" href="/delete_customer/{{ $customer->id }}"><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a>
                            </center>
                          </td>
                      </tr>
                      
                  @endforeach
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->

     


          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 @include('layouts.bottom-footer')

 <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
