@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Edit Blog</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/blogs" class="btn btn-lg btn-secondary">View Blogs</a></div>
  </div>


  <form class="card" method="post" action="/cms/blogs/update">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Blog Name</label>
          <input type="text" class="form-control" name="name" placeholder="Blog Name" value="{{$Blog->name}}"/>
          <input type="hidden"  name="id"  value="{{$Blog->id}}"/>
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Blog Name Hindi</label>
          <input type="text" class="form-control" name="name_hn" placeholder="Blog Name Hindi" value="{{$Blog->name_hn}}" />
          @if ($errors->has('name_hn'))
          <p class="text-danger">{{ $errors->first('name_hn') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Blog Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Blog slug" value="{{$Blog->slug}}" />
          @if ($errors->has('slug'))
          <p class="text-danger">{{ $errors->first('slug') }}</p>
        @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Batch Start Date</label>
          <input type="date" class="form-control" name="start_date" value="{{$Blog->start_date}}"/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Blog Duration (Days)</label>
          <input type="number" class="form-control" placeholder="Days" name="duration" value="{{$Blog->duration}}" />
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Class Mode</label>
          <select class="form-control" name="class_mode" value="{{$Blog->class_mode}}">
            <option>Select</option>
            <option value="live">Live</option>
            <option value="recorded">Recorded</option>
            <option value="offline">Offline</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Blog Description</label>
          <textarea class="form-control txteditor" rows="6" placeholder="Blog Description ..." name="description">{{$Blog->description}}</textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Blog Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Blog Synopsis ..." name="synopsis">{{$Blog->synopsis}}</textarea>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12 align-self-center">
            <label class="font-weight-bold mb-0">Display Blogs</label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
            <label class="form-check-label" for="inlineCheckbox1" name="display_Blog[]">Home</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
            <label class="form-check-label" for="inlineCheckbox2" name="display_Blog[]">Blog Listing</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
            <label class="form-check-label" for="inlineCheckbox3" name="display_Blog[]">Blog</label>
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