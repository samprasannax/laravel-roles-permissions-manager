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

class Offer extends Controller{	

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

			$offers = DB::table('offer_type')
						->where('is_deleted', '=', '0')	
						->orderBy('id', 'DESC')					
						->get();
			return view('/offer-list',compact(['offers']));			
		}

		public function new_offer(){
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

			return view('/new-offer');
		}

		public function insert_offer()
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
             

			   if(isset($_POST['offer_name'])) $offer_name = $_POST['offer_name'];

			 
			   $customer_info = DB::table('offer_type')->insert( ['offer_name'=>$offer_name] );
			
			   return redirect('/offer-list')->with('success', 'Offer saved!');
		}

		public function edit_offer($offer_unique_id)
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

			$edit_offer = DB::table('offer_type')
							 ->select('offer_type.id','offer_type.offer_name')
							 ->where('id', '=', $offer_unique_id)
							 ->get();

			return view('/edit-offer',compact(['edit_offer']));
		}

		public function update_offer(){	
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


			if(isset($_POST['offer_unique_id']))$offer_unique_id = $_POST['offer_unique_id'];
			if(isset($_POST['offer_name']))$offer_name = $_POST['offer_name'];
			

			$udpate_offer = DB::table('offer_type')->where('id', $offer_unique_id)->update( ['offer_name' => $offer_name]);
			
				return redirect('/offer-list')->with('success', 'Offer details updated!');
			
		}

		public function delete_offer ($offer_unique_id){	
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

				$delete_offer = DB::table('offer_type')->where('id', $offer_unique_id)->update( ['is_deleted' => '1']);
			
				return redirect('/offer-list')->with('success', 'Offer details deleted!');
			
		}




		public function assc_offer_list(){
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

			$assc_offers = DB::table('assc_offer')
						->leftJoin('dealers','dealers.id', '=', 'assc_offer.dealer_id')
						->leftJoin('offer_type','offer_type.id', '=', 'assc_offer.offer_id')
						->select('dealers.dealer_name','offer_type.offer_name','assc_offer.offer_qty','assc_offer.qty_amount','assc_offer.total_amount','assc_offer.offer_date','assc_offer.description','assc_offer.id','assc_offer.dealer_id')
						->where('assc_offer.is_deleted', '=', '0')	
						->orderBy('assc_offer.id', 'DESC')					
						->get();
			return view('/assc-offer-list',compact(['assc_offers']));			
		}

		public function new_assc_offer(){
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

			$offers = DB::table('offer_type')
						->where('is_deleted', '=', '0')	
						->orderBy('id', 'DESC')					
						->get();

			$dealers = DB::table('dealers')
						->where('is_deleted', '=', '0')	
						->orderBy('id', 'DESC')					
						->get();
						


			return view('/new-assc-offer',compact(['dealers','offers']));			
		}

		public function insert_assc_offer(){

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


            if(isset($_POST['offer_date']))$offer_date = date("Y-m-d", strtotime($_POST['offer_date']));
			if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];
			if(isset($_POST['offer_id']))$offer_id = $_POST['offer_id'];
			if(isset($_POST['offer_qty']))$offer_qty = $_POST['offer_qty'];
			if(isset($_POST['qty_amount']))$qty_amount = $_POST['qty_amount'];
			if(isset($_POST['total_amount']))$total_amount = $_POST['total_amount'];
			if(isset($_POST['description']))$description = $_POST['description'];



			        $dealer_rate_info =  DB::table('dealers')
									->where('id', '=', $dealer_id)
									->where('is_deleted', '=', 0)
									->get();

					$initial_total = $dealer_rate_info[0]->initial_balance;
				
					$total_remaining = $dealer_rate_info[0]->total_remaining;


					$update_initial_total = $initial_total - $total_amount;
					$update_remaining = $total_remaining - $total_amount;

	
			$update_dealer_total_val = DB::table('dealers')->where([['dealers.id', '=', $dealer_id],['dealers.is_deleted', '=', 0]])->update(['initial_balance'=>$update_initial_total, 'total_remaining'=>$update_remaining ]);



			$insert_assc_offers = DB::table('assc_offer')->insert( ['offer_id'=>$offer_id,'dealer_id' => $dealer_id,'offer_qty' => $offer_qty, 'qty_amount' =>$qty_amount,'total_amount' => $total_amount,'offer_date'=>$offer_date,'description'=>$description] );




			return redirect('/assc-offer-list');	
		}


		public function delete_assc_offer($offer_unique_id,$dealer_id){


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



            	  $fetch_offer_detials = DB::table('assc_offer')
            							->where('assc_offer.is_deleted', '=', 0)
            							->where('assc_offer.dealer_id', '=', $dealer_id)
            							->where('assc_offer.id', '=', $offer_unique_id)
            							->get();


            		$total_amount = $fetch_offer_detials[0]->total_amount;



			        $dealer_rate_info =  DB::table('dealers')
									->where('id', '=', $dealer_id)
									->where('is_deleted', '=', 0)
									->get();

					$initial_total = $dealer_rate_info[0]->initial_balance;
				
					$total_remaining = $dealer_rate_info[0]->total_remaining;


					$update_initial_total = $initial_total + $total_amount;
					$update_remaining = $total_remaining + $total_amount;

	
			$update_dealer_total_val = DB::table('dealers')->where([['dealers.id', '=', $dealer_id],['dealers.is_deleted', '=', 0]])->update(['initial_balance'=>$update_initial_total, 'total_remaining'=>$update_remaining ]);


				$update_assc_offer = DB::table('assc_offer')->where([['dealer_id', '=', $dealer_id],['id', '=', $offer_unique_id]])->update(['is_deleted'=>1]);



			return redirect('/assc-offer-list');	
		}






		
}
?>