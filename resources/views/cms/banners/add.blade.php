@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Add Banners</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/banners" class="btn btn-lg btn-secondary">View Users</a></div>
  </div>


  <form class="card" method="post" action="/cms/banners/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Banner Name</label>
          <input type="text" class="form-control" placeholder="banner_name" name="name" />
        </div>
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Banner Image</label>
          <input id="form-image" type="hidden" class="form-control" name="image" />
          <div class="input-group upload-image mb-3">
            <input id="inputBanner" type="file" class="form-control" placeholder="Banner Image">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" onclick="uploadImage($('#inputBanner').val(),'form-image')" type="button" id="button-addon2">Button</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Live From</label>
          <input type="date" class="form-control" name="live_from" />
        </div>
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Live Till</label>
          <input type="date" class="form-control" name="live_till" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12">
          <label class="font-weight-bold">Banner Type</label>
          <select class="form-control" name="banner_type">
            <option value="full_page">Full Width Banner</option>
            <option value="thumbnail">Thumbnail Banner</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 text-center">
          <input type="submit" class="btn btn-primary" value="Submit" />
        </div>
      </div>
    </div>
  </form>

@stop