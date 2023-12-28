@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  @include('layouts.home_banner')
  @include('layouts.feature_section')
  @if(!empty($courses))
    @include('layouts.course_slider')
  @endif
  @include('layouts.study_materials')
  @if ($successStories)
    @include('layouts.success_stories')
  @endif
  @if (!empty($teachers))
    @include('layouts.mentors')
  @endif
  @if(!empty($blogs))
    @include('layouts.story_slider')
  @endif
  @if(!empty($videoTestimonial))
    @include('layouts.testimonial')
  @endif
  @include('layouts.footer')
@stop

