@extends('user._layout')
@section('content')

<div class="content-wrapper">
    <h3>{{__('公告')}}</h3>
    <div class="panel panel-default">
            <h2 class="text-lg">
                {{ $news->title }}
            </h2>
            <p class="clearfix">
                <span class="pull-left"><small class="mr-sm">
                {{ $news->created_at }}</small> </span>
            </p>
            {!! $news->content !!}
    </div>
</div>
@endsection