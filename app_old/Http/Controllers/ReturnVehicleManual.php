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

class ReturnVehicleManual extends Controller
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


            $fetch_return_vehicles = DB::table('return_vehicle_manual')
                                    ->leftJoin('dealers', 'dealers.id', '=', 'return_vehicle_manual.dealer_id')
                                    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'return_vehicle_manual.vehicle_type_id')
                                    ->leftJoin('colors', 'colors.id', '=', 'return_vehicle_manual.vehicle_color_id')
                                    ->leftJoin('main_model', 'main_model.id', '=', 'return_vehicle_manual.vehicle_model_id')
                                   
                                ->select('return_vehicle_manual.id','return_vehicle_manual.vehicle_amount','return_vehicle_manual.warranty_amount','return_vehicle_manual.return_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','dealers.dealer_name','return_vehicle_manual.chassis_no','return_vehicle_manual.total_amount')
                                ->where('return_vehicle_manual.is_deleted', '=', 0)
                                ->get();
            

        return view('return-vehicle-manual', compact(['fetch_return_vehicles']));
    }


    public function add_return_vehicle_manual()
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


            $vehicle_types = DB::table('vehicle_type')                  
                    ->where('is_deleted', '=', 0)
                    ->get();
            $models = DB::table('main_model')                  
                    ->where('is_deleted', '=', 0)
                    ->get();
            $colors = DB::table('colors')                  
                    ->where('is_deleted', '=', 0)
                    ->get();
            $dealers = DB::table('dealers')                  
                    ->where('is_deleted', '=', 0)
                    ->get();

            return view('add-return-vehicle-manual', compact(['vehicle_types','models','colors','dealers']));


    }


    public function insert_return_vehicle_manual()
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



            if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];           
            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
            if(isset($_POST['model_name']))$model_name = $_POST['model_name'];
            if(isset($_POST['vehicle_color_id']))$vehicle_color_id = $_POST['vehicle_color_id'];
            if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];
            if(isset($_POST['engine_no']))$engine_no = $_POST['engine_no'];
            if(isset($_POST['vehicle_amount']))$vehicle_amount = $_POST['vehicle_amount'];
            if(isset($_POST['warranty_amount']))$warranty_amount = $_POST['warranty_amount'];
            if(isset($_POST['return_date']))$return_date = $_POST['return_date'];


            $total_amount = $vehicle_amount + $warranty_amount;

             $dealer_rate_info =  DB::table('dealers')
                                    ->where('id', '=', $dealer_id)
                                    ->where('is_deleted', '=', 0)
                                    ->get();

                    $initial_total = $dealer_rate_info[0]->initial_balance;
                    $total_paid = $dealer_rate_info[0]->total_paid;
                    $total_remaining = $dealer_rate_info[0]->total_remaining;


                    $update_initial_total = $initial_total + $total_amount;
                    $update_remaining = $total_remaining + $total_amount;

                    $update_dealer_total_val = DB::table('dealers')->where([['dealers.id', '=', $dealer_id],['dealers.is_deleted', '=', 0]])->update(['initial_balance'=>$update_initial_total, 'total_remaining'=>$update_remaining ]);


            $fetch_total_stock = DB::table('main_model')
                                            ->select('main_model.in_stock')
                                            ->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_name]])
                                            ->get();

                        $in_stock = $fetch_total_stock[0]->in_stock;

                        $update_in_stock = $in_stock + 1;

                        $update_instock_val = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_name]])->update(['in_stock'=>$update_in_stock]);



            $insert_return_vehicle_manual = DB::table('return_vehicle_manual')->insert( ['dealer_id'=>$dealer_id,'vehicle_type_id' => $vehicle_type,'vehicle_color_id' => $vehicle_color_id, 'vehicle_model_id' =>$model_name,  'chassis_no' => $chassis_no,'engine_no'=>$engine_no,'total_amount'=>$total_amount,'vehicle_amount'=>$vehicle_amount,'warranty_amount'=>$warranty_amount,'return_date'=>$return_date] );



              $unqiue_string = Str::random(30); 

              $insert_vehicle_stock = DB::table('vehicle_stock')->insert( ['unique_id'=>$unqiue_string,'vehicle_type'=>$vehicle_type,'vehicle_color'=>$vehicle_color_id,'stock_date'=>$return_date,'model_name'=>$model_name,'chassis_no'=>$chassis_no,'engine_no'=>$engine_no] );


                     return redirect('/return-vehicle-manual')->with('success', 'Successfully Vehicle take Return!');



    }



      public function delete_return_vehicle_manual($return_unique_id)
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



            $fetch_return = DB::table('return_vehicle_manual')
                            ->where('is_deleted','=',0)
                            ->where('id','=', $return_unique_id)
                            ->get();

            $dealer_id = $fetch_return[0]->dealer_id;
            $vehicle_type = $fetch_return[0]->vehicle_type_id;
            $model_name = $fetch_return[0]->vehicle_model_id;
            $vehicle_color_id = $fetch_return[0]->vehicle_color_id;
            $chassis_no = $fetch_return[0]->chassis_no;
            $total_amount = $fetch_return[0]->total_amount;


             $dealer_rate_info =  DB::table('dealers')
                                    ->where('id', '=', $dealer_id)
                                    ->where('is_deleted', '=', 0)
                                    ->get();

                    $initial_total = $dealer_rate_info[0]->initial_balance;
                    $total_paid = $dealer_rate_info[0]->total_paid;
                    $total_remaining = $dealer_rate_info[0]->total_remaining;


                    $update_initial_total = $initial_total - $total_amount;
                    $update_remaining = $total_remaining - $total_amount;

                    $update_dealer_total_val = DB::table('dealers')->where([['dealers.id', '=', $dealer_id],['dealers.is_deleted', '=', 0]])->update(['initial_balance'=>$update_initial_total, 'total_remaining'=>$update_remaining ]);


            $fetch_total_stock = DB::table('main_model')
                                            ->select('main_model.in_stock')
                                            ->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_name]])
                                            ->get();

                        $in_stock = $fetch_total_stock[0]->in_stock;

                        $update_in_stock = $in_stock - 1;

                        $update_instock_val = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_name]])->update(['in_stock'=>$update_in_stock]);



            $insert_return_vehicle_manual = DB::table('return_vehicle_manual')->where('return_vehicle_manual.id', '=', $return_unique_id)->update( ['return_vehicle_manual.is_deleted'=>1] );


             
              $insert_vehicle_stock = DB::table('vehicle_stock')->where([['vehicle_type', '=', $vehicle_type],['vehicle_color', '=', $vehicle_color_id],['model_name', '=', $model_name],['chassis_no', '=', $chassis_no]])->update( ['vehicle_stock.is_deleted'=>1] );


                     return redirect('/return-vehicle-manual')->with('success', 'Successfully Deleted!');



    }



}
