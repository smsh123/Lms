@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Add Blogs</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/pages" class="btn btn-lg btn-secondary">View Pages</a></div>
  </div>


  <form class="card" method="post" action="/cms/pages/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Blog Name</label>
          <input type="text" id="title" onkeyup="CreateAndSetSlug()" class="form-control" name="name" placeholder="Blog Name" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Blog Name Hindi</label>
          <input type="text" class="form-control" name="name_hindi" placeholder="Blog Name Hindi" />
          @if ($errors->has('name_hindi'))
          <p class="text-danger">{{ $errors->first('name_hindi') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Blog Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Blog slug"  />
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
                <option value="{{ !empty($user['id']) ? $user['id'] : ''}}">{{ !empty($user['name']) ? $user['name'] : ''}}</option>
              @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Blog Description</label>
          <textarea class="form-control txteditor" rows="6" placeholder="Blog Description ..." name="description"></textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Blog Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Blog Synopsis ..." name="synopsis"></textarea>
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