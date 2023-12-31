@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Roles and Permissions</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/users" class="btn btn-lg btn-secondary">View Users</a></div>
  </div>


  <form class="card" method="post" action="/cms/users/permissions-store">
    @csrf
   <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-12">
            <input type="hidden" name="_id" value="{{$_id}}">
          <label class="font-weight-bold">Roles </label>
          <hr>
          @if (!empty($roles))
              @foreach ($roles as $role)
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="roles[]" value="{{$role->name}}" {{in_array($role->name,$userRoles) ? 'checked' : ''}}>
                <label class="form-check-label" for="inlineCheckbox1" >{{$role->name}}</label>
              </div>  
              @endforeach
          @endif
        </div>
        <div class="col-lg-12">
            <hr>
            <label class="font-weight-bold">Permissions </label>
            <hr>
            @if (!empty($permissions))
                @foreach ($permissions as $permission)
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="permissions[]" value="{{$permission->name}}" {{in_array($permission->name,$userPermissions) ? 'checked' : ''}}>
                  <label class="form-check-label" for="inlineCheckbox1" >{{$permission->name}}</label>
                </div>  
                @endforeach
            @endif
          </div>
      </div>
      <div class="row form-group">
        <div class="col-12 text-center">
          <input type="submit" class="btn btn-lg btn-primary" value="Update" />
        </div>
      </div>
    </div>
  </form>


@stop