@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  @include('layouts.home_banner')
  @include('layouts.feature_section')
  @if(!empty($courses))
    @include('layouts.course_slider')
  @endif
  @include('layouts.study_materials')
  @include('layouts.success_stories')
  @include('layouts.mentors')
  @if(!empty($blogs))
    @include('layouts.story_slider')
  @endif
  @include('layouts.testimonial')
  @include('layouts.footer')
@stop

