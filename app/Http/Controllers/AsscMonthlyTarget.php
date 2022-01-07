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


class AsscMonthlyTarget extends Controller{	
		  
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

			$assc_targets = DB::table('assc_monthly_target')
							->leftJoin('dealers', 'dealers.id', '=', 'assc_monthly_target.assc_id')
							->select('dealers.dealer_name','assc_monthly_target.target_qty','assc_monthly_target.target_month','assc_monthly_target.target_year','assc_monthly_target.id')
						 ->where('assc_monthly_target.is_deleted', '=', '0')
						 ->orderBy('assc_monthly_target.id', 'DESC')
						 ->get();
			return view('/view-assc-monthly-target', compact(['assc_targets']));

		}


		public function new_assc_monthly_target(){

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
            				->where('is_deleted', 0)
            				->get();


			return view('/new-assc-monthly-target', compact(['dealers']));
		}


		public function insert_assc_monthly_target(){

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


            if(isset($_POST['assc_id']))$assc_id = $_POST['assc_id'];
			if(isset($_POST['target_qty']))$target_qty = $_POST['target_qty'];
			if(isset($_POST['target_month']))$target_month = $_POST['target_month'];
			if(isset($_POST['target_year']))$target_year = $_POST['target_year'];

			
        	$assc_taget_info = DB::table('assc_monthly_target')->insert( ['assc_id' => $assc_id,'target_qty' => $target_qty,'target_month'=>$target_month,'target_year'=>$target_year] );
			
				return redirect('/view-assc-monthly-target')->with('success', 'Successfully saved!');


        }



        public function edit_assc_monthly_target($assc_target_unqiue_id)
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


		

						$edit_assc_monthly_targets = DB::table('assc_monthly_target')
												->leftJoin('dealers', 'dealers.id', '=', 'assc_monthly_target.assc_id')
												->select('dealers.dealer_name','assc_monthly_target.target_qty','assc_monthly_target.assc_id','assc_monthly_target.target_month','assc_monthly_target.target_year','assc_monthly_target.id')
												 ->where('assc_monthly_target.is_deleted', '=', '0')
												 ->where('assc_monthly_target.id', '=', $assc_target_unqiue_id)
												 ->get();

 						$dealers = DB::table('dealers')
            				->where('is_deleted', 0)
            				->get();


			return view('/edit-assc-monthly-target',compact(['edit_assc_monthly_targets','dealers']));
		}



		public function udpate_assc_monthly_target(){

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
            if(isset($_POST['assc_id']))$assc_id = $_POST['assc_id'];
			if(isset($_POST['target_qty']))$target_qty = $_POST['target_qty'];
			if(isset($_POST['target_month']))$target_month = $_POST['target_month'];
			if(isset($_POST['target_year']))$target_year = $_POST['target_year'];

			
        	$dsc_taget_info = DB::table('assc_monthly_target')->where([['is_deleted', '=', 0],['id', '=', $target_unique_id]])->update( ['assc_id' => $assc_id,'target_qty' => $target_qty,'target_month'=>$target_month,'target_year'=>$target_year] );
			
				return redirect('/view-assc-monthly-target')->with('success', 'Successfully saved!');


        }




		public function delete_assc_monthly_target($assc_target_unqiue_id){

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

          
			
        	$assc_taget_info = DB::table('assc_monthly_target')->where([['is_deleted', '=', 0],['id', '=', $assc_target_unqiue_id]])->update( ['is_deleted' =>1] );
			
				return redirect('/view-assc-monthly-target')->with('success', 'Successfully Deleted!');


        }


        











}
?>