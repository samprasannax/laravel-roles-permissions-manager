<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class=" {{ request()->is('admin/home')  ? 'active' : '' }}">
          <a class="{{ request()->is('admin/home') || request()->is('admin/home/*') ? 'active' : '' }}" href="{{ route("admin.home") }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>          
        </li>
    
        <!--
        User management 
        -->

        @can('users_manage')
       
        <li class="{{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
          <a href="{{ route("admin.permissions.index") }}" >
            <i class="fa fa-unlock-alt"></i> <span>Permissions</span>
            <span class="pull-right-container">
              
            </span>
          </a>          
        </li>

        <li  class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
          <a href="{{ route("admin.roles.index") }}">
            <i class="fa fa-briefcase"></i> <span>Roles</span>
            <span class="pull-right-container">
              
            </span>
          </a>          
        </li>

        <li class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
          <a href="{{ route("admin.users.index") }}" >
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              
            </span>
          </a>          
        </li>

       
          <!-- 
          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>User Management</span>
              <span class="pull-right-container">
                <span class="fa fa-angle-left pull-right"></span>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route("admin.permissions.index") }}" class="{{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}"><i class="fa fa-unlock-alt"></i> Permissions</a></li>

              <li><a href="{{ route("admin.roles.index") }}" class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}"><i class="fa fa-briefcase"></i> Roles</a></li>

              <li><a href="{{ route("admin.users.index") }}" class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}"><i class="fa  fa-user"></i> Users</a></li>
             
            </ul>
          </li> 
          -->

        @endcan

        <!--
        Admin 
        -->
        @can('admin')
       


  
        <li class="header">MASTERS</li>
    
         <li class=" {{ request()->is('financial-year')  ? 'active' : '' }}" >
          <a href="/financial-year">
            <i class="fa fa fa-address-book"></i> <span>Financial Year</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        
         <li class="{{ request()->is('bank') ? 'active' : '' }}">
          <a href="/bank">
            <i class="fa fa-home"></i> <span>Finance Bank</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
         <li class="{{ request()->is('customers') ? 'active' : '' }}">
          <a href="/customers">
            <i class="fa fa-user"></i> <span>Customers</span>
            <span class="pull-right-container">
              
            </span>
          </a>          
        </li>
        
         <li class="{{ request()->is('offer-list') ? 'active' : '' }}">
          <a href="/offer-list">
            <i class="fa fa-star"></i> <span>Offer</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        
         <li class="{{ request()->is('mechanical')  ? 'active' : '' }}">
          <a href="/mechanical">
            <i class="fa fa-wrench"></i> <span>Mechanic</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li  class="{{ request()->is('sales-person')  ? 'active' : '' }}">
          <a href="/sales-person">
            <i class="fa fa-tag"></i> <span>Sales Executive</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        
        <li class="header">ACCOUNTS</li>
           

        <li class="{{ request()->is('cash-in-hand')  ? 'active' : '' }}">
          <a href="/cash-in-hand">
            <i class="fa fa-dollar"></i> <span>Opening Balance</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li class="{{ request()->is('voucher-credit-list')  ? 'active' : '' }}">
          <a href="/voucher-credit-list">
            <i class="fa fa-dollar"></i> <span>Cash In Hand Credit</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        
        
         <li class="{{ request()->is('daily-account-close')  ? 'active' : '' }}">
          <a href="/daily-account-close">
            <i class="fa fa-dollar"></i> <span>Daily Account Close</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        
         <li class="header">DEALERS</li>

       

       
        <li class="{{ request()->is('sub-dealer')  ? 'active' : '' }}">
          <a href="/sub-dealer">
            <i class="fa fa-user"></i> <span>Dealers</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

       
        
        <li class="{{ request()->is('dealer-rate')  ? 'active' : '' }}">
          <a href="/dealer-rate">
            <i class="fa fa-star"></i> <span>Dealers Rate</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        


         <li class="{{ request()->is('assc-offer-list')  ? 'active' : '' }}">
          <a href="/assc-offer-list">
            <i class="fa fa-user"></i> <span>Dealers Offer</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        



        
         <li class="{{ request()->is('return-vehicle-manual')  ? 'active' : '' }}">
          <a href="/return-vehicle-manual">
            <i class="fa fa-user"></i> <span>Dealers Return Manual</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

       
        
          <!--<li class="header">DAILY ACCOUNT</li>-->

        
          <li class="header">MONTHLY TARGET</li>


         <li class="{{ request()->is('view-dsc-monthly-target')  ? 'active' : '' }}">
          <a href="/view-dsc-monthly-target">
            <i class="fa fa-wrench"></i> <span>Sales Executive Target</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
         <li class=" {{ request()->is('view-assc-monthly-target')  ? 'active' : '' }}">
          <a href="/view-assc-monthly-target">
            <i class="fa fa-wrench"></i> <span>Dealers Target</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        

        <li class="header">VEHICLE MANAGEMENT</li>

        <li class=" {{ request()->is('vehicle-type')  ? 'active' : '' }}">
          <a href="/vehicle-type">
            <i class="fa fa-cog"></i> <span>Vehicle Type</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li class=" {{ request()->is('vehicle-color')  ? 'active' : '' }}">
          <a href="/vehicle-color">
            <i class="fa fa-paint-brush"></i> <span>Color</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li class=" {{ request()->is('model-list')  ? 'active' : '' }}">
          <a href="/model-list">
            <i class="fa fa-file"></i> <span>Model</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li class=" {{ request()->is('vehicle-stock')  ? 'active' : '' }}">
          <a href="/vehicle-stock">
            <i class="fa fa-cloud-download"></i> <span>Vehicle Stock</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>        

        <li class=" {{ request()->is('vehicle-model')  ? 'active' : '' }}">
          <a href="/vehicle-model">
            <i class="fa fa-star"></i> <span>Model Rate Info</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>       

        <li class="header">BOOKING / RECEIPT</li>
        
        <li class=" {{ request()->is('sales-booking')  ? 'active' : '' }}">
          <a href="/sales-booking">
            <i class="fa fa-file"></i> <span>Sales Booking / Receipt</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        
        <li class=" {{ request()->is('sales-booking-without-filter')  ? 'active' : '' }}">
          <a href="/sales-booking-without-filter">
            <i class="fa fa-file"></i> <span>Booking / Receipt(Full)</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>



        <li class=" {{ request()->is('dealer-booking')  ? 'active' : '' }}">
          <a href="/dealer-booking">
            <i class="fa fa-file"></i> <span>Dealer Booking</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        <!-- <li>
          <a href="/dealer-booking">
            <i class="fa fa-book"></i> <span>Warranty Card(Monthly)</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>-->
        <li class="header">EXPENSE MANAGEMENT</li>

        <li class=" {{ request()->is('voucher-category')  ? 'active' : '' }}">
          <a href="/voucher-category">
            <i class="fa fa-list-alt"></i> <span>Expense Category</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li class=" {{ request()->is('voucher-receipt-list')  ? 'active' : '' }}">
          <a href="/voucher-receipt-list">
            <i class="fa fa-book"></i> <span>Expense Receipt</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li class="header">RTO</li>

        <li class=" {{ request()->is('rto-check')  ? 'active' : '' }}">
          <a href="/rto-check">
            <i class="fa fa-book"></i> <span>RTO Check</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        


        <li class="header">FEEDBACK MANAGEMENT</li>

        <li class=" {{ request()->is('feed-back-list')  ? 'active' : '' }}">
          <a href="/feed-back-list">
            <i class="fa fa-book"></i> <span>Feedback</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>



        <li class="header">REPORTS</li>

        <li class=" {{ request()->is('list-of-reports')  ? 'active' : '' }}">
          <a href="/list-of-reports">
            <i class="fa fa-circle-o"></i> <span>List Of Reports</span>
            <span class="pull-right-container">              
            </span>
          </a>     
    

