@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Edit Users</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/users" class="btn btn-lg btn-secondary">View Users</a></div>
  </div>


  <form class="card" method="post" action="/cms/users/update">
    @csrf
    <input type="hidden" name="id" value="{{ !empty($users['_id']) ? $users['_id'] : ''}}" />
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <div class="icon-200 mx-auto my-3">
            <div class="ratio-image image_1-1 rounded-circle">
              <img src="{{ !empty($users['avatar_image']) ? $users['avatar_image'] : '' }}" alt="{{ !empty($users['name']) ? $users['name'] : ''}}" />
            </div>
            <input type="hidden" value="{{ !empty($users['avatar_image']) ? $users['avatar_image'] : '' }}"   name="avatar_image" />
          </div>
        </div>
        <div class="col-lg-6">
          <input type="file" class="form-control" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">User Name</label>
          <input type="text" class="form-control" name="name" placeholder="User's Full Name" value="{{ !empty($users['name']) ? $users['name'] : ''}}" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">User Email</label>
          <input type="email" class="form-control" name="email" placeholder="User's Email"  value="{{ !empty($users['email']) ? $users['email'] : ''}}" />
          @if ($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Mobile</label>
          <input type="number" class="form-control" name="mobile" placeholder="Mobile" value="{{ !empty($users['mobile']) ? $users['mobile'] : ''}}"  />
          @if ($errors->has('mobile'))
          <p class="text-danger">{{ $errors->first('mobile') }}</p>
        @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Password</label>
          <input type="password" class="form-control" name="pwd" placeholder="Password" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12">
         <label class="font-weight-bold">User Type</label>
          <select id="user_type_select" class="form-control" name="user_type">
            <option value="external">User Type</option>
            <option value="external">External</option>
            <option value="internal">Internal</option>
          </select>
        </div>
       
      </div>
      <div class="row form-group">
        <div class="col-12 text-center">
          <input type="submit" class="btn btn-lg btn-primary" value="Update" />
        </div>
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