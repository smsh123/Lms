@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Edit Page</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/pages" class="btn btn-lg btn-secondary">View Pages</a></div>
  </div>

  <form class="card" method="post" action="/cms/pages/update">
    @csrf
    <input type="hidden" value="{{ !empty($pages['id']) ? $pages['id'] : '' }}" name="id" />
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Page Name</label>
          <input type="text" id="title" onkeyup="CreateAndSetSlug()" class="form-control" name="name" placeholder="Page Name" value="{{ !empty($pages['name']) ? $pages['name'] : '' }}" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Page Name Hindi</label>
          <input type="text" class="form-control" name="name_hindi" placeholder="Page Name Hindi" value="{{ !empty($pages['name_hindi']) ? $pages['name_hindi'] : '' }}" />
          @if ($errors->has('name_hindi'))
          <p class="text-danger">{{ $errors->first('name_hindi') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Meta Title</label>
          <input type="text" class="form-control" name="meta_title" value="{{ !empty($pages['meta_title']) ? $pages['meta_title'] : '' }}" placeholder="Meta Title" />
          @if ($errors->has('meta_title'))
            <p class="text-danger">{{ $errors->first('meta_title') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Meta Keywords</label>
          <input type="text" class="form-control" data-role="tagsinput" name="meta_keywords" value="{{ !empty($pages['meta_keywords']) ? $pages['meta_keywords'] : '' }}" placeholder="Keywords" />
          @if ($errors->has('meta_keywords'))
          <p class="text-danger">{{ $errors->first('meta_keywords') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Meta Description</label>
          <textarea class="form-control" name="meta_description">{{ !empty($pages['meta_description']) ? $pages['meta_description'] : '' }}</textarea>
          @if ($errors->has('meta_description'))
            <p class="text-danger">{{ $errors->first('meta_description') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Page Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Page slug" value="{{ !empty($pages['slug']) ? $pages['slug'] : '' }}" readonly  />
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
                <option {{ !empty($user['id']) && $user['id'] == $pages['author'] ? 'selected' : ''}} value="{{ !empty($user['id']) ? $user['id'] : ''}}">{{ !empty($user['name']) ? $user['name'] : ''}}</option>
              @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Page HTML Content</label>
          <textarea class="form-control" rows="6" placeholder="Page Content HTML ..." name="description">{{ !empty($pages['description']) ? $pages['description'] : '' }}</textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
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