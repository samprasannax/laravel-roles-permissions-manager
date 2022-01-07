<?php 
Route::redirect('/', 'admin/home');
Auth::routes(['register' => false]);

// Change Password Routes...

Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');

}); 
 
 
/*
*
*Financial Year 
* 
*/

Route::get('/financial-year', 'FinancialYear@index');// Financial Year
Route::get('/new-financial-year', 'FinancialYear@new_financial_year');// New Financial Year
Route::post('/insert_financial_year', 'FinancialYear@insert_financial_year');// Insert Financial Year
Route::get('/edit_financial_year/{financial_year_unique_id}', 'FinancialYear@edit_financial_year_info');// Edit Financial Year
Route::post('/update_financial_year', 'FinancialYear@update_financial_year');// Update Financial Year
Route::get('/delete_financial_year/{financial_year_unique_id}', 'FinancialYear@delete_financial_year');// Delete Financial Year



/*
*
* Cash In Hand
* 
*/



Route::get('/cash-in-hand', 'CashInHand@index');// Cash In Hand
Route::get('/new-cash-in-hand', 'CashInHand@new_cash_in_hand');// New Cash in Hand
Route::post('/insert_cash_in_hand', 'CashInHand@insert_cash_in_hand');// Insert Cash In Hand
Route::get('/edit_cash_in_hand/{cash_in_hand_id}', 'CashInHand@edit_cash_in_hand');// Edit Cash In Hand
Route::post('/update_cash_in_hand', 'CashInHand@update_cash_in_hand');// Update Cash In Hand



/*
*
*Bank 
*
*/

Route::get('/bank', 'Bank@index');// Bank
Route::get('/new-bank', 'Bank@new_bank');// New banks
Route::post('/insert_bank', 'Bank@insert_bank');// Insert bank
Route::get('/edit_bank/{bank_unique_id}', 'Bank@edit_bank_info');// Edit Bank
Route::post('/update_bank', 'Bank@update_bank');// Update Bank
Route::get('/delete_bank/{bank_unique_id}', 'Bank@delete_bank');// Delete Bank


/*Route::get('/test_controller', 'Bank@test_controller');*/ // Delete Bank



/*
*
*Offer 
*
*/

Route::get('/offer-list', 'Offer@index');// Offer
Route::get('new-offer', 'Offer@new_offer');// New Offer
Route::post('/insert_offer', 'Offer@insert_offer');// Insert Offer
Route::get('/edit_offer/{offer_unique_id}', 'Offer@edit_offer');// Edit Offer
Route::post('/update_offer', 'Offer@update_offer');// Update Offer
Route::get('/delete_offer/{offer_unique_id}', 'Offer@delete_offer');// Delete Offer



/*
*
Assc Offer
*
*/
Route::get('/assc-offer-list', 'Offer@assc_offer_list');// Assc Offer List
Route::get('/new-assc-offer', 'Offer@new_assc_offer');// New Assc Offer List

Route::post('/insert_assc_offer', 'Offer@insert_assc_offer');// Insert Assc Offer List
Route::get('/delete_assc_offer/{offer_unique_id}/{dealer_id}', 'Offer@delete_assc_offer');// Insert Assc Offer List


/*
*
*
Customers
*
*
*/

Route::get('/customers', 'Customers@index'); // Customers List
Route::get('/new-customer', 'Customers@new_customer');// New Customers
Route::post('/insert_customer_details', 'Customers@insert_new_customer'); // New Customers
Route::get('/edit_customers/{customer_unique_id}', 'Customers@edit_customer_info');// Edit Customers
Route::post('/update_customers', 'Customers@update_cusomers_info');// Update Customers
Route::get('/delete_customer/{customer_unique_id}', 'Customers@delete_cusomers_info');// Delete Customers

/*
*
*
* Sub Dealer
*
*
*/

Route::get('/sub-dealer', 'SubDealer@index');// Sub Dealers List
Route::get('/new-sub-dealer', 'SubDealer@new_sub_dealer'); // New Sub Dealers
Route::post('/insert_sub_dealers', 'SubDealer@insert_sub_dealers'); // Insert Sub Dealers
Route::get('/edit_sub_dealer/{dealer_unique_id}', 'SubDealer@edit_dealer_info'); // Edit Sub Dealers
Route::post('/update_sub_dealers', 'SubDealer@update_dealers_info');// Update Sub Dealers
Route::get('/delete_sub_dealer/{customer_unique_id}', 'SubDealer@delete_dealers_info');// Delete Sub Dealers

/*
*
*
*Mechanical 
*
*/

Route::get('/mechanical', 'Mechanical@index'); //Mechanic List
Route::get('/new-mechanical', 'Mechanical@new_mechanical');//  New Mechanic 
Route::post('/insert_mechanical', 'Mechanical@insert_mechanical');//  Insert Mechanic 
Route::get('/edit_mechanical/{mechanic_unique_id}', 'Mechanical@edit_mechanical');//  Edit Mechanic
Route::post('/update_mechanical', 'Mechanical@update_mechanical');//  Update Mechanic 
Route::get('/delete_mechanical/{mechanic_unique_id}', 'Mechanical@delete_mechanical');//  Delete Mechanic

/*
* 
*
Sales Person
*
*/
Route::get('/sales-person', 'SalesPerson@index');// Sale Person List
Route::get('/new-sales-person', 'SalesPerson@new_sales_person');// New Sales Person
Route::post('/insert_sales_person', 'SalesPerson@insert_sales_person');// insert Sales Person
Route::get('/edit_sales_person/{sales_person_unique_id}', 'SalesPerson@edit_sales_person');// edit Sales Person
Route::post('/update_sales_person', 'SalesPerson@update_sales_person');// update Sales Person
Route::get('/delete_sales_person/{sales_person_unique_id}', 'SalesPerson@delete_sales_person');// update Sales Person

/*
*
*
*Vehicle Type
*
*/
Route::get('/vehicle-type', 'ManageVehicle@vehicle_type');// Vehicle Type List
Route::get('/new-vehicle-type', 'ManageVehicle@new_vehicle_type');// New Vehicle Type
Route::post('/insert_vehicle_type', 'ManageVehicle@insert_vehicle_type');//  Insert New Vehicle Type
Route::get('/edit_vehicle_type/{vehicle_type_id}', 'ManageVehicle@edit_vehicle_type');//  Insert New Vehicle Type
Route::post('/update_vehicle_type', 'ManageVehicle@update_vehicle_type');//  Update New Vehicle Type
Route::get('/delete_vehicle_type/{vehicle_type_id}', 'ManageVehicle@delete_vehicle_type');//  Delete New Vehicle Type

/*
*
*
Color 
*
*/
Route::get('/vehicle-color', 'ManageVehicle@vehicle_color');// Color List
Route::get('/new-vehicle-color', 'ManageVehicle@new_vehicle_color');// New Color
Route::post('/insert_vehicle_color', 'ManageVehicle@insert_vehicle_color');//  Insert New Vehicle Color
Route::get('/edit_vehicle_color/{vehicle_color_id}', 'ManageVehicle@edit_vehicle_color');//  Insert  Vehicle Color
Route::post('/update_vehicle_color', 'ManageVehicle@update_vehicle_color');//  Update New Vehicle Color
Route::get('/delete_vehicle_color/{vehicle_color_id}', 'ManageVehicle@delete_vehicle_color');//  Delete  Vehicle Color


/*
*
*
Vehicle Model 
*
*/
Route::get('/model-list', 'ManageVehicle@model_list'); // Model List
Route::get('/new-model-list', 'ManageVehicle@new_model_list'); // New Model List
Route::post('/insert_model_list', 'ManageVehicle@insert_model_list'); // Insert Model List
Route::get('/edit_model_list/{model_unique_id}', 'ManageVehicle@edit_model_list');// Edit Model List
Route::post('/update_model_list', 'ManageVehicle@update_model_list'); // Update Model List
 Route::get('/delete_model_list/{model_unique_id}', 'ManageVehicle@delete_model_list'); // Delete  Model List



/*
*
*
* Vehicle Model Rate
*
*/


