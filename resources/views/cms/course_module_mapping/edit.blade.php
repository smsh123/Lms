@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-12"><h1>Edit Course Module Mapping</h1></div>
  </div>
  <div class="card">
    <div class="card-header">
      <form method="post" action="/cms/course-module-mapping/update" class="p-3">
      @csrf
        <input type="hidden" name="id" value="{{!empty($mappings['id']) ? $mappings['id'] : ''}}" />
        <div class="row d-flex align-items-stretch flex-wrap">
          <div class="col-12 col-md-6 col-lg-6 align-self-center">
            <div class="form-group mb-0">
              <label>Select Course</label>
              <select class="form-control" name="course">
                <option>Select Course</option>
                @if(!empty($courses))
                  @foreach ($courses as $course)
                    <option {{ !empty($mappings['course']) && $mappings['course'] == $course['id'] ? "selected" : '' }} value="{{ !empty($course['id']) ? $course['id'] : '' }}">{{ !empty($course['name']) ? $course['name'] : '' }}</option>
                  @endforeach
                @endif
              </select>
              @if ($errors->has('course'))
                <p class="text-danger">{{ $errors->first('course') }}</p>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-6 align-self-end text-left">
            <input type="submit" value="Update Mapping" class="btn btn-primary" />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="form-group">
              <label>Selected Modules</label>
              <ul id="selected_input" class="list-no-style p-0 m-0">
                @if(!empty($mappings['modules']))
                  @foreach ($mappings['modules'] as $key => $module)
                    <li class='d-inline-block mx-2 mb-2'><input type='hidden' id='{{ !empty($module['id']) ? $module['id'] : ''  }}' value='{{ !empty($module['id']) ? $module['id'] : ''  }}' name='module_id[{{ $key }}]' readonly /><input type='text' name='module_name[{{$key}}]' class='btn btn-outline-info rounded-pill' value='{{!empty($module['moduleName']) ?$module['moduleName'] : ""}}' readonly /></li>
                  @endforeach
                @endif
              </ul>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="card-body">
      @if(!empty($modules))
        <ul class="list-group row" style="flex-direction:row;">
          @foreach ($modules as  $key => $module)
            <li class="list-group-item col-12 col-md-6 col-lg-4 border">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $key }}" value="{{ !empty($module['id']) ? $module['id'] : '' }}" name="check_select" onChange="selectForMap(this,'selected_input')" data-label="{{ !empty($module['name']) ? $module['name'] : '' }}"  @if(!empty($mappings['modules'])) @foreach ($mappings['modules'] as $moduleArray) @if($moduleArray['moduleId'] == $module['id']) checked @endif @endforeach  @endif>
                <label class="form-check-label" for="inlineCheckbox{{ $key }}">{{ !empty($module['name']) ? $module['name'] : '' }}</label>
              </div>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>


@stop