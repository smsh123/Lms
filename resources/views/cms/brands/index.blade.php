@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Brands</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/brands/add" class="btn btn-lg btn-secondary">Add Brand</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>Brand Name</label>
        <input type="text" class="form-control" placeholder="Title of Category" />
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
            {{-- <th>Created By</th> --}}
            <th>Modified Date</th>
            {{-- <th>Modified By</th> --}}
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @if(!empty($brands))
        @foreach ($brands as $brand)
        <tr>
          <td>{{$brand->name}}</td>
          <td>{{$brand->slug}}</td>
          <td>{{$brand->created_at}}</td>
          {{-- <td>vivek@aryabhattclasses.com</td> --}}
          <td>{{$brand->updated_at}}</td>
          {{-- <td>vivek@aryabhattclasses.com</td> --}}
          <td class="text-nowrap">
            <a href="/cms/brands/view" class="mx-1" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/brands/edit/{{$brand->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/brands/delete/{{$brand->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      @endif
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation" class="my-3">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="{{$brands->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$brands->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$brands->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$brands->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop