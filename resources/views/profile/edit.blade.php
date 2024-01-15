@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="min-vh-100">
    @include('layouts.profile_common')
    <div class="row no-gutters">
      <div class="col-12">
      @if (session('error'))
        <div class="alert alert-danger custom-alert font-weight-bold">
            {{ session('error') }}
        </div>
      @elseif (session('msg'))
        <div class="alert alert-success custom-alert font-weight-bold">
            {{ session('msg') }}
        </div>
      @elseif (session('msg_focus'))
        <div class="alert alert-warning alert-fixed alert-dismissible fade show" role="alert">
          {!! html_entity_decode(session('msg_focus')) !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
          @if(!empty($profile_details))
            <div class="card mw-768 mx-auto mb-3">
              <div class="card-header"><h3 class="font-22 font-weight-bold mb-0">Edit Profile</h3></div>
              <div class="card-body">
                <form method="post" action="/profile/update">
                  @csrf
                  <input type="hidden" value="{{ !empty($profile_details['_id']) ? $profile_details['_id'] : ''}}" name="id" />
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
                  <div class="row form-group">
                    <div class="col-12 col-lg-6">
                      <div class="icon-200 mx-auto">
                        <div class="ratio-image image_1-1 rounded-circle my-3">
                          <img id="image-preview" src="{{ !empty($profile_details['avatar_image']) ? $profile_details['avatar_image'] : '' }}" />
                        </div>
                      </div>
                      <div class="input-group upload-image mb-3">
                        <input id="inputImage" type="file" class="form-control"  placeholder="Banner Image" />
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage','form-image-input','image-preview');" type="button" id="button-addon2">Upload</button>
                        </div>
                      </div>
                      <input id="form-image-input" type="hidden" class="form-control" name="avatar_image" value="{{ !empty($profile_details['avatar_image']) ? $profile_details['avatar_image'] : '' }}" />
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="w-100 mw-320 my-4 mx-auto">
                        <div class="ratio-image image_16-9">
                          <img id="image-preview_1" src="{{ !empty($profile_details['cover_image']) ? $profile_details['cover_image'] : '' }}" />
                        </div>
                      </div>
                      <div class="input-group upload-image mb-3">
                        <input id="inputImage_1" type="file" class="form-control" placeholder="Banner Image">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage_1','form-image-input_1','image-preview_1');" type="button" id="button-addon2">Upload</button>
                        </div>
                      </div>
                      <input id="form-image-input_1" type="hidden" class="form-control" name="cover_image" value="{{ !empty($profile_details['cover_image']) ? $profile_details['cover_image'] : '' }}" />
                    </div>
                  </div>
                  <div class="form-group text-center">
                    <input type="submit" class="btn btn-theme-contrast" value="Update" />
                  </div>
                </form>
              </div>
            </div>
          @endif
      </div>
    </div>
  </div>
@stop

