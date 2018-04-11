@component('mail::message')

# {{$rights->title}}

@component('mail::panel')
{{$rights->reason}}
@endcomponent

> 联系方式： {{$rights->contact}}

> 日期：{{$rights->created_at}}
@endcomponent