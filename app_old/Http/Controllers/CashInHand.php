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

class CashInHand extends Controller{	

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

			$cashinhands = DB::table('cash_in_hand')
						->where('is_deleted', '=', '0')						
						->get();
			return view('/cash-in-hand',compact(['cashinhands']));			
		}

		public function new_cash_in_hand(){
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
			return view('/new-cash-in-hand');
		}

		public function insert_cash_in_hand()
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

			   if(isset($_POST['opening_balance'])) $opening_balance = $_POST['opening_balance'];
			 

			   $cash_in_hand = DB::table('cash_in_hand')->insert( ['opening_balance'=>$opening_balance,'account_balance'=>$opening_balance] );
			
			   return redirect('/cash-in-hand')->with('success', 'Cash in hand saved!');
		}

		public function edit_cash_in_hand($cash_in_hand_id)
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

			$edit_cash_in_hand = DB::table('cash_in_hand')							
							 ->where('id', '=', $cash_in_hand_id)
							 ->get();

			return view('/edit-cash-in-hand',compact(['edit_cash_in_hand']));

		}

		public function update_cash_in_hand(){	
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

			if(isset($_POST['cash_in_hand_id']))$cash_in_hand_id = $_POST['cash_in_hand_id'];
			if(isset($_POST['opening_balance']))$opening_balance = $_POST['opening_balance'];
			
			$update_cash_in_hand = DB::table('cash_in_hand')->where('id', $cash_in_hand_id)->update( ['opening_balance' => $opening_balance,'account_balance'=>$opening_balance]);
			
				return redirect('/cash-in-hand')->with('success', ' Voucher Opening updated!');
			
		}

		// public function delete_financial_year($financial_year_unique_id){	
		// 	if (! Gate::allows('admin')) {
		// 		if (! Gate::allows('receipt')) {
  //           		return abort(401);
  //           	}
  //           }


		// 		$delete_financial_year = DB::table('financial_year')->where('id', $financial_year_unique_id)->update( ['is_deleted' => '1']);
			
		// 		return redirect('/financial-year')->with('success', 'Financial Year details deleted!');
			
		// }



}
?>