@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<div class="back-ground">

<h2 class="new-title">新規ユーザー登録</h2>

{{ Form::label('UserName') }}
{{ Form::text('username',null,['class' => 'input']) }}
@if ($errors->has('username'))
        <span class="help-block">
           <strong>{{ $errors->first('username') }}</strong>
        </span>
@endif

{{ Form::label('MailAdress') }}
{{ Form::text('mail',null,['class' => 'input']) }}
@if ($errors->has('mail'))
        <span class="help-block">
           <strong>{{ $errors->first('mail') }}</strong>
        </span>
@endif
{{ Form::label('Password') }}
{{ Form::password('password',['class' => 'input']) }}
@if ($errors->has('password'))
        <span class="help-block">
           <strong>{{ $errors->first('password') }}</strong>
        </span>
@endif
{{ Form::label('Password_confirm') }}
{{ Form::password('password-confirm',['class' => 'input']) }}
@if ($errors->has('password-confirm'))
        <span class="help-block">
           <strong>{{ $errors->first('password-confirm') }}</strong>
        </span>
@endif
{{ Form::submit('REGISTER',['class' => 'form-btn']) }}

<p><a class="back-login" href="/login">ログイン画面へ戻る</a></p>
</div>
{!! Form::close() !!}


@endsection