Route::get('/vehicle-model', 'ManageVehicle@vehicle_model');// Vehicle Model List
Route::get('/new-vehicle-model', 'ManageVehicle@new_vehicle_model');//  New Vehicle Model
Route::post('/fetch_model', 'ManageVehicle@fetch_model');//  New Vehicle Model
Route::post('/insert_vehicle_model', 'ManageVehicle@insert_vehicle_model');//  Insert New Vehicle Model
Route::get('/edit_vehicle_model/{vehicle_model_id}', 'ManageVehicle@edit_vehicle_model');//  Insert  Vehicle Model
Route::post('/update_vehicle_model', 'ManageVehicle@update_vehicle_model');//  Update New Vehicle Model
Route::get('/delete_vehicle_model/{vehicle_model_id}', 'ManageVehicle@delete_vehicle_model');//  Delete  Vehicle Model

/*
*
*
Vehicle Stock
*
*
*/
Route::get('/vehicle-stock', 'ManageVehicle@vehicle_stock');// vehicle Stock
Route::post('/fetch_dealer_sold_details', 'ManageVehicle@fetch_dealer_sold_details');// Fetch vehicle sold details
Route::post('/fetch_customer_sold_details', 'ManageVehicle@fetch_customer_sold_details');// Fetch vehicle sold details
Route::get('/new-vehicle-stock', 'ManageVehicle@new_vehicle_stock'); // New Stock
Route::post('/fetch_stock_model', 'ManageVehicle@fetch_stock_model');//  Fetch Stock Model
Route::post('/fetch_stock_color', 'ManageVehicle@fetch_stock_color');//  Fetch Stock Color
Route::post('/insert_vehicle_stock', 'ManageVehicle@insert_vehicle_stock');//  Insert New Vehicle Stock
Route::get('/edit_vehicle_stock/{vehicle_stock_id}', 'ManageVehicle@edit_vehicle_stock');//  Insert  Vehicle Stock
Route::post('/update_vehicle_stock', 'ManageVehicle@update_vehicle_stock');//  Update New Vehicle Stock
Route::get('/delete_vehicle_stock/{vehicle_stock_id}', 'ManageVehicle@delete_vehicle_stock');//  Delete  Vehicle Stock


/*
*
*
*
*
Import Stock
*
*
*
*/ 
Route::get('/import-stock', 'ManageVehicle@import_stock'); // Import Stock
Route::post('/insert_import_stock', 'ManageVehicle@insert_import_stock'); // Import Stock



/*
*
*
* Sales Confirm Booking
*
*/

Route::get('/sales-booking','SalesBooking@index'); // Sales Booking List
Route::get('/sales-booking-without-filter','SalesBooking@sales_booking_without_filter'); // Sales Booking List
Route::get('/new-booking', 'SalesBooking@new_booking');// New sales booking
Route::post('/fetch_vehicle_amount', 'SalesBooking@fetch_vehicle_amount'); // Fetch Vehicle Amount
Route::post('/insert_sale_booking', 'SalesBooking@insert_sale_booking'); // Insert sales booking
Route::get('/edit-sale-booking/{sale_booking_order_id}/{balance_sheet_unique_id}', 'SalesBooking@edit_sale_booking');// Edit sales booking
Route::post('/update_sale_booking','SalesBooking@update_sale_booking');//Update sale Booking

Route::get('/delete-booking/{sale_booking_order_id}/{balance_sheet_unique_id}','SalesBooking@delete_sale_booking');//Delete sale Booking
Route::get('/cancel_booking/{booking_order_id}/{balance_sheet_unique_id}/{customer_id}','SalesBooking@cancel_booking');// Cancel Booking


Route::get('/customer_gate_pass_print/{booking_order_id}', 'SalesBooking@customer_gate_pass_print'); // Customer Gate Pass Print


Route::post('/fetch_sale_booking_info','SalesBooking@fetch_sale_booking_info');// Booking Info Fetch
Route::get('/add_customer_sale_vehicle_info/{booking_order_id}','SalesBooking@add_customer_sale_vehicle_info');// Add sale vehicle info

Route::get('/edit_customer_sale_vehicle_info/{booking_order_id}','SalesBooking@edit_customer_sale_vehicle_info');// Add sale vehicle info
Route::post('/insert_customer_sale_vehicle_info','SalesBooking@insert_customer_sale_vehicle_info');
Route::post('/update_customer_sale_vehicle_info','SalesBooking@update_customer_sale_vehicle_info');

Route::get('/edit_customer_sale_vehicle_info/{booking_order_id}','SalesBooking@edit_customer_sale_vehicle_info');// Add sale vehicle info

Route::post('/update_account_close_status','SalesBooking@update_account_close_status');


