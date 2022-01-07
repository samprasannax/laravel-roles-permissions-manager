  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
       Dealers Monthly Sale Percentage     
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active"> Dealers Monthly Sale Percentage </li>
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
                Dealers Monthly Sale Percentage <button class="btn btn-success" data-toggle="modal" data-target="#modal-default"> Filters</button>
 
                 
              </h3>

               <form method="post" action="/export_assc_monthly_sales_percentage" style="float:right;padding-right: 15px;">
                                  @csrf

                                <input type="hidden" name="report_from_date" id="report_from_date" value="{{ $report_from_date }}" required="true">
                                <input type="hidden" name="report_to_date" id="report_to_date" value="{{ $report_to_date }}"  required="true">

                                 <input type="hidden" name="dealer_id" id="dealer_id" value="{{ $dealer_id }}">

                                 <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>

                                 
                            </form>




             

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th>HYP / CASH</th>                 
                    <th>Percentage</th>
                    <th>Count</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>CASH</td>
                    <td><?php 

                    $total_count = $fetch_cash_count;
                    $total_count1 = $total_sales_count;

                    if($total_count1 != 0)
                    {
                         echo  $cash = round($total_count / $total_count1 * 100).'%';
                    }
                    else
                    {
                        echo  $cash = "0%";
                    }


                    ?></td>
                    <td>
                        <?php echo $total_count; ?>
                    </td>
                  </tr>

                  @foreach($bank_percentage as $bp)

                  <tr>
                    <td>{{ $bp->bank_name }}</td>
                    <td><?php
                    
                    if($total_count1 != 0)
                    {
                         echo  $bank = round($bp->total_count / $total_count1 * 100).'%';
                    }
                    else
                    {
                        echo  $bank = "0%";
                    }


                    ?></td>
                    <td>
                        <?php echo $bp->total_count ; ?>
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


         <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Dealers Filters </h4>
              </div>

              <div class="modal-body">
               <form action="/assc_monthly_sales_percentage" method="POST" enctype="multipart/form-data">

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
                        <label for="exampleName">Dealers Name</label>
                        <select class="form-control select2" name="dealer_id" id="dealer_id"   style="width:100%">
                          <option value="">Select </option>
                          @foreach ($dealer_lists as $dealer_list)
                          <option value="{{ $dealer_list->id }}">{{ $dealer_list->dealer_name }} </option>
                          @endforeach
                        </select>
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




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 @include('layouts.bottom-footer')

 <script>
  $(function () {

    $('#example1').DataTable();

    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

  });
</script>
