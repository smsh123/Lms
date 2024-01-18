@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Faq</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/faq/add" class="btn btn-lg btn-secondary">Add Faq</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <form action="" method="get">
      <div class="row">
        @csrf
        <div class="form-group col-lg-4 col-md-6">
          <label>Name</label>
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
            <th>Title</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Modified Date</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($faqs as $faq)
        <tr>
          <td>{{$faq->name}}</td>
          <td>{{$faq->status}}</td>
          <td>{{$faq->created_at}}</td>
          <td>{{$faq->updated_at}}</td>
          <td class="text-nowrap">
            <a href="/cms/faq/toggle-status/{{$faq->id}}" class="mx-1 {{ !empty($faq->is_public) && $faq->is_public == 1 ? 'text-success' : 'text-danger' }}" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/faq/edit/{{$faq->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/faq/delete/{{$faq->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation" class="my-3">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="{{$faqs->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$faqs->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$faqs->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$faqs->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop