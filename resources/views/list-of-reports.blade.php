 @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')
 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    
   <!--<section class="content-header">
      <h1>
        Reports       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reports</li>
      </ol>
    </section>-->

  @can('admin')

    <!-- Main content -->
    <section class="content">     
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