Route::post('/fetch_account_close_details','SalesBooking@fetch_account_close_details');

Route::get('/reupdate_cancel/{order_id}','SalesBooking@reupdate_cancel');


/*
* 
* 
*
Sales Receipt 
*
*/
Route::get('/receipt/{order_id}/{customer_id}', 'Receipt@index');// Receipt
Route::post('/insert_receipt', 'Receipt@insert_receipt'); // Insert Receipt
Route::post('/edit_single_receipt','Receipt@edit_single_receipt'); // Edit Single Receipt
Route::post('/update_receipt','Receipt@update_receipt'); // Update Receipt
Route::get('/delete_single_receipt/{receipt_id}/{booking_order_id}/{balance_sheet_unique_id}/{customer_id}','Receipt@delete_single_receipt');


Route::get('/print-customer-receipt/{customer_receipt_unique_id}', 'Receipt@print_customer_receipt'); // Customer Receipt



/*
*
*
*
Dealer Booking 
*
*
*
*/

Route::get('/dealer-booking', 'DealerBooking@dealer_booking'); // Dealer booking
Route::get('/new-dealer-booking', 'DealerBooking@new_dealer_booking'); //  New Dealer Booking
Route::post('/fetch_dealer_stock_model', 'DealerBooking@fetch_dealer_stock_model'); //  Fetch Dealer booking model availability
Route::post('/fetch_dealer_stock_color', 'DealerBooking@fetch_dealer_stock_color'); //  Fetch Dealer booking Color availability
Route::post('/fetch_dealer_stock_chassis_no', 'DealerBooking@fetch_dealer_stock_chassis_no'); //  Fetch Dealer booking Chassis No availability
Route::post('/fetch_dealer_stock_amount', 'DealerBooking@fetch_dealer_stock_amount'); //  Fetch Dealer booking Amount availability
Route::post('/get_temp_vehicle_list', 'DealerBooking@get_temp_vehicle_list'); //   Get temp Vehicle List for dealer booking.
Route::post('/insert_temp_vehicle_list', 'DealerBooking@insert_temp_vehicle_list'); //   insert temp Vehicle List for dealer booking
Route::post('/get_total_amount','DealerBooking@get_total_amount');//Get total Amount
Route::post('/get_total_qty','DealerBooking@get_total_qty');//Get total Amount
Route::post('/delete_temp_vehicle','DealerBooking@delete_temp_vehicle');//Get total Amount
Route::post('/insert_dealer_booking','DealerBooking@insert_dealer_booking');// Insert Dealer Booking
Route::post('/fetch_dealer_gate_pass_user','DealerBooking@fetch_dealer_gate_pass_user'); // Fetch Dealer Gate Pass User Details
Route::post('/insert_dealer_gate_pass_user','DealerBooking@insert_dealer_gate_pass_user'); // Insert 
Route::post('/update_dealer_gate_pass_user','DealerBooking@update_dealer_gate_pass_user'); // Update 

/*
*
Dealer Receipt
*
*/

Route::get('/dealer_receipt/{dealer_unique_id}', 'DealerBooking@dealer_receipt'); // Dealer Receipt
Route::post('/insert_dealer_receipt', 'DealerBooking@insert_dealer_receipt'); // Insert Dealer Receipt
Route::post('/edit_single_dealer_receipt', 'DealerBooking@edit_single_dealer_receipt'); // Edit Dealer Single Receipt
Route::post('/update_dealer_receipt', 'DealerBooking@update_dealer_receipt'); // Edit Dealer Single Receipt
Route::get('/delete_single_dealer_receipt/{receipt_id}/{booking_order_id}/{balance_sheet_unique_id}/{dealer_id}', 'DealerBooking@delete_single_dealer_receipt'); // Delete Dealer Single Receipt

Route::get('/print_dealer_receipt/{receipt_unique_id}/{dealer_unique_id}', 'DealerBooking@print_dealer_receipt'); // Print Dealer Receipt
Route::get('/edit_dealer_booking/{dealer_order_id}', 'DealerBooking@edit_dealer_booking'); // Edit Dealer Booking
Route::post('/fetch_dealer_stock_model_list', 'DealerBooking@fetch_dealer_stock_model_list');
Route::post('/fetch_dealer_stock_chassis_no_list', 'DealerBooking@fetch_dealer_stock_chassis_no_list');
Route::post('/insert_vehicle_list', 'DealerBooking@insert_vehicle_list'); 
Route::post('/get_vehicle_total_amount_list','DealerBooking@get_vehicle_total_amount_list');//Get total Amount

