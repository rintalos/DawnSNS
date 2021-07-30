@extends('layouts.logout')

@section('content')
<div class="back-town">
    <div id="clear">
     <p class="word-a"> {{ $user->username }}さん</p>
     <p class="word-b">ようこそ！DAWNSNSへ！</p>
     <p class="word-c">ユーザー登録が完了しました。</p>
     <p class="word-d">さっそく、ログインをしてみましょう。</p>

    </div>

    <p class="back-position"><a class="back-add" href="/login">ログイン画面へ</a></p>
</div>

@endsection