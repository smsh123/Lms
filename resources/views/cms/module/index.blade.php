@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Modules</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/modules/add" class="btn btn-lg btn-secondary">Add Modules</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>Module Name</label>
        <input type="text" class="form-control" placeholder="Title of Module" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Module Slug</label>
        <input type="text" class="form-control" placeholder="Module Slug" />
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
            <th>Title</th>
            <th>Slug</th>
            <th>Created Date</th>
            <th>Modified Date</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($modules as $module)
        <tr>
          <td>{{$module->name}}</td>
          <td>{{$module->slug}}</td>
          <td>{{$module->created_at}}</td>
          <td>{{$module->updated_at}}</td>
          <td class="text-nowrap">
            <a href="/cms/modules/view" class="mx-1" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/modules/edit/{{$module->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/modules/delete" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>
  </div>
@stop