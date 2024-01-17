@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12"><h1 class="font-weight-bold font-32 my-3 text-warning">Reviews</h1></div>
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
        <div class="form-group col-lg-4 col-md-6">
          <label>Slug</label>
          <input type="text" name="slug" id="_slug" class="form-control" />
        </div>
        <div class="form-group col-lg-4 col-md-6">
          <label>Type</label>
          <input type="text" name="course_type" id="_course_type" class="form-control" />
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
            <th>name</th>
            <th>mobile</th>
            <th>email</th>
            <th>comment</th>
            <th>product</th>
            <th>rating</th>
            <th>image</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @if(!empty($reviews))
          @foreach ($reviews as $review)
            <tr>
              <td>{{$review->name}}</td>
              <td>{{$review->mobile}}</td>
              <td>{{$review->email}}</td>
              <td><textarea class="form-control" rows="3">{{$review->comment}}</textarea></td>
              <td>{{$review->product}}</td>
              <td>{{$review->rating}}</td>
              <td><div class="icon-80 mx-auto"><div class="ratio-image image_1-1 rounded-circle"><img src="{{$review->image}}" alt="image" /></div></div></td>
              <td class="text-nowrap">
                <a href="/cms/reviews/toggle-status/{{$review->id}}" class="mx-1 {{ !empty($review->is_public) && $review->is_public == 1 ? 'text-success' : 'text-danger' }}" title="View"><span data-feather="eye"></span></a>
                <a href="/cms/reviews/delete/{{$review->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
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
        <li class="page-item"><a class="page-link" href="{{$reviews->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$reviews->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$reviews->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$reviews->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop