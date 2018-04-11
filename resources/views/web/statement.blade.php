@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header">网站声明</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="list-group-item">
                            <h5>开源共享</h5>
                            <p>本着互联网的分享精神，致力于收集，分享书籍，并提供下载或购买链接</p>
                            <p>本站的大部分书籍信息都来自互联网，使用爬虫进行数据采集。</p>
                        </li>
                        <li class="list-group-item">
                            <h5>无认证网站</h5>
                            <p>本站所有功能对所有网友都是开放的，即本站对所有网友来说是匿名的，或者说是独享的体验。</p>
                            <p>本站的主要功能是协作完成的，获得的成果所有网友共享，不附加任何代价。</p>
                        </li>
                        <li class="list-group-item">
                            <h5>我们的口号</h5>
                            <p>我们不写书，我们只是搬运书</p>
                        </li>
                        <li class="list-group-item">
                            <h5>接受捐赠</h5>
                            <p>本站承诺将所获取的捐赠用于提供更好的服务。</p>
                            <p>捐赠者可以出现的捐赠墙上（可以提供名称和logo），并可以与本站交换链接。<a href="{{ url('donate') }}">慷慨解囊</a></p>
                        </li>
                        <li class="list-group-item">
                            <h5>关于侵权</h5>
                            <p>如果本网站侵犯了您的合法权益，请向我们提交书面通知，我们将第一时间做出处理，谢谢您的理解。<a href="{{ url('rights') }}"></a></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
