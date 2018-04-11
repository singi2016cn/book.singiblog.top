@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row justify-content-center mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-center">
                            书单-{{ $book_list->name }}
                        </div>
                        <div class="list-group">
                            @foreach($book_list->books as $book)
                            <a href="{{ route('books.show',['id'=>$book->id]) }}" class="list-group-item list-group-item-action">
                                <div class="media">
                                    <img class="mr-3" style="width: 12%" src="{{ $book->cover }}" alt="{{ $book->title }}">
                                    <div class="media-body">
                                        <h5>{{ $book->title }}</h5>
                                        <h6>{{ $book->author }} {{ $book->publish }}</h6>
                                        @foreach($book->tags as $tag)
                                            <span class="badge badge-primary">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                            @endforeach
                            <div>
                                {{ $book_list->books->links() }}
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {{ $book_list->created_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
