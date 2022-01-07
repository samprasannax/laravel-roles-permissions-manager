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

class VoucherCategory extends Controller{	

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


			$voucher_lists = DB::table('voucher_category')
						 ->where('is_deleted', '=', '0')
						 ->get();
			return view('/voucher-category', compact(['voucher_lists']));
		}
		public function new_voucher_category(){

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


            return view('/new-voucher-category');

        }


        public function insert_voucher_category(){	

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


			if(isset($_POST['voucher_category']))$voucher_category = $_POST['voucher_category'];
		

				$voucher_category_info = DB::table('voucher_category')->insert( ['voucher_name'=>$voucher_category] );
			
				return redirect('/voucher-category')->with('success', 'Voucher category saved!');
			
		}

		public function edit_voucher_category_info($voucher_category_unique_id)
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



			$edit_voucher_lists = DB::table('voucher_category')
						 ->select('voucher_category.id','voucher_category.voucher_name')
						 ->where('id', '=', $voucher_category_unique_id)
						 ->get();

			return view('/edit-voucher-category',compact(['edit_voucher_lists']));
		}

		public function update_voucher_category_info(){	

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
            
			if(isset($_POST['voucher_category_unique_id']))$voucher_category_unique_id = $_POST['voucher_category_unique_id'];
			if(isset($_POST['voucher_category']))$voucher_category = $_POST['voucher_category'];
			
				$update_voucher_category_info = DB::table('voucher_category')->where('id', $voucher_category_unique_id)->update( ['voucher_name' => $voucher_category]);
				return redirect('/voucher-category')->with('success', 'Voucher category updated!');
			
		}

		public function delete_voucher_category($voucher_category_unique_id){	

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

				$delete_voucher_category_info = DB::table('voucher_category')->where('id', $voucher_category_unique_id)->update( ['is_deleted' => '1']);
			      
			
				return redirect('/voucher-category')->with('success', 'Voucher Category Deleted!');
			
		}



}
?>