@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Permissions</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/permissions/add" class="btn btn-lg btn-secondary">Add Permissions</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>Permission Name</label>
        <input type="text" class="form-control" placeholder="Permission Name" />
      </div>
    </div>
  </fieldset>
  <div class="overflow-auto w-100">
    <table class="table table-striped table-bordered">
      <thead>
          <tr>
            <th>Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @if(!empty($permissions))
        @foreach ($permissions as $permission)
        <tr>
          <td>{{$permission->name}}</td>
          <td>{{$permission->created_at}}</td>
          <td>{{$permission->updated_at}}</td>
          <td><a href="/cms/permissions/edit/{{$permission->_id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/permissions/delete/{{$permission->_id}}" class="mx-1" title="Delete"><span data-feather="delete"></span></a>
          </td>
        </tr>
        @endforeach
      @else
        <p class="text-danger text-center">No Record to Display</p>
      @endif
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation" class="my-3">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="{{$permissions->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$permissions->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$permissions->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$permissions->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop