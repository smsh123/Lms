@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Edit Blog</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/blogs" class="btn btn-lg btn-secondary">View Blogs</a></div>
  </div>

  <form class="card" method="post" action="/cms/blogs/update">
    @csrf
    <input type="hidden" value="{{ !empty($blogs['id']) ? $blogs['id'] : '' }}" name="id" />
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Blog Name</label>
          <input type="text" id="title" onkeyup="CreateAndSetSlug()" class="form-control" name="name" placeholder="Blog Name" value="{{ !empty($blogs['name']) ? $blogs['name'] : '' }}" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Blog Name Hindi</label>
          <input type="text" class="form-control" name="name_hindi" placeholder="Blog Name Hindi" value="{{ !empty($blogs['name_hindi']) ? $blogs['name_hindi'] : '' }}" />
          @if ($errors->has('name_hindi'))
          <p class="text-danger">{{ $errors->first('name_hindi') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Meta Title</label>
          <input type="text" class="form-control" name="meta_title" value="{{ !empty($blogs['meta_title']) ? $blogs['meta_title'] : '' }}" placeholder="Meta Title" />
          @if ($errors->has('meta_title'))
            <p class="text-danger">{{ $errors->first('meta_title') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Meta Keywords</label>
          <input type="text" class="form-control" data-role="tagsinput" name="meta_keywords" value="{{ !empty($blogs['meta_keywords']) ? $blogs['meta_keywords'] : '' }}" placeholder="Keywords" />
          @if ($errors->has('meta_keywords'))
          <p class="text-danger">{{ $errors->first('meta_keywords') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Meta Description</label>
          <textarea class="form-control" name="meta_description">{{ !empty($blogs['meta_description']) ? $blogs['meta_description'] : '' }}</textarea>
          @if ($errors->has('meta_description'))
            <p class="text-danger">{{ $errors->first('meta_description') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Blog Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Blog slug" value="{{ !empty($blogs['slug']) ? $blogs['slug'] : '' }}" readonly  />
          @if ($errors->has('slug'))
          <p class="text-danger">{{ $errors->first('slug') }}</p>
        @endif
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Author</label>
          <select class="form-control" name="author">
            <option>Select Author</option>
             @if(!empty($users))
              @foreach ($users as $user)
                <option {{ !empty($user['id']) && $user['id'] == $blogs['author'] ? 'selected' : ''}} value="{{ !empty($user['id']) ? $user['id'] : ''}}">{{ !empty($user['name']) ? $user['name'] : ''}}</option>
              @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Blog Description</label>
          <textarea class="form-control txteditor" rows="6" placeholder="Blog Description ..." name="description">{{ !empty($blogs['description']) ? $blogs['description'] : '' }}</textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Blog Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Blog Synopsis ..." name="synopsis">{{ !empty($blogs['synopsis']) ? $blogs['synopsis'] : '' }}</textarea>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Tags</label>
          <input type="text" value="{{ !empty($blogs['tags']) ? $blogs['tags'] : '' }}" data-role="tagsinput" class="form-control" name="tags" />
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
          <input id="form-image-input" type="hidden" class="form-control" value="{{ !empty($blogs['thumbnail_image']) ? $blogs['thumbnail_image'] : '' }}" name="thumbnail_image" />

          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview" src="{{ !empty($blogs['thumbnail_image']) ? $blogs['thumbnail_image'] : '' }}" />
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Blog Banner</label>
          <div class="input-group upload-image mb-3">
            <input id="inputImage_1" type="file" class="form-control" placeholder="Banner Image">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage_1','form-image-input_1','image-preview_1');" type="button" id="button-addon2">Upload</button>
            </div>
          </div>
          <input id="form-image-input_1" type="hidden" class="form-control" value="{{ !empty($blogs['banner_image']) ? $blogs['banner_image'] : '' }}" name="banner_image" />
          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview_1" src="{{ !empty($blogs['banner_image']) ? $blogs['banner_image'] : '' }}" />
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