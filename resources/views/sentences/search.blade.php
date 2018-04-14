@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-2">
            <div class="col">
                <div class="card card-default">
                    <div class="card-header">搜索条件</div>
                    <div class="card-body">
                        {{--<div class="row">
                            <div class="col-1">
                                <button type="button" class="btn btn-light disabled">标签</button>
                            </div>
                            <div class="col-11">
                                <a class="btn @if(!$search_data['tag_id']) btn-primary @else btn-outline-primary @endif mb-2"
                                   href="{{ route('books.search',['category'=>$search_data['category'],'orderBy'=>$search_data['orderBy'],'search_value'=>$search_data['search_value']]) }}">不限</a>
                                @foreach($tags as $k=>$v)
                                    <a class="btn @if($search_data['tag_id'] == $k) btn-primary @else btn-outline-primary @endif mb-2"
                                       href="{{ route('books.search',['category'=>$search_data['category'],'tag_id'=>$k,'publish_id'=>$search_data['publish_id'],'orderBy'=>$search_data['orderBy'],'search_value'=>$search_data['search_value']]) }}">{{$v}}</a>
                                @endforeach
                            </div>
                        </div>--}}
                        <div class="row mt-2">
                            <div class="col-1">
                                <button type="button" class="btn btn-light disabled">搜索</button>
                            </div>
                            <div class="col-11">
                                <form action="{{ route('sentences.search') }}">
                                    <div class="input-group">
                                        <input type="text" value="{{$search_data['search_value']}}"
                                               class="form-control border-primary" name="search_value"
                                               placeholder="句子">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="submit">搜索</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">搜索结果</div>
                    <div class="card-body">
                        @forelse ($sentences as $sentence)
                            <div class="card-body text-center">
                                <blockquote class="blockquote">
                                    <p class="m-2 text-truncate">{{ $sentence->content }}</p>
                                    <footer class="blockquote-footer mb-2">
                                        @if($sentence->author)
                                            <cite title="Source Title">{{ $sentence->author }}</cite>
                                        @else
                                            <cite title="Source Title">佚名</cite>
                                        @endif
                                        @if($sentence->book)
                                            <span class="small col-4">《{{ $sentence->book }}》</span>
                                        @endif
                                    </footer>
                                    {{--<footer class="small">
                                        <span class="badge badge-pill badge-primary">励志</span>
                                        <span class="badge badge-pill badge-secondary">感悟</span>
                                        <span class="badge badge-pill badge-success">哲理</span>
                                        <span class="badge badge-pill badge-danger">残忍</span>
                                        <span class="badge badge-pill badge-warning">伤感</span>
                                        <span class="badge badge-pill badge-info">睿智</span>
                                        <span class="badge badge-pill badge-light">消极</span>
                                        <span class="badge badge-pill badge-dark">黑暗</span>
                                    </footer>--}}
                                </blockquote>
                            </div>
                            @if(!$loop->last)
                                <hr>
                            @endif
                        @empty
                            <div class="row">
                                <div class="clearfix" style="display: block;margin: 0 auto">
                                    没有搜索到任何句子
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="clearfix">
                {{ $sentences->appends($search_data)->links() }}
            </div>
        </div>
    </div>
@endsection
