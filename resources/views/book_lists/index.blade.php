@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <button class="btn btn-light">所有书单</button>
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ url('book_lists/create') }}">发表书单</a>
                        <a class="btn btn-primary" href="{{ url('book_lists/search') }}">更多</a>
                    </span>
                </div>

                <div class="card-body text-center">
                    <div class="row">
                        @foreach ($book_lists as $book_list)
                            <div class="col-sm-3">
                                <a href="{{ route('book_lists.show',['id'=>$book_list->id]) }}" class="btn btn-primary">
                                    <span class="text-truncate text-capitalize">{{ $book_list->name }}</span>
                                    <span class="badge badge-light">{{ count(explode(',',$book_list->book_ids)) }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="m-4">
            {{ $book_lists->links() }}
        </div>
    </div>
</div>
@endsection
