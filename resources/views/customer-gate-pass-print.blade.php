<html>
<head>
<style>
	body {
	  font-family: "Bookman Old Style";
	  background: #fff;
	  border:1px solid #000; 
	  width:21cm;
	  height:29.7cm;
	  }
	  .main-div
	  {
	     background: #fff;
	    border: 1px solid #000;
	    margin: 10px;
	    width: 20.4cm;
	    height: 28.7cm;
	    border-radius: 20px;

	  }
	  /* Header */
	.header{
		display: flex;
		clear:both;
		border-bottom:1px dotted #000;
		margin-bottom:20px;
	}

	.header-left{
	    float: left;
	    border: none;
	    line-height: 1px;
	    padding: 10px;
	    width: 76%;	  	
	}

	.header-right{
	    float: right;
	    border: none;
	    width: 17%;
	    padding: 10px;
	}

	.header-logo
	{
    width: 100%;
	}
	h1{
		font-size: 28px;
	}

	h4
	{
	  font-size: 20px;
	}

	/* Header Title */

	.header-title
	{

	  display: block;
	  clear:both;

	}

	.header-title-left h3
	{
		background-color:#656565;
		text-align: center;
		margin:auto;
		display:block;
		width:150px;
		color:#fff;
		border-radius: 30px;
		padding:10px;
	}

	
	.header-title-left h4.date
	{
		text-align: left;
		margin-top:-30px;
		width:200px;
		float: right;
		font-size:17px;
	}

	.header-title-left h4.voucher-no
	{
		text-align: left;
		margin-top:5px;
		padding-left:10px;
		width:200px;
		float: left;
		font-size:17px;
	}

			.body-content
			{
				    height: 48%;
			}

	       

            .body-content p
            {
            	padding:10px;
    			line-height: 54px;
            }
   .buyer
   {
   	margin-top: 20px;   	
    height: 500px;
   }


#buyer {
  
  border-collapse: collapse;
  width: 100%;
}
#buyer td
{
	height:50px;
}

#buyer td, #buyer th {
  border: 1px solid #000;
  padding: 8px;
}

#buyer tr:nth-child(even){background-color: #f2f2f2;}

#buyer tr:hover {background-color: #ddd;}

#buyer th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left; 
  color: #000;
}




      .vehicle-model
   {
   	margin-top: 20px;   	
    height: 500px;
   }


#vehicle-model-list td
{
	height:50px;
}

#vehicle-model-list {
  
  border-collapse: collapse;
  width: 100%;
}

#vehicle-model-list td, #vehicle-model-list th {
  border: 1px solid #000;
 
  padding: 8px;
}

#vehicle-model-list tr:nth-child(even){background-color: #f2f2f2;}

#vehicle-model-list tr:hover {background-color: #ddd;}

#vehicle-model-list th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left; 
  color: #000;
}

.top-title h3
{
	text-align:center;
}

.footer
{
	border-top:1px dotted #000;
}

.footer h3
{	
	text-align:right;
	    padding-right: 20px;
}


.footer p
{
	margin-top:50px;
	text-align:right;
	    padding-right: 20px;
}


