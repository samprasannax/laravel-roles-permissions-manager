  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Sales Executive Monthly Target
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/view-dsc-monthly-target">View Sales Executive Monthly Target</a></li>
        <li class="active">Create Sales Executive Monthly Target</li>
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
            <form action="/insert_dsc_monthly_target" method="POST" enctype="multipart/form-data">
                @csrf

                 <div class="box-body">

                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Sales Executive Name</label>                                       
                                                       <select class="form-control select2" name="dsc_id" id="dsc_id" required="true">
                                                        <option value="">-- Select Sales Executive--</option>
                                                             @foreach($sales_persons as $sales_person)
                                                                <option value="{{$sales_person->id}}">{{$sales_person->sales_person_name}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>                                      
                                     
                                        

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Target Quantity</label>
                                                <input type="text" class="form-control" id="target_qty" name="target_qty" aria-describedby="emailHelp" placeholder="Target Qty" onkeypress="javascript:return isNumber(event)" required="true">
                                            </div>
                                        </div>


                                         <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Month</label>                                                

                                                <select class="form-control select2" name="target_month" id="target_month" required="true">

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
                                        </div>


                                          <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Target Year</label>
                                                <input type="text" class="form-control" id="target_year" name="target_year" aria-describedby="emailHelp" placeholder="Target Year" onkeypress="javascript:return isNumber(event)" value="{{ date("Y") }}"required="true" readonly="true">
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

</script>