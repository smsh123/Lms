@extends('layouts.front')
@section('body')
@include('layouts.global_header')
 
<div class="container py-3">
  @if(!empty($page_content))
  @php $page_content @endphp
    {{ !empty($page_content['name']) ? $page_content['name'] : ''  }}
    {!! $page_content['description'] !!}
  @else
    <div class="alert alert-warning text-center font-weight-bold">No Custom Pages Added!</div>
  @endif
</div>
@stop