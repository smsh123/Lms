@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Edit Course</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/courses/index" class="btn btn-lg btn-secondary">View Courses</a></div>
  </div>


  <form class="card" method="post" action="/cms/courses/update">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Course Name</label>
          <input type="text" class="form-control" name="name" placeholder="Course Name" value="{{$course->name}}"/>
          <input type="hidden"  name="id"  value="{{$course->id}}"/>
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
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
        <div class="col-lg-6">
          <label class="font-weight-bold">Course Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="course slug" value="{{$course->slug}}" />
          @if ($errors->has('slug'))
          <p class="text-danger">{{ $errors->first('slug') }}</p>
        @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Batch Start Date</label>
          <input type="date" class="form-control" name="start_date" value="{{$course->start_date}}"/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Course Duration (Days)</label>
          <input type="number" class="form-control" placeholder="Days" name="duration" value="{{$course->duration}}" />
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Class Mode</label>
          <select class="form-control" name="class_mode" value="{{$course->class_mode}}">
            <option>Select</option>
            <option value="live">Live</option>
            <option value="recorded">Recorded</option>
            <option value="offline">Offline</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Course Description</label>
          <textarea class="form-control txteditor" rows="6" placeholder="Course Description ..." name="description">{{$course->description}}</textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Course Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Course Synopsis ..." name="synopsis">{{$course->synopsis}}</textarea>
        </div>
      </div>
      <fieldset class="border p-3 mb-3">
        <legend class="d-inline-block w-auto px-3">Price & Offer Details</legend>
        <div class="row form-group">
          <div class="col-lg-6">
            <label class="font-weight-bold">Original Price (&#8377;)</label>
            <input type="number" class="form-control" placeholder="Original Price"  name="original_price" value="{{$course->original_price}}"/>
            @if ($errors->has('original_price'))
          <p class="text-danger">{{ $errors->first('original_price') }}</p>
        @endif
          </div>
          <div class="col-lg-6">
              <label class="font-weight-bold">Selling Price (&#8377;)</label>
              <input type="number" class="form-control" placeholder="Selling Price" name="selling_price" value="{{$course->selling_price}}" />
              @if ($errors->has('selling_price'))
          <p class="text-danger">{{ $errors->first('selling_price') }}</p>
        @endif
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6">
            <label class="font-weight-bold">Offer Type</label>
            <select class="form-control" name="offer_type" value="{{$course->offer_type}}">
              <option>Select</option>
              <option value="discount">Discount</option>
              <option value="cashback">Cashback</option>
              <option value="coupon">Coupon</option>
            </select>
          </div>
          <div class="col-lg-6 align-self-center">
              <label class="font-weight-bold mb-0">Offer Unit</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="disount_unit" id="inlineRadio1" value="flat" {{$course->disount_unit == 'flat' ? 'checked' : ''}}>
                <label class="form-check-label mb-0" for="inlineRadio1">Flat</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="disount_unit" id="inlineRadio2" value="percentage" {{$course->disount_unit == 'percentage' ? 'checked' : ''}}>
                <label class="form-check-label mb-0" for="inlineRadio2">Percentage</label>
              </div>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6">
            <label class="font-weight-bold">Offer Value</label>
            <input type="number" class="form-control" placeholder="Offer Value"  name="offer_value" value="{{$course->offer_value}}"/>
          </div>
          <div class="col-lg-6">
              <label class="font-weight-bold">Coupon Code</label>
              <input type="text" class="form-control" placeholder="Couupon Code" name="coupon_code" value="{{$course->coupon_code}}" />
          </div>
        </div>
        <div class="row form-group">
          <div class="col-12">
            <label class="font-weight-bold">Offer Label</label>
            <textarea rows="2" class="form-control" placeholder="Write Offer Details Text" name="offer_details">{{$course->offer_details}}</textarea>
          </div>
        </div>
      </fieldset>
      <div class="row form-group">
        <div class="col-lg-12 align-self-center">
            <label class="font-weight-bold mb-0">Display Courses</label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
            <label class="form-check-label" for="inlineCheckbox1" name="display_course[]">Home</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
            <label class="form-check-label" for="inlineCheckbox2" name="display_course[]">Course Listing</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
            <label class="form-check-label" for="inlineCheckbox3" name="display_course[]">Blog</label>
          </div>
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