<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sales Automation System</title>
  
  
  <!-- Favicon Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/custom_image/Logo.png') }}">
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/iCheck/square/blue.css') }}">
<style>
    body{
    	background-image: url(https://aid-frontend.prod.atl-paas.net/atlassian-id/front-end/5.0.264/static/media/default_left.e74de3ec.svg), url(https://aid-frontend.prod.atl-paas.net/atlassian-id/front-end/5.0.264/static/media/default_right.6ece9751.svg) !important;
    background-repeat: no-repeat, no-repeat!important;
    background-attachment: fixed, fixed !important;
    background-size: 368px, 368px !important;
    background-position: left bottom, right bottom !important;
    }
    </style>
    
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b><img src="{{ asset('storage/custom_image/AutoRover-logo.svg') }}" style="width:357px" ></b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>

                    @if(\Session::has('message'))
                        <p class="alert alert-info">
                            {{ \Session::get('message') }}
                        </p>
                    @endif


    <form  method="post" action="{{ route('login') }}">
        {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus placeholder="Email" value="{{ old('email', null) }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
      </div>
      <div class="form-group has-feedback">
        <input  name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
      </div>
      <div class="row">
        <div class="col-xs-4">
        </div>
        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" style="    color: #fff !important;
    background-color: #177adf !important;
    border-color: #177adf !important;">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ URL::asset('plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
