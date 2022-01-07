<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
      </form>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>AutoMobile Management System</b> 
    </div>
    <strong><a href="http://www.elroisoftwaresolution.com" target="_blank" style="color:black;"><b>AUTOROVER</b> Developed by <b style="color:#050066">Elroi Software Solution</b>, Chennai, INDIA.</a></strong> All rights
    reserved.
  </footer>



</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('bower_components/fastclick/lib/fastclick.js') }}"></script>


<!-- Select2 -->
<script src="{{ URL::asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap  -->
<script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ URL::asset('bower_components/chart.js/Chart.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('dist/js/pages/dashboard2.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('dist/js/demo.js') }}"></script>
<script src="{{ URL::asset('js/main.js') }}"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $('.select-mul').select2()

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })


  });

   function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script>


</body>

</html>
