@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Schedule A Class</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/schedule" class="btn btn-lg btn-secondary">View Schedules</a></div>
  </div>


  <form class="card" method="post" action="/cms/schedule/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Select Course</label>
          <select id="course_select" class="form-control" onchange="CustomFunctions.getCourseModule('course_select','module_select')" name="course">
            <option>Select</option>
            @if(!empty($courses))
              @foreach ($courses as $course)
                <option data-id="{{ !empty($course['_id']) ? $course['_id'] : '' }}" data-slug="{{ !empty($course['slug']) ? $course['slug'] : '' }}">{{ !empty($course['name']) ? $course['name'] : '' }}</option>
              @endforeach
            @endif
          </select>
          <input id="course_id" type="hidden" name="course_id" />
          @if ($errors->has('course_id'))
            <p class="text-danger">{{ $errors->first('course_id') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Select Module</label>
          <select id="module_select" class="form-control" onchange="CustomFunctions.getCourseSubModule('module_select','subModule_select')" name="module"><option>Select</option></select>
          <input id="module_id" type="hidden" name="module_id" />
          @if ($errors->has('module_id'))
            <p class="text-danger">{{ $errors->first('module_id') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Select Course</label>
          <select id="subModule_select" class="form-control" name="sub_module">
            <option>Select</option>
          </select>
          <input id="submodule_id" type="hidden" name="submodule_id" />
          @if ($errors->has('submodule_id'))
            <p class="text-danger">{{ $errors->first('submodule_id') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Select Module</label>
          <input type="date" class="form-control" name="class_start_time" />
          @if ($errors->has('class_start_time'))
            <p class="text-danger">{{ $errors->first('class_start_time') }}</p>
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