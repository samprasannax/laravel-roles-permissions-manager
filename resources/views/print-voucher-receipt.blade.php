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
	  border:1px solid #000; 
	  margin: 10px;
	  height:143mm;
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

	        span.underline1 {
                font-size: 15px;
                font-weight:bold;
                border-bottom: 3px dotted grey;
                    width: 634px;
				    display: inline-block;
				    line-height: 30px;
            }

            span.underline2 {
                font-size: 15px;
                font-weight:bold;
                border-bottom: 3px dotted grey;
                    width: 500px;
				    display: inline-block;
				    line-height: 30px;
            }
            span.underline3 {
                font-size: 15px;
                font-weight:bold;
                border-bottom: 3px dotted grey;
                    width: 622px;
				    display: inline-block;
				    line-height: 30px;
            }

            .body-content p
            {
            	padding:10px;
    			line-height: 54px;
            }
    .footer
    {
      display: block;
	  clear:both;
	  padding:10px 20px;
	  padding-bottom:10px;

    }

    .footer .voucher-amount
    {
      float:left;
     width:30%;
    }

    .footer .voucher-amount h1
    {
      font-size:20px;
    }


     .footer .received-signature
    {
      float:right;
     
    }

    .footer .received-signature h1
    {
      font-size:20px;
    }


    .footer .authorised-signatory
    {
     /*text-align:center;   */  
     float:left; 
    }


     .footer .authorised-signatory h1
    {
      font-size:20px;
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
   $number = $print_voucher_receipt[0]->voucher_amount;
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
		 		<p style="line-height:10px; margin-top: -10px;">MADURAI- 625 007. </p>
		 		<p style="font-weight: bold;">Cell : 78789 45644 </p>
		 	</div>

		 	<div class="header-right">
		 		<img class="header-logo" src="{{ asset('storage/custom_image/surabhi.png') }}">
		 	</div>

		 </div>

		 <div class="header-title">

		 	<div class="header-title-left">
		 		<h4 class="voucher-no">No: <?php echo  $print_voucher_receipt[0]->voucher_no;  ?></h4> 
		 		<h3>EXPENSE</h3> 
		 		<h4 class="date">Date: <?php echo  date("d-m-Y", strtotime($print_voucher_receipt[0]->voucher_date));  ?></h4> 
		 	</div>
		 </div>


		 <div class="body-content">
		 	<p>Head of A/C <span class="underline1" ><?php echo $print_voucher_receipt[0]->person_name ?></span> Received with thanks Rupees  <span class="underline2" ><?php echo $result; ?></span> on account of <span class="underline3" ><?php echo $print_voucher_receipt[0]->voucher_name ?></span> </p>		 	
		 </div>


		 <div class="footer">

		 	<div class="voucher-amount">
		 		<h1> Rs. <?php echo $print_voucher_receipt[0]->voucher_amount; ?> </h1>
		 	</div>

		 	<div class="authorised-signatory">
		 		<h1> Authorised Signatory </h1>
		 	</div>

		 	<div class="received-signature">
		 		<h1> Receiver's Signature </h1>
		 		
		 	</div>

		 </div>







	</div> 
</body>
<script type="text/javascript">
	window.onload = function() { window.print(); }
</script>
</html>


