  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Expense Receipt List
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Expense Receipt List</li>
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
                        
                        
                        

     <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">           
            <!-- /.box-header -->
            
            <!-- form start -->
            <form action="/voucher-receipt-list" method="GET" enctype="multipart/form-data">
               
                  <div class="box-body">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleName">From Date</label>
                            <input type="date" class="form-control" id="report_from_date" name="report_from_date"   required="true">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleName">To Date</label>                            
                            <input type="date" class="form-control" id="report_to_date" name="report_to_date"   required="true">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-groupn filter-btn">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>


                  </div>
              <!-- /.box-body -->

            </form>
          </div>
          <!-- /.box -->

        
        </div>
        
        


        <div class="col-xs-12">

            <div class="box">
            <div class="box-header">
              <h3 class="box-title"> 
                <a class="btn btn-success" href="/new-voucher-receipt">
                  Add Expense Receipt
                </a>
              </h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Expense No</th> 
                  <th>Date</th>  
                  <th>Person Name</th> 
                  <th>Expense Category</th>
                  <th>Amount</th>     
                  <th>Description</th>           
                  <th>Action</th>
                  <th>Print</th>
                </tr>
                </thead>
                
                <tbody>
                  @php($count=0)
                  @foreach ($voucher_receipt_lists as $vc)
                  @php($count++)
                      <tr>
                          <td>{{ $count }}</td>
                          <td>{{ $vc->voucher_no }}</td>
                          <td>{{  date("d-m-Y", strtotime($vc->voucher_date))  }}</td>
                          <td>{{ $vc->person_name }}</td>
                          <td>{{ $vc->voucher_name }}</td>
                          <td>{{ $vc->voucher_amount }}</td>
                          <td>{{ $vc->voucher_description }}</td>
                                                    
                          <td>                          
                           <a onclick="return confirm('Are you sure want to edit this voucher?')"  href="/edit_voucher_receipt/{{ $vc->id }}"><button type="button" class="btn btn-warning btn-circle m-rb-5"><i class="fa fa-edit"title="Edit"></i></button></a>
                                                        
                           <a onclick="return confirm('Are you sure want to delete this voucher?')"  href="/delete_voucher_receipt/{{ $vc->id }}/{{ $vc->unique_id }}/{{ $vc->order_id }}"><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a>
                          </td>
                          
                          <td>
                            <a href="/print_voucher_receipt/{{ $vc->id }}" target="_blank"><button type="button" class="btn btn-primary btn-circle m-rb-5">Print</button></a>
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
