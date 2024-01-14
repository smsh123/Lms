@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-12"><h1 class="font-weight-bold font-32 my-3 text-warning">Create Course Testimonial Mapping</h1></div>
  </div>
  <div class="card">
    <div class="card-header">
      <form method="post" action="/cms/course-testimonial-mapping/store" class="p-3">
      @csrf
        <div class="row d-flex align-items-stretch flex-wrap">
          <div class="col-12 col-md-6 col-lg-6 align-self-center">
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
              @if ($errors->has('course'))
                <p class="text-danger">{{ $errors->first('course') }}</p>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-6 align-self-end text-left">
            <input type="submit" value="Create Mapping" class="btn btn-primary" />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="form-group">
              <label>Selected Faqs</label>
              <ul id="selected_input" class="list-no-style p-0 m-0"></ul>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="card-body">
      @if(!empty($testimonials))
        <ul class="list-group row" style="flex-direction:row;">
          @foreach ($testimonials as  $key => $testimonial)
            <li class="list-group-item col-12 col-md-6 col-lg-4 border">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $key }}" value="{{ !empty($testimonial['id']) ? $testimonial['id'] : '' }}" name="check_select" onChange="selectForMap(this,'selected_input')" data-label="{{ !empty($testimonial['synopsis']) ? $testimonial['synopsis'] : '' }}" entity-type="testimonial">
                <label class="form-check-label" for="inlineCheckbox{{ $key }}">{{ !empty($testimonial['synopsis']) ? $testimonial['synopsis'] : '' }}</label>
              </div>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>


@stop