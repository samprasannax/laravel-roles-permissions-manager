  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Daily Account Close
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/daily-account-close">View Daily Account Close</a></li>
        <li class="active">Daily Account Close</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">           
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/insert_new_daily_account_close" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">

                      <div class="col-sm-3">
                       <div class="form-group">
                        <label for="exampleName">Close Date</label>
                            <input type="text" class="form-control is-invalid" id="close_date" name="close_date" required="true">
                        </div>
                      </div>

                      <div class="col-sm-3">
                       <div class="form-group">
                        <label for="exampleName">Close By</label>
                            <input type="text" class="form-control is-invalid" id="close_by" name="close_by" required="true" placeholder="Close By">
                        </div>
                      </div>

                      <div class="col-sm-3">
                       <div class="form-group">
                        <label for="exampleName">Today Closing Balance</label>
                            <input type="text" class="form-control is-invalid" id="total_soft_amount" name="total_soft_amount" required="true" value="{{ $final_open }}" readonly="true">
                        </div>
                      </div>


                      <div class="col-md-6">
                        <table class="table table-bordered">
                              <tr>
                                  <td><input type="text" name="note_two_thousand" id="note_two_thousand" value="2000" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="two_thousand_count" id="two_thousand_count" value="0"></td>
                                  <td><input type="text" name="two_thousand_value" id="two_thousand_value" value="0" readonly="true"></td>
                              </tr>
                              <tr>                                 
                                  <td><input type="text" name="note_five_hundred" id="note_five_hundred" value="500" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="five_hundred_count" id="five_hundred_count" value="0"></td>
                                  <td><input type="text" name="five_hundred_value" id="five_hundred_value" value="0" readonly="true"></td>
                              </tr>
                              <tr>                                 
                                  <td><input type="text" name="note_two_hundred" id="note_two_hundred" value="200" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="two_hundred_count" id="two_hundred_count" value="0"></td>
                                  <td><input type="text" name="two_hundred_value" id="two_hundred_value" value="0" readonly="true"></td>
                              </tr>
                              <tr>                                  
                                  <td><input type="text" name="note_one_hundred" id="note_one_hundred" value="100" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="one_hundred_count" id="one_hundred_count" value="0"></td>
                                  <td><input type="text" name="one_hundred_value" id="one_hundred_value" value="0" readonly="true"></td>
                              </tr>
                               <tr>                                  
                                  <td><input type="text" name="note_fifty" id="note_fifty" value="50" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="fifty_count" id="fifty_count" value="0"></td>
                                  <td><input type="text" name="fifty_value" id="fifty_value" value="0" readonly="true"></td>
                              </tr>
                              <tr>                                 
                                  <td><input type="text" name="note_twenty" id="note_twenty" value="20" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="twenty_count" id="twenty_count" value="0"></td>
                                  <td><input type="text" name="twenty_value" id="twenty_value" value="0" readonly="true"></td>
                              </tr>
                             
                              <tr>                                 
                                  <td><input type="text" name="note_ten" id="note_ten" value="10" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="ten_count" id="ten_count" value="0"></td>
                                  <td><input type="text" name="ten_value" id="ten_value" value="0" readonly="true"></td>
                              </tr>
                              <tr>                                  
                                  <td><input type="text" name="note_five" id="note_five" value="5" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="five_count" id="five_count" value="0"></td>
                                  <td><input type="text" name="five_value" id="five_value" value="0" readonly="true"></td>
                              </tr>
                              <tr>                                  
                                  <td><input type="text" name="note_two" id="note_two" value="2" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="two_count" id="two_count" value="0"></td>
                                  <td><input type="text" name="two_value" id="two_value" value="0" readonly="true"></td>
                              </tr>
                              <tr>                                  
                                  <td><input type="text" name="note_one" id="note_one" value="1" readonly="true"></td>
                                  <td>*</td>
                                  <td><input type="text" name="one_count" id="one_count" value="0"></td>
                                  <td><input type="text" name="one_value" id="one_value" value="0" readonly="true"></td>
                              </tr>
                        </table>
                      </div>


                      <div class="col-sm-4">
                       <div class="form-group">
                        <label for="exampleName">Total Note Value</label>
                            <input type="text" class="form-control is-invalid" id="total_note_amount" name="total_note_amount" required="true" value="0" readonly="true">
                        </div>
                      </div>
                       <div class="col-sm-4">
                       <div class="form-group">
                        <label for="exampleName">Result</label>
                            <input type="text" class="form-control is-invalid" id="tally_amount" name="tally_amount" required="true" value="0" readonly="true">
                        </div>
                      </div>


                  </div>




              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit"  value="save" name="save" id="save" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        
        </div>
        <!--/.col (left) -->
     
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


 @include('layouts.bottom-footer')
 <script>
   var app_url = "{{config('app.url')}}";  
