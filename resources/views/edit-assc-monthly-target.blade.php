  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Dealers Monthly Target
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/view-assc-monthly-target">View Dealers Monthly Target</a></li>
        <li class="active">Edit Dealers Monthly Target</li>
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
            <form action="/udpate_assc_monthly_target" method="POST" enctype="multipart/form-data">
                @csrf

                  <input type="hidden" name="target_unique_id" id="target_unique_id" value="{{ $edit_assc_monthly_targets[0]->id }}">

                 <div class="box-body">

                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Dealers Name</label>                                       
                                                       <select class="form-control select2" name="assc_id" id="assc_id" required="true">
                                                        <option value="">-- Select Dealers--</option>
                                                                 @foreach($dealers as $dealer)
                                                                <option value="{{$dealer->id}}" @if($dealer->id==$edit_assc_monthly_targets[0]->assc_id) selected @endif >{{ $dealer->dealer_name }}</option>
                                                                @endforeach
                                                        </select>
                                            </div>
                                        </div>  


                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Target Quantity</label>
                                                <input type="text" class="form-control" id="target_qty" name="target_qty" aria-describedby="emailHelp" placeholder="Target Qty" onkeypress="javascript:return isNumber(event)" value="{{ $edit_assc_monthly_targets[0]->target_qty }}" required="true">
                                            </div>
                                        </div>


                                         <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Month</label>
                                                <select class="form-control select2" name="target_month" id="target_month" required="true">
                                                <option value="">- Month -</option>
                                                <option value="01" @if($edit_assc_monthly_targets[0]->target_month == '01') selected @endif>January</option>
                                                <option value="02" @if($edit_assc_monthly_targets[0]->target_month == '02') selected @endif>Febuary</option>
                                                <option value="03" @if($edit_assc_monthly_targets[0]->target_month == '03') selected @endif>March</option>
                                                <option value="04" @if($edit_assc_monthly_targets[0]->target_month == '04') selected @endif>April</option>
                                                <option value="05" @if($edit_assc_monthly_targets[0]->target_month == '05') selected @endif>May</option>
                                                <option value="06" @if($edit_assc_monthly_targets[0]->target_month == '06') selected @endif>June</option>
                                                <option value="07" @if($edit_assc_monthly_targets[0]->target_month == '07') selected @endif>July</option>
                                                <option value="08" @if($edit_assc_monthly_targets[0]->target_month == '08') selected @endif>August</option>
                                                <option value="09" @if($edit_assc_monthly_targets[0]->target_month == '09') selected @endif>September</option>
                                                <option value="10" @if($edit_assc_monthly_targets[0]->target_month == '10') selected @endif>October</option>
                                                <option value="11" @if($edit_assc_monthly_targets[0]->target_month == '11') selected @endif>November</option>
                                                <option value="12" @if($edit_assc_monthly_targets[0]->target_month == '12') selected @endif>December</option>

                                              </select>


                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Target Year</label>
                                                <input type="text" class="form-control" id="target_year" name="target_year" aria-describedby="emailHelp" placeholder="Target Year" onkeypress="javascript:return isNumber(event)" value="{{ $edit_assc_monthly_targets[0]->target_year }}"required="true" readonly="true">
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
