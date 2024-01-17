@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Tickets</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/tickets/add" class="btn btn-lg btn-secondary">Add Ticket</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <form action="" method="get">
      <div class="row">
        @csrf
        <div class="form-group col-lg-4 col-md-6">
          <label>Name</label>
          <input type="text" name="name" id="_name" class="form-control" placeholder="Blog Name" />
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
            <th>ticket_id</th>
            <th>name</th>
            <th>mobile</th>
            <th>email</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @if(!empty($tickets))
        @foreach ($tickets as $ticket)
        <tr>
          <td>{{$ticket->ticket_id}}</td>
          <td>{{$ticket->name}}</td>
          <td>{{$ticket->mobile}}</td>
          <td>{{$ticket->email}}</td>
          <td class="text-nowrap">
            <a href="/cms/tickets/edit/{{$ticket->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/tickets/delete/{{$ticket->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
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
        <li class="page-item"><a class="page-link" href="{{$tickets->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$tickets->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$tickets->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$tickets->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop