  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
       Self Sale Exchange Vehicle
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active"> Self Sale Exchange Vehicle </li>
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
                Self Sale Exchange Vehicle <button class="btn btn-success" data-toggle="modal" data-target="#modal-default"> Filters </button>
 
                 
              </h3>

               <form method="post" action="/export_self_sale_exchange_vehicle" style="float:right;padding-right: 15px;">
                                  @csrf

                                <input type="hidden" name="report_from_date" id="report_from_date" value="{{ $report_from_date }}" required="true">
                                <input type="hidden" name="report_to_date" id="report_to_date" value="{{ $report_to_date }}"  required="true">


                                 <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>

                                 
                            </form>




             

            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                   <tr>
                    <th>Booking Date</th>
                    <th>Customer Name</th> 
                    <th>Contact No</th> 
                    <th>Sales Person Name</th> 
                    <th>Exchange Model</th>                      
                    <th>Valuable Amount</th>
                    <th>Total Paid</th>
                    <th>Total Remaining</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>                 
                  @foreach ($ledger_report_items as $ls)                             
                  <tr> 
                    <td><?php
                      if($ls->bookingDate !='')
                      {
                        echo date("d-m-Y", strtotime($ls->bookingDate));
                      }
                      else
                      {
                        echo "";
                      }
                    ?></td>       
                    <td> {{ strtoupper($ls->customerName)  }} </td>             
                    <td> {{ strtoupper($ls->contactNo)  }} </td>
                    <td> {{ strtoupper($ls->salesPersonName)  }} </td>
                    <td> {{ strtoupper($ls->exchangeVehicleModel)  }} </td>
                    <td> {{ strtoupper($ls->exchangeAmount)  }} </td>
                    <td> {{ strtoupper($ls->totalPaid)  }} </td>
                    <td> {{ strtoupper($ls->totalRemaining)  }} </td>

                    <td><?php
                    if($ls->totalPaid >= $ls->exchangeAmount)
                    {
                      ?>
                        <button class="btn btn-success"> Completed!! </button>
                      <?php

                    }
                    else
                    {
                      ?>
                       <button class="btn btn-danger"> Pending!! </button>
                      <?php

                    }

                    ?> </td>
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






         <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Receipt Filters </h4>
              </div>

              <div class="modal-body">
               <form action="/self_sale_exchange_vehicle" method="POST" enctype="multipart/form-data">

                @csrf

                 <div class="box-body">
                   
                        <div class="form-group">
                          <label for="exampleName">Report From Date</label>
                          <input class="form-control" type="date" name="report_from_date" id="report_from_date" required="true">
                        </div>                  

                 
                        <div class="form-group">
                          <label for="exampleName">Report To Date</label>
                          <input class="form-control" type="date" name="report_to_date" id="report_to_date" required="true">
                        </div>
                 

                  

                   
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Filter</button>
                      </div>
                   

                  </div>
              <!-- /.box-body -->
            </form>
             
              </div>
               <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      
                                    </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


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
