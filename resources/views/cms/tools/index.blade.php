@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Tools</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/tools/add" class="btn btn-lg btn-secondary">Add Tools</a></div>
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
            {{-- <th>Created By</th> --}}
            <th>Modified Date</th>
            {{-- <th>Modified By</th> --}}
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @if(!empty($tools))
        @foreach ($tools as $tool)
        <tr>
          <td>{{$tool->name}}</td>
          <td>{{$tool->slug}}</td>
          <td>{{$tool->created_at}}</td>
          {{-- <td>vivek@aryabhattclasses.com</td> --}}
          <td>{{$tool->updated_at}}</td>
          {{-- <td>vivek@aryabhattclasses.com</td> --}}
          <td class="text-nowrap">
            <a href="/cms/tools/toggle-status/{{$tool->id}}" class="mx-1 {{ !empty($tool->is_public) && $tool->is_public == 1 ? 'text-success' : 'text-danger' }}" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/tools/edit/{{$tool->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/tools/delete/{{$tool->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
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
        <li class="page-item"><a class="page-link" href="{{$tools->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$tools->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$tools->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$tools->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop