@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Scheduling</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/schedule/add" class="btn btn-lg btn-secondary">Add Schedule</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <form action="" method="get">
      <div class="row">
        @csrf
        <div class="form-group col-lg-4 col-md-6">
          <label>Course</label>
          <input type="text" name="course" id="_course" class="form-control" placeholder="Name" />
        </div>
        <div class="form-group col-lg-4 col-md-6">
          <label>Module</label>
          <input type="text" name="module" id="_module" class="form-control" />
        </div>
        <div class="form-group col-lg-4 col-md-6">
          <label>Sub Module</label>
          <input type="text" name="sub_module" id="_sub_module" class="form-control" />
        </div>
        <div class="form-group col-lg-4 col-md-6">
          <label>Teacher</label>
          <input type="text" name="teacher" id="_teacher" class="form-control" />
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
            <th>Course</th>
            <th>Module</th>
            <th>Sub Module</th>
            <th>Teacher</th>
            <th>Created Date</th>
            {{-- <th>Created By</th> --}}
            <th>Modified Date</th>
            {{-- <th>Modified By</th> --}}
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($schedules as $schedule)
        <tr>
          <td>{{$schedule->course}}</td>
          <td>{{$schedule->module}}</td>
          <td>{{$schedule->sub_module}}</td>
          <td>{{$schedule->teacher}}</td>
          <td>{{$schedule->created_at}}</td>
          {{-- <td>vivek@aryabhattclasses.com</td> --}}
          <td>{{$schedule->updated_at}}</td>
          {{-- <td>vivek@aryabhattclasses.com</td> --}}
          <td class="text-nowrap">
            <a href="/cms/schedule/view" class="mx-1" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/schedule/edit/{{$schedule->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/schedule/delete/{{$schedule->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation" class="my-3">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="{{$schedules->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$schedules->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$schedules->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$schedules->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop