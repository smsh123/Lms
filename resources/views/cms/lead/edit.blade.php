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
          <label class="font-weight-bold">Lead Name Hindi</label>
          <input type="text" class="form-control" name="name_hn" placeholder="Lead Name Hindi" value="{{$Lead->name_hn}}" />
          @if ($errors->has('name_hn'))
          <p class="text-danger">{{ $errors->first('name_hn') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Lead Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Lead slug" value="{{$Lead->slug}}" />
          @if ($errors->has('slug'))
          <p class="text-danger">{{ $errors->first('slug') }}</p>
        @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Batch Start Date</label>
          <input type="date" class="form-control" name="start_date" value="{{$Lead->start_date}}"/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Lead Duration (Days)</label>
          <input type="number" class="form-control" placeholder="Days" name="duration" value="{{$Lead->duration}}" />
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Class Mode</label>
          <select class="form-control" name="class_mode" value="{{$Lead->class_mode}}">
            <option>Select</option>
            <option value="live">Live</option>
            <option value="recorded">Recorded</option>
            <option value="offline">Offline</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Lead Description</label>
          <textarea class="form-control txteditor" rows="6" placeholder="Lead Description ..." name="description">{{$Lead->description}}</textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Lead Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Lead Synopsis ..." name="synopsis">{{$Lead->synopsis}}</textarea>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12 align-self-center">
            <label class="font-weight-bold mb-0">Display Leads</label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
            <label class="form-check-label" for="inlineCheckbox1" name="display_Lead[]">Home</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
            <label class="form-check-label" for="inlineCheckbox2" name="display_Lead[]">Lead Listing</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
            <label class="form-check-label" for="inlineCheckbox3" name="display_Lead[]">Lead</label>
          </div>
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