 @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')
<style>

@media only screen and  (min-width: 992px) and (max-width: 1300px) {
.dash-widget {
    width: 50%;
}
}
@media only screen and  (min-width: 1301px) and (max-width: 1600px) {
.dash-widget {
    width: 33%;




}
}



/*
@media only screen and  (min-width: 1660px) and (max-width: 1920px) {
.dash-widget {
    width: 32.666667%;
}
}


@media only screen and  (min-width: 983px) and (max-width: 1660px) {
.dash-widget {
    width: 32.666667%;
}
}*/
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    
    <section class="content-header">
      
      <h2 class="head">
        Dashboard 
      </h2>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>

    </section>



  @can('rto')
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">

       <a href="#"> <div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="material-icons">policy</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Insurance Pending</span>
              <span class="info-box-number" style="color:#000;">{{ $insurance_pending }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>



        <a href="#"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="material-icons">verified_user</i></span>

            <div class="info-box-content">
              <span class="info-box-text">RTO Pending</span>
              <span class="info-box-number" style="color:#000;">{{ $rto_pending }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div> </a>
        <!-- /.col -->
        <a href="#"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="material-icons">inbox</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Number Plate Pending</span>
              <span class="info-box-number" style="color:#000;">{{ $number_plate_pending }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <a href="#"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="material-icons">content_paste_search</i></span>

            <div class="info-box-content">
              <span class="info-box-text">RC Book Pending</span>
              <span class="info-box-number" style="color:#000;">{{  $rc_book_pending }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>
        <!-- /.col -->
    
        


        <!-- /.col -->

      </div>
      <!-- /.row -->
      
      </section>
  
  
  @endcan
  
  
  @can('admin')

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">

       <a href="/bank"> <div class=" col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
         
       <!--   <span class="info-box-icon bg-yellow"><i class="ion ion-ios-home"></i></span> -->
       <span class="info-box-icon bg-yellow"><i class="material-icons">account_balance</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Finance Banks</span>
              <span class="info-box-number" style="color:#000;">{{ $bank }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>



        <a href="/customers"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
              <!--  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>-->
            <span class="info-box-icon bg-yellow"><i class="material-icons">groups</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Customers</span>
              <span class="info-box-number" style="color:#000;">{{ $customers }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div> </a>
        <!-- /.col -->
        <a href="/sub-dealer"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
           <!-- <span class="info-box-icon bg-red"><i class="ion ion-ios-person"></i></span> -->
            <span class="info-box-icon bg-yellow"><i class="material-icons">person</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Dealers</span>
              <span class="info-box-number" style="color:#000;">{{ $dealers }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <a href="/sales-person"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <!--<span class="info-box-icon bg-green"><i class="ion ion-ios-cart"></i></span> -->
            <span class="info-box-icon bg-yellow"><i class="material-icons">shopping_cart</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales Person</span>
              <span class="info-box-number" style="color:#000;">{{  $sales_person }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>
        <!-- /.col -->
        <a href="/mechanical"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="material-icons">construction</i></span>

            <!-- <span class="info-box-icon bg-yellow"><i class="ion ion-settings"></i></span>-->
            <div class="info-box-content">
           <span class="info-box-text">Mechanics</span>
              <span class="info-box-number" style="color:#000;">{{ $mechanic }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>
        <!-- /.col -->
        

        <div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
           <!-- <span class="info-box-icon bg-aqua"><i class="ion ion-card"></i></span>-->
           <span class="info-box-icon bg-yellow"><i class="material-icons">local_atm</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Cash in Hand</span>
              <span class="info-box-number" style="color:#000;">Rs.{{ $final_cash_in_hand }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>



        <a href="#"> <div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
             <!--<span class="info-box-icon bg-yellow"><i class="ion ion-information-circled"></i></span>-->
            <span class="info-box-icon bg-yellow"><i class="material-icons">pending</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rto Check(Pending)</span>
              <span class="info-box-number" style="color:#000;">{{ $rto_check_pending }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>


    <a href="/finance_pending_list"> <div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <!--<span class="info-box-icon bg-yellow"><i class="ion ion-load-d"></i></span>-->
            <span class="info-box-icon bg-yellow"><i class="material-icons">pending_actions</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Finance(Pending)</span>
              <span class="info-box-number" style="color:#000;">{{ $finance_pending_count }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>



  <a href="/monthly-vehicle-stock"> <div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <!--<span class="info-box-icon bg-yellow"><i class="ion ion-ios-briefcase"></i></span>-->
            <span class="info-box-icon bg-yellow"><i class="material-icons">account_balance_wallet</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Stock</span>
              <span class="info-box-number" style="color:#000;">{{ $total_import_stock }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>



        <!-- /.col -->

      </div>
      <!-- /.row -->



      <!-- row -->
      <div class="row">

      <div class="content-header">
                  <h3 class="head" >Quick Reports</h3>
                </div>
        <div class="">
         
        
          <!-- /.box -->
          <div class=" row">
            <div class="col-md-12">
              <div class=""> 

              

                <div class="bak_col box-body">   

               


               <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">

                <!-- Stock In Hand -->
                <form  method="post" action="/stock_in_hand">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                  <i class="material-icons-outlined">store</i>
                     <p> Stock in Hand (SELFs)</p>
                  </button>
                </form>
              </div>

                <!-- Stock In hand for ASSC -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/assc_stock_in_hand">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                
                  <i class="material-icons-outlined">store</i><p> Stock in Hand (Dealers)</p>
                  </button>
                </form>
              </div>

                <!-- Receipt -->
                <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/receipt_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                
                  <i class="material-icons-outlined">assignment</i><p> Receipt</p>
                  </button>
                </form>
              </div>


                <!-- Cancel Receipt -->
                <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/cancel_receipt_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                  <i class="material-icons-outlined">cancel_presentation</i>
                  <p> Cancel Receipt</p>
                  </button>
                </form>
              </div>


                 <!-- Sold Vehicle Stock -->
                 <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/sold_vehicle_stock">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">                
                  <i class="material-icons-outlined">verified</i>
                  <p> Self Sold Vehicle Stock</P>
                  </button>
                </form>
              </div>
              
              
              
               <!-- Dealers Sold Vehicle Stock -->
                 <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/assc_sold_vehicle_stock">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                <i class="material-icons-outlined">thumb_up_off_alt</i>
                <p> Dealers Sold Vehicle Stock</P>
                  </button>
                </form>
              </div>


                 <!-- Return Vehicle  -->
                 <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/return_vehicle_stock">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                  <i class="material-icons-outlined">assignment_return</i>
                  <p> Return Vehicle </P>
                  </button>
                </form>
              </div>



                   <!--  Voucher Receipt  -->
                   <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/voucher_receipt_report_list">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">                
                  <i class="material-icons-outlined">receipt</i>
                  <p> Voucher Receipt</P>
                  </button>
                </form>
              </div>

                    <!--  Rto check (Pending)  -->
                    <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/rto-check-pending">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                  <i class="material-icons-outlined">task_alt</i>
                  <p> Rto check (Pending)</P>
                  </button>
                </form>
              </div>


                     <!--  Feedback  -->
                     <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/feed_back_report_list">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                  <i class="material-icons-outlined">feedback</i>
                  <p> Feedback</P>
                  </button>
                </form>
              </div>


                <!--  Dealer Ledger  -->
                <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                
                <a class="btn btn-app-app" data-toggle="modal" data-target="#modal-default">
                  <i class="material-icons-outlined">fact_check</i>
                    <p> Dealers Monthly Ledger</P>
                  </a>
                 
              </div>



                 <!--  Dealer Ledger  -->
                 <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/dsc_monthly_sale">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                  <i class="material-icons-outlined">calendar_today</i>
                  <p> Sales Executive  Monthly Sale</p>
                  </button>
                </form>
              </div>


                 <!--  Daily Expense Ledger  -->
                 <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/daily_expense_ledger">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                
                  <i class="material-icons-outlined">today</i>
                  <p> Daily Expense Ledger</p>
                  </button>
                </form>
              </div>
              
              
                <!--  DSC Monthly Target -->
                 <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/dsc_monthly_target_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                
                  <i class="material-icons-outlined">shopping_bag</i>
                  <p> Sales Executive Monthly Target</P>
                  </button>
                </form>
              </div>


                <!--  ASSC Monthly Target -->
                 <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/assc_monthly_target_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                
                  <i class="material-icons-outlined">account_box</i>
                  <p> Dealers Monthly Target</p>
                  </button>
                </form>
              </div>
              
              
                 <!--  Voucher Receipt  -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/monthwise_voucher_cateogry_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                
                  <i class="material-icons-outlined">analytics</i>
                  <p> Voucher Categoy Wise Report</P>
                  </button>
                </form>
              </div>
              
              
                   <!--  Dealer Ledger  -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">

                  <a href="/assc-final-opening-balance"class="btn btn-app-app" >
                  <i class="material-icons-outlined">account_balance_wallet</i>
                  <p>Dealers Opening Balance</P>
                  </a>
                 
              </div>
              
              
               <!--  Daily Note -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/daily_delivery_note">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">                
                  <i class="material-icons-outlined">sticky_note_2</i>
                    <p>Daily Delivery Note</P>
                  </button>
                </form>
              </div>
              
              
              
              <!--  DSC MOnthly Discount  -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/dsc_monthly_discount">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">                        
                  <i class="material-icons-outlined">shopping_basket</i>
                    <p>Sales Executive Monthly Discount</P>
                  </button>
                </form>
              </div>
              
              
              
                <!--  Monthly Sales Percentage  -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/dsc_monthly_sales_percentage">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                           
                  <i class="material-icons-outlined">add_shopping_cart</i>
                  <p>Sales Executive Monthly Sales Percentage</P>
                  </button>
                </form>
              </div>



              <!--  Total Finance -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/total_finance_amount">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                      <i class="material-icons-outlined">addchart</i>
                  <p>Total Finance Amount</P>
                  </button>
                </form>
              </div>
              
              
              
              <!--  Total Finance -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/assc_monthly_sales">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                
                      <i class="material-icons-outlined">wysiwyg</i>
                      <p>Dealers Monthly Sales</P>
                  </button>
                </form>
              </div>
              
              
                   


              <!-- Assc Monthly Sales Percentage -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/assc_monthly_sales_percentage">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                
                      <i class="material-icons-outlined">edit_calendar</i>
                    <p>Dealers Monthly Sales Percentage</p>
                  </button>
                </form>
              </div>
              
              
              <!-- Assc Monthly Sales Percentage -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="post" action="/self_sale_exchange_vehicle">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                
                      <i class="material-icons-outlined">pending_actions</i>
                    <p>Exchange Pendings</p>
                  </button>
                </form>
              </div>
			  
			  <!-- Mechanic Reports -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="get" action="/mechanic">  
                @csrf      
                  <button type="submit"  class="btn btn-app-app">
                    <i class="material-icons-outlined">construction</i>
					<p>Mechanic</p>
                  </button>
                </form>
              </div>
			  
			  
			  <!-- Vechicle Ageing Reports -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form  method="get" action="/vechicle_ageing">  
                @csrf      
					<button type="submit"  class="btn btn-app-app">
					<i class="material-icons-outlined">edit_calendar</i>
					<p>Vechicle Ageing</p>
                  </button>
                </form>
              </div>
			  
			  
			  
            </div>


            <!-- /.box-body -->
          </div>
            </div>


<div class="col-md-12">
            <!-- In Stock  -->
            <div class="col-md-6">

              <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">In Stock Info</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Vehicle Type</th>
                            <th>Model</th>
                            <th>Total Quantity</th>
                            <th>View</th>
                            <th>Find</th>
                          </tr>
                          </thead>
                          <tbody>
                              @php($count=0)
                              @foreach ($main_models as $main_model)
                              @php($count++)
                          <tr>
                            <td>{{ $count }}</td>
                            <td>{{ strtoupper($main_model->type_of_vehicle) }}</td>
                            <td>{{ strtoupper($main_model->model) }}</td>
                            <td>{{ strtoupper($main_model->in_stock) }}</td>
                            <td>
                               <a href="/list_of_stock_in_hand/{{ $main_model->id }}/{{ $main_model->vehicle_type_id }}"><button type="button" class="btn btn-primary" ><i class="fa fa-eye" title="View  Vehicle Stock"></i></button></a>
                            </td>
                            <td>
                                   <button class="btn btn-success"  data-id="{{ $main_model->id }}" data-toggle="modal" data-target="#modal-color-stock1" onclick="model_color_stock1(this)"><i  class="fa fa-cloud-download" title="Stock Colors"> </i> </button> 
                            </td>
                          </tr>
                          @endforeach
                         
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
               </div>
           </div>


             <!-- In Stock  -->
            <div class="col-md-6">

              <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Dealer Stock Info</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Type</th>
                            <th>Model</th>
                            <th>Total Quantity</th>
                            <th>View</th>                            
                          </tr>
                          </thead>
                          <tbody>
                              @php($count=0)
                              @foreach ($dealer_vehicle_stock as $dvs)
                              @php($count++)
                          <tr>
                            <td>{{ $count }}</td>
                            <td>{{ strtoupper($dvs->type_of_vehicle) }}</td>
                            <td>{{ strtoupper($dvs->model) }}</td>
                            <td>{{ strtoupper($dvs->total_stock) }}</td>
                            <td>
                               <a href="/list_of_assc_stock_in_hand/{{$dvs->vehicle_type_id}}/{{$dvs->model_id}}"><button type="button" class="btn btn-primary" ><i class="fa fa-eye" title="View  Vehicle Stock"></i></button></a>
                            </td>
                           
                          </tr>
                               @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
               </div>
           </div>


           </div>
           
           

          </div>
          <!-- /.row -->

          <!-- /.box -->
        </div>
        
        
        
              <!-- In Stock  -->
            <div class="col-md-6">

              <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Self Stock Over view</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Vehicle Type</th>
                            <th>Total</th>
                            
                          </tr>
                          </thead>
                          <tbody>
                            
                          <tr>
                            <td>1</td>
                            <td>SCOOTER</td>
                            <td>{{ $find_scooty_count}}</td>
                          </tr>

                          <tr>
                            <td>2</td>
                            <td>MOTORCYCLE</td>
                            <td>{{ $find_motorcycle_count}}</td>
                          </tr>


                          <tr>
                            <td>3</td>
                            <td>TOTAL</td>
                            <td>{{ $find_motorcycle_count + $find_scooty_count}}</td>
                          </tr>
                        
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
               </div>
           </div>


              <!-- In Stock  -->
            <div class="col-md-6">

              <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Dealers Stock Over View</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Vehicle Type</th>
                            <th>Total</th>
                            
                          </tr>
                          </thead>
                          <tbody>
                            
                          <tr>
                            <td>1</td>
                            <td>SCOOTER</td>
                            <td>{{ $find_assc_scooty_count}}</td>
                          </tr>

                          <tr>
                            <td>2</td>
                            <td>MOTORCYCLE</td>
                            <td>{{ $find_assc_motorcycle_count}}</td>
                          </tr>


                          <tr>
                            <td>3</td>
                            <td>TOTAL</td>
                            <td>{{ $find_assc_scooty_count + $find_assc_motorcycle_count}}</td>
                          </tr>
                        
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
               </div>
           </div>




      </div>
      <!-- /.row -->



<!-- 
ASSC Ledger Filter
-->

      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Dealers Ledger Filter </h4>
              </div>

              <div class="modal-body">
               <form action="/monthly_opening_balance" method="POST" enctype="multipart/form-data">

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
                        <select class="form-control select2" name="dealer_id" id="dealer_id"  required="true" style="width:100%">
                          <option>Select </option>
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
        
        
        
       <div class="modal fade" id="modal-color-stock1">
          <div class="modal-dialog">
            <div class="modal-content">
              
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Available Colors </h4>
              </div>

              <div class="modal-body">
           
                 <div class="box-body">
                   
                       <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Color</th>
                            <th>Total Vehicle Count</th>         
                          </tr>
                          </thead>
                          <tbody id="model-color-stock-report1">
                             
                          
                          </tbody>
                        </table>
                        
                        
                        
                  </div>
              <!-- /.box-body -->
     
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
    @endcan



  @can('receipt')

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">

       <a href="/bank"> <div class=" col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
         
       <!--   <span class="info-box-icon bg-yellow"><i class="ion ion-ios-home"></i></span> -->
       <span class="info-box-icon bg-yellow"><i class="material-icons">account_balance</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Finance Banks</span>
              <span class="info-box-number" style="color:#000;">{{ $bank }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>



        <a href="/customers"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
              <!--  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>-->
            <span class="info-box-icon bg-yellow"><i class="material-icons">groups</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Customers</span>
              <span class="info-box-number" style="color:#000;">{{ $customers }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div> </a>
        <!-- /.col -->
        <a href="/sub-dealer"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
           <!-- <span class="info-box-icon bg-red"><i class="ion ion-ios-person"></i></span> -->
            <span class="info-box-icon bg-yellow"><i class="material-icons">person</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Dealers</span>
              <span class="info-box-number" style="color:#000;">{{ $dealers }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <a href="/sales-person"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <!--<span class="info-box-icon bg-green"><i class="ion ion-ios-cart"></i></span> -->
            <span class="info-box-icon bg-yellow"><i class="material-icons">shopping_cart</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales Person</span>
              <span class="info-box-number" style="color:#000;">{{  $sales_person }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>
        <!-- /.col -->
        <a href="/mechanical"><div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="material-icons">construction</i></span>

            <!-- <span class="info-box-icon bg-yellow"><i class="ion ion-settings"></i></span>-->
            <div class="info-box-content">
           <span class="info-box-text">Mechanics</span>
              <span class="info-box-number" style="color:#000;">{{ $mechanic }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>
        <!-- /.col -->
        

        <div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
           <!-- <span class="info-box-icon bg-aqua"><i class="ion ion-card"></i></span>-->
           <span class="info-box-icon bg-yellow"><i class="material-icons">local_atm</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Cash in Hand</span>
              <span class="info-box-number" style="color:#000;">Rs.{{ $final_cash_in_hand }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>



        <a href="#"> <div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
             <!--<span class="info-box-icon bg-yellow"><i class="ion ion-information-circled"></i></span>-->
            <span class="info-box-icon bg-yellow"><i class="material-icons">pending</i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rto Check(Pending)</span>
              <span class="info-box-number" style="color:#000;">{{ $rto_check_pending }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>


    <a href="/finance_pending_list"> <div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <!--<span class="info-box-icon bg-yellow"><i class="ion ion-load-d"></i></span>-->
            <span class="info-box-icon bg-yellow"><i class="material-icons">pending_actions</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Finance(Pending)</span>
              <span class="info-box-number" style="color:#000;">{{ $finance_pending_count }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>



  <a href="/monthly-vehicle-stock"> <div class="col-md-3 col-sm-6 col-xs-12 dash-widget">
          <div class="info-box">
            <!--<span class="info-box-icon bg-yellow"><i class="ion ion-ios-briefcase"></i></span>-->
            <span class="info-box-icon bg-yellow"><i class="material-icons">account_balance_wallet</i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Stock</span>
              <span class="info-box-number" style="color:#000;">{{ $total_import_stock }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div></a>



        <!-- /.col -->

      </div>
      <!-- /.row -->




      <!-- row -->
      <div class="row">

        <div class="col-md-12">
         
        
              <!-- row -->
      <div class="row">

<div class="content-header">
            <h3 class="head" >Quick Reports</h3>
          </div>
  <div class="">
   
  
    <!-- /.box -->
    <div class=" row">
      <div class="col-md-12">
        <div class=""> 

        

          <div class="bak_col box-body">   

         


         <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">

          <!-- Stock In Hand -->
          <form  method="post" action="/stock_in_hand">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
            <i class="material-icons-outlined">store</i>
               <p> Stock in Hand (SELFs)</p>
            </button>
          </form>
        </div>

          <!-- Stock In hand for ASSC -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/assc_stock_in_hand">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          
            <i class="material-icons-outlined">store</i><p> Stock in Hand (Dealers)</p>
            </button>
          </form>
        </div>

          <!-- Receipt -->
          <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/receipt_report">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          
            <i class="material-icons-outlined">assignment</i><p> Receipt</p>
            </button>
          </form>
        </div>


          <!-- Cancel Receipt -->
          <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/cancel_receipt_report">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
            <i class="material-icons-outlined">cancel_presentation</i>
            <p> Cancel Receipt</p>
            </button>
          </form>
        </div>


           <!-- Sold Vehicle Stock -->
           <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/sold_vehicle_stock">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">                
            <i class="material-icons-outlined">verified</i>
            <p> Self Sold Vehicle Stock</P>
            </button>
          </form>
        </div>
        
        
        
         <!-- Sold Vehicle Stock -->
           <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/assc_sold_vehicle_stock">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          <i class="material-icons-outlined">thumb_up_off_alt</i>
          <p> Dealers Sold Vehicle Stock</P>
            </button>
          </form>
        </div>


           <!-- Return Vehicle  -->
           <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/return_vehicle_stock">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
            <i class="material-icons-outlined">assignment_return</i>
            <p> Return Vehicle </P>
            </button>
          </form>
        </div>



             <!--  Voucher Receipt  -->
             <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/voucher_receipt_report_list">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">                
            <i class="material-icons-outlined">receipt</i>
            <p> Voucher Receipt</P>
            </button>
          </form>
        </div>

              <!--  Rto check (Pending)  -->
              <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/rto-check-pending">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
            <i class="material-icons-outlined">task_alt</i>
            <p> Rto check (Pending)</P>
            </button>
          </form>
        </div>


               <!--  Feedback  -->
               <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/feed_back_report_list">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
            <i class="material-icons-outlined">feedback</i>
            <p> Feedback</P>
            </button>
          </form>
        </div>


          <!--  Dealer Ledger  -->
          <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          
          <a class="btn btn-app-app" data-toggle="modal" data-target="#modal-default">
            <i class="material-icons-outlined">fact_check</i>
              <p> Dealers Monthly Ledger</P>
            </a>
           
        </div>



           <!--  Dealer Ledger  -->
           <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/dsc_monthly_sale">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
            <i class="material-icons-outlined">calendar_today</i>
            <p> Sales Executive  Monthly Sale</p>
            </button>
          </form>
        </div>


           <!--  Daily Expense Ledger  -->
           <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/daily_expense_ledger">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          
            <i class="material-icons-outlined">today</i>
            <p> Daily Expense Ledger</p>
            </button>
          </form>
        </div>
        
        
          <!--  DSC Monthly Target -->
           <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/dsc_monthly_target_report">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          
            <i class="material-icons-outlined">shopping_bag</i>
            <p> Sales Executive Monthly Target</P>
            </button>
          </form>
        </div>


          <!--  ASSC Monthly Target -->
           <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/assc_monthly_target_report">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          
            <i class="material-icons-outlined">account_box</i>
            <p> Dealers Monthly Target</p>
            </button>
          </form>
        </div>
        
        
           <!--  Voucher Receipt  -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/monthwise_voucher_cateogry_report">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          
            <i class="material-icons-outlined">analytics</i>
            <p> Voucher Categoy Wise Report</P>
            </button>
          </form>
        </div>
        
        
             <!--  Dealer Ledger  -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">

            <a href="/assc-final-opening-balance"class="btn btn-app-app" >
            <i class="material-icons-outlined">account_balance_wallet</i>
            <p>Dealers Opening Balance</P>
            </a>
           
        </div>
        
        
         <!--  Daily Note -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/daily_delivery_note">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">                
            <i class="material-icons-outlined">sticky_note_2</i>
              <p>Daily Delivery Note</P>
            </button>
          </form>
        </div>
        
        
        
        <!--  DSC MOnthly Discount  -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/dsc_monthly_discount">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">                        
            <i class="material-icons-outlined">shopping_basket</i>
              <p>Sales Executive Monthly Discount</P>
            </button>
          </form>
        </div>
        
        
        
          <!--  Monthly Sales Percentage  -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/dsc_monthly_sales_percentage">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
                     
            <i class="material-icons-outlined">add_shopping_cart</i>
            <p>Sales Executive Monthly Sales Percentage</P>
            </button>
          </form>
        </div>



        <!--  Total Finance -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/total_finance_amount">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
                <i class="material-icons-outlined">addchart</i>
            <p>Total Finance Amount</P>
            </button>
          </form>
        </div>
        
        
        
        <!--  Total Finance -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/assc_monthly_sales">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          
                <i class="material-icons-outlined">wysiwyg</i>
                <p>Dealers Monthly Sales</P>
            </button>
          </form>
        </div>
        
        
             


        <!-- Assc Monthly Sales Percentage -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/assc_monthly_sales_percentage">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          
                <i class="material-icons-outlined">edit_calendar</i>
              <p>Dealers Monthly Sales Percentage</p>
            </button>
          </form>
        </div>
        
        
        <!-- Assc Monthly Sales Percentage -->
        <div class="qr-btn col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <form  method="post" action="/self_sale_exchange_vehicle">  
          @csrf      
            <button type="submit"  class="btn btn-app-app">
          
                <i class="material-icons-outlined">pending_actions</i>
              <p>Exchange Pendings</p>
            </button>
          </form>
        </div>
      </div>


      <!-- /.box-body -->
    </div>
      </div>

<div class="col-md-12">
            <!-- In Stock  -->
            <div class="col-md-6">

              <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">In Stock Info</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Vehicle Type</th>
                            <th>Model</th>
                            <th>Total Quantity</th>
                            <th>View</th>
                            <th>Find</th>
                          </tr>
                          </thead>
                          <tbody>
                              @php($count=0)
                              @foreach ($main_models as $main_model)
                              @php($count++)
                          <tr>
                            <td>{{ $count }}</td>
                            <td>{{ strtoupper($main_model->type_of_vehicle) }}</td>
                            <td>{{ strtoupper($main_model->model) }}</td>
                            <td>{{ strtoupper($main_model->in_stock) }}</td>
                            <td>
                               <a href="/list_of_stock_in_hand/{{ $main_model->id }}/{{ $main_model->vehicle_type_id }}"><button type="button" class="btn btn-primary" ><i class="fa fa-eye" title="View  Vehicle Stock"></i></button></a>
                            </td>
                      
                            <td>
                                <button class="btn btn-success" data-id="{{ $main_model->id }}" data-toggle="modal" data-target="#modal-color-stock" onclick="model_color_stock(this)"><i  class="fa fa-cloud-download" title="Stock Colors"> </i> </button> 
                            </td>
                          </tr>
                          @endforeach
                         
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
               </div>
           </div>


             <!-- In Stock  -->
            <div class="col-md-6">

              <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Dealer Stock Info</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Type</th>
                            <th>Model</th>
                            <th>Total Quantity</th>
                            <th>View</th>                            
                          </tr>
                          </thead>
                          <tbody>
                              @php($count=0)
                              @foreach ($dealer_vehicle_stock as $dvs)
                              @php($count++)
                          <tr>
                            <td>{{ $count }}</td>
                            <td>{{ strtoupper($dvs->type_of_vehicle) }}</td>
                            <td>{{ strtoupper($dvs->model) }}</td>
                            <td>{{ strtoupper($dvs->total_stock) }}</td>
                            <td>
                               <a href="/list_of_assc_stock_in_hand/{{$dvs->vehicle_type_id}}/{{$dvs->model_id}}"><button type="button" class="btn btn-primary" ><i class="fa fa-eye" title="View  Vehicle Stock"></i></button></a>
                            </td>
                           
                          </tr>
                               @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
               </div>
           </div>


           
           
           

          </div>
          <!-- /.row -->

          <!-- /.box -->
        </div>
        
        
        
              <!-- In Stock  -->
            <div class="col-md-6">

              <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Self Stock Over view</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Vehicle Type</th>
                            <th>Total</th>
                            
                          </tr>
                          </thead>
                          <tbody>
                            
                          <tr>
                            <td>1</td>
                            <td>SCOOTER</td>
                            <td>{{ $find_scooty_count}}</td>
                          </tr>

                          <tr>
                            <td>2</td>
                            <td>MOTORCYCLE</td>
                            <td>{{ $find_motorcycle_count}}</td>
                          </tr>


                          <tr>
                            <td>3</td>
                            <td>TOTAL</td>
                            <td>{{ $find_motorcycle_count + $find_scooty_count}}</td>
                          </tr>
                        
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
               </div>
           </div>


              <!-- In Stock  -->
            <div class="col-md-6">

              <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">ASSC Stock Over View</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Vehicle Type</th>
                            <th>Total</th>
                            
                          </tr>
                          </thead>
                          <tbody>
                            
                          <tr>
                            <td>1</td>
                            <td>SCOOTER</td>
                            <td>{{ $find_assc_scooty_count}}</td>
                          </tr>

                          <tr>
                            <td>2</td>
                            <td>MOTORCYCLE</td>
                            <td>{{ $find_assc_motorcycle_count}}</td>
                          </tr>


                          <tr>
                            <td>3</td>
                            <td>TOTAL</td>
                            <td>{{ $find_assc_scooty_count + $find_assc_motorcycle_count}}</td>
                          </tr>
                        
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
               </div>
           </div>




      </div>
      <!-- /.row -->



<!-- 
ASSC Ledger Filter
-->

      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> ASSC Ledger Filter </h4>
              </div>

              <div class="modal-body">
               <form action="/monthly_opening_balance" method="POST" enctype="multipart/form-data">

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
                        <label for="exampleName">ASSC Name</label>
                        <select class="form-control select2" name="dealer_id" id="dealer_id"  required="true" style="width:100%">
                          <option>Select </option>
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
        
        
        
        <!-- 
ASSC Ledger Filter
-->

      <div class="modal fade" id="modal-color-stock">
          <div class="modal-dialog">
            <div class="modal-content">
              
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Available Colors </h4>
              </div>

              <div class="modal-body">
           
                 <div class="box-body">
                   
                      
                       <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Color</th>
                            <th>Total Vehicle Count</th>         
                          </tr>
                          </thead>
                          <tbody id="model-color-stock-report">
                             
                          
                          </tbody>
                        </table>
                        
                        
                        
                  </div>
              <!-- /.box-body -->
     
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
    @endcan


  </div>
  <!-- /.content-wrapper -->

 @include('layouts.bottom-footer')
 <script>
    $('#report_date').datepicker('setDate', 'today');
 </script>
 
  <script>
   var app_url = "{{config('app.url')}}";  
   
   
   
   function model_color_stock1(ths){

           var primary_id = $(ths).attr('data-id');
                               
                              $.ajax({
                                  type: "POST",
                                  url: app_url+'/fetch_colors_count_one',
                                  data: {"_token": "{{ csrf_token() }}","primary_id":primary_id },

                                  success: function( msg ) {
                                      
                                      
                                     if(msg.length>0)
                                      {

                                       
                                        var school_edu_list = '<ul>';
                
                                        var count=1; 
                
                                        for(var i=0; i<msg.length; i++){
                
                                            school_edu_list +='<tr><td><span class="sm-slist-name">'+count+' </span></td><td><span class="sm-slist-name">'+msg[i].type_of_color+' </span></td><td><span class="sm-slist-name">'+msg[i].total_count_color_one+' </span></td></tr>';
                
                                            count++;
                
                                        }
                
                                        school_edu_list +='</ul>';
                
                                        $("#model-color-stock-report1").html(school_edu_list);
                                      }
                                      else
                                      {
                                                
                                      }
                                     
                                  }

                             });
     }
     
     
     
   function model_color_stock(ths){

           var primary_id = $(ths).attr('data-id');
                               
                              $.ajax({
                                  type: "POST",
                                  url: app_url+'/fetch_colors_count',
                                  data: {"_token": "{{ csrf_token() }}","primary_id":primary_id },

                                  success: function( msg ) {
                                      
                                      
                                     if(msg.length>0)
                                      {

                                       
                                        var school_edu_list1 = '<ul>';
                
                                        var count=1; 
                
                                        for(var i=0; i<msg.length; i++){
                
                                            school_edu_list1 +='<tr><td><span class="sm-slist-name">'+count+' </span></td><td><span class="sm-slist-name">'+msg[i].type_of_color+' </span></td><td><span class="sm-slist-name">'+msg[i].total_count_color_one+' </span></td></tr>';
                
                                            count++;
                
                                        }
                
                                        school_edu_list1 +='</ul>';
                
                                        $("#model-color-stock-report").html(school_edu_list1);
                                      }
                                      else
                                      {
                                                
                                      }
                                     
                                  }

                             });
     }
     
     
</script>
 
 
 