Route::post('/get_vehicle_total_qty', 'DealerBooking@get_vehicle_total_qty'); //   Get Vehicle List for dealer booking.

Route::post('/get_vehicle_list', 'DealerBooking@get_vehicle_list'); // Get Vehicle list

Route::post('/delete_vehicle','DealerBooking@delete_vehicle');//Delete Single Vehicle 

Route::post('/update_dealer_booking','DealerBooking@update_dealer_booking');//Update Dealer Booking


Route::get('/view_dealer_booking/{dealer_order_id}', 'DealerBooking@view_dealer_booking'); // View Dealer Booking

Route::get('/delete_dealer_booking/{dealer_order_id}/{dealer_id}', 'DealerBooking@delete_dealer_booking'); // Delete Dealer Booking

Route::get('/dealer_gate_pass_print/{dealer_order_id}', 'DealerBooking@dealer_gate_pass_print');// Delaer  Gate Pass Print

/*
*
*
*
Dealer Rate
*
*
*/
Route::get('/dealer-rate','DealerRate@index'); // Dealer Rate Info
Route::get('/new-dealer-rate-info','DealerRate@new_dealer_rate_info'); // New Dealer Rate Info
Route::post('/insert_dealer_rate_info','DealerRate@insert_dealer_rate_info'); // Insert Dealer Rate Info
Route::get('/edit_dealer_rate_info/{dealer_rate_unique_id}', 'DealerRate@edit_dealer_rate_info');// Edit Dealer Rate Info
Route::post('/update_dealer_rate_info', 'DealerRate@update_dealer_rate_info');// Update Dealer Rate Info
Route::get('/delete_dealer_rate_info/{dealer_rate_unique_id}', 'DealerRate@delete_dealer_rate_info');// Edit Dealer Rate Info


/*
*
*
*
Voucher Category
*
*
*/
Route::get('/voucher-category','VoucherCategory@index');//List of Voucher Category
Route::get('/new-voucher-category','VoucherCategory@new_voucher_category');//New Voucher Category
Route::post('/insert_voucher_category','VoucherCategory@insert_voucher_category');//Insert Voucher Category
Route::get('/edit_voucher_category/{voucher_category_unique_id}', 'VoucherCategory@edit_voucher_category_info');// Edit Voucher Category
Route::post('/update_voucher_category', 'VoucherCategory@update_voucher_category_info');// Update Voucher Category
Route::get('/delete_voucher_category/{voucher_category_unique_id}', 'VoucherCategory@delete_voucher_category');// Delete Voucher Category


/*
*
*
*
*
*Voucher Receipt
*
*
*/
Route::get('/voucher-receipt-list','VoucherReceipt@index'); //List of Voucher Receipt
Route::get('/new-voucher-receipt','VoucherReceipt@new_voucher_receipt'); //New Voucher Receipt
Route::post('/insert_voucher_receipt','VoucherReceipt@insert_voucher_receipt'); //Insert Voucher Receipt
Route::get('/edit_voucher_receipt/{voucher_receipt_unique_id}', 'VoucherReceipt@edit_voucher_receipt'); // Edit Voucher Receipt
Route::post('/update_voucher_receipt','VoucherReceipt@update_voucher_receipt'); //Update Voucher Receipt
Route::get('/delete_voucher_receipt/{voucher_receipt_unique_id}/{unique_id}/{order_id}','VoucherReceipt@delete_voucher_receipt'); //Delete Voucher Receipt
Route::get('/print_voucher_receipt/{voucher_receipt_unique_id}','VoucherReceipt@print_voucher_receipt'); //Print Voucher Receipt



/*
*
*
*
Return Vehicle 
*
*
*/
Route::get('/dealer-stock/{dealer_unique_id}','DealerStock@index'); // Fetch Assc Stock Details
Route::post('/fetch_assc_user_details','DealerStock@fetch_assc_user_details'); // Fetch Assc Sales Details
Route::post('/insert_assc_sale_details','DealerStock@insert_assc_sale_details'); // Insert Assc Sales Details
Route::post('/update_assc_sale_details','DealerStock@update_assc_sale_details'); // Udpate Old Assc Sales Details
Route::post('/fetch_assc_retrun_details','DealerStock@fetch_assc_retrun_details'); // Fetch Vehicle Info
Route::post('/check_assc_info','DealerStock@check_assc_info'); // Update retrun Details

