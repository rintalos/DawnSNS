@extends('layouts.login')

@section('content')

<form action="up-profile" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <p>UserName<input type="text" name="username" value="{{$auth->username}}"></p>
    @if ($errors->has('username'))
        <span class="help-block">
           <strong>{{ $errors->first('username') }}</strong>
        </span>
    @endif
    <p>MailAdress<input type="text" name="mail" value="{{$auth->mail}}"></p>
    @if ($errors->has('mail'))
        <span class="help-block">
            <strong>{{ $errors->first('mail') }}</strong>
        </span>
    @endif
    <p>Password<input type="password" name="password" value="{{$auth->password}} readonly"></p>
    <p>New Password<input type="password" name="new-password"></p>
    @if ($errors->has('new-password'))
        <span class="help-block">
            <strong>{{ $errors->first('new-password') }}</strong>
        </span>
    @endif
    <p>bio<input type="textarea" name="bio" value="{{$auth->bio}}"></p>
    @if ($errors->has('bio'))
        <span class="help-block">
            <strong>{{ $errors->first('bio') }}</strong>
        </span>
    @endif
    <p>Icon Image<input type="file" name="images" value="{{$auth->images}}"></p>
    @if ($errors->has('images'))
        <span class="help-block">
            <strong>{{ $errors->first('images') }}</strong>
        </span>
    @endif
    <p><input type="submit" value="送信"></p>
</form>

@endsection
