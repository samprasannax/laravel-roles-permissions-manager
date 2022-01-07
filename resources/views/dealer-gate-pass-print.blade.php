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
	  /*border:1px solid #000; */
	  margin: 10px;
	  height:143mm;
	  /*border-radius: 20px;*/

	  }

	/* Header */

	.header{
		display: flex;
		clear:both;
		/*border-bottom:1px dotted #000;*/
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
		margin-top:3px;
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


	.body-content h1
	{
		text-align: center;
	    font-size: 18px;
	    margin-top: 10%;
	}

			.body-content
			{
				    height: 34%;
			}

	      

            .body-content p
            {
            	padding:10px;
    			font-size: 20px;
   				line-height: 36px;
            }
            .border-content{            	
			    border: 1px solid #000;
			    padding: 12px 0px;
            }
   

   .vehicle-model
   {
   	margin-top: 20px;   	
    height: 500px;
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
.footer h1
{
	line-height:10px;
}
.footer .company-name{
	font-size: 18px;
}

.footer .company-authorised
{
	font-size: 18px;
	margin-top: 11%;
}
.body-content span
{
	font-weight: bold;
}



</style>
</head>
<body>
	<div class="main-div">

			 <div class="header">

			 	<div class="header-left">
			 		<h1>Sales Automation Pvt. Ltd., </h1>
			 		<h4>Authorised Main Dealer SAS</h4>
			 		<p style="line-height:10px; margin-top: -10px;">Madurai. </p>
			 		<p style="line-height:10px; ">E-mail : sas@gmail.com </p>
			 		<p style="font-weight: bold;">Cell : 98999 99899 </p>
			 	</div>

			 	<div class="header-right">
			 		<img class="header-logo" src="{{ asset('storage/custom_image/surabhi.png') }}">
			 	</div>

			 </div>
		

			 <div class="header-title">

			 	<div class="header-title-left">
			 		<h4 class="voucher-no">TO</h4> 
			 		
			 		<h4 class="date">Date: <?php echo  date("d-m-Y", strtotime($dealer_booking_val[0]->booking_date));  ?></h4> 
			 	</div>
			 </div>


			<div class="body-content">
				<h1> WHOMSOEVER IT MAY CONCERN </h1>

			 	<p> We are sending <span> <?php echo  $dealer_booking_val[0]->total_qty; ?>/Nos </span> of Honda Brand two wheeler for demo purpose / Show room display purpose and this will be taken by our Authorized person is <span> <?php echo  $dealer_booking_val[0]->dealer_name; ?></span>. will not involve any commercial activities. </p>		 	
			</div>

			<div class="vehicle-model">
				<table id="vehicle-model-list">
					<tr>
						<th>SNO</th>
						<th>MODEL</th>
						<th>COLOR</th>
						<th>CHASSIS NO</th>
						<th>ENGINE NO</th>
						<th>BOOK NO</th>
					</tr>
					<tbody>
					   
						@php($count=0)
               			@foreach ($dealer_booking_vehicle_lists as $dealer_booking_vehicle_list)
                        @php($count++)
						<tr>
							<td>{{ $count }}</td>
							<td style="font-size:12px;"><b>{{ strtoupper($dealer_booking_vehicle_list->model) }}</b></td>
							<td style="font-size:12px;"><b>{{ strtoupper($dealer_booking_vehicle_list->type_of_color) }}</b></td>
							<td style="font-size:12px;"><b>{{ strtoupper($dealer_booking_vehicle_list->chassis_no) }}</b></td>
							<td style="font-size:12px;"><b>{{ strtoupper($dealer_booking_vehicle_list->engine_no) }}</b></td>
							<td style="font-size:12px;"><b>{{ strtoupper($dealer_booking_vehicle_list->book_no) }}</b></td>
						</tr>
						@endforeach					
					</tbody>
				</table>
			</div>


			<div class="footer">
				<h1 class="company-name">For SALES AUTOMATION PVT.LTD</h1>

				<h1 class="company-authorised">AUTHORISED SIGNATORY</h1>
			</div>




	</div> 
</body>
<script type="text/javascript">
	window.onload = function() { window.print(); }
</script>
</html>


