@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-2">
            <div class="col">
                <div class="card card-default">
                    <div class="card-header">搜索条件</div>
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-1">
                                <button type="button" class="btn btn-light disabled">搜索</button>
                            </div>
                            <div class="col-11">
                                <form action="{{ route('book_lists.search') }}">
                                    <div class="input-group">
                                        <input type="text" value="{{$search_data['search_value']}}"
                                               class="form-control border-primary" name="search_value"
                                               placeholder="书单名">
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
                    <div class="card-body text-center">
                        <div class="row">
                            @forelse ($book_lists as $book_list)
                                <div class="col-sm-3">
                                    <a href="{{ route('book_lists.show',['id'=>$book_list->id]) }}" class="btn btn-primary">
                                        <span class="text-truncate text-capitalize">{{ $book_list->name }}</span>
                                        <span class="badge badge-light">{{ count(explode(',',$book_list->book_ids)) }}</span>
                                    </a>
                                </div>
                            @empty
                                <div class="clearfix" style="display: block;margin: 0 auto">
                                    没有搜索到任何书单,<a href="{{ url('book_lists') }}">去逛逛</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="clearfix">
                {{ $book_lists->appends($search_data)->links() }}
            </div>
        </div>
    </div>
@endsection