</style>
</head>
<body>
	
	<div class="main-div">

		 <div class="header">

		 	<div class="header-left">
		 		<h1>Sales Automation Pvt. Ltd., </h1>
		 		<h4>Authorised Main Dealer SAS</h4>
		 		<p style="line-height:10px; margin-top: -10px;"> MADURAI- 625 007. </p>
		 		<p style="font-weight: bold;">Cell : 78789 45788 </p>
		 	</div>

		 	<div class="header-right">
		 		<img class="header-logo" src="{{ asset('storage/custom_image/surabhi.png') }}">
		 	</div>

		 </div>
		 <div class="top-title">
		 	<h3> DELIVERY NOTE </h3>
		 </div>



		 <div class="header-title">

		 	<table id="buyer">					
					<tbody>						
						<tr>							
							<td style="width:430px;vertical-align: top;" rowspan="4" >Buyer
							<?php
							$customer_name = $fsbs[0]->customer_name;
							$swd_category = $fsbs[0]->swd_category;
							$swd_name = $fsbs[0]->swd_name;
							$customer_address = $fsbs[0]->customer_address;
							$contact_no = $fsbs[0]->contact_no1;
							$enquiry_no = $fsbs[0]->enquiry_no;
							

							echo "<br>".$customer_name .",".$swd_category.".".$swd_name."<br>".$customer_address."<br> Contact No: ".$contact_no."<br> Enquiry No: ".$enquiry_no;
							
							?>
							</td>
							<td>Delivery Note No : {{ $fsbs[0]->booking_unique_value }}</td>
						</tr>
						<tr>
							<td>Delivery Date : <?php echo  date("d-m-Y", strtotime($self_sale_info[0]->delivery_date ))?></td>
						</tr>

						<tr>
							<td>Mode of Payment : <?php
							$mode_of_payment = $fsbs[0]->hyp;

							if($mode_of_payment == 'no')
							{
								echo "Cash";
							}

							if($mode_of_payment == 'yes')
							{
								echo $fsbs[0]->bank_name;
							}

							?></td>
						</tr>
						<tr>
							<td style="height:110px;vertical-align: top;">Payment Description 
								<br>
								<b>Initial Payment : <?php echo  $fsbs[0]->initial_balance ?></b><br>
								 <?php
								 if($fsbs[0]->exchange_or_new !='')
								 {
								 
								$exchange_or_new = $fsbs[0]->exchange_or_new;
								if($exchange_or_new=='exchange')
								{
									?>
									<b>Model : <?php echo $exchange_vehicle_info[0]->model_name; ?></b><br>
									<b>Exchange Amount : <?php echo $exchange_vehicle_info[0]->valuable_amount;  ?></b>

									<?php
								}
							}
								?> 
							</td>
						</tr>			
									
					</tbody>
				</table>		


		 </div>


		 <div class="body-content">
		 	<table id="vehicle-model-list">
					<tr>
						<th>SR NO</th>
						<th>DESCRIPTION OF GOODS AND SERVICES</th>
						<th>QUANTITY</th>						
					</tr>
					<tbody>
						
						<tr>
							<td>1</td>
							<td>
								<b>Model Name : {{ strtoupper($fsbs[0]->model) }} </b><br>
								<b>Color : {{ strtoupper($fsbs[0]->type_of_color) }} </b><br>
								<b>Chassis No : {{ strtoupper($self_sale_info[0]->chassis_no) }} </b><br>
								<b>Engine No  : {{ strtoupper($fetch_vehicle_stock[0]->engine_no) }} </b><br>

							</td>
							<td></td>
							
						</tr>

						<tr>
							<td>2</td>
							<td><b>Book No : {{ $self_sale_info[0]->service_book_no }} </b></td>
							<td></td>
							
						</tr>

						<tr>
							<td>3</td>
							<td><b>Sales Executive Name :  {{ $fsbs[0]->sales_person_name }}</b></td>
							<td></td>
							
						</tr>

						<tr>
							<td>4</td>
							<td><b>Extra Fitting :  {{ strtoupper($fsbs[0]->extra_fitting) }}</b></td>
							<td></td>
							
						</tr>

						<tr>
							<td>5</td>
							<td><b>Helmet : 
								<?php

								if($self_sale_info[0]->helmat_status == 1)
								{
									echo "YES";
								}
								else
								{
									echo "NO";
								}
								?>

							</b></td>
							<td></td>
							
						</tr>


						<tr>
							<td>6</td>
							<td><b>Checked by : <?php
							  
									echo $fsbs[0]->delivery_note_checked_by;
							

							 ?>  </b></td>
							<td></td>
							
						</tr>			
									
					</tbody>
				</table>		 	
		 </div>


		 <div class="footer">

		 	<h3> For Sales Automation PVT LTD </h3>

		 	<p> Authorised Signatory </p>



		 </div>


	</div> 
</body>
<script type="text/javascript">
	window.onload = function() { window.print(); }
</script>
</html>