Route::get('/dealer-return/{dealer_unique_id}','DealerReturn@index'); // Update retrun Details


Route::post('/fetch_assc_user_details_for_rto','DealerStock@fetch_assc_user_details_for_rto'); // Fetch Assc Sales Details For RTO


Route::post('/update_assc_rto_date','DealerStock@update_assc_rto_date'); // update Assc Sales Details For RTO

/*
*
*
*
Warranty Send and Retrun
*
*/
Route::get('/dealer-warranty/{dealer_unique_id}','DealerWarranty@index'); // Fetch Dealer Warranty Card Remaining 
Route::post('/update_dealer_warranty_card','DealerWarranty@update_dealer_warranty_card'); // Update Dealer Warranty Card Remaining

/*
*
*
Reports
*
*
*/
Route::get('/list-of-reports','Reports@index'); // List Of Reports
Route::post('/stock_in_hand','Reports@stock_in_hand'); // Stock In Hand (Self)
Route::post('/assc_stock_in_hand','Reports@assc_stock_in_hand'); // Stock In Hand (ASSC)
Route::post('/receipt_report','Reports@receipt_report'); // Receipt Report
Route::post('/cancel_receipt_report','Reports@cancel_receipt_report'); // Cancel Receipt Report
Route::post('/sold_vehicle_stock','Reports@sold_vehicle_stock'); // Sold Vehicle Stock
Route::post('/assc_sold_vehicle_stock','Reports@assc_sold_vehicle_stock'); // Sold Vehicle Stock
Route::get('/assc_sold_vehicle_stock','Reports@assc_sold_vehicle_stock'); // Sold Vehicle Stock
Route::post('/return_vehicle_stock','Reports@return_vehicle_stock'); // Return Vehicle Stock


Route::post('/monthly_opening_balance','Reports@monthly_opening_balance');// Monthly Opening Balance



Route::post('/dsc_monthly_sale','Reports@dsc_monthly_sale');// DSC Monthly Sales
Route::get('/list_of_stock_in_hand/{model_id}/{vehicle_type_id}','Reports@list_of_stock_in_hand'); // Fetch Stock Details
Route::get('/list_of_assc_stock_in_hand/{vehicle_type_id}/{model_id}','Reports@list_of_assc_stock_in_hand'); // Fetch Assc Stock Details
Route::post('/rto-check-pending','Reports@rto_check_pending'); // RTO Check Pending
Route::post('/voucher_receipt_report_list','Reports@voucher_receipt_report_list'); // Voucher Receipt Report List
Route::post('/feed_back_report_list','Reports@feed_back_report_list'); // Feed Back Report List

Route::post('/daily_expense_ledger','DailyExpenseLedger@daily_expense_ledger'); // Feed Back Report List

Route::post('/monthwise_voucher_cateogry_report','Reports@monthwise_voucher_cateogry_report'); // Feed Back Report List

Route::get('/monthly-vehicle-stock', 'Reports@monthly_vehicle_stock');// Monthly vehicle Stock

Route::get('/assc-final-opening-balance', 'Reports@assc_final_opening_balance');// Assc Final Opening Balance

Route::post('/daily_delivery_note', 'Reports@daily_delivery_note');// Daily Delivery Note
Route::post('/dsc_monthly_discount', 'Reports@dsc_monthly_discount');// DSC Monthly Discount

Route::get('/mechanic', 'Reports@mechanic');  // Mechanic Reports
Route::get('/vechicle_ageing', 'Reports@vechicle_ageing'); //vechicle_ageing Reports
Route::get('/vechicle_ageing1/{id}', 'Reports@vechicle_ageing1'); //vechicle_ageing Reports


/*
*
Exports
*
*/

