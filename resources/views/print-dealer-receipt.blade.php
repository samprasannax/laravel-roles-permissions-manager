<html>
<head>
<style>
	body {
	  font-family: "Bookman Old Style";
	  background: #fff;
	  border:1px solid #000; 
	  width:210mm;
	  height:148.5mm;
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
				    height: 34%;
			}

	        span.underline1 {
                font-size: 15px;
                font-weight:bold;
                border-bottom: 3px dotted grey;
                    width: 488px;
				    display: inline-block;
				    line-height: 30px;
            }

            span.underline2 {
                font-size: 15px;
                font-weight:bold;
                border-bottom: 3px dotted grey;
                    width: 585px;
				    display: inline-block;
				    line-height: 30px;
            }
            span.underline3 {
                font-size: 15px;
                font-weight:bold;
                border-bottom: 3px dotted grey;
                    width: 712px;
				    display: inline-block;
				    line-height: 30px;
            }

            .body-content p
            {
            	padding:10px;
    			line-height: 54px;
            }
            .border-content{            	
			    border: 1px solid #000;
			    padding: 12px 0px;
            }
    .footer
    {
    display: flex;
    clear: both;
    padding: 20px 0;
    }

.footer div {
    float: left;
}
.footer  .voucher-amount {
    width: 25%;

}

.footer  .voucher-amount h1
{
    font-size: 15px;
    border: 1px solid #000;
    display: flex;
    border-radius: 26px;
}

.footer .voucher-amount h1 span.rs
{
	background-color: #000;
    padding: 12px;
    border-radius: 26px 0 0 26px;
    display: inline-block;
    color: #fff;
}
.footer .voucher-amount h1 span.amnt{
	padding: 11px;
}
.footer  .authorised-signatory {
    width: 30%;
    border: 1px solid #000;
    margin-left: 8px;
    height: 76px;
    border-radius: 17px;
    position: relative;
}
.footer  .authorised-signatory h1
{
    font-size: 15px;
    text-align: center;
    position: absolute;
    bottom: 0;
    width: 100%;
}


.footer  .received-signature {
    width: 45%;
    border: 1px solid #000;
    margin-left: 8px;
    height: 76px;
    border-radius: 17px;
    position: relative;
}
.footer  .received-signature h1
{
	font-size:15px;
    text-align: center;
    position: absolute;
    top: 0;
    width: 100%;
}


    


</style>
</head>
<body>
	<?php


  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
   $number = $print_customer_receipt[0]->amount_to_pay;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
   $result . "Rupees  "/* . $points . " Paise"*/;

	?>
	<div class="main-div">

		 <div class="header">

		 	<div class="header-left">
		 		<h1>Sales Automation Pvt. Ltd., </h1>
		 		<h4>Authorised Main Dealer SAS</h4>
		 		<p style="line-height:10px; margin-top: -10px;">Madurai. </p>
		 		<p style="line-height:10px; ">E-mail : sas@gmail.com </p>
		 		<p style="font-weight: bold;">Cell : 78778 99899 </p>
		 	</div>

		 	<div class="header-right">
		 		<img class="header-logo" src="{{ asset('storage/custom_image/surabhi.png') }}">
		 	</div>

		 </div>
		 <div class="border-content" >

			 <div class="header-title">

			 	<div class="header-title-left">
			 		<h4 class="voucher-no">No: <?php echo  $print_customer_receipt[0]->receipt_no;  ?></h4> 
			 		<h3>RECEIPT</h3> 
			 		<h4 class="date">Date: <?php echo  date("d-m-Y", strtotime($print_customer_receipt[0]->receipt_date));  ?></h4> 
			 	</div>
			 </div>


			 <div class="body-content">
			 	<p>Received with thanks from M/s.<span class="underline1" ><?php echo $print_customer_receipt[0]->dealer_name; ?></span> the sum of Rupees  <span class="underline2" ><?php echo $result; ?></span> by <span class="underline3" ><?php  $payment_mode = $print_customer_receipt[0]->payment_mode;

	                        if($payment_mode==1)
	                        {
	                          echo"Cash";
	                        }

	                        if($payment_mode==2)
	                        {
	                          echo"Bank";
	                        }

	                        if($payment_mode==3)
	                        {
	                           echo"Cheque";
	                           echo", Cheque No : " .  $print_customer_receipt[0]->cheque_no;
	                           echo", Bank Name : " .  $print_customer_receipt[0]->cheque_bank_name;
	                        }

	                        if($payment_mode==4)
	                        {
	                           echo"Credit Card";
	                           echo", Transaction No : " . $print_customer_receipt[0]->credit_card_transaction_no;
	                           echo", Bank Name : " .  $print_customer_receipt[0]->credit_card_bank_name;
	                        }

	                        if($payment_mode==5)
	                        {
	                           echo"Debit Card";
	                           echo", Transaction No : " . $print_customer_receipt[0]->debit_card_transaction_no;
	                           echo", Bank Name : " . $print_customer_receipt[0]->debit_card_bank_name;
	                        }

	                        ?>
	                        	
	                        </span> </p>		 	
				</div>


			</div>



		 <div class="footer">

		 	<div class="voucher-amount">
		 		<h1> <span class="rs">Rs.</span><span class="amnt"><?php echo $print_customer_receipt[0]->amount_to_pay; ?></span></h1>
		 	</div>

		 	<div class="authorised-signatory">
		 		<h1> {{ $print_customer_receipt[0]->payee_name }}</h1>
		 	</div>

		 	<div class="received-signature">
		 		<h1> For Sales Automation Pvt.Ltd., </h1>
		 		 <br>
		 		<h5 style="font-size:15px"><center> {{ $print_customer_receipt[0]->creator_name }} </center></h5>
		 		
		 	</div>

		 </div>








	</div> 
</body>
<script type="text/javascript">
	window.onload = function() { window.print(); }
</script>
</html>


