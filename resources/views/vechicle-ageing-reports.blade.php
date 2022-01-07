  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')
<style> 
#panel, #flip {
  padding: 5px;
  text-align: center;
  background-color: #e5eecc;
  border: solid 1px #c3c3c3;
}

#panel {
  padding: 50px;
  display: none;
}
</style>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Vehicle Ageing Reports
      </h1>

      <ol class="breadcrumb">
         <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/list-of-reports"> List Of Reports </a> </li>
         <li class="active">Vehicle Ageing Reports </li>
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

               <form method="post" action="/export_sold_vehicle_stock" style="float:right;padding-right: 15px;">
                                  @csrf

                                <input type="hidden" name="report_from_date" id="report_from_date" value="" required="true">
                                <input type="hidden" name="report_to_date" id="report_to_date" value=""  required="true">

                                 <input type="hidden" name="dsc_id" id="dsc_id" value="">

                                <!--  <button type="submit"  class="btn btn-info save" > <i class="voyager-download"></i>&nbsp;<i class="fa fa-download"></i> xlsx</button> -->

                                 
                            </form>
            </div>

          <!-- <div id="flip">
              <button style="float: right;margin-top: -3px;" id="sshow"><i class="fa fa-angle-double-down"></i></button> 
              <button style="float: right;margin-top: -3px;" id="bhide"><i class="fa fa-angle-double-up"></i></button>
              Click to slide down panel</div> -->
          <div id="panel"></div>

            <div class="box-header">


            <input type="checkbox" id="vehicle" name="vehicle" value="30"  onclick="onlyOne(this)"  <?php $a = explode('/', Request::url()); $last = end($a); if($last == '30'){ echo "checked"; } ?> >
              <label for="vehicle1"> &nbsp; More than 30 Days</label> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;

              <input type="checkbox" id="vehicle" name="vehicle" value="60" <?php $a = explode('/', Request::url()); $last = end($a); if($last == '60'){ echo "checked"; } ?> onclick="window.location='{{ url('vechicle_ageing1/60') }}'">
              <label for="vehicle1"> &nbsp; More than 60 Days</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="checkbox" id="vehicle" name="vehicle" value="90" <?php $a = explode('/', Request::url()); $last = end($a); if($last == '90'){ echo "checked"; } ?> onclick="window.location='{{ url('vechicle_ageing1/90') }}'">
              <label for="vehicle1"> &nbsp; More than 90 Days</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="checkbox" id="vehicle" name="vehicle" value="180" <?php $a = explode('/', Request::url()); $last = end($a); if($last == '180'){ echo "checked"; } ?> onclick="window.location='{{ url('vechicle_ageing1/180') }}'">
              <label for="vehicle1"> &nbsp; More than 180 Days</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="checkbox" id="vehicle" name="vehicle" value="00" onclick="onlyOne(this)">
              <label for="vehicle1"> &nbsp; Custom Days</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

              

             <form role="form" id="vehicle-ageing" method="GET"  action="/vechicle_ageing"  autocomplete="off" enctype="multipart/form-data">
                  {{ csrf_field() }}    
              <div class="row">
                
                
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="exampleInputCategory">FromDate</label>
                        <input type="date" class="form-control" id="fromdate" value="{{$fromdate}}" name="fromdate">
                   
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="exampleInputCategory">ToDate</label>
                        <input type="date" class="form-control" id="todate" value="{{ $todate }}" name="todate">
                   
                      </div>
                    </div>

                    <div class="col-sm-3" style="margin-top: 30px;">
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Filter" name="vehicleageingreports" />
                   
                      </div>

                    </div>
                  
                  </div>

                  </form>
                  <hr>
             
            </div>
            
                     
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <!-- <th>Purchase Date</th> 
                  <th>Sold Date</th>  -->
                  <th>Stock Date</th>
                  <th>Vehicle Type</th> 
                  <th>Vehicle Model</th> 
                  <th>Vehicle Color</th>  
                  
                  <th>Chassis No</th>
                  <th>Engine No</th>
                  <!-- <th>Customer Name</th>
                  <th>Contact No</th> -->
                  <!-- <th> Sales Executive Name</th> -->
                  <!-- <th>RTO Date</th>
                  <th>Vehicle No</th> -->
                </tr>
                </thead>
                <tbody>
                  @php($count=0)
                  @foreach ($vehicle_lists as $vehicle_list)
                  @php($count++)
                    <tr>
                      <td>{{ $count }}</td>
                      <td>{{ date("d-m-Y", strtotime($vehicle_list->stock_date)) }}</td>
                      <td>{{ strtoupper($vehicle_list->type_of_vehicle) }}</td> 
                      <td>{{ strtoupper($vehicle_list->model) }}</td>
                      <td>{{ strtoupper($vehicle_list->type_of_color) }}</td>
                      <td>{{ strtoupper($vehicle_list->chassis_no) }}</td>
                      <td>{{ strtoupper($vehicle_list->engine_no) }}</td>
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
                <h4 class="modal-title">  Sales Executive Filters </h4>
              </div>

              <div class="modal-body">
               <form action="/sold_vehicle_stock" method="POST" enctype="multipart/form-data">

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
                        <label for="exampleName"> Sales Executive Name</label>
                        <select class="form-control select2" name="dsc_id" id="dsc_id"   style="width:100%">
                          <option value="">Select </option>
                          
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
<script> 
  


  $( document ).ready(function() {
   $("#vehicle-ageing").hide();

/*var url = window.location.pathname;
var id = url.substring(url.lastIndexOf('/') + 1);
alert(id)
$('#vehicle:checked').val();*/
//var checkboxes = document.getElementById('vehicle').value;
//alert(checkboxes);

//document.getElementById("vehicle").value;

});
function onlyOne(checkbox) {

  if (checkbox.value == 00) {
    $("#vehicle-ageing").show();
  } else {
    window.location='{{ url('vechicle_ageing1') }}'+'/'+checkbox.value;
    $("#vehicle-ageing").hide();
  }
  

    var checkboxes = document.getElementsByName('vehicle')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
    
}

</script>
<script> 
$(document).ready(function(){
  $("#sshow").click(function(){
    //$("#bhide").hide();
    $("#panel").slideDown("slow");
  });
  $("#bhide").click(function(){
    //$("#sshow").hide();
    $("#panel").slideUp("slow");
  });
});
</script>