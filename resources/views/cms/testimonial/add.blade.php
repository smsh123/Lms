@extends('cms.layouts.master')
@section('body')
@php $global_picklist = session()->has('global_picklist') ? session('global_picklist') : [] ; @endphp
<div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Add Testimonial</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/testimonials" class="btn btn-lg btn-secondary">View Testimonial</a></div>
  </div>

  <form class="card" method="post" action="/cms/testimonials/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Select User</label>
          <select class="form-control" name="user">
            <option>Select User</option>
            @if(!empty($users))
              @foreach($users as $key => $user)
                <option {{!empty($testimonial->user) && $testimonial->user == $user['id']."-".$user['name'] ? "selected" : "" }}>{{!empty($user['id']) && !empty($user['name']) ?  $user['id']."-".$user['name'] : '' }}</option>
              @endforeach
            @endif
          </select>
          @if ($errors->has('user'))
            <p class="text-danger">{{ $errors->first('user') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Testimonial Type</label>
          <select class="form-control" name="type">
            <option>Select Type</option>
            @if(!empty($global_picklist['testimonialType']))
              @foreach ($global_picklist['testimonialType'] as $key => $type)
                <option value="{{ !empty($type['code']) ? $type['code'] : ''}}">{{ !empty($type['label']) ? $type['label'] : '' }}</option>
              @endforeach
            @endif
          </select>
          @if ($errors->has('type'))
          <p class="text-danger">{{ $errors->first('type') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Testimonial Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Testimonial Synopsis ..." name="synopsis"></textarea>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Image</label>
          <input type="file" class="form-control" name="image" />
        </div>
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Video</label>
          <input type="text" class="form-control" placeholder="YT URL" name="video" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 text-center">
          <label class="font-weight-bold">Status</label>
          <select class="form-control" name="status">
            @if(!empty($global_picklist['status']))
              @foreach ($global_picklist['status'] as $faqstatus)
                  <option value="{{ !empty($faqstatus['label']) ? $faqstatus['label'] : '' }}">{{ !empty($faqstatus['label']) ? $faqstatus['label'] : '' }}</option>
              @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Thumbnail Image</label>
          <div class="input-group upload-image mb-3">
            <input id="inputImage" type="file" class="form-control" placeholder="Banner Image">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage','form-image-input','image-preview');" type="button" id="button-addon2">Upload</button>
            </div>
          </div>
          <input id="form-image-input" type="hidden" class="form-control" value="" name="thumbnail_image" />

          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview" src="" />
            </div>
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