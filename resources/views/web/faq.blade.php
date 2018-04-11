@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">FAQ</div>
                    <div class="card-body ml-4">

                        <h5>如何使用本站?</h5>
                        <p>1 作为寻找书籍的网友，你可以到 <a href="{{ url('books/search') }}">搜索书籍</a> 页面，根据
                            <mark>书名</mark>
                            <mark>作者</mark>
                            <mark>ISBN</mark>
                            <mark>出版社</mark>
                            可以快速找到自己想要的资源。
                        </p>
                        <p>2 作为想要贡献资源的网友，首先，你可以搜索到想要贡献链接的书籍详情页，然后就可以看到提交下载链接的按钮。</p>

                        <h5>下载链接那么多，我该如何选择？</h5>
                        <p>所有的下载链接会根据下载次数，上传时间降序，并且受到网友提交的 <strong style="text-success">赞</strong> or <strong
                                    class="text-secondary">踩</strong>的影响。</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
