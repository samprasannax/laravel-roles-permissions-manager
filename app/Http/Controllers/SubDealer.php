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

class SubDealer extends Controller{	

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

			$dealers = DB::table('dealers')
						->where('is_deleted', '=', '0')
						->orderBy('id', 'DESC')
						->get();
			return view('/sub-dealer-list',compact(['dealers']));
		}

		public function new_sub_dealer(){

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

			return view('/new-sub-dealer');
		}


		public function insert_sub_dealers(){	

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

			if(isset($_POST['dealer_code']))$dealer_code = $_POST['dealer_code'];
			if(isset($_POST['dealer_name']))$dealer_name = $_POST['dealer_name'];
			if(isset($_POST['contact_no1']))$contact_no1 = $_POST['contact_no1'];
			if(isset($_POST['contact_no2']))$contact_no2 = $_POST['contact_no2'];
			if(isset($_POST['dealer_address']))$dealer_address = $_POST['dealer_address'];
			if(isset($_POST['initial_balance']))$initial_balance = $_POST['initial_balance'];



		      $unqiue_string = Str::random(30); 

				$dealers_info = DB::table('dealers')->insert( ['unique_id'=>$unqiue_string,'dealer_code' => $dealer_code,'dealer_name' => $dealer_name, 'contact_no1' =>$contact_no1, 'contact_no2' => $contact_no2, 'dealer_address' => $dealer_address, 'initial_balance'=>$initial_balance,'total_remaining'=>$initial_balance,'opening_balance'=>$initial_balance] );
			
				return redirect('/sub-dealer')->with('success', 'Sub dealers details saved!');
			
		}

		public function edit_dealer_info($dealer_unique_id)
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


			$edit_sub_dealers = DB::table('dealers')
							 ->select('dealers.id','dealers.dealer_code','dealers.dealer_name','dealers.contact_no1','dealers.contact_no2','dealers.dealer_address','dealers.initial_balance')
							 ->where('id', '=', $dealer_unique_id)
							 ->get();

			return view('/edit-sub-dealer',compact(['edit_sub_dealers']));
		}



		public function update_dealers_info(){	

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


			if(isset($_POST['dealer_unique_id']))$dealer_unique_id = $_POST['dealer_unique_id'];
			if(isset($_POST['dealer_code']))$dealer_code = $_POST['dealer_code'];
			if(isset($_POST['dealer_name']))$dealer_name = $_POST['dealer_name'];
			if(isset($_POST['contact_no1']))$contact_no1 = $_POST['contact_no1'];
			if(isset($_POST['contact_no2']))$contact_no2 = $_POST['contact_no2'];
			if(isset($_POST['dealer_address']))$dealer_address = $_POST['dealer_address'];
			if(isset($_POST['initial_balance']))$initial_balance = $_POST['initial_balance'];

			$update_customers_info = DB::table('dealers')->where('id', $dealer_unique_id)->update( ['dealer_code' => $dealer_code, 'dealer_name'=>$dealer_name, 'contact_no1'=>$contact_no1, 'contact_no2'=>$contact_no2,'dealer_address'=>$dealer_address]);
			
				return redirect('/sub-dealer')->with('success', 'Sub dealers details updated!');
			
		}

		public function delete_dealers_info($dealer_unique_id){	
			
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

            

				$update_dealers_info = DB::table('dealers')->where('id', $dealer_unique_id)->update( ['is_deleted' => '1']);
			      
			
				return redirect('/sub-dealer')->with('success', 'Sub Dealers details Deleted!');
			
		}

}
?>