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
 

class DealerBooking extends Controller{	

	     /**
	     * Create a new controller instance.
	     *
	     * @return void
	     */

	    public function __construct()
	    {
	        $this->middleware('auth');
	    }



		public function dealer_booking(){

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
            
            
              $report_from_date1="";
             $report_to_date1="";

         
            if(isset($_GET['report_from_date']))$report_from_date1 = $_GET['report_from_date'];

            if(isset($_GET['report_to_date']))$report_to_date1 = $_GET['report_to_date'];

            if($report_from_date1 =='')
            {
            	$report_from_date1 = date("Y-m-d");
            }

            if($report_to_date1 =='')
            {
            	$report_to_date1 = date("Y-m-d");
            }

            $report_from_date = date("Y-m-d", strtotime($report_from_date1));
            $report_to_date = date("Y-m-d", strtotime($report_to_date1));

            $rfrom_date = $report_from_date;
            $rto_date = $report_to_date;

            
          
            

 
            $dealer_booking_lists = DB::table('dealer_booking')
            			 ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking.dealer_id')
            			 ->leftJoin('dealer_gate_pass_user', 'dealer_gate_pass_user.booking_order_id', '=', 'dealer_booking.order_id')
                         ->select('dealers.dealer_name','dealer_booking.booking_date','dealer_booking.total_qty','dealer_booking.total_amount','dealer_booking.booking_no','dealer_booking.order_id','dealer_booking.dealer_id','dealer_booking.delivery_status','dealer_gate_pass_user.booking_order_id')
            			 ->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('dealer_booking.booking_date', [$report_from_date, $report_to_date]);

							       						        
							        	$query->where([['dealer_booking.is_deleted', '=', 0]]);

							        })->get();


		

			return view('/dealer-booking',compact(['dealer_booking_lists']));
		}



		public function new_dealer_booking(){
			
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



             $fetch_booking1 =  DB::table('dealer_booking')           						

            						->where(function($query) use ($start_date, $end_date) {		
							       	 if($start_date !='' and $end_date !='')
							       	 $query->whereBetween('booking_date', [$start_date, $end_date]);

							        })
							        ->max('booking_unique_value');

            $fetch_booking = $fetch_booking1 + 1;
		
			$current_date = date("Ymd");
			$booking_prefix = "SUDB";

			$booking_no = $booking_prefix . '-' . $current_date.'-'.$fetch_booking;

			$sub_dealers = DB::table('dealers')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$vehicle_types = DB::table('vehicle_type')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$vehicle_colors = DB::table('colors')
					->where('is_deleted', '=', '0')
					->get();


			$delete_temp_vehicle_list = DB::table('temp_dealer_booking_vehicle_info')
										->where('temp_dealer_booking_vehicle_info.is_deleted', 0)->delete();


			$update_temp_status = DB::table('vehicle_stock')            						
            						->update(['temp_status' => 0]);


			return view('/new-dealer-booking', compact(['sub_dealers','vehicle_types','vehicle_colors']))->with(['booking_unique_value'=>$fetch_booking,'booking_no'=>$booking_no]);

			//return view('/new-dealer-booking');
		}

		public function fetch_dealer_stock_model(){

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


            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
            if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];

            $stock_models = DB::table('vehicle_stock')
                        ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
                         ->select('vehicle_stock.model_name','main_model.model')
            			 ->where([['vehicle_stock.vehicle_type', '=', $vehicle_type],['vehicle_stock.chassis_no', '=', $chassis_no],['vehicle_stock.is_deleted', '=', 0],['vehicle_stock.status', '=', 0],['vehicle_stock.temp_status', '=', 0]])						
						->get();

						return $stock_models;
		}


		public function fetch_dealer_stock_color(){

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


            if(isset($_POST['model_id']))$model_id = $_POST['model_id'];           
            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
            if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];
            
            $stock_colors = DB::table('vehicle_stock')
            			 ->leftJoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
                         ->select('vehicle_stock.vehicle_color','colors.type_of_color')
            			 ->where([['vehicle_stock.vehicle_type', '=', $vehicle_type],['vehicle_stock.model_name', '=', $model_id],['vehicle_stock.chassis_no', '=', $chassis_no],['vehicle_stock.is_deleted', '=', 0],['vehicle_stock.status', '=', 0],['vehicle_stock.temp_status', '=', 0]])						
						->get();



						return $stock_colors;
		}


		public function fetch_dealer_stock_chassis_no(){

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
         
            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
         
            $stock_chassis = DB::table('vehicle_stock')
            			
                         ->select('vehicle_stock.chassis_no','vehicle_stock.engine_no')
            			 ->where([['vehicle_stock.vehicle_type', '=', $vehicle_type],['vehicle_stock.is_deleted', '=', 0],['vehicle_stock.status', '=', 0],['vehicle_stock.temp_status', '=', 0]])						
						->get();

						return $stock_chassis;
		}

		public function fetch_dealer_stock_amount(){

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

            if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];  
            if(isset($_POST['model_id']))$model_id = $_POST['model_id'];           
            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
         

               $stock_amount = DB::select("SELECT dealer_sale_rate FROM dealer_rate WHERE vehicle_type_id = '$vehicle_type' and vehicle_model_id = '$model_id' and  dealer_id = '$dealer_id'");

               if(empty($stock_amount))
               {
							   $stock_amount1 = DB::table('vehicle_model')
		                         ->select('vehicle_model.dealer_sale_rate')
		            			 ->where([['vehicle_model.vehicle_type', '=', $vehicle_type],['vehicle_model.model_name', '=', $model_id],['vehicle_model.is_deleted', '=', 0]])						
								->get();

								return $stock_amount1;
               }
				
				
			return $stock_amount;

		}

		public function get_temp_vehicle_list()
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

			$temp_vehicle_list = DB::table('temp_dealer_booking_vehicle_info')
								 ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'temp_dealer_booking_vehicle_info.vehicle_type_id')
								 ->leftJoin('main_model', 'main_model.id', '=', 'temp_dealer_booking_vehicle_info.model_id')
								 ->leftJoin('colors', 'colors.id', '=', 'temp_dealer_booking_vehicle_info.color_id')

								 ->select('temp_dealer_booking_vehicle_info.id','temp_dealer_booking_vehicle_info.chassis_no','temp_dealer_booking_vehicle_info.model_id','temp_dealer_booking_vehicle_info.vehicle_amount','temp_dealer_booking_vehicle_info.book_no','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color')
								 ->where('temp_dealer_booking_vehicle_info.is_deleted', '=', 0)
								 ->get();

								 return $temp_vehicle_list;
		}


		public function insert_temp_vehicle_list()
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

			if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];           
            if(isset($_POST['model_id']))$model_id = $_POST['model_id'];
            if(isset($_POST['color_id']))$color_id = $_POST['color_id'];
            if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];
            if(isset($_POST['vehicle_amount']))$vehicle_amount = $_POST['vehicle_amount'];
            if(isset($_POST['book_no']))$book_no = $_POST['book_no'];
            if(isset($_POST['engine_no']))$engine_no = $_POST['engine_no'];

           

           $insert_temp_vehicle_list = DB::table('temp_dealer_booking_vehicle_info')->insert( ['vehicle_type_id' => $vehicle_type,'model_id' => $model_id, 'color_id' =>$color_id, 'chassis_no' => $chassis_no, 'vehicle_amount' => $vehicle_amount, 'book_no'=>$book_no, 'engine_no'=>$engine_no ] );


            $update_temp_status = DB::table('vehicle_stock')
            						->where([['chassis_no', $chassis_no],['vehicle_type', $vehicle_type],['model_name', $model_id]])
            						->update(['temp_status' => 1]);

            					

				$vehicle_total_amount = DB::table('temp_dealer_booking_vehicle_info')				   
				    ->where('temp_dealer_booking_vehicle_info.is_deleted', '=', 0)
				    ->sum('temp_dealer_booking_vehicle_info.vehicle_amount');




			      return response()->json(['success' => 'Added successfully.']);


		}

		public function get_total_amount(){

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

            $total_amount = DB::table('temp_dealer_booking_vehicle_info')
					    ->where('temp_dealer_booking_vehicle_info.is_deleted', '=', 0)
					    ->sum('temp_dealer_booking_vehicle_info.vehicle_amount');
					 //   return response()->json(['total_amount' => $total_amount]);

					    return $total_amount;

		}


		public function get_total_qty(){

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


            $total_qty = DB::table('temp_dealer_booking_vehicle_info')
					    ->where('temp_dealer_booking_vehicle_info.is_deleted', '=', 0)
					    ->count();

					    return $total_qty;
					// return response()->json(['total_qty' => $total_qty]);


		}


		/* Delete Delete Temp Vehicle Info */

		public function delete_temp_vehicle(){
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

			 if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];
			

		            $delete_temp_vehicle = DB::table('temp_dealer_booking_vehicle_info')->where('temp_dealer_booking_vehicle_info.chassis_no', $chassis_no)->delete();

		              $update_temp_status = DB::table('vehicle_stock')
            						->where('chassis_no', $chassis_no)
            						->update( ['temp_status' => 0]);




				    return $delete_temp_vehicle;

		}

		/* End Delete Temp Vehicle Info*/


		public function insert_dealer_booking()
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

	        if(isset($_POST['booking_save']))$booking_save = $_POST['booking_save'];
	        
	      
	       // print "Check Status".$booking_save;
	        
            $booking_order_id = date("Ymd") . time() . mt_rand();

			if(isset($_POST['booking_unique_value']))$booking_unique_value = $_POST['booking_unique_value'];
            if(isset($_POST['booking_no']))$booking_no = $_POST['booking_no'];
            if(isset($_POST['booking_date']))$booking_date = date("Y-m-d", strtotime($_POST['booking_date']));
            if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];
            if(isset($_POST['vehicle_qty']))$vehicle_qty = $_POST['vehicle_qty'];
            if(isset($_POST['total_amount']))$total_amount = $_POST['total_amount'];
            if(isset($_POST['dealer_booking_description']))$dealer_booking_description = $_POST['dealer_booking_description'];
            
             if(isset($_POST['person_name']))$person_name = $_POST['person_name'];
             $des = "Null";
         

 
            $select_temp_vehicle_list = DB::table('temp_dealer_booking_vehicle_info')
            							->where('temp_dealer_booking_vehicle_info.is_deleted', '=', 0)
            							->get();

            foreach ($select_temp_vehicle_list as $data) {

						 $vehicle_type_id =  $data->vehicle_type_id;
						 $model_id =  $data->model_id;
						 $color_id =  $data->color_id;
						 $chassis_no =  $data->chassis_no;
						 $book_no =  $data->book_no;
						 $vehicle_amount =  $data->vehicle_amount;
						 $engine_no =  $data->engine_no;

						 $insert_booking_vehicle_info = DB::table('dealer_booking_vehicle_info')->insert( ['booking_order_id'=>$booking_order_id,'booking_date'=>$booking_date,'vehicle_type_id' => $vehicle_type_id,'model_id' => $model_id, 'color_id' =>$color_id, 'chassis_no' => $chassis_no,'vehicle_amount'=>$vehicle_amount,'engine_no'=>$engine_no,'book_no'=>$book_no,'dealer_id'=>$dealer_id]);


						 $update_stock = DB::table('vehicle_stock')
						 				 ->where([['chassis_no', '=', $chassis_no]])
						 				 ->update( ['status'=>'1', 'sale_type'=>'dealer', 'sale_type_id'=>$dealer_id,'temp_status'=>0 ]);

						$fetch_total_stock = DB::table('main_model')
											->select('main_model.in_stock')
											->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])
											->get();

						$in_stock = $fetch_total_stock[0]->in_stock;

						$update_in_stock = $in_stock - 1;

						$update_instock_val = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])->update(['in_stock'=>$update_in_stock]);


				    } 

				     $insert_booking_vehicle = DB::table('dealer_booking')->insert( ['booking_no'=>$booking_no,'booking_unique_value' => $booking_unique_value,'order_id' => $booking_order_id, 'booking_date' =>$booking_date,  'dealer_id' => $dealer_id,'total_qty'=>$vehicle_qty,'total_amount'=>$total_amount,'booking_description'=>$dealer_booking_description] );

        

			        $dealer_rate_info =  DB::table('dealers')
									->where('id', '=', $dealer_id)
									->where('is_deleted', '=', 0)
									->get();

					$initial_total = $dealer_rate_info[0]->initial_balance;
					$total_paid = $dealer_rate_info[0]->total_paid;
					$total_remaining = $dealer_rate_info[0]->total_remaining;


					$update_initial_total = $initial_total - $total_amount;
					$update_remaining = $total_remaining - $total_amount;

					$update_dealer_total_val = DB::table('dealers')->where([['dealers.id', '=', $dealer_id],['dealers.is_deleted', '=', 0]])->update(['initial_balance'=>$update_initial_total, 'total_remaining'=>$update_remaining ]);



                    if($person_name !='')
                    {
                        $insert_gate_pass_user = DB::table('dealer_gate_pass_user')->insert( ['booking_order_id'=>$booking_order_id,'person_name'=>$person_name,'description'=>$des]);
        
                        $update_dealer_gate_booking = DB::table('dealer_booking')->where([['order_id', '=', $booking_order_id],['is_deleted', '=', 0]])->update(['delivery_status'=>1]);
                    }




                    
				   //  return redirect('/dealer-booking')->with('success', 'Dealers booking Saved!');
				     
				    if($booking_save=='save')
					{
					    //print"Test1";
					    
						return redirect('/dealer-booking')->with('success', 'Dealers booking Saved!');

					}
					else
					{
					    //print"Test";
						
						return Redirect('/dealer-booking')->with(['booking_order_id'=>$booking_order_id]);
						//return redirect('/dealer-booking')->with('success', 'Dealers booking Saved!');
					}

				     

		}


		

		public function edit_dealer_booking($dealer_order_id)
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

			$sub_dealers = DB::table('dealers')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$vehicle_types = DB::table('vehicle_type')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$vehicle_colors = DB::table('colors')
					->where('is_deleted', '=', '0')
					->get();




			$fetch_dealer_booking = DB::table('dealer_booking')
									 ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking.dealer_id')
									 ->select('dealers.dealer_name','dealer_booking.dealer_id','dealer_booking.booking_no','dealer_booking.order_id','dealer_booking.booking_date','dealer_booking.total_qty','dealer_booking.total_amount','dealer_booking.booking_description')
									->where('order_id', $dealer_order_id)
									->get();

            return view('/edit-dealer-booking',compact(['fetch_dealer_booking','vehicle_types','vehicle_colors','sub_dealers']));

		}



		public function view_dealer_booking($dealer_order_id)
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

			$sub_dealers = DB::table('dealers')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$vehicle_types = DB::table('vehicle_type')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$vehicle_colors = DB::table('colors')
					->where('is_deleted', '=', '0')
					->get();




			$fetch_dealer_booking = DB::table('dealer_booking')
									 ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking.dealer_id')
									 ->select('dealers.dealer_name','dealer_booking.dealer_id','dealer_booking.booking_no','dealer_booking.order_id','dealer_booking.booking_date','dealer_booking.total_qty','dealer_booking.total_amount','dealer_booking.booking_description')
									->where('order_id', $dealer_order_id)
									->get();

            return view('/view-dealer-booking',compact(['fetch_dealer_booking','vehicle_types','vehicle_colors','sub_dealers']));

		}



		public function fetch_dealer_stock_model_list(){

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


            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];

            $stock_models = DB::table('main_model')
                         ->select('main_model.id','main_model.model')
            			 ->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.is_deleted', '=', 0]])						
						->get();

						return $stock_models;
		}

		public function fetch_dealer_stock_chassis_no_list(){

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


            if(isset($_POST['model_id']))$model_id = $_POST['model_id'];           
            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
         
            $stock_chassis = DB::table('vehicle_stock')
            			
                         ->select('vehicle_stock.chassis_no','vehicle_stock.engine_no')
            			 ->where([['vehicle_stock.vehicle_type', '=', $vehicle_type],['vehicle_stock.model_name', '=', $model_id],['vehicle_stock.is_deleted', '=', 0],['vehicle_stock.status', '=', 0],['vehicle_stock.temp_status', '=', 0]])						
						->get();

						return $stock_chassis;
		}




		public function get_vehicle_list()
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

			if(isset($_POST['order_id']))$order_id = $_POST['order_id'];           
            if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];


			$vehicle_list = DB::table('dealer_booking_vehicle_info')
								 ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
								 ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
								 ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')

								 ->select('dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.model_id','dealer_booking_vehicle_info.vehicle_amount','dealer_booking_vehicle_info.book_no','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color')
								 ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
								  ->where('dealer_booking_vehicle_info.return_status', '=', 0)
								 ->where('dealer_booking_vehicle_info.booking_order_id', '=', $order_id)							 
								 ->get();

								 return $vehicle_list;
		}


		public function insert_vehicle_list()
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

		    if(isset($_POST['order_id']))$order_id = $_POST['order_id'];
		    if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];   
			if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];           
            if(isset($_POST['model_id']))$model_id = $_POST['model_id'];
            if(isset($_POST['color_id']))$color_id = $_POST['color_id'];
            if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];
            if(isset($_POST['vehicle_amount']))$vehicle_amount = $_POST['vehicle_amount'];
            if(isset($_POST['book_no']))$book_no = $_POST['book_no'];
            if(isset($_POST['engine_no']))$engine_no = $_POST['engine_no'];
            if(isset($_POST['booking_date']))$booking_date = date("Y-m-d", strtotime($_POST['booking_date']));


            if(isset($_POST['vehicle_qty']))$vehicle_qty = $_POST['vehicle_qty'];
            if(isset($_POST['total_amount']))$total_amount = $_POST['total_amount'];




            if($vehicle_qty == 0 && $total_amount == 0)
            {
            	$vehicle_qty1 = 1;
            	$total_amount1 = $vehicle_amount;
            }
            else
            {
            	$vehicle_qty1 = $vehicle_qty + 1;
            	$total_amount1 = $total_amount + $vehicle_amount;
            }




           /* Update total Amount */

            $fetch_dealer_amount = DB::table('dealers')
           						->where('id', '=', $dealer_id)
           						->where('is_deleted', '=', 0)
           						->get();

           	$dealer_initial = $fetch_dealer_amount[0]->initial_balance;           	
           	$total_remaining = $fetch_dealer_amount[0]->total_remaining;

           	$update_dealer_initial = $dealer_initial - $vehicle_amount;
           	$update_total_remaining = $total_remaining - $vehicle_amount;


           	$update_dealer_balance = DB::table('dealers')
           							->where([['id', '=', $dealer_id],['is_deleted', '=', 0]])
           							->update(['initial_balance' => $update_dealer_initial,'total_remaining' => $update_total_remaining]);
           
            /* Update Dealer Booking */            
            $update_dealer_booking = DB::table('dealer_booking')
           							->where([['order_id', '=', $order_id],['is_deleted', '=', 0]])
           							->update(['total_qty' => $vehicle_qty1,'total_amount' => $total_amount1]);


           /* Insert Vehicle Info */
            $insert_temp_vehicle_list = DB::table('dealer_booking_vehicle_info')->insert( ['booking_order_id' => $order_id,'booking_date'=>$booking_date,'vehicle_type_id' => $vehicle_type,'model_id' => $model_id, 'color_id' =>$color_id, 'chassis_no' => $chassis_no, 'vehicle_amount' => $vehicle_amount, 'book_no'=>$book_no, 'engine_no'=>$engine_no, 'dealer_id'=>$dealer_id ] );


            /* Update Stock */
                        $update_temp_status = DB::table('vehicle_stock')
            						->where([['chassis_no', $chassis_no],['vehicle_type', $vehicle_type],['model_name', $model_id]])
            						->update(['temp_status' => 1,'sale_type_id' => $dealer_id,'sale_type' => 'dealer','status' => 1]);
            					

				        $vehicle_total_amount = DB::table('dealer_booking_vehicle_info')				   
								    ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
								    ->sum('dealer_booking_vehicle_info.vehicle_amount');

				        $fetch_total_stock = DB::table('main_model')
											->select('main_model.in_stock')
											->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_id]])
											->get();

						$in_stock = $fetch_total_stock[0]->in_stock;

						$update_in_stock = $in_stock - 1;

						$update_instock_val = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_id]])->update(['in_stock'=>$update_in_stock]);





			      return response()->json(['success' => 'Added successfully.']);


		}


		public function get_vehicle_total_amount_list(){

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

             if(isset($_POST['order_id']))$order_id = $_POST['order_id'];

            $total_amount = DB::table('dealer_booking_vehicle_info')
					    ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
					     ->where('dealer_booking_vehicle_info.return_status', '=', 0)
					    ->where('dealer_booking_vehicle_info.booking_order_id', '=', $order_id)
					    ->sum('dealer_booking_vehicle_info.vehicle_amount');
					 //   return response()->json(['total_amount' => $total_amount]);

					    return $total_amount;

		}


		public function get_vehicle_total_qty(){

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

            if(isset($_POST['order_id']))$order_id = $_POST['order_id'];  
            $total_qty = DB::table('dealer_booking_vehicle_info')
					    ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
					    ->where('dealer_booking_vehicle_info.return_status', '=', 0)
					    ->where('dealer_booking_vehicle_info.booking_order_id', '=', $order_id)
					    ->count();

					    return $total_qty;
					// return response()->json(['total_qty' => $total_qty]);


		}


		public function delete_vehicle(){


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

		            if(isset($_POST['order_id']))$order_id = $_POST['order_id'];
					if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];
					if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];

					    


					    /* Fetch Single Vehicle Amount */
					    $fetch_vehicle_amount = DB::table('dealer_booking_vehicle_info')
					 						 ->where('dealer_booking_vehicle_info.chassis_no', $chassis_no)
				                             ->where('dealer_booking_vehicle_info.booking_order_id', $order_id)
				                             ->where('dealer_booking_vehicle_info.is_deleted', 0)
				                             ->get();

				        $vehicle_amount = $fetch_vehicle_amount[0]->vehicle_amount;

				        /* Update total Amount */

			            $fetch_dealer_amount = DB::table('dealers')
			           						->where('id', '=', $dealer_id)
			           						->where('is_deleted', '=', 0)
			           						->get();

			           	$dealer_initial = $fetch_dealer_amount[0]->initial_balance;           	
			           	$total_remaining = $fetch_dealer_amount[0]->total_remaining;

			           	$update_dealer_initial = $dealer_initial + $vehicle_amount;
			           	$update_total_remaining = $total_remaining + $vehicle_amount;







			           	$update_dealer_balance = DB::table('dealers')
			           							->where([['id', '=', $dealer_id],['is_deleted', '=', 0]])
			           							->update(['initial_balance' => $update_dealer_initial,'total_remaining' => $update_total_remaining]);



   	                        $fetch_dealer_booking =  DB::table('dealer_booking')
			           						->where('order_id', '=', $order_id)
			           						->where('dealer_id', '=', $dealer_id)
			           						->where('is_deleted', '=', 0)
			           						->get();


			           		$dealer_qty = $fetch_dealer_booking[0]->total_qty;
			           		$dealer_total_amount = $fetch_dealer_booking[0]->total_amount;


			           		$update_dealer_qty = $dealer_qty-1;
			           		$update_dealer_toal_amount = $dealer_total_amount-$vehicle_amount;

			           
			            /* Update Dealer Booking */
			            $update_dealer_booking = DB::table('dealer_booking')
			           							->where([['order_id', '=', $order_id],['is_deleted', '=', 0]])
			           							->update(['total_qty' => $update_dealer_qty,'total_amount' => $update_dealer_toal_amount]);


					  	/* Stock Updation */
			  		    $fetch_stock = DB::table('vehicle_stock')
			  						->where('chassis_no','=',$chassis_no)
			  						->where('is_deleted','=',0)
			  						->get();


			  			$vehicle_type = $fetch_stock[0]->vehicle_type;
			  			$model_id = $fetch_stock[0]->model_name;
		          


                        $update_temp_status = DB::table('vehicle_stock')
            						->where([['chassis_no', $chassis_no],['vehicle_type', $vehicle_type],['model_name', $model_id]])
            						->update(['temp_status' =>0, 'sale_type_id' =>0,'sale_type' => '','status' => 0]);




            		    $fetch_total_stock = DB::table('main_model')
											->select('main_model.in_stock')
											->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_id]])
											->get();

						$in_stock = $fetch_total_stock[0]->in_stock;

						$update_in_stock = $in_stock + 1;


						$update_instock_val = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_id]])->update(['in_stock'=>$update_in_stock]);


							 $delete_temp_vehicle = DB::table('dealer_booking_vehicle_info')
				            ->where('dealer_booking_vehicle_info.chassis_no', $chassis_no)
				            ->where('dealer_booking_vehicle_info.booking_order_id', $order_id)
				            ->delete();



				    return $delete_temp_vehicle;

		}



		public function update_dealer_booking()
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
            
            if(isset($_POST['order_id']))$order_id = $_POST['order_id'];
            if(isset($_POST['booking_date']))$booking_date = date("Y-m-d", strtotime($_POST['booking_date']));
           
            
            $update_dealer_booking = DB::table('dealer_booking')->where([['dealer_booking.order_id', '=', $order_id],['dealer_booking.is_deleted', '=', 0]])->update(['booking_date'=>$booking_date]);
            $update_dealer_booking_vehicle_info = DB::table('dealer_booking_vehicle_info')->where([['dealer_booking_vehicle_info.booking_order_id', '=', $order_id],['dealer_booking_vehicle_info.is_deleted', '=', 0]])->update(['booking_date'=>$booking_date]);

            

            

				     return redirect('/dealer-booking')->with('success', 'Dealers booking Updated!');;

		}


		public function delete_dealer_booking($dealer_order_id,$dealer_id)
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


			$select_dealer_booking = DB::table('dealer_booking_vehicle_info')
            							->where('is_deleted', '=', 0)
            							->where('booking_order_id', '=', $dealer_order_id)
            							->get();

            foreach ($select_dealer_booking as $data) {

						 $vehicle_type_id =  $data->vehicle_type_id;
						 $model_id =  $data->model_id;
						 $color_id =  $data->color_id;
						 $chassis_no =  $data->chassis_no;
						 $book_no =  $data->book_no;
						 $vehicle_amount =  $data->vehicle_amount;
						 $engine_no =  $data->engine_no;


						 $update_stock = DB::table('vehicle_stock')
						 				 ->where([['chassis_no', '=', $chassis_no]])						 				 
						 				 ->update( ['status'=>'0', 'sale_type'=>'', 'sale_type_id'=> 0, 'temp_status'=> 0]);

						$fetch_total_stock = DB::table('main_model')
											->select('main_model.in_stock')
											->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])
											->get();

						$in_stock = $fetch_total_stock[0]->in_stock;

						$update_in_stock = $in_stock + 1;

						$update_instock_val = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])->update(['in_stock'=>$update_in_stock]);


				    } 


				            $fetch_dealer_booking =  DB::table('dealer_booking')
			           						->where('order_id', '=', $dealer_order_id)
			           						->where('dealer_id', '=', $dealer_id)
			           						->where('is_deleted', '=', 0)
			           						->get();


			           		$dealer_qty = $fetch_dealer_booking[0]->total_qty;
			           		$dealer_total_amount = $fetch_dealer_booking[0]->total_amount;



			           	$fetch_dealer_amount = DB::table('dealers')
			           						->where('id', '=', $dealer_id)
			           						->where('is_deleted', '=', 0)
			           						->get();

			           	$dealer_initial = $fetch_dealer_amount[0]->initial_balance;           	
			           	$total_remaining = $fetch_dealer_amount[0]->total_remaining;

			           	$update_dealer_initial = $dealer_initial + $dealer_total_amount;
			           	$update_total_remaining = $total_remaining + $dealer_total_amount;


			           	$update_dealer_balance = DB::table('dealers')
			           							->where([['id', '=', $dealer_id],['is_deleted', '=', 0]])
			           							->update(['initial_balance' => $update_dealer_initial,'total_remaining' => $update_total_remaining]);


			            $delete_dealers_booking = DB::table('dealer_booking')
			            						 ->where([['order_id', '=', $dealer_order_id],['dealer_id', '=', $dealer_id]])						 				 
						 				          ->update( ['is_deleted'=>1]);


						$delete_dealers_booking = DB::table('dealer_booking_vehicle_info')
			            						 ->where([['booking_order_id', '=', $dealer_order_id]])						 				 
						 				          ->update( ['is_deleted'=>1]);


				     return redirect('/dealer-booking')->with('success', 'Dealers booking Deleted!');;


		}



		public function print_dealer_receipt($receipt_unique_id,$dealer_unique_id)
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


            $print_customer_receipt = DB::table('customer_sales_receipt')
            			  ->leftJoin('dealers', 'dealers.id', '=', 'customer_sales_receipt.dealer_id')
						  ->select('customer_sales_receipt.payee_name','customer_sales_receipt.receipt_no','customer_sales_receipt.receipt_date','customer_sales_receipt.amount_to_pay','customer_sales_receipt.payment_mode','customer_sales_receipt.cheque_no','customer_sales_receipt.cheque_bank_name','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.debit_card_transaction_no','customer_sales_receipt.debit_card_bank_name','customer_sales_receipt.payment_description','dealers.dealer_name','customer_sales_receipt.creator_name') 
						  ->where('customer_sales_receipt.is_deleted', '=', '0')
						  ->where('customer_sales_receipt.id', '=', $receipt_unique_id)
						   ->where('customer_sales_receipt.dealer_id', '=', $dealer_unique_id)
						  ->get();

			return view('/print-dealer-receipt',compact(['print_customer_receipt']));

		}





		public function dealer_gate_pass_print($dealer_order_id)
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


			 $dealer_booking_val = DB::table('dealer_booking')
            			 ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking.dealer_id')
                         ->select('dealers.dealer_name','dealer_booking.booking_date','dealer_booking.total_qty')
            			 ->where([['dealer_booking.is_deleted', '=', 0],['dealer_booking.order_id', '=', $dealer_order_id]])						
						->get();

			$dealer_booking_vehicle_lists = DB::table('dealer_booking_vehicle_info')
            			 ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
            			 ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
            			 ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')
            			  ->leftJoin('vehicle_stock', 'vehicle_stock.chassis_no', '=', 'dealer_booking_vehicle_info.chassis_no')
                         ->select('vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.book_no','vehicle_stock.engine_no')
            			 ->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.booking_order_id', '=', $dealer_order_id],['dealer_booking_vehicle_info.return_status', '=', 0]])						
						->get();
				
					//	print_r($dealer_booking_vehicle_lists);



			return view('/dealer-gate-pass-print',compact(['dealer_booking_val','dealer_booking_vehicle_lists']));

		}


		public function dealer_receipt($dealer_unique_id){

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



             $receipt_no1 =  DB::table('customer_sales_receipt') 
            						->where(function($query) use ($start_date, $end_date) {		
							       	 if($start_date !='' and $end_date !='')
							       	 $query->whereBetween('receipt_date', [$start_date, $end_date]);
							        })
							        ->max('receipt_no');							        

            $receipt_no = $receipt_no1 + 1;


            $fetch_over_view = DB::table('dealers')
            				->select('dealers.id','dealers.initial_balance','dealers.total_paid','dealers.total_remaining')            			
            				->where('dealers.id', '=', $dealer_unique_id)
            				->get();

	        $banks = DB::table('bank')
            		->where('is_deleted', '=', 0)
            		->get();


            $fetch_dealer_receipts = DB::table('customer_sales_receipt')            				
            				->where([['customer_sales_receipt.is_deleted', '=', 0],['customer_sales_receipt.dealer_id', '=', $dealer_unique_id]])
            				->orderby('customer_sales_receipt.receipt_date', 'DESC')
            				->get();


            return view('/dealer-receipt', compact(['fetch_over_view','fetch_dealer_receipts','banks']))->with(['receipt_no'=>$receipt_no]);

			//return view('/dealer-receipt', compact(''));
		}


		public function insert_dealer_receipt()
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
			    
			    /** Payment Mode **/

                if(isset($_POST['dealer_unique_id']))$dealer_unique_id = $_POST['dealer_unique_id'];

                if(isset($_POST['total_paid']))$total_paid1 = $_POST['total_paid'];

                if(isset($_POST['total_remaining']))$total_remaining1 = $_POST['total_remaining'];
                if(isset($_POST['amount_to_pay']))$amount_to_pay = $_POST['amount_to_pay'];
                
                  /*
                Sever Side Validation
                */
                
                
                if(isset($_POST['total_paid_old']))$total_paid_old = $_POST['total_paid_old'];
                if(isset($_POST['total_remaining_old']))$total_remaining_old = $_POST['total_remaining_old'];
                
                $total_paid = $total_paid_old + $amount_to_pay;
                $total_remaining = $total_remaining_old + $amount_to_pay;
                
                

                

			    if(isset($_POST['payment_mode']))$payment_mode = $_POST['payment_mode'];

			    if(isset($_POST['receipt_no']))$receipt_no = $_POST['receipt_no'];

			    if(isset($_POST['receipt_date']))$receipt_date = date("Y-m-d", strtotime($_POST['receipt_date']));

			    if(isset($_POST['cheque_no']))$cheque_no = $_POST['cheque_no']; // cheque No

			    if(isset($_POST['cheque_bank_name']))$cheque_bank_name = $_POST['cheque_bank_name'];// cheque Bank Name

			    if(isset($_POST['credit_card_transaction_no']))$credit_card_transaction_no = $_POST['credit_card_transaction_no']; // Credit Card Transaction No

			    if(isset($_POST['credit_card_bank_name']))$credit_card_bank_name = $_POST['credit_card_bank_name']; //  Credit Card Bank Name

				if(isset($_POST['debit_card_transaction_no']))$debit_card_transaction_no = $_POST['debit_card_transaction_no']; // Debit Card Transaction No

			    if(isset($_POST['debit_card_bank_name']))$debit_card_bank_name = $_POST['debit_card_bank_name'];// Debit Card Bank Name

			    if(isset($_POST['payment_description']))$payment_description = $_POST['payment_description'];

			    if(isset($_POST['payee_name']))$payee_name = $_POST['payee_name'];
			    
			    
			    if(isset($_POST['creator_name']))$creator_name = $_POST['creator_name'];
			    
			    
			      /* Finance Status */
			     if(isset($_POST['bank_id']))$bank_id = $_POST['bank_id'];
			     if(isset($_POST['finance_status']))$finance_status = $_POST['finance_status'];
			     
			     

			     
			      $unqiue_string = Str::random(30); 

			      $balance_sheet_unique_id = 'B'.date("Ymd") . time() . mt_rand();

			      $balance_sheet_date = date('Y-m-d');



             $insert_balance_sheet = DB::table('balance_sheet')->insert(['unique_id'=>$balance_sheet_unique_id,'order_id'=>$unqiue_string,'bal_date'=>$balance_sheet_date,'payment_mode'=>$payment_mode,'amount'=>$amount_to_pay]);


			    $insert_receipt = DB::table('customer_sales_receipt')->insert( ['creator_name'=>$creator_name,'booking_order_id'=>$unqiue_string,'receipt_no' => $receipt_no,'amount_to_pay' => $amount_to_pay, 'payment_mode' =>$payment_mode, 'cheque_no' => $cheque_no, 'cheque_bank_name' => $cheque_bank_name, 'credit_card_transaction_no'=>$credit_card_transaction_no,'credit_card_bank_name'=>$credit_card_bank_name,'debit_card_transaction_no'=>$debit_card_transaction_no,'debit_card_bank_name'=>$debit_card_bank_name,'payment_description'=>$payment_description,'receipt_date'=>$receipt_date,'dealer_id'=>$dealer_unique_id,'balance_sheet_unique_id'=>$balance_sheet_unique_id,'payee_name'=>$payee_name,'bank_id'=>$bank_id,'finance_status'=>$finance_status] );



			    $update_sales_booking = DB::table('dealers')->where('id', $dealer_unique_id)->update( ['total_paid' => $total_paid, 'total_remaining'=>$total_remaining ]);

			    return redirect('/dealer_receipt/'.$dealer_unique_id.'')->with(['message' => 'Added successfully.!!!']);


		}


		public function edit_single_dealer_receipt()
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

			if(isset($_POST['receipt_id']))$receipt_id = $_POST['receipt_id'];


			$edit_single_receipt = DB::table('customer_sales_receipt')
									->where('id', '=', $receipt_id)
									->where('is_deleted', '=', 0)
									->get();

			return $edit_single_receipt;

		}




		public function update_dealer_receipt()
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


				if(isset($_POST['uorder_id']))$uorder_id = $_POST['uorder_id'];
			 
                if(isset($_POST['udealer_id']))$udealer_id = $_POST['udealer_id'];
             


                if(isset($_POST['utotal_paid']))$utotal_paid1 = $_POST['utotal_paid'];
                if(isset($_POST['utotal_remaining']))$utotal_remaining1 = $_POST['utotal_remaining'];

                if(isset($_POST['uamount_to_pay']))$uamount_to_pay = $_POST['uamount_to_pay'];

			    if(isset($_POST['upayment_mode']))$upayment_mode = $_POST['upayment_mode'];

			    if(isset($_POST['ureceipt_no']))$ureceipt_no = $_POST['ureceipt_no'];

			    if(isset($_POST['ureceipt_date']))$ureceipt_date = date("Y-m-d", strtotime($_POST['ureceipt_date']));

			    if(isset($_POST['ucheque_no']))$ucheque_no = $_POST['ucheque_no'] ? : ''; // cheque No
			    if(isset($_POST['ucheque_bank_name']))$ucheque_bank_name = $_POST['ucheque_bank_name']  ? : '';// cheque Bank Name

			    if(isset($_POST['ucredit_card_transaction_no']))$ucredit_card_transaction_no = $_POST['ucredit_card_transaction_no']  ? : ''; // Credit Card Transaction No
			    if(isset($_POST['ucredit_card_bank_name']))$ucredit_card_bank_name = $_POST['ucredit_card_bank_name']  ? : ''; //  Credit Card Bank Name

				if(isset($_POST['udebit_card_transaction_no']))$udebit_card_transaction_no = $_POST['udebit_card_transaction_no']  ? : ''; // Debit Card Transaction No
				
			    if(isset($_POST['udebit_card_bank_name']))$udebit_card_bank_name = $_POST['udebit_card_bank_name']  ? : '';// Debit Card Bank Name

			    if(isset($_POST['upayment_description']))$upayment_description = $_POST['upayment_description']  ? : '';


			    if(isset($_POST['ubalance_sheet_unique_id']))$ubalance_sheet_unique_id = $_POST['ubalance_sheet_unique_id']  ? : '';
			    if(isset($_POST['ureceipt_id']))$ureceipt_id = $_POST['ureceipt_id'];

			     if(isset($_POST['upayee_name']))$upayee_name = $_POST['upayee_name'];
            
                 if(isset($_POST['ucreator_name']))$creator_name = $_POST['ucreator_name'];
                 
                 
                    /* Finance Status */
			     if(isset($_POST['ubank_id']))$ubank_id = $_POST['ubank_id'];
			     if(isset($_POST['ufinance_status']))$ufinance_status = $_POST['ufinance_status'];
			     
			     
                 
                 
                   /*
                Server Side Calculation
                */
                
                if(isset($_POST['utotal_paid_old']))$utotal_paid_old = $_POST['utotal_paid_old'];
                if(isset($_POST['utotal_remaining_old']))$utotal_remaining_old = $_POST['utotal_remaining_old'];
                if(isset($_POST['old_uamount_to_pay']))$old_uamount_to_pay = $_POST['old_uamount_to_pay'];
                    
                    
                   $min_total_paid = $utotal_paid_old - $old_uamount_to_pay;
                   $min_total_remaining =  $utotal_remaining_old - $old_uamount_to_pay;
            
                   $utotal_remaining = $min_total_remaining + $uamount_to_pay;
                   $utotal_paid = $min_total_paid + $uamount_to_pay;  
                    
                 
                 



			     $ubalance_sheet_date = date('Y-m-d');

			     $updat_payment =DB::table('customer_sales_receipt')
			     				->where([['booking_order_id', '=', $uorder_id],['balance_sheet_unique_id', '=', $ubalance_sheet_unique_id],['id', '=', $ureceipt_id],['is_deleted', '=', 0]])
			     				->update(['cheque_no' => '', 'cheque_bank_name' => '', 'credit_card_transaction_no'=> '','credit_card_bank_name'=> '','debit_card_transaction_no'=> '','debit_card_bank_name'=> '']);




			    $update_receipt = DB::table('customer_sales_receipt')->where([['balance_sheet_unique_id', '=', $ubalance_sheet_unique_id],['id', '=', $ureceipt_id],['is_deleted', '=', 0]])->update( ['creator_name'=>$creator_name,'amount_to_pay' => $uamount_to_pay, 'payment_mode' =>$upayment_mode, 'cheque_no' => $ucheque_no, 'cheque_bank_name' => $ucheque_bank_name, 'credit_card_transaction_no'=>$ucredit_card_transaction_no,'credit_card_bank_name'=>$ucredit_card_bank_name,'debit_card_transaction_no'=>$udebit_card_transaction_no,'debit_card_bank_name'=>$udebit_card_bank_name,'payment_description'=>$upayment_description,'receipt_date'=>$ureceipt_date,'payee_name'=>$upayee_name,'bank_id'=>$ubank_id,'finance_status'=>$ufinance_status] );
			    
			    

			    $update_sales_booking = DB::table('dealers')->where('id', $udealer_id)->update( ['total_paid' => $utotal_paid, 'total_remaining'=>$utotal_remaining ]);


			    $update_balance_sheet = DB::table('balance_sheet')->where([['unique_id', '=', $ubalance_sheet_unique_id],['is_deleted', '=', 0]])->update(['bal_date'=>$ubalance_sheet_date,'payment_mode'=>$upayment_mode,'amount'=>$uamount_to_pay]);


			    return redirect('/dealer_receipt/'.$udealer_id.'')->with(['message' => 'Update successfully.!!!']);


		}



		public function delete_single_dealer_receipt($receipt_id,$booking_order_id,$balance_sheet_unique_id,$dealer_id)
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


			$select_customer_receipt = DB::table('customer_sales_receipt')
									   ->where([['booking_order_id', '=', $booking_order_id],['balance_sheet_unique_id', '=', $balance_sheet_unique_id],['id', '=', $receipt_id],['is_deleted', '=', 0],['dealer_id', '=', $dealer_id]])									   
									   ->get();

			$select_dealer = DB::table('dealers')
									->where([['id', '=', $dealer_id],['is_deleted', '=', 0]])
									->get();


						$up_amount_to_pay = $select_customer_receipt[0]->amount_to_pay;

						$up_total_paid = $select_dealer[0]->total_paid;
						$up_total_remaining = $select_dealer[0]->total_remaining;

						$update_total_paid = $up_total_paid - $up_amount_to_pay;
						$update_total_remaining = $up_total_remaining - $up_amount_to_pay;


			  $update_receipt = DB::table('customer_sales_receipt')->where([['booking_order_id', '=', $booking_order_id],['balance_sheet_unique_id', '=', $balance_sheet_unique_id],['id', '=', $receipt_id],['is_deleted', '=', 0]])->update( ['is_deleted' => 1] );

			    $update_sales_booking = DB::table('dealers')->where('id', $dealer_id)->update( ['total_paid' => $update_total_paid, 'total_remaining'=>$update_total_remaining ]);


			    $update_balance_sheet = DB::table('balance_sheet')->where([['unique_id', '=', $balance_sheet_unique_id],['is_deleted', '=', 0]])->update(['is_deleted'=>1]);


			    return redirect('/dealer_receipt/'.$dealer_id.'')->with(['message' => 'Deleted successfully.!!!']);


		}
		

		public function fetch_dealer_gate_pass_user()
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

	         if(isset($_POST['order_id']))$order_id = $_POST['order_id'];

			$fetch_dealer_gate_pass_user = DB::table('dealer_gate_pass_user')
										->where('is_deleted', 0)
										->where('booking_order_id', $order_id)
										->get();
				return $fetch_dealer_gate_pass_user;
		}

		public function insert_dealer_gate_pass_user()
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

				if(isset($_POST['gate_pass_order_id']))$gate_pass_order_id = $_POST['gate_pass_order_id'];			 
                if(isset($_POST['person_name']))$person_name = $_POST['person_name'];
                if(isset($_POST['description']))$description = $_POST['description'];
             


			    $insert_dealer_gate_pass_user = DB::table('dealer_gate_pass_user')->insert( ['booking_order_id'=>$gate_pass_order_id,'person_name' => $person_name,'description' => $description] );

			    $update_dealer_gate_booking = DB::table('dealer_booking')->where([['order_id', '=', $gate_pass_order_id],['is_deleted', '=', 0]])->update(['delivery_status'=>1]);



				  return redirect('/dealer-booking')->with('success', 'Gate Pass user details saved!');;
		}


		public function update_dealer_gate_pass_user()
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

            
				if(isset($_POST['gate_pass_order_id1']))$gate_pass_order_id1 = $_POST['gate_pass_order_id1'];			 
                if(isset($_POST['person_name1']))$person_name1 = $_POST['person_name1'];
                if(isset($_POST['description1']))$description1 = $_POST['description1'];
             


			    $update_dealer_gate_pass_user = DB::table('dealer_gate_pass_user')->where('booking_order_id', $gate_pass_order_id1)->update( ['person_name' => $person_name1,'description' => $description1] );



				  return redirect('/dealer-booking')->with('success', 'Gate Pass user details updated!');;
		}


}
?>