</script>

<script>
    $('#close_date').datepicker('setDate', 'today');
      
      /* Thousand Calculation */
      $('#two_thousand_count').on('change', function() {
        calculate_two_thousand_count();
        total_amount();
       });

      var calculate_two_thousand_count = function(){        
         var note_two_thousand = 0;
         var two_thousand_count = 0;
         var two_thousand_value = 0;  
    
        var note_two_thousand = parseFloat($("#note_two_thousand").val()) || 0; 
        var two_thousand_count = parseFloat($("#two_thousand_count").val()) || 0; 

        var two_thousand_value = parseFloat(note_two_thousand) * parseFloat(two_thousand_count);      
        $('#two_thousand_value').val(two_thousand_value);
      }

      /* Five Calculation */
      $('#five_hundred_count').on('change', function() {
        calculate_five_hundred_count();
        total_amount();
       });

      var calculate_five_hundred_count = function(){
         var note_five_hundred = 0;
         var five_hundred_count = 0;
         var five_hundred_value = 0;  
    
        var note_five_hundred = parseFloat($("#note_five_hundred").val()) || 0; 
        var five_hundred_count = parseFloat($("#five_hundred_count").val()) || 0; 

        var five_hundred_value = parseFloat(note_five_hundred) * parseFloat(five_hundred_count);      
        $('#five_hundred_value').val(five_hundred_value);
      }


      /* Two Hundred Calculation */
      $('#two_hundred_count').on('change', function() {
        calculate_two_hundred_count();
        total_amount();
       });

      var calculate_two_hundred_count = function(){
         var note_two_hundred = 0;
         var two_hundred_count = 0;
         var two_hundred_value = 0;  
    
        var note_two_hundred = parseFloat($("#note_two_hundred").val()) || 0; 
        var two_hundred_count = parseFloat($("#two_hundred_count").val()) || 0; 

        var two_hundred_value = parseFloat(note_two_hundred) * parseFloat(two_hundred_count);      
        $('#two_hundred_value').val(two_hundred_value);
      }



      /* One Hundred Calculation */
      $('#one_hundred_count').on('change', function() {
        calculate_one_hundred_count();
        total_amount();
       });

      var calculate_one_hundred_count = function(){
         var note_one_hundred = 0;
         var one_hundred_count = 0;
         var one_hundred_value = 0;  
    
        var note_one_hundred = parseFloat($("#note_one_hundred").val()) || 0; 
        var one_hundred_count = parseFloat($("#one_hundred_count").val()) || 0; 

        var one_hundred_value = parseFloat(note_one_hundred) * parseFloat(one_hundred_count);      
        $('#one_hundred_value').val(one_hundred_value);
      }


       /* Fifty Calculation */
      $('#fifty_count').on('change', function() {
        calculate_fifty_count();
        total_amount();
       });

      var calculate_fifty_count = function(){
         var note_fifty = 0;
         var fifty_count = 0;
         var fifty_value = 0;  
    
        var note_fifty = parseFloat($("#note_fifty").val()) || 0; 
        var fifty_count = parseFloat($("#fifty_count").val()) || 0; 

        var fifty_value = parseFloat(note_fifty) * parseFloat(fifty_count);      
        $('#fifty_value').val(fifty_value);
      }


       /* Twenty Calculation */
      $('#twenty_count').on('change', function() {
        calculate_twenty_count();
        total_amount();
       });

      var calculate_twenty_count = function(){
         var note_twenty = 0;
         var twenty_count = 0;
         var twenty_value = 0;  
    
        var note_twenty = parseFloat($("#note_twenty").val()) || 0; 
        var twenty_count = parseFloat($("#twenty_count").val()) || 0; 

        var twenty_value = parseFloat(note_twenty) * parseFloat(twenty_count);      
        $('#twenty_value').val(twenty_value);
      }

      /* Ten Calculation */
      $('#ten_count').on('change', function() {
        calculate_ten_count();
        total_amount();
       });

      var calculate_ten_count = function(){
         var note_ten = 0;
         var ten_count = 0;
         var ten_value = 0;  
    
        var note_ten = parseFloat($("#note_ten").val()) || 0; 
        var ten_count = parseFloat($("#ten_count").val()) || 0; 

        var ten_value = parseFloat(note_ten) * parseFloat(ten_count);      
        $('#ten_value').val(ten_value);
      }



      /* Five Calculation */
      $('#five_count').on('change', function() {
        calculate_five_count();
        total_amount();
       });

      var calculate_five_count = function(){
         var note_five = 0;
         var five_count = 0;
         var five_value = 0;  
    
        var note_five = parseFloat($("#note_five").val()) || 0; 
        var five_count = parseFloat($("#five_count").val()) || 0; 

        var five_value = parseFloat(note_five) * parseFloat(five_count);      
        $('#five_value').val(five_value);
      }


        /* Two Calculation */
      $('#two_count').on('change', function() {
        calculate_two_count();
        total_amount();
       });

      var calculate_two_count = function(){
         var note_two = 0;
         var two_count = 0;
         var two_value = 0;  
    
        var note_two = parseFloat($("#note_two").val()) || 0; 
        var two_count = parseFloat($("#two_count").val()) || 0; 

        var two_value = parseFloat(note_two) * parseFloat(two_count);      
        $('#two_value').val(two_value);
      }

         /* One Calculation */
      $('#one_count').on('change', function() {
        calculate_one_count();
        total_amount();
       });

      var calculate_one_count = function(){
         var note_one = 0;
         var one_count = 0;
         var one_value = 0;  
    
        var note_one = parseFloat($("#note_one").val()) || 0; 
        var one_count = parseFloat($("#one_count").val()) || 0; 

        var one_value = parseFloat(note_one) * parseFloat(one_count);      
        $('#one_value').val(one_value);
      }


      var total_amount = function()
      {
        var total_amount = 0;
        var tot_tally_amount=0;

        var two_thousand_value = parseFloat($("#two_thousand_value").val()) || 0; 
        var five_hundred_value = parseFloat($("#five_hundred_value").val()) || 0; 
        var two_hundred_value = parseFloat($("#two_hundred_value").val()) || 0; 
        var one_hundred_value = parseFloat($("#one_hundred_value").val()) || 0; 
        var fifty_value = parseFloat($("#fifty_value").val()) || 0; 
        var twenty_value = parseFloat($("#twenty_value").val()) || 0; 
        var ten_value = parseFloat($("#ten_value").val()) || 0; 
        var five_value = parseFloat($("#five_value").val()) || 0; 
        var two_value = parseFloat($("#two_value").val()) || 0; 
        var one_value = parseFloat($("#one_value").val()) || 0;


        var total_soft_amount = parseFloat($("#total_soft_amount").val()) || 0;
        


        var total_amount = parseFloat(two_thousand_value) + parseFloat(five_hundred_value) + parseFloat(two_hundred_value)+ parseFloat(one_hundred_value) + parseFloat(fifty_value) + parseFloat(twenty_value) + parseFloat(ten_value) + parseFloat(five_value) + parseFloat(two_value) + parseFloat(one_value);  

        $('#total_note_amount').val(total_amount);

        var tot_tally_amount = parseFloat(total_amount) - parseFloat(total_soft_amount)

         $('#tally_amount').val(tot_tally_amount);





      }




</script>