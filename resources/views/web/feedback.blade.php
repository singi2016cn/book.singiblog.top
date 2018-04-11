@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <button class="btn btn-light">提交反馈建议</button>
                    <a href="{{url()->previous()}}" class="btn btn-outline-info float-right">返回</a>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="title">标题</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('title') ? 'is-invalid' : 'is-valid' }}"
                                               id="title" name="title" placeholder="请输入标题" value="{{ old('title') }}">
                                        @if ($errors->has('title'))
                                            <div class="invalid-feedback ml-1">
                                                {{ $errors->first('title') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="content">反馈建议</label>
                                        <textarea
                                                class="form-control {{ $errors->has('content') ? 'is-invalid' : 'is-valid' }}"
                                                id="content" name="content" placeholder="请输入反馈建议"
                                                rows="10">{{ old('content') }}</textarea>
                                        @if ($errors->has('content'))
                                            <div class="invalid-feedback ml-1">
                                                {{ $errors->first('content') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="contact">联系方式</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('contact') ? 'is-invalid' : 'is-valid' }}"
                                               id="contact" name="contact" placeholder="请输入联系方式"
                                               value="{{ old('contact') }}">
                                        @if ($errors->has('contact'))
                                            <div class="invalid-feedback ml-1">
                                                {{ $errors->first('contact') }}
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
            }, {
                type: 'success',
                placement: {
                    align: "center"
                }
            });
        </script>
    @endif
@endsection

