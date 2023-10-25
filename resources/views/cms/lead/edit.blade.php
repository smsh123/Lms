@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Edit Leads</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/leads" class="btn btn-lg btn-secondary">View Leads</a></div>
  </div>


  <form class="card" method="post" action="/cms/leads/update">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Lead Name</label>
          <input type="text" class="form-control" name="name" placeholder="Lead Name" value="{{$Lead->name}}"/>
          <input type="hidden"  name="id"  value="{{$Lead->id}}"/>
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Lead Email</label>
          <input type="text" class="form-control" name="email" placeholder="Lead Email" value="{{$Lead->email}}" />
          @if ($errors->has('name_hn'))
          <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
        </div>
      </div>
       <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Mobile</label>
          <input type="number" class="form-control" name="mobile" placeholder="{{$Lead->mobile}}" value="{{$Lead->mobile}}"  />
          @if ($errors->has('mobile'))
          <p class="text-danger">{{ $errors->first('mobile') }}</p>
        @endif
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Course Interested</label>
          <select name="course_interested" Class="form-control">
            <option value="0">Select Course</option>
            <option {{!empty($Lead->course_interested) &&  $Lead->course_interested == 'Course 1' ? 'selected' : ''}} value="Course 1">Course 1</option>
            <option {{!empty($Lead->course_interested) &&  $Lead->course_interested == 'Course 2' ? 'selected' : ''}} value="Course 2">Course 2</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Lead Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Lead Synopsis ..." name="synopsis">
            {{!empty($Lead->synopsis) ? $Lead->synopsis : '' }}
          </textarea>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12 align-self-center">
            <label class="font-weight-bold mb-0">Lead Status</label>
            <select name="status" Class="form-control">
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