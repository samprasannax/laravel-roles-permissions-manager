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

class Bank extends Controller{	

	     /**
	     * Create a new controller instance.
	     *
	     * @return void
	     */
	    public function __construct()
	    {
	        $this->middleware('auth');
	    }



		public function index(){
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

			$banks = DB::table('bank')
						->where('is_deleted', '=', '0')	
						->orderBy('id', 'DESC')					
						->get();
			return view('/bank-list',compact(['banks']));			
		}

		public function new_bank(){
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

			return view('/new-bank');
		}

		public function insert_bank()
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
             

			   if(isset($_POST['bank_name'])) $bank_name = $_POST['bank_name'];

			   $unqiue_string = Str::random(30); 

			   $customer_info = DB::table('bank')->insert( ['unique_id'=>$unqiue_string,'bank_name'=>$bank_name] );
			
			   return redirect('/bank')->with('success', 'Bank saved!');
		}

		public function edit_bank_info($bank_unique_id)
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

			$edit_bank = DB::table('bank')
							 ->select('bank.id','bank.bank_name')
							 ->where('id', '=', $bank_unique_id)
							 ->get();

			return view('/edit-bank',compact(['edit_bank']));
		}

		public function update_bank(){	
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


			if(isset($_POST['bank_unique_id']))$bank_unique_id = $_POST['bank_unique_id'];
			if(isset($_POST['bank_name']))$bank_name = $_POST['bank_name'];
			

			$update_bank = DB::table('bank')->where('id', $bank_unique_id)->update( ['bank_name' => $bank_name]);
			
				return redirect('/bank')->with('success', 'Bank details updated!');
			
		}

		public function delete_bank($bank_unique_id){	
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

				$delete_bank = DB::table('bank')->where('id', $bank_unique_id)->update( ['is_deleted' => '1']);
			
				return redirect('/bank')->with('success', 'Bank details deleted!');
			
		}
		
		
		
// 		public function test_controller()
// 		{
// 			if (! Gate::allows('admin')) 
// 			{
// 				if (! Gate::allows('receipt')) 
// 				{
// 					if (! Gate::allows('stock_import')) 
// 					{
// 						if (! Gate::allows('gate_pass')) 
// 						{
// 							if (! Gate::allows('rto')) {
//             					return abort(401);
// 			            	}
// 			            }
// 			        }
//             	}
//             }


//             $fetch_dbvi = DB::table('dealer_booking_vehicle_info')
//             				->get();

//             foreach($fetch_dbvi as $dbvi)
//             {
//             	$delivery_date = $dbvi->delivery_date;
//             	$dbvi_id = $dbvi->id;

//             	if($delivery_date=="")
//             	{
//             		$update_date = "";
//             	}
//             	else
//             	{
//             		$update_date = date("Y-m-d", strtotime($delivery_date));            	
//             	}

//             	$update_dbvi = DB::table('dealer_booking_vehicle_info')->where('id', $dbvi_id)->update( ['delivery_date' => $update_date]);


//             }

//             return redirect('/bank')->with('success', 'Bank details deleted!');



// 		}




}
?>