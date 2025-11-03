@extends('layouts.login',['bodyClassName' => 'loging_body'])
@section('content')
<form method="POST" action="{{ route('login') }}">
     {{ csrf_field() }}
    <div class="form-group mt-md{{ $errors->has('username') || $errors->has('email')? ' has-error' : '' }}">
        <span class="input-with-icon">
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
            <i class="fa fa-envelope"></i>
        </span>
        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <span class="input-with-icon">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <i class="fa fa-key"></i>
        </span>
         @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <div class="checkbox-custom checkbox-danger">
            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="check" for="remember">Remember me</label>
        </div>
    </div>
    <div class="logbtn-wrap">
        <button class="logBtn" type="submit">Login</button>
        <a href="{{ route('password.request') }}">Forgot password?</a>
    </div>
</form>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@stop
@section('script')
 <script>
history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};

 </script>
@stop