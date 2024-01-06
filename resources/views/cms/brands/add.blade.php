@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Add Brands</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/brands" class="btn btn-lg btn-secondary">View Brands</a></div>
  </div>


  <form class="card" method="post" action="/cms/brands/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Brand Name</label>
          <input type="text" id="title" onkeyup="CreateAndSetSlug()" class="form-control" name="name" placeholder="Brand Name" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Brand Name Hindi</label>
          <input type="text" class="form-control" name="name_hindi" placeholder="Brand Name Hindi" />
          @if ($errors->has('name_hindi'))
          <p class="text-danger">{{ $errors->first('name_hindi') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Brand Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Brand slug"  />
          @if ($errors->has('slug'))
            <p class="text-danger">{{ $errors->first('slug') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Facebook</label>
          <input type="text" class="form-control" name="facebook"/>
        </div>
      </div>
       <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Twitter</label>
          <input type="text" class="form-control" name="twitter" placeholder="Brand twitter" value="" />
          @if ($errors->has('twitter'))
          <p class="text-danger">{{ $errors->first('twitter') }}</p>
        @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Youtube</label>
          <input type="text" class="form-control" name="youtube" value=""/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Instagram</label>
          <input type="text" class="form-control" name="instagram" placeholder="Brand instagram" value="" />
          @if ($errors->has('instagram'))
          <p class="text-danger">{{ $errors->first('instagram') }}</p>
        @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">LinkedIn</label>
          <input type="text" class="form-control" name="linkedin" value=""/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Phone</label>
          <input type="number" class="form-control" name="phone" placeholder="Brand Phone" value="" />
          @if ($errors->has('phone'))
            <p class="text-danger">{{ $errors->first('phone') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Support Number</label>
          <input type="number" class="form-control" name="support_number" value=""/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Email</label>
          <input type="text" class="form-control" name="email" placeholder="Brand Email" value="" />
          @if ($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Support Email</label>
          <input type="text" class="form-control" name="support_email" value=""/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Address</label>
          <input type="text" class="form-control" name="address" placeholder="Brand Address" value="" />
          @if ($errors->has('address'))
            <p class="text-danger">{{ $errors->first('address') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Brand Url</label>
          <input type="text" class="form-control" name="website" value=""/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Brand Description</label>
          <textarea class="form-control txteditor" rows="6" placeholder="Brand Description ..." name="description"></textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Brand Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Brand Synopsis ..." name="synopsis"></textarea>
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
          <input id="form-image-input" type="hidden" class="form-control" name="thumbnail_image" />

          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview" src="" />
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Brand Banner</label>
          <div class="input-group upload-image mb-3">
            <input id="inputImage_1" type="file" class="form-control" placeholder="Banner Image">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage_1','form-image-input_1','image-preview_1');" type="button" id="button-addon2">Upload</button>
            </div>
          </div>
          <input id="form-image-input_1" type="hidden" class="form-control" name="banner_image" />
          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview_1" src="" />
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