@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Edit Category</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/categories" class="btn btn-lg btn-secondary">View Categories</a></div>
  </div>
  <form class="card" method="post" action="/cms/categories/update">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Category Name</label>
          <input type="text" class="form-control" name="name" placeholder="Category Name" value="{{$categories->name}}"/>
          <input type="hidden"  name="id"  value="{{$categories->id}}"/>
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Category Name Hindi</label>
          <input type="text" class="form-control" name="name_hindi" placeholder="Category Name Hindi" value="{{$categories->name_hindi}}" />
          @if ($errors->has('name_hindi'))
          <p class="text-danger">{{ $errors->first('name_hindi') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Meta Title</label>
          <input type="text" class="form-control" name="meta_title" value="{{ !empty($categories->meta_title) ? $categories->meta_title : '' }}" placeholder="Meta Title" />
          @if ($errors->has('meta_title'))
            <p class="text-danger">{{ $errors->first('meta_title') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Meta Keywords</label>
          <input type="text" class="form-control" data-role="tagsinput" name="meta_keywords" value="{{ !empty($categories->meta_keywords) ? $categories->meta_keywords : '' }}" placeholder="Keywords" />
          @if ($errors->has('meta_keywords'))
          <p class="text-danger">{{ $errors->first('meta_keywords') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Meta Description</label>
          <textarea class="form-control" name="meta_description">{{ !empty($categories->meta_description) ? $categories->meta_description : '' }}</textarea>
          @if ($errors->has('meta_description'))
            <p class="text-danger">{{ $errors->first('meta_description') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Category Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Category slug" value="{{$categories->slug}}" readonly />
          @if ($errors->has('slug'))
          <p class="text-danger">{{ $errors->first('slug') }}</p>
        @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Batch Start Date</label>
          <input type="date" class="form-control" name="start_date" value="{{$categories->start_date}}"/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Category Description</label>
          <textarea class="form-control txteditor" rows="6" placeholder="Category Description ..." name="description">{{$categories->description}}</textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Category Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Category Synopsis ..." name="synopsis">{{$categories->synopsis}}</textarea>
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
          <input id="form-image-input" type="hidden" value="{{ !empty($categories->thumbnail_image) ? $categories->thumbnail_image : '' }}" class="form-control" name="thumbnail_image" />

          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview" src="{{ !empty($categories->thumbnail_image) ? $categories->thumbnail_image : '' }}" />
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Category Banner</label>
          <div class="input-group upload-image mb-3">
            <input id="inputImage_1" type="file" class="form-control" placeholder="Banner Image">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage_1','form-image-input_1','image-preview_1');" type="button" id="button-addon2">Upload</button>
            </div>
          </div>
          <input id="form-image-input_1" type="hidden" value="{{ !empty($categories->banner_image) ? $categories->banner_image : '' }}" class="form-control" name="banner_image" />
          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview_1" src="{{ !empty($categories->banner_image) ? $categories->banner_image : '' }}" />
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