<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SAMSPERPUS | Log in</title>
    @include('sc_head')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
        <a href="../../index2.html"><b>SAMS</b>PERPUS</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Silahkan Login</p>

        
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }} ☻</strong>
            </span>
        @endif

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

        <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
            <!-- /.col -->
            <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
        </form>


        <a href="#">I forgot my password</a><br>
        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
        </div>
    </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@include('sc_footer')
</body>
</html>
