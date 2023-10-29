@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-12"><h1>Create Course Module Mapping</h1></div>
  </div>
  <div class="card">
    <div class="card-heading">
      <form method="post" action="/cms/course-module-mapping/store" class="p-3">
        <div class="row d-flex align-items-stretch flex-wrap">
          <div class="col-12 col-md-6 col-lg-4 align-self-center">
            <div class="form-group mb-0">
              <label>Select Course</label>
              <select class="form-control" name="course">
                <option>Select Course</option>
                @if(!empty($courses))
                  @foreach ($courses as $course)
                    <option value="{{ !empty($course['id']) ? $course['id'] : '' }}">{{ !empty($course['name']) ? $course['name'] : '' }}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 align-self-end text-right">
            <input type="button" value="Create Mapping" class="btn btn-primary" />
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Selected Modules</label>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="card-body">
      @if(!empty($modules))
        <ul class="list-group row">
          @foreach ($modules as  $key => $module)
            <li class="list-group-item col-12 col-md-6 col-lg-4">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $key }}" value="{{ !empty($module['id']) ? $module['id'] : '' }}">
                <label class="form-check-label" for="inlineCheckbox{{ $key }}">{{ !empty($module['name']) ? $module['name'] : '' }}</label>
              </div>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>

@stop