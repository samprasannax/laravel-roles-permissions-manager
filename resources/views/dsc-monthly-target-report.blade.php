  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Sales Executive Monthly Target
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Report</li>
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
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-default"> Filters</button>

              </h3>
               <form method="post" action="/export_dsc_monthly_target_report" style="float:right;padding-right: 15px;">
                                  @csrf

                                <input type="hidden" name="target_month" id="target_month" value="{{ $month }}">
                                <input type="hidden" name="target_year" id="target_year" value="{{ $year }}">

                                 <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button>

                                 
                            </form>

             

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Sales Executive Name</th>
                  <th>Target</th> 
                  <th>Scooter</th> 
                  <th>Motrocycle</th>                             
                  <th>Total</th>
                  <th>Conversion</th>
                  <th>Balance Target</th>
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($dsc_month_target as $dscmt)
                  @php($count++)
                    <tr>
                          <td>{{ $count }}</td>
                          <td>{{ strtoupper($dscmt->sales_person_name) }}</td>
                          <td>{{ $dscmt->target_qty}}</td>
                          <td>{{ $dscmt->total_count_scooty }}</td>
                          <td>{{ $dscmt->total_count_motorcycle }}</td>
                          <td>{{ $dscmt->total_count_scooty + $dscmt->total_count_motorcycle }} </td>
                          <td><?php

                            if($dscmt->target_qty != 0)
                            {

                                $data1=$dscmt->target_qty;
                                $dataofdata1=$dscmt->total_count_scooty + $dscmt->total_count_motorcycle;
                                $percent=($dataofdata1*100)/$data1;

                                echo number_format($percent, 2).'%';
                              }

                          ?></td>

                          <td> <?php

                            if($dscmt->target_qty!='0')
                            {
                               $total = $dscmt->total_count_scooty + $dscmt->total_count_motorcycle;
                            echo $dscmt->target_qty - $total;

                    
                            } 
                             ?> </td>

                         
                      </tr>
                  @endforeach
                   <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $sum_of_dsc_monthly_target }}</td>
                    <td>{{ $sum_of_scooter }}</td>
                    <td>{{ $sum_of_motorcycle }}</td>
                    <td>{{ $sum_of_scooter + $sum_of_motorcycle }}</td>
                    <td></td>
                    <td>{{ $sum_of_dsc_monthly_target - $sum_of_scooter + $sum_of_motorcycle}}</td>
                   </tr>
                  
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
                <h4 class="modal-title">  Filters </h4>
              </div>

              <div class="modal-body">
               <form action="/dsc_monthly_target_report" method="POST" enctype="multipart/form-data">

                @csrf

                 <div class="box-body">
                   
                        <div class="form-group">
                          <label for="exampleName">Month</label>
                         
                                                <select class="form-control select2" name="target_month" id="target_month" required="true" style="width:100%;">

                                                <option value="">- Month -</option>
                                                <option value="01">January</option>
                                                <option value="02">Febuary</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>

                                              </select>

                        </div>                   

                 
                        <div class="form-group">
                          <label for="exampleName">Year</label>
                          <input class="form-control" type="text" name="target_year" id="target_year" value="<?php echo  date("Y"); ?>" required="true">
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
