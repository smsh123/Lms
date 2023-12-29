@extends('cms.layouts.master')
@section('body')
@php $global_picklist = session()->has('global_picklist') ? session('global_picklist') : [] ; @endphp
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Add Faq</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/faq" class="btn btn-lg btn-secondary">View Faq</a></div>
  </div>


  <form class="card" method="post" action="/cms/faq/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Faq Name</label>
          <input type="text" id="title" onkeyup="CreateAndSetSlug()" class="form-control" name="name" placeholder="Faq Name" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
        <div class="col-lg-6 align-self-center">
          <label class="font-weight-bold mb-0">Faq Status</label>
          <select name="status" class="form-control">
            @if(!empty($global_picklist['status']))
              @foreach ($global_picklist['status'] as $faq_status)
                  <option value="{{ !empty($faq_status['label']) ? $faq_status['label'] : '' }}">{{ !empty($faq_status['label']) ? $faq_status['label'] : '' }}</option>
              @endforeach
            @endif
          </select>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-12">
          <div class="accordion" id="accordionExample">
            <div class="card" id="card1">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0 d-flex justify-content-between">
                  <div class="align-self-center flex-fill">
                    <button class="btn font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Item#1
                    </button>
                  </div>
                  <div class="align-self-center">
                    <a class="btn btn-danger delete-card" data-card-id="card1" href="javascript:void(0);"><i class="bi bi-trash"></i></a>
                  </div>
                </h2>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="row form-group">
                    <div class="col-12">
                      <label class="font-weight-bold">Question</label>
                      <input type="text" class="form-control" name="question[]" placeholder="question" />
                      @if ($errors->has('question'))
                        <p class="text-danger">{{ $errors->first('question') }}</p>
                      @endif
                    </div>
                    <div class="col-12">
                      <label class="font-weight-bold">Answer</label>
                      <textarea class="form-control" rows="2" name="answer[]" placeholder="Answer"></textarea>
                      @if ($errors->has('answer'))
                        <p class="text-danger">{{ $errors->first('answer') }}</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-6 text-left">
          <input type="submit" class="btn btn-lg btn-primary" value="Submit" />
        </div>
        <div class="col-6 text-right">
          <button type="button" onclick="addMore();" class="btn btn-lg btn-warning"><i class="bi bi-node-plus mr-2"></i> Add More</button>
        </div>
      </div>
    </div>
  </form> 
@stop