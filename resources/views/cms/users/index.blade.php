@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Users</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/users/add" class="btn btn-lg btn-secondary">Add Users</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>User Name</label>
        <input type="text" class="form-control" placeholder="Title of Course" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Email</label>
        <input type="email" class="form-control" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Mobile</label>
        <input type="number" class="form-control" />
      </div>
      <div class="form-group col-lg-12 text-center">
        <input type="button" class="btn btn-primary" value="Search" >
      </div>
    </div>
  </fieldset>
  <div class="overflow-auto w-100">
    <table class="table table-striped table-bordered">
      <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Type</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @if(!empty($users))
        @foreach ($users as $user)
        <tr>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->mobile}}</td>
          <td>{{$user->user_type}}</td>
          <td class="text-nowrap">
            {{-- <a href="/cms/courses/view" class="mx-1" title="View"><span data-feather="eye"></span></a> --}}
            {{-- <a href="/cms/courses/edit" class="mx-1" title="Edit"><span data-feather="edit"></span></a> --}}
            <a href="/cms/users/permissions/{{$user->_id}}" class="mx-1" title="view roles and permission "><span data-feather="user-check"></span></a>
            <a href="/cms/users/edit/{{$user->_id}}" class="mx-1" title="Edit User Details"><span data-feather="edit"></span></a>
            <a href="/cms/users/delete/{{$user->_id}}" class="mx-1" title="Edit User Details"><span data-feather="trash"></span></a>
            {{-- <a href="/cms/courses/delete" class="mx-1" title="Delete"><span data-feather="trash"></span></a> --}}
          </td>
        </tr>
        @endforeach
      @else
        <p class="text-danger text-center">No Record to Display</p>
      @endif
      </tbody>
    </table>
  </div>
  <nav aria-label="Page navigation" class="my-3">
    <ul class="pagination justify-content-end">
      <li class="page-item"><a class="page-link" href="{{$users->previousPageUrl()}}">Previous</a></li>
      @for($i=1;$i<=$users->lastPage();$i++)
        <li class="page-item"><a class="page-link" href="{{$users->url($i)}}">{{$i}}</a></li>
      @endfor
      <li class="page-item"><a class="page-link" href="{{$users->nextPageUrl()}}">Next</a></li>
    </ul>
  </nav>
@stop