@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Add Roles</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/roles" class="btn btn-lg btn-secondary">View Roles</a></div>
  </div>


  <form class="card" method="post" action="/cms/roles/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Role Name</label>
          <input type="text" class="form-control" name="name" placeholder="Role Name" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
        <div class="col-lg-6 text-center mt-4">
          <input type="submit" class="btn btn-lg btn-primary" value="Save" />
        </div>
    </div>
  </form>


@stop