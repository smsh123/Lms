@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-12"><h1>Course Faq Mapping</h1></div>
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
            <a href="/cms/course-faq-mapping/view" class="mx-1" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/course-faq-mapping/edit/{{$mapping->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/course-faq-mapping/delete" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @endif

@stop