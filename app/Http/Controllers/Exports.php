<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

use App\Export\AsscLedger;
use App\Export\DailyLedger;
use App\Export\DscLedger;
use App\Export\ReceiptLedger;
use App\Export\VoucherReceiptLedger;
use App\Export\AsscOpeningLedger;
use App\Export\FeedBackLedger;
use App\Export\StockInHandLedger;
use App\Export\AsscStockInHandLedger;
use App\Export\CancelReceiptLedger;
use App\Export\SalesPercentageLedger;
use App\Export\TotalFinanaceLedger;

use App\Export\SoldVehicleStockLedger;
use App\Export\AsscSoldVehicleStockLedger;
use App\Export\AsscMonthlySalesLedger;

use App\Export\AsscSalesPercentageLedger;
use App\Export\SelfSaleExchangeVehicleLedger;

use App\Export\DscMonthlyTargetLedger;
use App\Export\AsscMonthlyTargetLedger;

use App\Export\FinancePendingListLedger;

use App\Export\DealerBookingLedger;
use App\Export\MechanicReport;

use Maatwebsite\Excel\Facades\Excel;
  
class Exports extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
 

   /* Export Ledger */
    public function export_assc_ledger() 
    {
        return Excel::download(new AsscLedger, 'Assc-Ledger.xlsx');
    }


    /* Daily Ledger */
    public function export_daily_ledger() 
    {
        return Excel::download(new DailyLedger, 'Daily-Ledger.xlsx');

    }



    /* DSC  Monthly Sale Ledger */

    public function export_dsc_ledger() 
    {

        return Excel::download(new DscLedger, 'Dsc-monthly-sale.xlsx');

    }


   /* Receipt Report */
    
    public function export_receipt_report() 
    {

        return Excel::download(new ReceiptLedger, 'Dsc-monthly-sale.xlsx');

    }



   /* Export Voucher  Report */
    
    public function export_assc_opening_balance() 
    {

        return Excel::download(new AsscOpeningLedger, 'assc-opening.xlsx');

    }

/* Export Voucher  Report */
    
    public function export_feed_back() 
    {

        return Excel::download(new FeedBackLedger, 'assc-opening.xlsx');

    }




    /* Export Stock In Hand */
    
    public function export_stock_in_hand() 
    {

        return Excel::download(new StockInHandLedger, 'Export-Stock-in-hand-self.xlsx');

    }


    /* Export Assc Stock In Hand */
    
    public function export_assc_stock_in_hand() 
    {

        return Excel::download(new AsscStockInHandLedger, 'Export-Assc-Stock-in-hand.xlsx');

    }


    /* Export Cancel Receipt Report */
    
    public function export_cancel_receipt_report() 
    {

        return Excel::download(new CancelReceiptLedger, 'Export-Cancel-Receipt-Report.xlsx');

    }
    
        /* Export Cancel Receipt Report */
    
    public function export_sales_percentage() 
    {

        return Excel::download(new SalesPercentageLedger, 'Export-monthly-sales-percentage.xlsx');

    }



    /* Export Total Finance Report */
    
    public function export_total_finance_amount() 
    {
        return Excel::download(new TotalFinanaceLedger, 'Export-Finance.xlsx');
    }



    /* Export Sold Vehicle Stock */
    
    public function export_sold_vehicle_stock() 
    {
        return Excel::download(new SoldVehicleStockLedger, 'Export-sold-vehicle-stock.xlsx');
    }


    /* Export Assc Sold Vehicle Stock */
    
    public function export_assc_sold_vehicle_stock() 
    {
        return Excel::download(new AsscSoldVehicleStockLedger, 'Export-assc-sold-vehicle-stock.xlsx');
    }
    
       /* Export Assc Monthly Sold Details */
    
    public function export_assc_monthly_sales() 
    {
        return Excel::download(new AsscMonthlySalesLedger, 'Export-assc-monthly-sales.xlsx');
    }
    
    
    /* Export Assc Monthly Sold Percentage  Details */
    
    public function export_assc_monthly_sales_percentage() 
    {
        return Excel::download(new AsscSalesPercentageLedger, 'Export-assc-monthly-sales-percentage.xlsx');
    }


      /* Export Self Sale Exchange Vehicle Info */
    
    public function export_self_sale_exchange_vehicle() 
    {
        return Excel::download(new SelfSaleExchangeVehicleLedger, 'Export-exhange-pending.xlsx');
    }
    
       /* Export Dsc Monthly Target */
    
    public function export_dsc_monthly_target_report() 
    {
        return Excel::download(new DscMonthlyTargetLedger, 'Export-dsc-monthly-target.xlsx');
    }


   /* Export Assc Monthly Target */
    
    public function export_assc_monthly_target_report() 
    {
        return Excel::download(new AsscMonthlyTargetLedger, 'Export-assc-monthly-target.xlsx');
    }
	
	/* Export Assc Monthly Target */
    
    public function export_mechanic_report() 
    {
        return Excel::download(new MechanicReport, 'mechanic-report.xlsx');
    }


    /* Export Finance Peding List */
    
    public function export_pending_finance_list() 
    {
        return Excel::download(new FinancePendingListLedger, 'Export-finance-pending-list.xlsx');
    }



    /* Export Finance Peding List */
    
    public function export_dealer_booking() 
    {
        return Excel::download(new DealerBookingLedger, 'Export-dealer-booking.xlsx');
    }

    /* Export Voucher Receipt Report*/
    public function export_voucher_receipt_report() 
    {
        return Excel::download(new VoucherReceiptLedger, 'Export-voucher-receipt-list.xlsx');
    }




}