@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-12"><h1>Edit Course Testimonial Mapping</h1></div>
  </div>
  <div class="card">
    <div class="card-header">
      <form method="post" action="/cms/course-testimonial-mapping/update" class="p-3">
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
              <label>Selected Faqs</label>
              <ul id="selected_input" class="list-no-style p-0 m-0">
                @if(!empty($mappings['testimonials']))
                  @foreach ($mappings['testimonials'] as $key => $testimonial)
                    <li class='d-inline-block mx-2 mb-2'><input type='hidden' id='{{ !empty($testimonial['testimonialId']) ? $testimonial['testimonialId'] : ''  }}' value='{{ !empty($testimonial['testimonialId']) ? $testimonial['testimonialId'] : ''  }}' name='testimonial_id[]' readonly /><input type='text' name='testimonial_name[]' class='btn btn-outline-info rounded-pill' value='{{!empty($testimonial['testimonialName']) ?$testimonial['testimonialName'] : ""}}' readonly /></li>
                  @endforeach
                @endif
              </ul>
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
                <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $key }}" value="{{ !empty($testimonial['id']) ? $testimonial['id'] : '' }}" name="check_select" onChange="selectForMap(this,'selected_input')" data-label="{{ !empty($testimonial['name']) ? $testimonial['name'] : '' }}"  @if(!empty($mappings['testimonials'])) @foreach ($mappings['testimonials'] as $testimonialArray) @if($testimonialArray['testimonialId'] == $testimonial['id']) checked @endif @endforeach  @endif entity-type="testimonial">
                <label class="form-check-label" for="inlineCheckbox{{ $key }}">{{ !empty($testimonial['name']) ? $testimonial['name'] : '' }}</label>
              </div>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>


@stop