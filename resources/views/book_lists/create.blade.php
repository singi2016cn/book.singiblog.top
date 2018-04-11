@extends('layouts.app')

@section('link')
    <link rel="stylesheet" href="{{ asset('plug_in/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <button class="btn btn-light">发布新的书单</button>
                    <a href="{{url('book_lists')}}" class="btn btn-outline-info float-right">返回</a>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('book_lists.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md">
                            <label for="title">书单名</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name" placeholder="请输入书单名" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback ml-1" >
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md">
                            <label for="book_id">书名</label>
                            <select multiple="multiple" class="form-control {{ $errors->has('book_id') ? 'is-invalid' : 'is-valid' }}" id="book_id" name="book_id[]">
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
                placeholder: "请选择或输入书名",
                tags: true
            });
        });
    </script>
@endsection

