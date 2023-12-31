@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-12"><h1 class="font-weight-bold font-32 my-3 text-warning">Course Module Mapping</h1></div>
  </div>

  @if(!empty($mappings))

   <div class="overflow-auto w-100">
    <table class="table table-striped table-bordered">
      <thead>
          <tr>
            <th>Course</th>
            <th>Created Date</th>
            <th>Modified Date</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($mappings as $mapping)
        <tr>
          <td>{{$mapping->course}}</td>
          <td>{{$mapping->created_at}}</td>
          <td>{{$mapping->updated_at}}</td>
          <td class="text-nowrap">
            <a href="/cms/course-module-mapping/view" class="mx-1" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/course-module-mapping/edit/{{$mapping->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/course-module-mapping/delete/{{$mapping->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="py-3">
    <nav aria-label="Page navigation" class="my-3">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="{{$mappings->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$mappings->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$mappings->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$mappings->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>

  @endif

@stop