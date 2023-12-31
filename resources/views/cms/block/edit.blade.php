@extends('cms.layouts.master')
@section('body')
@php $global_picklist = session()->has('global_picklist') ? session('global_picklist') : [] ; @endphp
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Edit Block</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/blocks" class="btn btn-lg btn-secondary">View Blocks</a></div>
  </div>


  <form class="card" method="post" action="/cms/blocks/update">
    @csrf
    <input type="hidden" name="id" value="{{ !empty($blocks['_id']) ? $blocks['_id'] : '' }}"  />
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-4">
          <label class="font-weight-bold">Block Name</label>
          <input type="text" id="title" class="form-control" value="{{ !empty($blocks['name']) ? $blocks['name'] : '' }}" name="name" placeholder="menu Name" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
        <div class="col-lg-4">
          <label class="font-weight-bold">Block Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="menu slug" value="{{ !empty($blocks['slug']) ? $blocks['slug'] : '' }}" readonly  />
          @if ($errors->has('slug'))
            <p class="text-danger">{{ $errors->first('slug') }}</p>
          @endif
        </div>
        <div class="col-lg-4 align-self-center">
          <label class="font-weight-bold mb-0">Block Status</label>
          <select name="status" class="form-control">
            @if(!empty($global_picklist['status']))
              @foreach ($global_picklist['status'] as $menu_status)
                  <option {{ !empty($blocks['status']) && $blocks['status'] == $menu_status['label'] ? "selected" : ''}} value="{{ !empty($menu_status['label']) ? $menu_status['label'] : '' }}">{{ !empty($menu_status['label']) ? $menu_status['label'] : '' }}</option>
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
            @if(!empty($blocks['items']))
              @foreach ($blocks['items'] as $key => $blockitem)
                <div class="card" id="card{{ $key }}">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0 d-flex justify-content-between">
                      <div class="align-self-center flex-fill">
                        <button class="btn font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Item# {{ !empty($blockitem['title']) ? $blockitem['title'] : '' }}
                        </button>
                      </div>
                      <div class="align-self-center">
                        <a class="btn btn-danger delete-card" data-card-id="card{{ $key }}" href="javascript:void(0);"><i class="bi bi-trash"></i></a>
                      </div>
                    </h2>
                  </div>
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <div class="row form-group">
                        <div class="col-lg-4">
                          <label class="font-weight-bold">Item Title</label>
                          <input type="text" class="form-control" name="title[]" value="{{ !empty($blockitem['title']) ? $blockitem['title'] : '' }}" placeholder="Item Title" />
                          @if ($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('title') }}</p>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <label class="font-weight-bold">Link</label>
                          <input type="text" class="form-control" name="link[]" placeholder="Item Link" value="{{ !empty($blockitem['link']) ? $blockitem['link'] : '' }}"  />
                          @if ($errors->has('slug'))
                            <p class="text-danger">{{ $errors->first('link') }}</p>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <label class="font-weight-bold">Icon</label>
                          <input type="text" class="form-control" name="icon[]" placeholder="Icon Class" value="{{ !empty($blockitem['icon']) ? $blockitem['icon'] : '' }}"  />
                          @if ($errors->has('slug'))
                            <p class="text-danger">{{ $errors->first('icon') }}</p>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <label class="font-weight-bold">Short Description</label>
                          <textarea type="text" class="form-control" name="short_description[]" placeholder="Short Description">
                            {{ !empty($blockitem['short_description']) ? $blockitem['short_description'] : '' }}
                          </textarea>
                          @if ($errors->has('short_description'))
                            <p class="text-danger">{{ $errors->first('short_description') }}</p>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <label class="font-weight-bold">Long Description</label>
                          <textarea type="text" class="form-control" name="long_description[]" placeholder="Long Description">
                            {{ !empty($blockitem['long_description']) ? $blockitem['long_description'] : '' }}
                          </textarea>
                          @if ($errors->has('long_description'))
                            <p class="text-danger">{{ $errors->first('long_description') }}</p>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <label class="font-weight-bold">Extra Info</label>
                          <textarea type="text" class="form-control" name="extra_info[]" value="{{ !empty($blockitem['extra_info']) ? $blockitem['extra_info'] : '' }}" placeholder="Extra Info"></textarea>
                          @if ($errors->has('extra_info'))
                            <p class="text-danger">{{ $errors->first('extra_info') }}</p>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <label class="font-weight-bold">Image</label>
                          <input type="text" class="form-control" name="image[]" placeholder="Image URL" value="{{ !empty($blockitem['image']) ? $blockitem['image'] : '' }}" />
                          @if ($errors->has('image'))
                            <p class="text-danger">{{ $errors->first('image') }}</p>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
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