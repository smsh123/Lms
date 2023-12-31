@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Leads</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/leads/add" class="btn btn-lg btn-secondary">Add Leads</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>Blog Name</label>
        <input type="text" class="form-control" placeholder="Title of Course" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Publish Date</label>
        <input type="date" class="form-control" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Blog Author</label>
        <select class="form-control">
          <option>Select</option>
        </select>
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
            <th>Mobile Date</th>
            <th>Lead Status</th>
            <th>Course Interested/th>
            <th>Synopsis</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($leads as $lead)
        <tr>
          <td>{{$lead->name}}</td>
          <td>{{$lead->email}}</td>
          <td>{{$lead->mobile}}</td>
          <td>{{$lead->status}}</td>
          <td>{{$lead->course_interested}}</td>
          <td>{{$lead->synopsis}}</td>
          <td class="text-nowrap">
            <a href="/cms/leads/view" class="mx-1" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/leads/edit/{{$lead->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/leads/delete/{{$lead->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation" class="my-3">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="{{$leads->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$leads->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$leads->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$leads->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop