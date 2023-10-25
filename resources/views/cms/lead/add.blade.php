@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Add Leads</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/leads" class="btn btn-lg btn-secondary">View Leads</a></div>
  </div>


  <form class="card" method="post" action="/cms/leads/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Name</label>
          <input type="text" class="form-control" name="name" placeholder="Name" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Email</label>
          <input type="text" class="form-control" name="email" placeholder="Email" />
          @if ($errors->has('email'))
          <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Mobile</label>
          <input type="number" class="form-control" name="mobile" placeholder="Mobile"  />
          @if ($errors->has('mobile'))
          <p class="text-danger">{{ $errors->first('mobile') }}</p>
        @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Course Interested</label>
          <select name="course_interested">
            <option value="0">Select Course</option>
            <option value="0">Course 1</option>
            <option value="0">Course 2</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Lead Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Lead Synopsis ..." name="synopsis"></textarea>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12 align-self-center">
            <label class="font-weight-bold mb-0">Lead Status</label>
            <select name="status">
              <option>Active</option>
              <option>Deactive</option>
            </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 text-center">
          <input type="submit" class="btn btn-lg btn-primary" value="Submit" />
        </div>
      </div>
    </div>
  </form>

@stop