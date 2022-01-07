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


class Customers extends Controller{	
		  
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

			$customers = DB::table('customers')
						 ->where('is_deleted', '=', '0')
						 ->orderBy('id', 'DESC')
						 ->get();
			return view('/customers-list', compact(['customers']));

		}


		public function new_customer(){

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

            $financial_year = DB::table('financial_year')->get();

            $start_date = $financial_year[0]->start_date;
            $end_date = $financial_year[0]->end_date;



            $customer_code_max1 =  DB::table('customers')           						

            						->where(function($query) use ($start_date, $end_date) {
		
							       	 if($start_date !='' and $end_date !='')
							       	 $query->whereBetween('customer_date', [$start_date, $end_date]);

							        })
							        ->max('customer_unique');

            $customer_code_max = $customer_code_max1 + 1;
		
			$current_date = date("Ymd");
			$customer_code_prefix = "SUC";

			$customer_code = $customer_code_prefix . '-'.$customer_code_max;


			//output: SUC-000001

			return view('/new-customer')->with([ 'customer_code'=>$customer_code,'customer_unique_value'=>$customer_code_max]);
		}

		public function insert_new_customer(){	

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
			if(isset($_POST['customer_code']))$customer_code = $_POST['customer_code'];
			if(isset($_POST['customer_name']))$customer_name = $_POST['customer_name'];
			if(isset($_POST['swd_category']))$swd_category = $_POST['swd_category'];
			if(isset($_POST['swd_name']))$swd_name = $_POST['swd_name'];
			if(isset($_POST['contact_no1']))$contact_no1 = $_POST['contact_no1'];
			if(isset($_POST['contact_no2']))$contact_no2 = $_POST['contact_no2'];
			if(isset($_POST['customer_address']))$customer_address = $_POST['customer_address'];
			if(isset($_POST['customer_unique_value']))$customer_unique_value = $_POST['customer_unique_value'];
	           if(isset($_POST['enquiry_no']))$enquiry_no = $_POST['enquiry_no'];
				$customer_date = date("Y-m-d");
		        $unqiue_string = Str::random(30); 

				$customer_info = DB::table('customers')->insert( ['enquiry_no'=>$enquiry_no,'unique_id'=>$unqiue_string,'customer_code' => $customer_code,'customer_name' => $customer_name,'swd_category'=>$swd_category,'swd_name'=>$swd_name,'contact_no1' =>$contact_no1, 'contact_no2' => $contact_no2, 'customer_address' => $customer_address, 'customer_unique' => $customer_unique_value,'customer_date'=>$customer_date] );
			
				return redirect('/customers')->with('success', 'Customer saved!');
			
		}

		public function edit_customer_info($customer_unique_id)
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


			$edit_customers = DB::table('customers')
						 ->select('customers.enquiry_no','customers.id','customers.customer_code','customers.swd_category','customers.swd_name','customers.customer_name','customers.contact_no1','customers.contact_no2','customers.customer_address')
						 ->where('id', '=', $customer_unique_id)
						 ->get();
			return view('/edit-customers',compact(['edit_customers']));
		}

		public function update_cusomers_info(){	

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
            
			if(isset($_POST['customer_unique_id']))$customer_unique_id = $_POST['customer_unique_id'];
			if(isset($_POST['customer_code']))$customer_code = $_POST['customer_code'];
			if(isset($_POST['swd_category']))$swd_category = $_POST['swd_category'];
			if(isset($_POST['swd_name']))$swd_name = $_POST['swd_name'];
			if(isset($_POST['customer_name']))$customer_name = $_POST['customer_name'];
			if(isset($_POST['contact_no1']))$contact_no1 = $_POST['contact_no1'];
			if(isset($_POST['contact_no2']))$contact_no2 = $_POST['contact_no2'];
			if(isset($_POST['customer_address']))$customer_address = $_POST['customer_address'];
            if(isset($_POST['enquiry_no']))$enquiry_no = $_POST['enquiry_no'];
			

				$update_customers_info = DB::table('customers')->where('id', $customer_unique_id)->update( ['enquiry_no'=>$enquiry_no,'customer_code' => $customer_code,'swd_category'=>$swd_category,'swd_name'=>$swd_name,'customer_name'=>$customer_name, 'contact_no1'=>$contact_no1, 'contact_no2'=>$contact_no2,'customer_address'=>$customer_address ]);
			      
			
				return redirect('/customers')->with('success', 'Customer details updated!');
			
		}


		public function delete_cusomers_info($customer_unique_id){	

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

				$update_customers_info = DB::table('customers')->where('id', $customer_unique_id)->update( ['is_deleted' => '1']);
			      
			
				return redirect('/customers')->with('success', 'Customer details Deleted!');
			
		}

}
?>