Route::post('/export_assc_ledger','Exports@export_assc_ledger'); // ASSC Ledger Export
Route::post('/export_daily_ledger','Exports@export_daily_ledger'); // Daily Ledger Export
Route::post('/export_dsc_ledger','Exports@export_dsc_ledger'); // DSC Sale Ledger Export
Route::post('/export_receipt_report','Exports@export_receipt_report'); // Export Receipt Report
Route::post('/export_voucher_receipt_report','Exports@export_voucher_receipt_report'); // Export Receipt Report
Route::post('/export_assc_opening_balance','Exports@export_assc_opening_balance');// Export Dealer Opening Balance 
Route::post('/export_feed_back','Exports@export_feed_back');// Export Feed Back
/*
*
*
*
RTO Check 
*
*
*
*/
Route::get('/rto-check','RtoCheck@index'); // List of RTO Check 

Route::get('/rto-check-completed','RtoCheck@rto_check_completed'); // List of RTO Check  Completed

Route::post('/fetch_rto_check_status','RtoCheck@fetch_rto_check_status'); // Rto Check  Status
Route::post('/update_rto_check_list','RtoCheck@update_rto_check_list'); // Rto Check  Status
Route::post('/fetch_rto_view','RtoCheck@fetch_rto_view'); // Rto Check  Status


/*
*
*
*
Feed Back 
*
*
*/

Route::get('/feed-back-list','FeedBack@index'); // Feed Back
Route::post('/fetch_rto_feed_status','FeedBack@fetch_rto_feed_status'); // Fetch RTO Feed Status
Route::post('/insert_rto_feed_status','FeedBack@insert_rto_feed_status'); // Insert RTO Feed Status
Route::post('/update_rto_feed_status','FeedBack@update_rto_feed_status'); // Update RTO Feed Status
Route::post('/view_rto_feed_status','FeedBack@view_rto_feed_status'); // Update RTO Feed Status


/*
*
*
*
*
*Voucher Credits
*
*
*/

 Route::get('/voucher-credit-list','VoucherCredit@index'); //List of Voucher Credit
 Route::get('/new-voucher-credit','VoucherCredit@new_voucher_credit'); //New Voucher Credit
 Route::post('/insert_voucher_credit','VoucherCredit@insert_voucher_credit'); //Insert Voucher Credit
 Route::get('/edit_voucher_credit/{voucher_receipt_unique_id}', 'VoucherCredit@edit_voucher_credit'); // Edit Voucher Credit
 Route::post('/update_voucher_credit','VoucherCredit@update_voucher_credit'); //Update Voucher Credit
 Route::get('/delete_voucher_credit/{voucher_receipt_unique_id}/{unique_id}/{order_id}','VoucherCredit@delete_voucher_credit'); //Delete Voucher Credit
 Route::get('/print_voucher_credit/{voucher_receipt_unique_id}','VoucherCredit@print_voucher_credit'); //Print Voucher Receipt

/*
*
*
*
Return Vehicle Manual 
*
*
*/
Route::get('/return-vehicle-manual','ReturnVehicleManual@index');
Route::get('/add-return-vehicle-manual','ReturnVehicleManual@add_return_vehicle_manual');
Route::post('/insert_return_vehicle_manual','ReturnVehicleManual@insert_return_vehicle_manual');
Route::get('/delete_return_vehicle_manual/{return_unique_id}','ReturnVehicleManual@delete_return_vehicle_manual'); // Update retrun Details

/*
*
*
Monthly Target 
*
*
*/

Route::get('/view-dsc-monthly-target','DscMonthlyTarget@index'); //Dsc Monthly Target
Route::get('/new-dsc-monthly-target','DscMonthlyTarget@new_dsc_monthly_target'); //New Dsc Monthly Target
Route::post('/insert_dsc_monthly_target','DscMonthlyTarget@insert_dsc_monthly_target'); //New Dsc Monthly Target
Route::get('/edit_dsc_monthly_target/{dsc_target_unqiue_id}','DscMonthlyTarget@edit_dsc_monthly_target'); //Edit Dsc Monthly Target
Route::post('/udpate_dsc_monthly_target','DscMonthlyTarget@udpate_dsc_monthly_target'); //Update Dsc Monthly Target

Route::get('/delete_dsc_monthly_target/{dsc_target_unqiue_id}','DscMonthlyTarget@delete_dsc_monthly_target'); //Delete Dsc Monthly Target


/*
*
*
Monthly Target Reprot 
*
*
*
*/


