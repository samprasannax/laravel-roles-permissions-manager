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

class Mechanical extends Controller{

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

			$mechanics = DB::table('mechanic')
						->where('is_deleted', '=', '0')						
						->get();
			return view('/mechanical-list',compact(['mechanics']));			
			}

		public function new_mechanical(){

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


			return view('/new-mechanical');
		}

		public function insert_mechanical()
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



			   if(isset($_POST['mechanic_code'])) $mechanic_code = $_POST['mechanic_code'];			  
			   if(isset($_POST['mechanic_name'])) $mechanic_name = $_POST['mechanic_name'];
			   if(isset($_POST['contact_no1'])) $contact_no1 = $_POST['contact_no1'];
			   if(isset($_POST['contact_no2'])) $contact_no2 = $_POST['contact_no2'];
			   if(isset($_POST['mechanic_address'])) $mechanic_address = $_POST['mechanic_address'];

			   $unqiue_string = Str::random(30); 

			   $mechanic_info = DB::table('mechanic')->insert( ['unique_id'=>$unqiue_string,'mechanic_code'=>$mechanic_code,'mechanic_name'=>$mechanic_name,'contact_no1'=>$contact_no1,'contact_no2'=>$contact_no2,'mechanic_address'=>$mechanic_address] );
			
				return redirect('/mechanical')->with('success', 'Mechanic saved!');

		}

		public function edit_mechanical($mechanic_unique_id)
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


			$edit_mechanic = DB::table('mechanic')
							 ->select('mechanic.id','mechanic.mechanic_name','mechanic.mechanic_code','mechanic.contact_no1','mechanic.contact_no2','mechanic.mechanic_address')
							 ->where('id', '=', $mechanic_unique_id)
							 ->get();

			return view('/edit-mechanical',compact(['edit_mechanic']));
		}

		public function update_mechanical(){	

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


			if(isset($_POST['mechanic_unique_id']))$mechanic_unique_id = $_POST['mechanic_unique_id'];
			if(isset($_POST['mechanic_code']))$mechanic_code = $_POST['mechanic_code'];
			if(isset($_POST['mechanic_name']))$mechanic_name = $_POST['mechanic_name'];
			if(isset($_POST['contact_no1'])) $contact_no1 = $_POST['contact_no1'];
			if(isset($_POST['contact_no2'])) $contact_no2 = $_POST['contact_no2'];
			if(isset($_POST['mechanic_address'])) $mechanic_address = $_POST['mechanic_address'];
			

			$update_mechanical = DB::table('mechanic')->where('id', $mechanic_unique_id)->update( ['mechanic_code' => $mechanic_code,'mechanic_name'=>$mechanic_name,'contact_no1'=>$contact_no1,'contact_no2'=>$contact_no2,'mechanic_address'=>$mechanic_address]);
			
				return redirect('/mechanical')->with('success', 'Bank details updated!');
			
		}

		public function delete_mechanical($mechanic_unique_id){	
			
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

            

				$delete_mechanical = DB::table('mechanic')->where('id', $mechanic_unique_id)->update( ['is_deleted' => '1']);
			
				return redirect('/mechanical')->with('success', 'Mechanical details deleted!');
			
		}



}

?>