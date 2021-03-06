@if (Auth::guest())
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('welcome') }}"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div id="msg" class="alert text-center">
        <strong></strong>
    </div>
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login') }}" method="post" id="frm-login">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('userid') ? ' has-error' : 'has-feedback' }}">
            <input type="text" class="form-control" name="userid" placeholder="User ID" value="{{ old('userid') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('userid'))
                <span class="help-block">
                    <strong>{{ $errors->first('userid') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : 'has-feedback' }}">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" id="btnsubmit" class="btn btn-primary btn-block btn-flat" onclick="return false;" >Sign In</button>
        </div>
        <!-- /.col -->
        </div>
    </form>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
        });
    });

    var pages = function(){

        return {
           Init : function() {
               $('#btnsubmit').click(function() {
                    $(this).text('Please wait . .');
                    $.ajax({
                        url : $('#frm-login').attr('action'),
                        type:'post',
                        data:{
                            userid : $('input[name=userid]').val(),
                            _token: $('input[name=_token]').val(),
                            password: $('input[name=password]').val()
                        },

                        success:function(data, status, c) {
                            $('#msg').addClass(`alert-${data.type}`);
                            $('#msg strong').text(data.msg);
                            $('#msg').show();
                            $('#btnsubmit').text('Sign In');
                            window.location = `${data.url}`;
                        },

                        error:function(data, status, c) {
                            $('#msg').addClass(`alert-${data.type}`);
                            $('#msg strong').text('Login failed.')
                            $('#msg').show();
                            $('#btnsubmit').text('Sign In');
                        }
                    })

               })
           }

        }

    }();


    $(function(){
        $('#msg').hide();
        pages.Init();
    })


</script>
</body>
</html>
@else
@php Redirect::to('/') @endphp
@endif