Route::get('/view-assc-monthly-target','AsscMonthlyTarget@index'); //ASSC Monthly Target
Route::get('/new-assc-monthly-target','AsscMonthlyTarget@new_assc_monthly_target'); //New ASSC Monthly Target
Route::post('/insert_assc_monthly_target','AsscMonthlyTarget@insert_assc_monthly_target'); //New ASSC Monthly Target
Route::get('/edit_assc_monthly_target/{assc_target_unqiue_id}','AsscMonthlyTarget@edit_assc_monthly_target'); //Edit ASSC Monthly Target
Route::post('/udpate_assc_monthly_target','AsscMonthlyTarget@udpate_assc_monthly_target'); //Update ASSC Monthly Target
Route::get('/delete_assc_monthly_target/{assc_target_unqiue_id}','AsscMonthlyTarget@delete_assc_monthly_target'); //Delete ASSC Monthly Target



/*
*
*
Monthly Target
*
*/
Route::post('/dsc_monthly_target_report','MonthlyTargetReport@dsc_monthly_target_report');
Route::post('/assc_monthly_target_report','MonthlyTargetReport@assc_monthly_target_report');



/*
*
*
*
Daily Account Close
*
*
*/

Route::get('/daily-account-close','DailyAccountClose@daily_account_close'); // Fetch Daily Account Close
Route::get('/new-daily-account-close','DailyAccountClose@new_daily_account_close'); // New Daily Account Close
Route::post('/insert_new_daily_account_close','DailyAccountClose@insert_new_daily_account_close'); // New Daily Account Close
Route::get('/delete_daily_account_close/{unique_id}','DailyAccountClose@delete_daily_account_close');// Delete Daily Account Close


/*
*
*
*
Fetcyh Color Wise Stock
*
*
*
*/

Route::post('/fetch_colors_count_one','FetchColorCount@fetch_colors_count_one'); // Fetch Color Count One
Route::post('/fetch_colors_count','FetchColorCount@fetch_colors_count'); // Fetch Color Count
Route::get('/finance_pending_list','SalesBooking@finance_pending_list');




/*
*
*
New Export Route
*
*
*/
Route::post('/export_stock_in_hand','Exports@export_stock_in_hand'); // Export Stock In Hand
Route::post('/export_assc_stock_in_hand','Exports@export_assc_stock_in_hand'); // Export ASSC Stock In Hand
Route::post('/export_cancel_receipt_report','Exports@export_cancel_receipt_report'); // Export Cancel Receipt Report
Route::post('/dsc_monthly_sales_percentage','Reports@dsc_monthly_sales_percentage'); // Dsc Monthly Sales Percentage
Route::post('/export_sales_percentage','Exports@export_sales_percentage'); // Exports Monthly Sales Percentage
Route::post('/total_finance_amount','Reports@total_finance_amount'); // Total Finance Amount
Route::post('/export_total_finance_amount', 'Exports@export_total_finance_amount'); // Export Total finance Amount

Route::post('/export_sold_vehicle_stock', 'Exports@export_sold_vehicle_stock'); // Export Sold Vehicle Stock

Route::post('/export_assc_sold_vehicle_stock', 'Exports@export_assc_sold_vehicle_stock'); // Export Assc Sold Vehicle Stock



Route::post('/assc_monthly_sales', 'Reports@assc_monthly_sales'); // Assc Monthly Sales

Route::post('/export_assc_monthly_sales', 'Exports@export_assc_monthly_sales'); // Assc Monthly Sales


Route::post('/assc_monthly_sales_percentage','Reports@assc_monthly_sales_percentage');
Route::post('/export_assc_monthly_sales_percentage', 'Exports@export_assc_monthly_sales_percentage'); // Export Sold Vehicle Stock


Route::post('/self_sale_exchange_vehicle', 'Reports@self_sale_exchange_vehicle'); // Self Sale Exchange Vehicle Info
Route::post('/export_self_sale_exchange_vehicle', 'Exports@export_self_sale_exchange_vehicle'); // Export Self Sale Exchange Vehicle Info



Route::post('/export_dsc_monthly_target_report','Exports@export_dsc_monthly_target_report'); // Export DSC  Monthly Target
Route::post('/export_assc_monthly_target_report','Exports@export_assc_monthly_target_report'); // Export DSC   Monthly Target

Route::post('/export_mechanic_report','Exports@export_mechanic_report'); // Export Mechanic Monthly Target

