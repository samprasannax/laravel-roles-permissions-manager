 @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    
    <section class="content-header">
      <h1>
        Reports       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reports</li>
      </ol>
    </section>

  @can('admin')

    <!-- Main content -->
    <section class="content">     
      <!-- row -->
      <div class="row">

        <div class="col-md-12">        
        
       
          <!-- /.box -->
          <div class="row">
            <div class="col-md-12">
              <div class="box"> 
                <div class="box-header">
                  <h3 class="box-title">Quick Reports</h3>
                </div>

                <div class="box-body">   

                <div style="float: left;">

              

               <div style="float: left;">

                <!-- Stock In Hand -->
                <form  method="post" action="/stock_in_hand">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                     <img src="{{ asset('storage/reports_icon/stock-in-hand-1.png') }}"><br> Stock in Hand (SELF)
                  </button>
                </form>
              </div>

                <!-- Stock In hand for Dealers -->
              <div style="float: left;">
                <form  method="post" action="/assc_stock_in_hand">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/stock-2.png') }}"><br> Stock in Hand (Dealers)
                  </button>
                </form>
              </div>

                <!-- Receipt -->
                <div style="float: left;">
                <form  method="post" action="/receipt_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/receipt.png') }}"><br> Receipt
                  </button>
                </form>
              </div>


                <!-- Cancel Receipt -->
                <div style="float: left;">
                <form  method="post" action="/cancel_receipt_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app">                
                    <img src="{{ asset('storage/reports_icon/cancel-receipt.png') }}"><br> Cancel Receipt
                  </button>
                </form>
              </div>


                 <!-- Sold Vehicle Stock -->
                 <div style="float: left;">
                <form  method="post" action="/sold_vehicle_stock">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/sold.png') }}"><br> Self Sold Vehicle Stock
                  </button>
                </form>
              </div>
              
              
              
               <!-- Sold Vehicle Stock -->
                 <div style="float: left;">
                <form  method="post" action="/assc_sold_vehicle_stock">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/sold.png') }}"><br> Dealers Sold Vehicle Stock
                  </button>
                </form>
              </div>

                 <!-- Return Vehicle  -->
                 <div style="float: left;">
                <form  method="post" action="/return_vehicle_stock">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/shape.png') }}"><br> Return Vehicle 
                  </button>
                </form>
              </div>



               <!--  Voucher Receipt  -->
              <div style="float: left;">
                <form  method="post" action="/voucher_receipt_report_list">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/voucher.png') }}"><br> Voucher Receipt
                  </button>
                </form>
              </div>

               <!--  Rto check (Pending)  -->
               <div style="float: left;">
                <form  method="post" action="/rto-check-pending">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/rto-checked.png') }}"><br> Rto check (Pending)
                  </button>
                </form>
              </div>


              <!--  Feedback  -->
              <div style="float: left;">
                <form  method="post" action="/feed_back_report_list">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/feedback.png') }}"><br> Feedback
                  </button>
                </form>
              </div>


               
              <!--  Dealer Ledger  -->
              <div style="float: left;">

                  <a class="btn btn-app" data-toggle="modal" data-target="#modal-default">
                    <img src="{{ asset('storage/reports_icon/balance.png') }}"><br> Dealers Monthly Ledger
                  </a>
                 
              </div>



                 <!--  Dealer Ledger  -->
                 <div style="float: left;">
                <form  method="post" action="/dsc_monthly_sale">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/dsc-icon.png') }}"><br> Sales Executive <br>Monthly Sale
                  </button>
                </form>
              </div>


                 <!--  Daily Expense Ledger  -->
                 <div style="float: left;">
                <form  method="post" action="/daily_expense_ledger">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/voucher-new.png') }}"><br> Daily Expense Ledger
                  </button>
                </form>
              </div>
              
              
                <!--  DSC Monthly Target -->
                 <div style="float: left;">
                <form  method="post" action="/dsc_monthly_target_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/target-1.png') }}"><br>  Sales Executive <br>Monthly Target
                  </button>
                </form>
              </div>


                <!--  ASSC Monthly Target -->
                 <div style="float: left;">
                <form  method="post" action="/assc_monthly_target_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/target-2.png') }}"><br> Dealers Monthly Target
                  </button>
                </form>
              </div>
              
              
              
               <!--  Voucher Receipt  -->
              <div style="float: left;">
                <form  method="post" action="/monthwise_voucher_cateogry_report">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/voucher.png') }}"><br> Expense Categoy<br> Wise Report
                  </button>
                </form>
              </div>
              
              
              
                 <!--  Dealer Ledger  -->
              <div style="float: left;">

                  <a href="/assc-final-opening-balance"class="btn btn-app" >
                    <img src="{{ asset('storage/reports_icon/balance.png') }}"><br>Dealers Opening Balance
                  </a>
                 
              </div>
              
              
              
              
               <!--  Daily Note -->
              <div style="float: left;">
                <form  method="post" action="/daily_delivery_note">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/target-2.png') }}"><br>Daily Delivery Note
                  </button>
                </form>
              </div>
              
              
              
              <!--  DSC MOnthly Discount  -->
              <div style="float: left;">
                <form  method="post" action="/dsc_monthly_discount">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/target-2.png') }}"><br>Sales Executive <br>Monthly Discount
                  </button>
                </form>
              </div>
              
              
              
                <!--  Monthly Sales Percentage  -->
              <div style="float: left;">
                <form  method="post" action="/dsc_monthly_sales_percentage">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/target-2.png') }}"><br>Sales Executive <br>Monthly Sales Percentage
                  </button>
                </form>
              </div>



              <!--  Total Finance -->
              <div style="float: left;">
                <form  method="post" action="/total_finance_amount">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/target-2.png') }}"><br>Total Finance Amount
                  </button>
                </form>
              </div>
              
              
              
              <!--  Total Finance -->
              <div style="float: left;">
                <form  method="post" action="/assc_monthly_sales">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/target-2.png') }}"><br>Dealers Monthly Sales
                  </button>
                </form>
              </div>
              
                   


              <!-- Assc Monthly Sales Percentage -->
              <div style="float: left;">
                <form  method="post" action="/assc_monthly_sales_percentage">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/target-2.png') }}"><br>Dealers Monthly <br>Sales Percentage
                  </button>
                </form>
              </div>
              
              
              
              <!-- Assc Monthly Sales Percentage -->
              <div style="float: left;">
                <form  method="post" action="/self_sale_exchange_vehicle">  
                @csrf      
                  <button type="submit"  class="btn btn-app">
                
                    <img src="{{ asset('storage/reports_icon/target-2.png') }}"><br>Exchange Pending
                  </button>
                </form>
              </div>
              
              


            </div>


            <!-- /.box-body -->
          </div>
            </div>
           
          </div>
          <!-- /.row -->

          <!-- /.box -->
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