<!--<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("btn_s");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("activ");
  current[0].className = current[0].className.replace("activ", "");
  this.className += " activ";
  });
}
</script> -->



        @endcan

        <!--
        Receipt 
        -->

        @can('receipt')

         <li>
          <a href="/voucher-credit-list">
            <i class="fa fa-money"></i> <span>Cash In Hand Credit</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

         <li>
          <a href="/bank">
            <i class="fa fa-bank"></i> <span>Bank</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li>
          <a href="/customers">
            <i class="fa fa-users"></i> <span>Customers</span>
            <span class="pull-right-container">
              
            </span>
          </a>          
        </li>
        
        
           <li>
          <a href="/offer-list">
            <i class="fa fa-bank"></i> <span>Offer</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>


         <li>
          <a href="/assc-offer-list">
            <i class="fa fa-user"></i> <span>Assc Offer</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        

        <li>
          <a href="/sub-dealer">
            <i class="fa fa-user"></i> <span>ASSC</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>


         <li>
          <a href="/mechanical">
            <i class="fa fa-wrench"></i> <span>Mechanic</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li>
          <a href="/sales-person">
            <i class="fa fa-handshake-o"></i> <span>DSC</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
          <li class="header">DAILY ACCOUNT</li>

         <li>
          <a href="/daily-account-close">
            <i class="fa fa-money"></i> <span>Daily Account Close</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        
          <li class="header">MONTHLY TARGET</li>


         <li>
          <a href="/view-dsc-monthly-target">
            <i class="fa fa-wrench"></i> <span>DSC Target</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
         <li>
          <a href="/view-assc-monthly-target">
            <i class="fa fa-wrench"></i> <span>ASSC Target</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>


       <li class="header">BOOKING / RECEIPT</li>
        
        <li>
          <a href="/sales-booking">
            <i class="fa fa-book"></i> <span>Sales Booking / Receipt</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>


        <li class="header">VOUCHER MANAGEMENT</li>

        <li>
          <a href="/voucher-category">
            <i class="fa fa-book"></i> <span>Vocher Category</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li>
          <a href="/voucher-receipt-list">
            <i class="fa fa-book"></i> <span>Vocher</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        
         <li class="header">REPORTS</li>

        <li>
          <a href="/list-of-reports">
            <i class="fa fa-circle-o"></i> <span>List Of Reports</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>


        @endcan


        @can('stock_import')

         <li class="header">VEHICLE MANAGEMENT</li>

        <li>
          <a href="/vehicle-type">
            <i class="fa fa-motorcycle"></i> <span>Vehicle Type</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li>
          <a href="/vehicle-color">
            <i class="fa fa-paint-brush"></i> <span>Color</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li>
          <a href="/model-list">
            <i class="fa fa-motorcycle"></i> <span>Model</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li>
          <a href="/vehicle-stock">
            <i class="fa fa-cloud-download"></i> <span>Vehicle Stock</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>       


        <li class="header">Feedback Management</li>

        <li>
          <a href="/feed-back-list">
            <i class="fa fa-book"></i> <span>Feedback</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li> 

        @endcan



        @can('gate_pass')

        <li class="header">BOOKING / RECEIPT</li>
        
        <li>
          <a href="/sales-booking">
            <i class="fa fa-book"></i> <span>Sales Booking / Receipt</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        <li>
          <a href="/dealer-booking">
            <i class="fa fa-book"></i> <span>Dealer Booking</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        @endcan



        @can('rto')

        <li>
          <a href="/rto-check">
            <i class="fa fa-book"></i> <span>RTO Check</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>
        
        
        <li>
          <a href="/rto-check-completed">
            <i class="fa fa-book"></i> <span>RTO Check Completed</span>
            <span class="pull-right-container">              
            </span>
          </a>          
        </li>

        @endcan







        <li>
          <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
          <i class="fa fa-sign-out"></i> <span>Logout</span> </a>
        </li>

      
      </ul>

      
    </section>
    <!-- /.sidebar -->
  </aside>
