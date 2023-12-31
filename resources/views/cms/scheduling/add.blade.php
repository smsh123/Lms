@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Schedule A Class</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/schedule" class="btn btn-lg btn-secondary">View Schedules</a></div>
  </div>


  <form class="card" method="post" action="/cms/schedule/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Select Course</label>
          <select id="course_select" class="form-control" onchange="CustomFunctions.getCourseModule('course_select','module_select','course_id')" name="course">
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
          <select id="module_select" class="form-control" onchange="CustomFunctions.getCourseSubModule('module_select','subModule_select','module_id')" name="module"><option>Select</option></select>
          <input id="module_id" type="hidden" name="module_id" />
          @if ($errors->has('module_id'))
            <p class="text-danger">{{ $errors->first('module_id') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Select Sub Module</label>
          <select id="subModule_select" class="form-control" name="sub_module">
            <option>Select</option>
          </select>
          @if ($errors->has('sub_module'))
            <p class="text-danger">{{ $errors->first('sub_module') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Class Start Time</label>
          <input type="datetime-local" class="form-control" name="class_start_time" />
          @if ($errors->has('class_start_time'))
            <p class="text-danger">{{ $errors->first('class_start_time') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Class End Time</label>
          <input type="datetime-local" class="form-control" name="class_end_time" />
          @if ($errors->has('class_end_time'))
            <p class="text-danger">{{ $errors->first('class_end_time') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Select Teacher</label>
          <select id="teacher_select_btn" class="form-control" name="teacher" onchange="selectTeacher('teacher_select_btn','teacher_id_input')">
            <option>Select</option>
            @if(!empty($teachers))
              @foreach ($teachers as $key => $teacher)
                  <option data-id="{{ !empty($teacher['_id']) ? $teacher['_id'] : '' }}">{{ !empty($teacher['name']) ? $teacher['name'] : '' }}</option>
              @endforeach
            @endif
          </select>
          <input id="teacher_id_input" type="hidden" name="teacher_id" />
          @if ($errors->has('teacher_id'))
            <p class="text-danger">{{ $errors->first('teacher_id') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Video ID</label>
          <input type="text" class="form-control" name="video_id" placeholder="Video ID" />
          @if ($errors->has('video_id'))
            <p class="text-danger">{{ $errors->first('video_id') }}</p>
          @endif
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Video Type</label>
          <select class="form-control" name="video_type">
            <option value="yt">Youtube</option>
          </select>
          @if ($errors->has('video_type'))
            <p class="text-danger">{{ $errors->first('video_type') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Ebook (PDF)</label>
          <input type="text" class="form-control" name="study_material" placeholder="Study Material Url" />
          @if ($errors->has('study_material'))
            <p class="text-danger">{{ $errors->first('study_material') }}</p>
          @endif
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Class Type</label>
          <select class="form-control" name="class_type">
            <option value="live">Live</option>
            <option value="recorded">Recorded</option>
          </select>
          @if ($errors->has('class_type'))
            <p class="text-danger">{{ $errors->first('class_type') }}</p>
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