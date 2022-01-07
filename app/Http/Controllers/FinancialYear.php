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

class FinancialYear extends Controller{	

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

			$financial_years = DB::table('financial_year')
						->where('is_deleted', '=', '0')						
						->get();
			return view('/financial-year',compact(['financial_years']));			
		}

		public function new_financial_year(){
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

			return view('/new-financial-year');
		}

		public function insert_financial_year()
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

			   if(isset($_POST['start_date'])) $start_date = $_POST['start_date'];
			   if(isset($_POST['end_date'])) $end_date = $_POST['end_date'];

			   $unqiue_string = Str::random(30); 

			   $customer_info = DB::table('financial_year')->insert( ['start_date'=>$start_date,'end_date'=>$end_date] );
			
			   return redirect('/financial-year')->with('success', 'Financial Year saved!');
		}

		public function edit_financial_year_info($financial_year_unique_id)
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

			$edit_financial_year = DB::table('financial_year')
							 ->select('financial_year.id','financial_year.start_date','financial_year.end_date')
							 ->where('id', '=', $financial_year_unique_id)
							 ->get();

			return view('/edit-financial-year',compact(['edit_financial_year']));
		}

		public function update_financial_year(){	
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

			if(isset($_POST['financial_year_unique_id']))$financial_year_unique_id = $_POST['financial_year_unique_id'];
			if(isset($_POST['start_date']))$start_date = $_POST['start_date'];
			if(isset($_POST['end_date']))$end_date = $_POST['end_date'];
			

			$update_financial_year = DB::table('financial_year')->where('id', $financial_year_unique_id)->update( ['start_date' => $start_date,'end_date'=>$end_date]);
			
				return redirect('/financial-year')->with('success', 'Financial Year details updated!');
			
		}

		public function delete_financial_year($financial_year_unique_id){	
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


				$delete_financial_year = DB::table('financial_year')->where('id', $financial_year_unique_id)->update( ['is_deleted' => '1']);
			
				return redirect('/financial-year')->with('success', 'Financial Year details deleted!');
			
		}



}
?>