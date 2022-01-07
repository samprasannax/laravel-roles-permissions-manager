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


class DscMonthlyTarget extends Controller{	
		  
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

			$dsc_targets = DB::table('dsc_monthly_target')
							->leftJoin('sales_person', 'sales_person.id', '=', 'dsc_monthly_target.dsc_id')
							->select('sales_person.sales_person_name','dsc_monthly_target.target_qty','dsc_monthly_target.target_month','dsc_monthly_target.target_year','dsc_monthly_target.id')
						 ->where('dsc_monthly_target.is_deleted', '=', '0')
						 ->orderBy('dsc_monthly_target.id', 'DESC')
						 ->get();

			return view('/view-dsc-monthly-target', compact(['dsc_targets']));

		}


		public function new_dsc_monthly_target(){

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
            				->where('is_deleted', 0)
            				->get();


			return view('/new-dsc-monthly-target', compact(['sales_persons']));
		}


		public function insert_dsc_monthly_target(){

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


            if(isset($_POST['dsc_id']))$dsc_id = $_POST['dsc_id'];
			if(isset($_POST['target_qty']))$target_qty = $_POST['target_qty'];
			if(isset($_POST['target_month']))$target_month = $_POST['target_month'];
			if(isset($_POST['target_year']))$target_year = $_POST['target_year'];

			
        	$dsc_taget_info = DB::table('dsc_monthly_target')->insert( ['dsc_id' => $dsc_id,'target_qty' => $target_qty,'target_month'=>$target_month,'target_year'=>$target_year] );
			
				return redirect('/view-dsc-monthly-target')->with('success', 'Successfully saved!');


        }



        public function edit_dsc_monthly_target($dsc_target_unqiue_id)
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


		

						$edit_dsc_monthly_targets = DB::table('dsc_monthly_target')
												->leftJoin('sales_person', 'sales_person.id', '=', 'dsc_monthly_target.dsc_id')
												->select('sales_person.sales_person_name','dsc_monthly_target.target_qty','dsc_monthly_target.dsc_id','dsc_monthly_target.target_month','dsc_monthly_target.target_year','dsc_monthly_target.id')
												 ->where('dsc_monthly_target.is_deleted', '=', '0')
												 ->where('dsc_monthly_target.id', '=', $dsc_target_unqiue_id)
												 ->get();

 						$sales_persons = DB::table('sales_person')
            				->where('is_deleted', 0)
            				->get();


			return view('/edit-dsc-monthly-target',compact(['edit_dsc_monthly_targets','sales_persons']));
		}



		public function udpate_dsc_monthly_target(){

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

            if(isset($_POST['target_unique_id']))$target_unique_id = $_POST['target_unique_id'];
            if(isset($_POST['dsc_id']))$dsc_id = $_POST['dsc_id'];
			if(isset($_POST['target_qty']))$target_qty = $_POST['target_qty'];
			if(isset($_POST['target_month']))$target_month = $_POST['target_month'];
			if(isset($_POST['target_year']))$target_year = $_POST['target_year'];

			
        	$dsc_taget_info = DB::table('dsc_monthly_target')->where([['is_deleted', '=', 0],['id', '=', $target_unique_id]])->update( ['dsc_id' => $dsc_id,'target_qty' => $target_qty,'target_month'=>$target_month,'target_year'=>$target_year] );
			
				return redirect('/view-dsc-monthly-target')->with('success', 'Successfully saved!');


        }




		public function delete_dsc_monthly_target($dsc_target_unqiue_id){

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


          
			
        	$dsc_taget_info = DB::table('dsc_monthly_target')->where([['is_deleted', '=', 0],['id', '=', $dsc_target_unqiue_id]])->update( ['is_deleted' =>1] );


				return redirect('/view-dsc-monthly-target')->with('success', 'Successfully Deleted!');


        }


}
?>