@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-2">
                <div class="card card-default">
                    <div class="card-header">书籍详情</div>
                    <div class="card-body">
                        <div class="media">
                            <img class="align-self-start mr-4" width="150px"
                                 src="{{$book->cover or asset('img/default.jpg')}}" alt="{{$book->title}}">
                            <div class="media-body mt-2">
                                <h5 class="mt-0">{{$book->title}}</h5>
                                <p>{{$book->author}}  @empty(!$book->publish_id){{ $publishes[$book->publish_id] }}@endempty</p>
                                <p>{{$book->series}}  @empty(!$book->publish_date){{$book->publish_date}}出版@endempty</p>
                                {{-- TODO 完善信息和纠错
                                @if(!$book->publish_id)
                                    <a href="#" class="btn btn-primary">书籍信息完善</a>
                                @endif
                                <a href="#" class="btn btn-warning">书籍信息有误</a>
                                --}}
                                @foreach($tags as $k=>$v)
                                    <span class="badge badge-warning">{{$v}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card card-default">
                    <div class="card-header">
                        <button class="btn btn-light">下载列表</button>
                        @if(!$book_download_links->isEmpty())
                            <a href="{{route('book_download_links.create',['books_id'=>$book->id])}}"
                               class="btn btn-outline-primary float-right">贡献新下载链接</a>
                        @endif
                    </div>
                    @if($book_download_links->isEmpty())
                        <div class="card-body" style="display: block;margin: 0 auto">
                            <div class="text-center mb-2">
                                <a href="{{route('book_download_links.create',['books_id'=>$book->id])}}"
                                   class="btn btn-outline-success">贡献第1个下载链接</a>
                            </div>
                        </div>
                    @else
                        <div class="card-body" style="display: block;margin: 0 auto">
                            @foreach($book_download_links as $book_download_link)
                                @if($book_download_link->type == 1)
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-primary">{{$type[$book_download_link->type]}}</span>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text border-primary">{{$book_download_link->url}}</span>
                                            @if($book_download_link->url_key)
                                                <span class="input-group-text border-primary"
                                                      id="url_key{{$book_download_link->id}}">{{$book_download_link->url_key}}</span>
                                                <button data-toggle="tooltip" title="复制密码" id="copy-button"
                                                        data-clipboard-target="url_key{{$book_download_link->id}}"
                                                        class="btn btn-outline-success"><span
                                                            class="oi oi-copywriting"></span>
                                                </button>
                                            @endif
                                            <a data-toggle="tooltip" title="下载" href="{{$book_download_link->url}}"
                                                    class="btn btn-outline-success"
                                                    target="_blank"
                                                    onclick="update_download_count({{$book_download_link->id}})"><span
                                                        class="oi oi-data-transfer-download"></span></a>
                                            <button data-toggle="tooltip" title="踩" href="{{ url('star/down') }}"
                                                    onclick="update_download_count({{$book_download_link->id}},2)"
                                                    class="btn btn-outline-danger"><span
                                                        class="oi oi-thumb-down"></span></button>
                                            <button data-toggle="tooltip" title="赞" href="{{ url('star/up') }}"
                                                    onclick="update_download_count({{$book_download_link->id}})"
                                                    class="btn btn-outline-success"><span class="oi oi-thumb-up"></span>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-primary">{{$type[$book_download_link->type]}}</span>
                                        </div>
                                        <div class="input-group-append">
                                            <a href="{{$book_download_link->url}}" data-toggle="tooltip" title="下载"
                                               class="btn btn-outline-success"
                                               target="_blank"><span class="oi oi-data-transfer-download"></span></a>
                                            <button data-toggle="tooltip" title="踩" href="{{ url('star/down') }}"
                                                    onclick="update_download_count({{$book_download_link->id}},2)"
                                                    class="btn btn-outline-danger"><span
                                                        class="oi oi-thumb-down"></span></button>
                                            <button data-toggle="tooltip" title="赞" href="{{ url('star/up') }}"
                                                    onclick="update_download_count({{$book_download_link->id}})"
                                                    class="btn btn-outline-success"><span class="oi oi-thumb-up"></span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_code')
    <script>
        var client = new ZeroClipboard(document.getElementById('copy-button'));
        ZeroClipboard.config({swfPath: "{{ asset('plug_in/ZeroClipboard.swf') }}"});
        client.on('ready', function (event) {
            //console.log(event);
            client.on('aftercopy', function (event) {
                //console.log(event);
                $.notify({
                    message: '已复制到剪贴板'
                }, {
                    type: 'success',
                    placement: {
                        align: "center"
                    }
                });
            });
        });
        client.on('error', function (event) {
            //console.log( 'ZeroClipboard error of type "' + event.name + '": ' + event.message );
            ZeroClipboard.destroy();
        });

        function update_download_count(book_download_link_id, type) {
            console.log(book_download_link_id);
            if (book_download_link_id <= 0) return false;
            if (!type) type = 1;
            $.get('{{url("book_download_links/update_download_count")}}/' + book_download_link_id + '/' + type, function (res) {
                console.log(res);
            }, 'json');
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
