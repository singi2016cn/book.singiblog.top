@extends('layouts.app')

@section('link')
    <link rel="stylesheet" href="{{ asset('plug_in/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <button class="btn btn-light">发布新的书籍</button>
                    <a href="{{url('books')}}" class="btn btn-outline-info float-right">返回</a>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('books.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md">
                            <label for="category">分类(杜威十进制图书分类法<a href="https://baike.baidu.com/item/%E6%9D%9C%E5%A8%81%E5%8D%81%E8%BF%9B%E5%88%B6%E5%9B%BE%E4%B9%A6%E5%88%86%E7%B1%BB%E6%B3%95/6273918?fr=aladdin" target="_blank">?</a>)</label>
                            <select class="form-control {{ $errors->has('category') ? 'is-invalid' : 'is-valid'}} " name="category" id="category">
                                @foreach ($categories as $k=>$v)
                                    <option value="{{ $k }}" @if( old('category') == $k) selected @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md">
                            <label for="title">书名</label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : 'is-valid' }}" id="title" name="title" placeholder="请输入书名" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md">
                            <label for="cover">封面图</label>
                            <input type="text" class="form-control {{ $errors->has('cover') ? 'is-invalid' : 'is-valid' }}" id="cover" name="cover" placeholder="请输入封面图url" value="{{ old('cover') }}">
                            @if ($errors->has('cover'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('cover') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md">
                            <label for="author">作者</label>
                            <input type="text" class="form-control {{ $errors->has('author') ? 'is-invalid' : 'is-valid' }}" id="author" name="author" placeholder="请输入作者名" value="{{ old('author') }}">
                            @if ($errors->has('author'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('author') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md">
                            <label for="isbn">国际标准书号(ISBN)</label>
                            <input type="text" class="form-control {{ $errors->has('isbn') ? 'is-invalid' : 'is-valid' }}" id="isbn" name="isbn" placeholder="请输入国际标准书号(ISBN)" value="{{ old('isbn') }}">
                            @if ($errors->has('isbn'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('isbn') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md">
                            <label for="publish_id">出版社</label>
                            <select class="form-control {{ $errors->has('publish_id') ? 'is-invalid' : 'is-valid' }}" id="publish_id" name="publish_id">
                                <option value=""></option>
                                @foreach($publishes as $k=>$v)
                                    <option value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('publish_id'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('publish_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md">
                            <label for="tag_id">标签</label>
                            <select multiple="multiple" class="form-control {{ $errors->has('tag_id') ? 'is-invalid' : 'is-valid' }}" id="tag_id" name="tag_id[]">
                                @foreach($tags as $k=>$v)
                                    <option value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tag_id'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('tag_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md mt-4 text-center">
                            <button class="btn btn-primary" type="submit">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('plug_in/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plug_in/select2/js/i18n/zh-CN.js') }}"></script>
@endsection

@section('script_code')
    <script>
    @if(Session::has('msg'))
        $.notify({
            message: '{{Session::get('msg')}}'
        },{
            type: 'success',
            placement: {
                align: "center"
            }
        });
    @endif
        $(document).ready(function() {
            $('#publish_id').select2({
                language: "zh-CN",
                placeholder: "请选择或输入出版社",
                tags: true
            });
            $('#tag_id').select2({
                language: "zh-CN",
                placeholder: "请选择或输入标签",
                tags: true
            });
        });
    </script>
@endsection

