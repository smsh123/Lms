@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Add Section</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/sections" class="btn btn-lg btn-secondary">View Sections</a></div>
  </div>
  <form class="card" method="post" action="/cms/sections/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Section Name</label>
          <input type="text" id="title" onkeyup="CreateAndSetSlug()" class="form-control" name="name" placeholder="Section Name" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Display Title</label>
          <input type="text" class="form-control" name="display_title" placeholder="Display Title" />
          @if ($errors->has('display_title'))
          <p class="text-danger">{{ $errors->first('display_title') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Section Tag Line</label>
          <input type="text" value="" class="form-control" name="tagline" />
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">List Items</label>
          <input type="text" value="" data-role="tagsinput" class="form-control" name="listitems" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Section Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Section slug"  />
          @if ($errors->has('slug'))
            <p class="text-danger">{{ $errors->first('slug') }}</p>
          @endif
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Mentors</label>
          <select class="form-control select_to" name="mentors[]" multiple="multiple">
            <option>Select</option>
            @if(!empty($mentors))
              @foreach ($mentors as $key => $mentor )
                <option value="{{ !empty($mentor['_id']) ? $mentor['_id'] : '' }}">{{ !empty($mentor['name']) ? $mentor['name'].' - ' : '' }}{{ !empty($mentor['_id']) ? $mentor['_id'] : '' }}</option>
              @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Blogs</label>
          <select class="form-control select_to" name="blogs[]" multiple="multiple">
            <option>Select</option>
            @if(!empty($blogs))
              @foreach ($blogs as $key => $blog )
                <option value="{{ !empty($blog['slug']) ? $blog['slug'] : '' }}">{{ !empty($blog['name']) ? $blog['name'] : '' }}</option>
              @endforeach
            @endif
          </select>
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Courses</label>
          <select class="form-control select_to" name="courses[]" multiple="multiple">
            <option>Select</option>
            @if(!empty($courses))
              @foreach ($courses as $key => $course )
                <option value="{{ !empty($course['slug']) ? $course['slug'] : '' }}">{{ !empty($course['name']) ? $course['name'] : '' }}</option>
              @endforeach
            @endif
          </select>
        </div>
      </div>
     
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Section Description</label>
          <textarea class="form-control txteditor" rows="6" placeholder="Section Description ..." name="description"></textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Section Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Section Synopsis ..." name="synopsis"></textarea>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Image</label>
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
          <label class="font-weight-bold">Banner</label>
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