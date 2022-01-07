  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Dealer Offers        
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dealer Offers</li>
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
                <a class="btn btn-success" href="/new-assc-offer">
                  Add Dealer Offers
                </a>
              </h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Date</th> 
                  <th>Dealer Name</th>  
                  <th>Offer Name</th>  
                  <th>Qty</th>  
                  <th>Amount</th> 
                  <th>Total Amount</th>                
                  <th>Action</th>
                </tr>
                </thead>

                <tbody>
                  @php($count=0)
                  @foreach ($assc_offers as $assc_offer)
                  @php($count++)
                    <tr>
                          <td>{{ $count }}</td>
                           <td>{{ date("d-m-Y", strtotime($assc_offer->offer_date)) }}</td>
                          <td>{{ strtoupper($assc_offer->dealer_name) }}</td>
                           <td>{{ strtoupper($assc_offer->offer_name) }}</td>
                          <td>{{ $assc_offer->offer_qty }}</td>
                          <td>{{ $assc_offer->qty_amount }}</td>
                          <td>{{ $assc_offer->total_amount }}</td>
                                                    
                          <td>                          
                          <center>
                         
                            <a onclick="return confirm('Are you sure want to delete?')"  href="/delete_assc_offer/{{ $assc_offer->id }}/{{ $assc_offer->dealer_id }}" ><button type="button" class="btn  btn-danger btn-circle m-rb-5"><i class="glyphicon glyphicon-trash" title="Delete"></i></button></a>
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


