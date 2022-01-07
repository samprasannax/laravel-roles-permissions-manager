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


class SalesPerson extends Controller{	

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

			$sales_persons = DB::table('sales_person')
						->where('is_deleted', '=', '0')						
						->get();
			return view('/sales-person-list',compact(['sales_persons']));
		}
		

		public function new_sales_person(){
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

			return view('/new-sales-person');
		}


		public function insert_sales_person()
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

			   if(isset($_POST['sales_person_code'])) $sales_person_code = $_POST['sales_person_code'];			  
			   if(isset($_POST['sales_person_name'])) $sales_person_name = $_POST['sales_person_name'];
			   if(isset($_POST['contact_no1'])) $contact_no1 = $_POST['contact_no1'];
			   if(isset($_POST['contact_no2'])) $contact_no2 = $_POST['contact_no2'];
			   if(isset($_POST['sales_person_address'])) $sales_person_address = $_POST['sales_person_address'];

			   $unqiue_string = Str::random(30); 

			   $sales_person_info = DB::table('sales_person')->insert( ['unique_id'=>$unqiue_string,'sales_person_code'=>$sales_person_code,'sales_person_name'=>$sales_person_name,'contact_no1'=>$contact_no1,'contact_no2'=>$contact_no2,'sales_person_address'=>$sales_person_address] );
			
				return redirect('/sales-person')->with('success', 'Sales person details saved!');

		}

		public function edit_sales_person($sale_person_unique_id)
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

			$edit_sales_person = DB::table('sales_person')
							 ->select('sales_person.id','sales_person.sales_person_name','sales_person.sales_person_code','sales_person.contact_no1','sales_person.contact_no2','sales_person.sales_person_address')
							 ->where('id', '=', $sale_person_unique_id)
							 ->get();

			return view('/edit-sales-person',compact(['edit_sales_person']));
		}

		public function update_sales_person(){	
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


			if(isset($_POST['sales_person_unique_id']))$sales_person_unique_id = $_POST['sales_person_unique_id'];
			if(isset($_POST['sales_person_code']))$sales_person_code = $_POST['sales_person_code'];
			if(isset($_POST['sales_person_name']))$sales_person_name = $_POST['sales_person_name'];
			if(isset($_POST['contact_no1'])) $contact_no1 = $_POST['contact_no1'];
			if(isset($_POST['contact_no2'])) $contact_no2 = $_POST['contact_no2'];
			if(isset($_POST['sales_person_address'])) $sales_person_address = $_POST['sales_person_address'];
			

			$udpate_sales_person = DB::table('sales_person')->where('id', $sales_person_unique_id)->update( ['sales_person_code' => $sales_person_code,'sales_person_name'=>$sales_person_name,'contact_no1'=>$contact_no1,'contact_no2'=>$contact_no2,'sales_person_address'=>$sales_person_address]);
			
				return redirect('/sales-person')->with('success', 'Sales Person details updated!');
			
		}

		public function delete_sales_person($sales_person_unique_id){
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
            
				$delete_sales_person = DB::table('sales_person')->where('id', $sales_person_unique_id)->update( ['is_deleted' => '1']);
			
				return redirect('/sales-person')->with('success', 'Sales Person details deleted!');
			
		}



}

?>