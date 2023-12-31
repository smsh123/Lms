@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Banners</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/banners/add" class="btn btn-lg btn-secondary">Add Banners</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>Banner Name</label>
        <input type="text" class="form-control" placeholder="Title of Banner" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Banner Type</label>
        <input type="text" class="form-control" />
      </div>
    </div>
  </fieldset>
  <div class="overflow-auto w-100">
    <table class="table table-striped table-bordered">
      <thead>
          <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Type</th>
            <th>Live Start Date</th>
            <th>Live End Date</th>
            {{-- <th>Action</th> --}}
          </tr>
      </thead>
      <tbody>
      @if(!empty($banners))
        @foreach ($banners as $banner)
        <tr>
          <td>{{$banner->name}}</td>
          <td>{{$banner->image}}</td>
          <td>{{$banner->banner_type}}</td>
          <td>{{$banner->live_from}}</td>
          <td>{{$banner->live_till}}</td>
          {{-- <td class="text-nowrap">
            <a href="/cms/courses/view" class="mx-1" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/courses/edit" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/courses/delete" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td> --}}
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
        <li class="page-item"><a class="page-link" href="{{$banners->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$banners->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$banners->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$banners->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop