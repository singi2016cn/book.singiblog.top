@extends('layouts.app')

@section('link')
    <link rel="stylesheet" href="{{ asset('plug_in/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <button class="btn btn-light">发布新的句子</button>
                    <a href="{{url('sentences')}}" class="btn btn-outline-info float-right">返回</a>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('sentences.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md">
                            <label for="content">句子</label>
                            <input type="text" class="form-control {{ $errors->has('content') ? 'is-invalid' : 'is-valid' }}" id="content" name="content" placeholder="请输入句子" value="{{ old('content') }}">
                            @if ($errors->has('content'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('content') }}
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
                            <label for="book_id">出自书籍</label>
                            <select class="form-control {{ $errors->has('book_id') ? 'is-invalid' : 'is-valid' }}" id="book_id" name="book_id">
                                <option value=""></option>
                                @foreach($books as $k=>$v)
                                    <option value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('book_id'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('book_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md">
                            <label for="tag_id">标签</label>
                            <select multiple="multiple" class="form-control {{ $errors->has('tag_id') ? 'is-invalid' : 'is-valid' }}" id="tag_id" name="tag_ids[]">
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
            $('#book_id').select2({
                language: "zh-CN",
                placeholder: "请选择或输入出自书籍",
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

