@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Menus</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/menus/add" class="btn btn-lg btn-secondary">Add Menus</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <form action="" method="get">
      <div class="row">
        @csrf
        <div class="form-group col-lg-4 col-md-6">
          <label>Module Name</label>
          <input type="text" name="name" id="_name" class="form-control" placeholder="Name" />
        </div>
        <div class="form-group col-lg-4 col-md-6">
          <label>Slug</label>
          <input type="text" name="slug" id="_slug" class="form-control" />
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
            <th>Title</th>
            <th>Slug</th>
            <th>Created Date</th>
            <th>Modified Date</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($menus as $menu)
        <tr>
          <td>{{$menu->name}}</td>
          <td>{{$menu->slug}}</td>
          <td>{{$menu->created_at}}</td>
          <td>{{$menu->updated_at}}</td>
          <td class="text-nowrap">
            <a href="/cms/menus/toggle-status/{{$menu->id}}" class="mx-1 {{ !empty($menu->is_public) && $menu->is_public == 1 ? 'text-success' : 'text-danger' }}" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/menus/edit/{{$menu->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/menus/delete/{{$menu->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation" class="my-3">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="{{$menus->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$menus->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$menus->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$menus->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop