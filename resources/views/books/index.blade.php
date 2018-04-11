@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-2">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <button class="btn btn-light">最热</button>
                    <span class="float-right"><a class="btn btn-primary" href="{{ url('books/search') }}">更多</a></span>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($books_hot as $book)
                            <div class="col-sm-3">
                                <div class="card">
                                    <img class="card-img-top p-2" src="{{ $book->cover }}" alt="{{ $book->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                                        <a href="{{ route('books.show',['id'=>$book->id]) }}" class="btn btn-primary">详情</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-2">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <button class="btn btn-light">最新</button>
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ url('books/search') }}">更多</a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($books_new as $book)
                            <div class="col-sm-3">
                                <div class="card">
                                    <img class="card-img-top p-2" src="{{ $book->cover }}" alt="{{ $book->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                                        <a href="{{ route('books.show',['id'=>$book->id]) }}" class="btn btn-primary">详情</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
