@component('mail::message')
# {{$feedback->title}}

@component('mail::panel')
    {{$feedback->content}}
@endcomponent

> 联系方式：{{$feedback->contact}}

> 日期：{{ $feedback->created_at }}
@endcomponent
