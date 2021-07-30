@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<p class="sub-title">Social Network Service</p>
<div class="back-space">
<p class="topic">DAWNSNSへようこそ</p>

{{ Form::label('MailAdress') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('LOGIN',['class' => 'form-btn']) }}

<p><a class="back" href="/register">新規ユーザーの方はこちら</a></p>
</div>
{!! Form::close() !!}

@endsection
