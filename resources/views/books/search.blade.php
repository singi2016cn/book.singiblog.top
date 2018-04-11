@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-2">
            <div class="col">
                <div class="card card-default">
                    <div class="card-header">搜索条件</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <button type="button" class="btn btn-light disabled">分类</button>
                            </div>
                            <div class="col-11">
                                <a class="btn @if(!$search_data['category']) btn-primary @else btn-outline-primary @endif mb-2"
                                   href="{{ route('books.search',['tag_id'=>$search_data['tag_id'],'orderBy'=>$search_data['orderBy'],'search_value'=>$search_data['search_value']]) }}">不限</a>
                                @foreach($categories as $category)
                                    <a class="btn @if($category->id == $search_data['category']) btn-primary @else btn-outline-primary @endif mb-2"
                                       href="{{ route('books.search',['category'=>$category->id,'tag_id'=>$search_data['tag_id'],'publish_id'=>$search_data['publish_id'],'orderBy'=>$search_data['orderBy'],'search_value'=>$search_data['search_value']]) }}">{{$category->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <button type="button" class="btn btn-light disabled">出版社</button>
                            </div>
                            <div class="col-11">
                                <a class="btn @if(!$search_data['publish_id']) btn-primary @else btn-outline-primary @endif mb-2"
                                   href="{{ route('books.search',['category'=>$search_data['category'],'tag_id'=>$search_data['tag_id'],'orderBy'=>$search_data['orderBy'],'search_value'=>$search_data['search_value']]) }}">不限</a>
                                @foreach($publishes as $k=>$v)
                                    <a class="btn @if($search_data['publish_id'] == $k) btn-primary @else btn-outline-primary @endif mb-2"
                                       href="{{ route('books.search',['category'=>$search_data['category'],'tag_id'=>$search_data['tag_id'],'publish_id'=>$k,'orderBy'=>$search_data['orderBy'],'search_value'=>$search_data['search_value']]) }}">{{$v}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <button type="button" class="btn btn-light disabled">排序</button>
                            </div>
                            <div class="col-11">
                                <a class="btn @if($search_data['orderBy'] == 0) btn-primary @else btn-outline-primary @endif mb-2"
                                   href="{{ route('books.search',['category'=>$search_data['category'],'tag_id'=>$search_data['tag_id'],'publish_id'=>$search_data['publish_id'],'orderBy'=>0,'search_value'=>$search_data['search_value']]) }}">不限</a>
                                <a class="btn @if($search_data['orderBy'] == 1) btn-primary @else btn-outline-primary @endif mb-2"
                                   href="{{ route('books.search',['category'=>$search_data['category'],'tag_id'=>$search_data['tag_id'],'publish_id'=>$search_data['publish_id'],'orderBy'=>1,'search_value'=>$search_data['search_value']]) }}">最热</a>
                                <a class="btn @if($search_data['orderBy'] == 2) btn-primary @else btn-outline-primary @endif mb-2"
                                   href="{{ route('books.search',['category'=>$search_data['category'],'tag_id'=>$search_data['tag_id'],'publish_id'=>$search_data['publish_id'],'orderBy'=>2,'search_value'=>$search_data['search_value']]) }}">最新</a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-1">
                                <button type="button" class="btn btn-light disabled">搜索</button>
                            </div>
                            <div class="col-11">
                                <form action="{{ route('books.search') }}">
                                    <div class="input-group">
                                        <input type="text" name="category" value="{{$search_data['category']}}" hidden>
                                        <input type="text" name="orderBy" value="{{$search_data['orderBy']}}" hidden>
                                        <input type="text" value="{{$search_data['search_value']}}"
                                               class="form-control border-primary" name="search_value"
                                               placeholder="书名/作者/出版社/ISBN">
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
                        @forelse ($books as $book)
                            <div class="row">
                                <div class="col-4 text-center mb-2">
                                    <img class="rounded" style="width: 150px" src="{{ $book->cover }}"
                                         alt="{{ $book->title }}">
                                </div>
                                <div class="col-8 mt-2">
                                    <h5 class="text-truncate">{{ $book->title }}</h5>
                                    <p>
                                        {{ $book->author }}
                                        @empty(!$book->publish_id){{ $publishes[$book->publish_id] }}@endempty
                                        <span class="badge badge-warning">下载次数{{$book->download_count}}</span>
                                    </p>
                                    <a href="{{ route('books.show',['id'=>$book->id]) }}" class="btn btn-primary">详情</a>
                                </div>
                            </div>
                            <hr>
                        @empty
                            <div class="row">
                                <div class="clearfix" style="display: block;margin: 0 auto">
                                    没有搜索到任何书籍
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="clearfix">
                {{ $books->appends($search_data)->links() }}
            </div>
        </div>
    </div>
@endsection
