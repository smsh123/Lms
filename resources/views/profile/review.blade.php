@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
 <div class="min-vh-100">
    @include('layouts.profile_common')
    <div class="bg-white py-1 border-top-0 border border-right-0 border-left-0">
      <div class="container">
        <div class="d-flex flex-nowrap justify-content-between" onclick="history.back()" >
          <div class="align-self-center">
            <div class="icon-48">
              <span class="btn btn-light border-radius-10"><i class="bi bi-chevron-left font-16"></i></span>
            </div>
          </div>
          <div class="align-self-center flex-fill pl-3">
            <h3 class="font-16 font-weight-bold mb-0">Write Reviews</h3>
          </div>
        </div>
      </div>
    </div>
    @if(!empty($product_details))
      <div class="card mw-768 mx-auto mb-3 mt-3">
          <div class="card-body">
            <div class="d-flex align-items-stretch justify-content-between">
              <div class="align-self-center">
                <div class="icon-80">
                  <div class="ratio-image image_16-9">
                    <img src="{{ !empty($product_details['thumbnail_image']) ? $product_details['thumbnail_image'] : '' }}" alt="product_thumb" />
                  </div>
                </div>
              </div>
              <div class="align-self-center flex-fill pl-3">
                <h3 class="font-14 font-weight-bold mb-0">{{ !empty($product_details['name']) ? $product_details['name'] : '' }}</h3>
              </div>
            </div>
          </div>
      </div>
    @endif
    @if(!empty($profile_details))
      <div class="card mw-768 mx-auto mb-3">
        <div class="card-header"><h3 class="font-22 font-weight-bold mb-0">Write Review</h3></div>
        <div class="card-body">
          <form method="post" action="/review/store">
            @csrf
            <input type="hidden" value="{{ !empty($profile_details['_id']) ? $profile_details['_id'] : ''}}" name="user_id" />
            <div class="form-group">
              <label>Rating</label>
              <input type="range" class="form-control-range" name="rating" min="0" max="5" value="4" step="1" />
              @if ($errors->has('rating'))
                <p class="text-danger">{{ $errors->first('rating') }}</p>
              @endif
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="name" value="{{ !empty($profile_details['name']) ? $profile_details['name'] : 'NA'}}" />
              @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
              @endif
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="mobile" value="{{ !empty($profile_details['mobile']) ? $profile_details['mobile'] : 'NA'}}" />
              @if ($errors->has('mobile'))
                <p class="text-danger">{{ $errors->first('mobile') }}</p>
              @endif
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="email" value="{{ !empty($profile_details['email']) ? $profile_details['email'] : 'NA'}}" />
              @if ($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label>Select Product</label>
              <input type="product" value="{{ !empty($product_details['slug']) ? $product_details['slug'] : '' }}" class="form-control" name="product" readonly />
            </div>
            <div class="form-group">
              <label>Review</label>
              <textarea class="form-control" name="comment" placeholder="Describe Porblem here"></textarea>
              @if ($errors->has('comment'))
                <p class="text-danger">{{ $errors->first('comment') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label>Your Selfie</label>
              <div class="input-group upload-image mb-3">
                <input id="inputImage" type="file" class="form-control"  placeholder="ScreenShot Image" />
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage','form-image-input','image-preview');" type="button" id="button-addon2">Upload</button>
                </div>
              </div>
              <input id="form-image-input" type="hidden" class="form-control" name="image" value="" />
              <div class="icon-200 mx-auto">
                <div class="ratio-image image_1-1 my-3">
                  <img id="image-preview" src="" />
                </div>
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" class="btn btn-theme-contrast" value="Submit" />
            </div>
          </form>
        </div>
      </div>
    @endif
  </div>
@stop

