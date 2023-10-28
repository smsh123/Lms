@extends('layouts.front')
@section('body')
@include('layouts.global_header')
 
<div class="container py-3">
  @if(!empty($pages))
    <ul class="list-group">
      @foreach ($pages as $page)
        <li class="list-group-item"><a href="{{!empty($page->slug) ? "/pages/".$page->slug : ''}}">{{!empty($page->name) ? $page->name : ''}}</a></li>
      @endforeach
    </ul>
  @else
    <div class="alert alert-warning text-center font-weight-bold">No Custom Pages Added!</div>
  @endif
</div>
@stop