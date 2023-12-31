@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Testimonial</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/testimonials/add" class="btn btn-lg btn-secondary">Add Testimonials</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>Testimonial Name</label>
        <input type="text" class="form-control" placeholder="Title of Testimonial" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Starting Date</label>
        <input type="date" class="form-control" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Created By</label>
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
            <th>User</th>
            <th>Type</th>
            <th>Status</th>
            <th>Synopsis</th>
            <th>Image</th>
            <th>Video</th>
            <th>Modified Date</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($testimonial as $testimonial)
        <tr>
          <td>{{$testimonial->user}}</td>
          <td>{{$testimonial->type}}</td>
          <td>{{$testimonial->status}}</td>
          <td>{{$testimonial->synopsis}}</td>
          <td>{{$testimonial->image}}</td>
           <td>{{$testimonial->video}}</td>
          <td>{{$testimonial->updated_at}}</td>
          {{-- <td>vivek@aryabhattclasses.com</td> --}}
          <td class="text-nowrap">
            <a href="/cms/testimonials/view" class="mx-1" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/testimonials/edit/{{$testimonial->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/testimonials/delete/{{$testimonial->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation" class="my-3">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="{{$testimonial->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$testimonial->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$testimonial->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$testimonial->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop