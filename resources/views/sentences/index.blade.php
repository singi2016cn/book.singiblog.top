@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-2">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <button class="btn btn-light">句子</button>
                        <span class="float-right">
                            <a class="btn btn-primary" href="{{ url('sentences/create') }}">发表句子</a>
                            <a class="btn btn-primary" href="{{ url('sentences/search') }}">更多</a>
                        </span>
                    </div>

                    @foreach ($sentences as $sentence)
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
                    @endforeach
                </div>
            </div>
            <div class="text-center mt-4">
                {{ $sentences->links() }}
            </div>
        </div>
    </div>
@endsection
