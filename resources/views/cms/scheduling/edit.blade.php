@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Edit Schedule</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/schedule" class="btn btn-lg btn-secondary">View Schedule</a></div>
  </div>
  <form class="card" method="post" action="/cms/courses/update">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Select Course</label>
          <input type="text" class="form-control" name="name" placeholder="Course Name" value="{{$course->name}}"/>
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Course Name Hindi</label>
          <input type="text" class="form-control" name="name_hn" placeholder="Course Name Hindi" value="{{$course->name_hn}}" />
          @if ($errors->has('name_hn'))
          <p class="text-danger">{{ $errors->first('name_hn') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 text-center">
          <input type="submit" class="btn btn-lg btn-primary" value="Submit" />
        </div>
      </div>
    </div>
  </form>

@stop