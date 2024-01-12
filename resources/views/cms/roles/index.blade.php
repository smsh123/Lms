@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Roles</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/roles/add" class="btn btn-lg btn-secondary">Add Roles</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <form action="" method="get">
      <div class="row">
        @csrf
        <div class="form-group col-lg-4 col-md-6">
          <label>Role</label>
          <input type="text" name="name" id="_name" class="form-control" placeholder="Name" />
        </div>
        <div class="form-group col-lg-12 text-center">
          <input type="submit" class="btn btn-primary" value="Search" >
        </div>
      </div>
    </form>
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
      @if(!empty($roles))
        @foreach ($roles as $role)
        <tr>
          <td>{{$role->name}}</td>
          <td>{{$role->created_at}}</td>
          <td>{{$role->updated_at}}</td>
          <td><a href="/cms/roles/edit/{{$role->_id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/roles/delete/{{$role->_id}}" class="mx-1" title="Delete"><span data-feather="delete"></span></a>
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
        <li class="page-item"><a class="page-link" href="{{$roles->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$roles->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$roles->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$roles->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop