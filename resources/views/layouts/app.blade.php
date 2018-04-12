<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @section('title')
        <title>舒八刀，编程书籍，pdf下载，pdf图书下载</title>
    @show
    <meta name="keywords" content="舒八刀，编程书籍，pdf下载，pdf图书下，pdf电子书下载，高清pdf电子书">
    <meta name="description" content="舒八刀提供pdf书籍下载链接。我们不写书，我们只是搬运书。">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/open-iconic-bootstrap.css') }}" rel="stylesheet">
    @yield('link')
    @yield('style')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel" id="nav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    {{--<li><a class="nav-link" href="{{ url('books/create') }}">发布书籍</a></li>--}}
                    <li><a class="nav-link" href="{{ url('books') }}">书籍</a></li>
                    <li><a class="nav-link" href="{{ url('book_lists') }}">书单</a></li>
                    <li><a class="nav-link" href="{{ url('sentences') }}">句子</a></li>
                    {{--<li><a class="nav-link" href="{{ url('book_lists/create') }}">发布书单</a></li>--}}
                </ul>

                <!-- Right Side Of Navbar -->
                {{--<ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>--}}
                <form class="form-inline" action="{{ route('books.search') }}" @if (Route::currentRouteName() == 'books.search') hidden @endif>
                    <div class="input-group">
                        <input type="text" class="form-control border-primary" size="30%" name="search_value" placeholder="书名/作者/ISBN/出版社" >
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <main class="py-4" id="main">
        @yield('content')
    </main>
</div>
<hr>
<footer class="mb-2" id="footer">
    <div class="row text-center">
        <div class="col">
            <a href="{{url('statement')}}" class="text-dark">网站声明</a>
            <a href="{{url('rights')}}" class="text-dark">维权通告</a>
            <a href="{{url('feedback')}}" class="text-dark">反馈建议</a>
            <a href="{{url('donate')}}" class="text-dark">慷慨解囊</a>
            <a href="{{url('faq')}}" class="text-dark">FAQ</a>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            Copyright © {{date('Y')}} | created by @singi
        </div>
    </div>
</footer>
<div class="position-fixed" style="right: 2%;bottom: 2%;">
    <div class="btn-group-vertical">
        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#alipayRedPacket"><span class="oi oi-yen"></span>
        </button>
        <button class="btn btn-primary btn-lg" id="a-chevron-top" hidden><span class="oi oi-chevron-top"></span>
        </button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="alipayRedPacket" tabindex="-1" role="dialog" aria-labelledby="alipayRedPacket"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <img class="img-thumbnail" src="/img/alipay_red_packet.png" alt="支付宝红包">
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('plug_in/bootstrap-notify-master/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('plug_in/ZeroClipboard.js') }}"></script>
@yield('script')
@yield('script_code')
<script>
    //最小高度
    $('#main').css('min-height', innerHeight - 157);
    //scroll() 方法为滚动事件
    $(window).scroll(function () {
        if ($(window).scrollTop() > 10) {
            $("#a-chevron-top").attr('hidden', false);
        } else {
            $("#a-chevron-top").attr('hidden', true);
        }
    });
    $("#a-chevron-top").click(function () {
        $('body,html').animate({scrollTop: 0}, 100);
        return false;
    });
    //推送连接到百度
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
</body>
</html>
