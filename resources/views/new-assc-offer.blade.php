  @include('layouts.top-header')
 @include('layouts.main-header')
 @include('partials.main-sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Dealers Offer
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{ route("admin.home") }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/assc-offer-list">View Dealers Offer</a></li>
        <li class="active">Add New Dealers Offer</li>
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
            <form action="/insert_assc_offer" method="POST" enctype="multipart/form-data">
                @csrf

                 <div class="box-body">
                                      <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName"> Date</label>
                                                <input type="date" class="form-control" id="offer_date" name="offer_date" aria-describedby="emailHelp" placeholder="Offer Date" required="true">
                                            </div>
                                        </div>


                                        <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Dealers Name</label>                                       
                                                       <select class="form-control select2" name="dealer_id" id="dealer_id" required="true">
                                                        <option value="">-- Select Dealers--</option>
                                                             @foreach($dealers as $dealer)
                                                                <option value="{{$dealer->id}}">{{$dealer->dealer_name}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>

                                       <div class="col-sm-3">                                        
                                            <div class="form-group">
                                                <label for="exampleName">Dealers Name</label>                                       
                                                       <select class="form-control select2" name="offer_id" id="offer_id" required="true">
                                                        <option value="">-- Select types--</option>
                                                             @foreach($offers as $offer)
                                                                <option value="{{$offer->id}}">{{$offer->offer_name}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Qty</label>
                                                <input type="text" class="form-control" id="offer_qty" name="offer_qty" aria-describedby="emailHelp" placeholder="Offer Qty"  onkeypress="javascript:return isNumber(event)"   value="0"  required="true">
                                            </div>
                                        </div>

                                          <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Per Qty Amount</label>
                                                <input type="text" class="form-control" id="qty_amount" name="qty_amount" aria-describedby="emailHelp" placeholder="Offer Qty Amount"  onkeypress="javascript:return isNumber(event)"   value="0"  required="true">
                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleName">Total Amount</label>
                                                <input type="text" class="form-control" id="total_amount" name="total_amount" aria-describedby="emailHelp" placeholder="Total Amount"  onkeypress="javascript:return isNumber(event)"   value="0"  required="true">
                                            </div>
                                        </div>

                                         <div class="col-sm-3">
                                         <div class="form-group">
                                                <label for="exampleName">Description</label>
                                                
                                                  <textarea class="form-control" id="description" rows="6" name="description" ></textarea>
                                            </div>
                                        </div>
                  </div>

                                       

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
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

    $('#offer_qty').on('change', function() {
      calculate_total();     
     });

    $('#qty_amount').on('change', function() {
      calculate_total();   
     });


    var calculate_total = function(){

      var offer_qty = 0;
      var qty_amount = 0;
      var total_amount = 0;
   
      var offer_qty = parseFloat($("#offer_qty").val()) || 0; // (self sale rate)
      var qty_amount = parseFloat($("#qty_amount").val()) || 0; // (+ self sale rate)
      var total_amount = parseFloat($("#total_amount").val()) || 0; // (+ self sale rate)



      var total = parseFloat(offer_qty) * parseFloat(qty_amount); 
    

      $('#total_amount').val(total);;

     }

    

</script>
