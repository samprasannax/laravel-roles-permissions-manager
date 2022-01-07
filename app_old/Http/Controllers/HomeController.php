<?php
namespace App\Http\Controllers;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Auth;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // print_r($this->middleware('auth'));
      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
       

        if (! Gate::allows('users_manage')) 
            {
            if (! Gate::allows('admin')) 
                {
                    if (! Gate::allows('receipt')) 
                    {
                        if (! Gate::allows('stock_import')) 
                        {
                            if (! Gate::allows('gate_pass')) 
                            {
                                if (! Gate::allows('rto')) {
                                    return abort(401);
                                }
                            }
                        }
                    }
                }
            }
            

        $main_models = DB::table('main_model')
                        ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'main_model.vehicle_type_id')
                        ->select('vehicle_type.type_of_vehicle','main_model.model','main_model.in_stock','main_model.id','main_model.vehicle_type_id')
                        ->where('main_model.is_deleted', '=', '0')
                        ->get();
                                  


        $dealer_stocks = DB::table('main_model')
                        ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'main_model.vehicle_type_id')
                        ->select('vehicle_type.type_of_vehicle','main_model.model','main_model.in_stock')
                        ->where('main_model.is_deleted', '=', '0')
                        ->get();

      
         $dealer_vehicle_stock1 = DB::table('dealer_booking_vehicle_info')
                                    ->leftjoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
                                    ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
                                    ->select('vehicle_type.type_of_vehicle','main_model.model',DB::raw('count(dealer_booking_vehicle_info.id) as total_stock'))
                                    ->groupBy(['vehicle_type.type_of_vehicle', 'main_model.model'])
                                     ->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.stock_status','=', 0],['dealer_booking_vehicle_info.return_status','=', 0]])
                                     ->get();




         $dealer_vehicle_stock = DB::table('dealer_booking_vehicle_info')
                                    ->leftjoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
                                    ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
                                      ->select('dealer_booking_vehicle_info.model_id','dealer_booking_vehicle_info.vehicle_type_id','vehicle_type.type_of_vehicle','main_model.model',DB::raw("(SELECT count(id) as total_scooter FROM dealer_booking_vehicle_info
                                WHERE dealer_booking_vehicle_info.model_id = main_model.id and dealer_booking_vehicle_info.vehicle_type_id = vehicle_type.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.stock_status = 0 and dealer_booking_vehicle_info.return_status = 0) as total_stock"))->distinct()
                                     ->get();
                                     

        $bank = DB::table('bank')->where('is_deleted', '=', 0)->count();
        $customers = DB::table('customers')->where('is_deleted', '=', 0)->count();
        $dealers = DB::table('dealers')->where('is_deleted', '=', 0)->count();
        $sales_person = DB::table('sales_person')->where('is_deleted', '=', 0)->count();
        $mechanic = DB::table('mechanic')->where('is_deleted', '=', 0)->count();
        $dealer_lists = DB::table('dealers')->where('is_deleted', '=', 0)->get();
        $sales_person_lists = DB::table('sales_person')->where('is_deleted', '=', 0)->get();
        $rto_check_pending = DB::table('sale_booking')->where([['is_deleted', '=', 0],['account_close_status', '=', 1],['cancel_status', '=', 0],['rto_check_status', '=', 0]])->count();

          
            $voucher_total_amount = DB::table('voucher_receipt')                  
                    ->where('is_deleted', '=', 0)
                    ->where('payment_mode', '=', 1)
                    ->sum('voucher_amount');
                    
             $voucher_credit_amount = DB::table('voucher_credit')                  
                    ->where('is_deleted', '=', 0)
                    ->where('payment_mode', '=', 1)
                    ->sum('voucher_amount');

            $receipt_total_amount = DB::table('customer_sales_receipt')                  
                    ->where('is_deleted', '=', 0)
                    ->where('amount_status', '=', 0)
                    ->where('payment_mode', '=', 1)
                    ->sum('amount_to_pay');

            $cash_in_hand = DB::table('cash_in_hand')                  
                    ->where('is_deleted', '=', 0)
                    ->sum('opening_balance');
                    
            

            $final_cash_in_hand = $cash_in_hand + $receipt_total_amount + $voucher_credit_amount - $voucher_total_amount;
            
            


            $find_scooty_count = DB::table('vehicle_stock')
                                ->where([['is_deleted', '=', 0],['status', '=', 0],['vehicle_type', '=', 1]])
                                ->count();

            $find_motorcycle_count = DB::table('vehicle_stock')
                                ->where([['is_deleted', '=', 0],['status', '=', 0],['vehicle_type', '=', 2]])
                                ->count();


            $find_assc_scooty_count = DB::table('dealer_booking_vehicle_info')
                                ->where([['is_deleted', '=', 0],['stock_status', '=', 0],['return_status', '=', 0],['vehicle_type_id', '=', 1]])
                                ->count();

            $find_assc_motorcycle_count = DB::table('dealer_booking_vehicle_info')

                                ->where([['is_deleted', '=', 0],['stock_status', '=', 0],['return_status', '=', 0],['vehicle_type_id', '=', 2]])
                                ->count();
                                
                                
                                
            $insurance_pending = DB::table('sale_booking')
                                ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')
                                ->where([['sale_booking.is_deleted', '=', 0],['sale_booking.account_close_status', '=', 1],['sale_booking.cancel_status', '=', 0],['self_sale_vehicle_info.insurance', '=', 0]])
                                ->count();


            $rto_pending = DB::table('sale_booking')
                                ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')
                                ->where([['sale_booking.is_deleted', '=', 0],['sale_booking.account_close_status', '=', 1],['sale_booking.cancel_status', '=', 0],['self_sale_vehicle_info.rto', '=', 0]])
                                ->count();


             $number_plate_pending = DB::table('sale_booking')
                                ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')
                                ->where([['sale_booking.is_deleted', '=', 0],['sale_booking.account_close_status', '=', 1],['sale_booking.cancel_status', '=', 0],['self_sale_vehicle_info.number_plate', '=', 0]])
                                ->count();

             $rc_book_pending = DB::table('sale_booking')
                                ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')
                                ->where([['sale_booking.is_deleted', '=', 0],['sale_booking.account_close_status', '=', 1],['sale_booking.rto_check_status', '=', 0],['sale_booking.cancel_status', '=', 0],['self_sale_vehicle_info.rc_book', '=', 0]])
                                ->count();
            
            $finance_pending_count = DB::table('sale_booking')
                                    ->where([['is_deleted', '=', 0],['finance_status', '=', 0],['cancel_status', '=', 0],['hyp', '=', 'yes']])
                                    ->count();
                                    
                                    
                                    
                 $target_month1 = date("m");
            	 $target_year1 = date("Y");
            	 $val3 = 01;
            	 
            	 	$date_find = $target_year1."-".$target_month1."-".$val3;
            	 	
            	 	$from_date1 = date('Y-m-01',strtotime($date_find));// hard-coded '01' for first day
			        $to_date1  = date('Y-m-t',strtotime($date_find));
            	 
            $total_import_stock = DB::table('vehicle_stock')
                                ->where(function($query) use ($from_date1, $to_date1) {	
						 		
								       	 if($from_date1 !='' and $to_date1 !='')
								       	 $query->whereBetween('vehicle_stock.stock_date', [$from_date1, $to_date1]);
 															        
								        	$query->where([['vehicle_stock.is_deleted', '=', 0]]);
								        	
								        })->count();
                                
                                    
                                    
    


        return view('home', compact(['total_import_stock','main_models','dealer_vehicle_stock','dealer_stocks','bank','customers','dealers','sales_person','mechanic','dealer_lists','sales_person_lists','rto_check_pending','final_cash_in_hand','find_scooty_count','find_motorcycle_count','find_assc_scooty_count','find_assc_motorcycle_count','insurance_pending','rto_pending','number_plate_pending','rc_book_pending','finance_pending_count']));
    }
}
