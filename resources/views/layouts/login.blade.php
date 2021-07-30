<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}" > <!--href="{{ asset('/css/reset.css') }}"に変更-->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" > <!--href="{{ asset('/css/style.css') }}"に変更-->
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
        <h1><a href="/top"><img class="main-icon" src="/images/main_logo.png"></a></h1>
            <div id="menu">
                <div class="menu-one">
                  <img class="persol-icon" src="/images/dawn.png">
                </div>
                <div class="menu">
                    <div class="menu-list">
                        <ul>
                            <li><a href="/top">HOME</a></li>
                            <li><a href="/profile">プロフィール編集</a></li>
                            <li><a href="/logout">ログアウト</a></li>
                        </ul>
                    </div>
                </div>
                <div class="hum" id="user-icon">
                    <p class="personal-name">{{$auth->username}}さん</p>
                </div>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p class="side-text">{{$auth->username}}さんの</p>
                <div>
                <p class="side-text count-member">フォロー数</p>
                <p class="side-text member">{{$follow_count}}名</p>
                </div>
                <p class="follow-btn"><a href="/follow-list" class='font-color'>フォローリスト</a></p><!---フォローリストのURL-->
                <div>
                <p class="side-text count-member">フォロワー数</p>
                <p class="side-text member">{{$follower_count}}名</p>
                </div>
                <p class="follow-btn"><a href="/follower-list" class='font-color'>フォロワーリスト</a></p> <!--フォロワーリストのURL-->
            </div>
            <p class="search-btn"><a href="/search" class='font-color'>ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('js/style.js')}}"></script>
</body>
</html>
