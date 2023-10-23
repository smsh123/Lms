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
          <input type="text" class="form-control" name="name" />
        </div>
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Banner Image</label>
          <input type="file" class="form-control" name="image" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Live From</label>
          <input type="date" class="form-control" name="live_from" />
        </div>
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Banner Image</label>
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
      <div class="row form-group">
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
        </div>
      </div>
    </div>
  </form>

  {{-- <script>
    $(document).ready(function(){
      $("#user_type_select").change(function(){
        var select_val = $(this).find('option:selected').attr('value');
        $("#user_type").val(user_type);
        alert(user_type);
      });
    });
  </script> --}}

@stop