@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <button class="btn btn-light">添加新的下载链接</button>
                    <a href="{{url('books',['id'=>$books_id])}}" class="btn btn-outline-info float-right">返回</a>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form action="{{ route('book_download_links.store') }}" method="post">
                                @csrf
                                <input type="text" name="books_id" value="{{$books_id}}" hidden>
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="type">下载类型</label>
                                        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : 'is-valid'}} " name="type" id="type">
                                            @foreach ($type as $t_i => $t_v)
                                                <option value="{{ $t_i }}" @if( old('type') == $t_i) selected @endif>{{ $t_v }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type'))
                                            <div class="invalid-feedback ml-1">
                                                {{ $errors->first('type') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="url">下载链接</label>
                                        <input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : 'is-valid' }}" id="url" name="url" placeholder="请输入下载链接" value="{{ old('url') }}">
                                        @if ($errors->has('url'))
                                            <div class="invalid-feedback ml-1" >
                                                {{ $errors->first('url') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="url_key">下载链接密码</label>
                                        <input type="text" class="form-control {{ $errors->has('url_key') ? 'is-invalid' : 'is-valid' }}" id="url_key" name="url_key" placeholder="请输入下载链接密码" value="{{ old('url_key') }}">
                                        @if ($errors->has('url_key'))
                                            <div class="invalid-feedback ml-1" >
                                                {{ $errors->first('url_key') }}
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
    @if(Session::has('msg'))
        <script>
            $.notify({
                message: '{{Session::get('msg')}}'
            },{
                type: 'success',
                placement: {
                    align: "center"
                }
            });
        </script>

    @endif
@endsection

