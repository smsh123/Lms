@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Edit Category</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/categories" class="btn btn-lg btn-secondary">View Categories</a></div>
  </div>
  <form class="card" method="post" action="/cms/categories/update">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Category</label>
          <select class="form-control select_to" name="category">
            <option>Select</option>
            @if(!empty($categories))
              @foreach ($categories as $key => $category )
                <option @if(!empty($categories->category) && $categories->category == $category['slug']) selected @endif value="{{ !empty($category['slug']) ? $category['slug'] : '' }}">{{ !empty($category['name']) ? $category['name'].' - ' : '' }}{</option>
              @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Category Name</label>
          <input type="text" class="form-control" name="name" placeholder="Category Name" value="{{$categories->name}}"/>
          <input type="hidden"  name="id"  value="{{$categories->id}}"/>
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Category Name Hindi</label>
          <input type="text" class="form-control" name="name_hindi" placeholder="Category Name Hindi" value="{{$categories->name_hindi}}" />
          @if ($errors->has('name_hindi'))
          <p class="text-danger">{{ $errors->first('name_hindi') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Meta Title</label>
          <input type="text" class="form-control" name="meta_title" value="{{ !empty($Category['meta_title']) ? $Category['meta_title'] : '' }}" placeholder="Meta Title" />
          @if ($errors->has('meta_title'))
            <p class="text-danger">{{ $errors->first('meta_title') }}</p>
          @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Meta Keywords</label>
          <input type="text" class="form-control" data-role="tagsinput" name="meta_keywords" value="{{ !empty($Category['meta_keywords']) ? $Category['meta_keywords'] : '' }}" placeholder="Keywords" />
          @if ($errors->has('meta_keywords'))
          <p class="text-danger">{{ $errors->first('meta_keywords') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Meta Description</label>
          <textarea class="form-control" name="meta_description">{{ !empty($Category['meta_description']) ? $Category['meta_description'] : '' }}</textarea>
          @if ($errors->has('meta_description'))
            <p class="text-danger">{{ $errors->first('meta_description') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Category Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Category slug" value="{{$categories->slug}}" readonly />
          @if ($errors->has('slug'))
          <p class="text-danger">{{ $errors->first('slug') }}</p>
        @endif
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Batch Start Date</label>
          <input type="date" class="form-control" name="start_date" value="{{$categories->start_date}}"/>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Category Duration (Days)</label>
          <input type="number" class="form-control" placeholder="Days" name="duration" value="{{$categories->duration}}" />
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Class Mode</label>
          <select class="form-control" name="class_mode" value="{{$categories->class_mode}}">
            <option>Select</option>
            <option @if(!empty($categories->class_mode) && $categories->class_mode =="live") selected @endif value="live">Live</option>
            <option @if(!empty($categories->class_mode) && $categories->class_mode =="recorded") selected @endif value="recorded">Recorded</option>
            <option @if(!empty($categories->Category_type) && $categories->Category_type =="live_and_recorded") selected @endif  value="live_and_recorded">Live & Recorded</option>
            <option @if(!empty($categories->class_mode) && $categories->class_mode =="offline") selected @endif value="offline">Offline</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Mentors</label>
          <select class="form-control select_to" name="mentors[]" multiple="multiple">
            <option>Select</option>
            @if(!empty($mentors))
              @foreach ($mentors as $key => $mentor )
                <option @if(!empty($categories->mentors) && in_array($mentor['_id'],$categories->mentors)) selected @endif value="{{ !empty($mentor['_id']) ? $mentor['_id'] : '' }}">{{ !empty($mentor['name']) ? $mentor['name'].' - ' : '' }}{{ !empty($mentor['_id']) ? $mentor['_id'] : '' }}</option>
              @endforeach
            @endif
          </select>
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Category Type</label>
          <select class="form-control" name="Category_type">
            <option>Select</option>
            <option @if(!empty($categories->Category_type) && $categories->Category_type =="class") selected @endif value="class">Class</option>
            <option @if(!empty($categories->Category_type) && $categories->Category_type =="ebook") selected @endif value="ebook">E-Book</option>
            <option @if(!empty($categories->Category_type) && $categories->Category_type =="audio_book") selected @endif value="audio_book">Audio Book</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Tools</label>
          <select class="form-control select_to" name="tools[]" multiple="multiple">
            <option>Select</option>
            @if(!empty($tools))
              @foreach ($tools as $key => $tool )
                <option @if(!empty($categories->tools) && in_array($tool['link'],$categories->tools)) selected @endif value="{{ !empty($tool['link']) ? $tool['link'] : '' }}">{{ !empty($tool['name']) ? $tool['name'].' - ' : '' }}{</option>
              @endforeach
            @endif
          </select>
        </div>
         <div class="col-lg-6">
          <label class="font-weight-bold">Skills</label>
          <input type="text" class="form-control" data-role="tagsinput" value="{{!empty($categories->skills) ? $categories->skills : ''}}" name="skills" placeholder="Skills" />
          @if ($errors->has('skills'))
          <p class="text-danger">{{ $errors->first('skills') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Category Description</label>
          <textarea class="form-control txteditor" rows="6" placeholder="Category Description ..." name="description">{{$categories->description}}</textarea>
          @if ($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Category Synopsis</label>
          <textarea class="form-control" rows="4"  placeholder="Category Synopsis ..." name="synopsis">{{$categories->synopsis}}</textarea>
        </div>
      </div>
       <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Tags</label>
          @php
            $tags = !empty($categories->tags) ? implode(',',$categories->tags) : '';
          @endphp
          <input type="text" value="{{ $tags }}" data-role="tagsinput" class="form-control" name="tags" />
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Highlights</label>
          <input type="text" value="{{!empty($categories->highlights) ? $categories->highlights : ''}}" data-role="tagsinput" class="form-control" name="highlights" />
        </div>
      </div>
      <fieldset class="border p-3 mb-3">
        <legend class="d-inline-block w-auto px-3">Price & Offer Details</legend>
        <div class="row form-group">
          <div class="col-lg-6">
            <label class="font-weight-bold">Original Price (&#8377;)</label>
            <input type="number" class="form-control" placeholder="Original Price"  name="original_price" value="{{$categories->original_price}}"/>
            @if ($errors->has('original_price'))
          <p class="text-danger">{{ $errors->first('original_price') }}</p>
        @endif
          </div>
          <div class="col-lg-6">
              <label class="font-weight-bold">Selling Price (&#8377;)</label>
              <input type="number" class="form-control" placeholder="Selling Price" name="selling_price" value="{{$categories->selling_price}}" />
              @if ($errors->has('selling_price'))
          <p class="text-danger">{{ $errors->first('selling_price') }}</p>
        @endif
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6">
            <label class="font-weight-bold">Offer Type</label>
            <select class="form-control" name="offer_type" value="{{$categories->offer_type}}">
              <option>Select</option>
              <option value="discount">Discount</option>
              <option value="cashback">Cashback</option>
              <option value="coupon">Coupon</option>
            </select>
          </div>
          <div class="col-lg-6 align-self-center">
              <label class="font-weight-bold mb-0">Offer Unit</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="disount_unit" id="inlineRadio1" value="flat" {{$categories->disount_unit == 'flat' ? 'checked' : ''}}>
                <label class="form-check-label mb-0" for="inlineRadio1">Flat</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="disount_unit" id="inlineRadio2" value="percentage" {{$categories->disount_unit == 'percentage' ? 'checked' : ''}}>
                <label class="form-check-label mb-0" for="inlineRadio2">Percentage</label>
              </div>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6">
            <label class="font-weight-bold">Offer Value</label>
            <input type="number" class="form-control" placeholder="Offer Value"  name="offer_value" value="{{$categories->offer_value}}"/>
          </div>
          <div class="col-lg-6">
              <label class="font-weight-bold">Coupon Code</label>
              <input type="text" class="form-control" placeholder="Couupon Code" name="coupon_code" value="{{$categories->coupon_code}}" />
          </div>
        </div>
        <div class="row form-group">
          <div class="col-12">
            <label class="font-weight-bold">Offer Label</label>
            <textarea rows="2" class="form-control" placeholder="Write Offer Details Text" name="offer_details">{{$categories->offer_details}}</textarea>
          </div>
        </div>
      </fieldset>
      <div class="row form-group">
        <div class="col-lg-12 align-self-center">
            <label class="font-weight-bold mb-0">Display Categorys</label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
            <label class="form-check-label" for="inlineCheckbox1" name="display_Category[]">Home</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
            <label class="form-check-label" for="inlineCheckbox2" name="display_Category[]">Category Listing</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
            <label class="form-check-label" for="inlineCheckbox3" name="display_Category[]">Blog</label>
          </div>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Thumbnail Image</label>
          <div class="input-group upload-image mb-3">
            <input id="inputImage" type="file" class="form-control" placeholder="Banner Image">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage','form-image-input','image-preview');" type="button" id="button-addon2">Upload</button>
            </div>
          </div>
          <input id="form-image-input" type="hidden" class="form-control" name="thumbnail_image" />

          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview" src="{{ !empty($Category['thumbnail_image']) ? $Category['thumbnail_image'] : '' }}" />
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold">Category Banner</label>
          <div class="input-group upload-image mb-3">
            <input id="inputImage_1" type="file" class="form-control" placeholder="Banner Image">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage_1','form-image-input_1','image-preview_1');" type="button" id="button-addon2">Upload</button>
            </div>
          </div>
          <input id="form-image-input_1" type="hidden" class="form-control" name="banner_image" />
          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview_1" src="{{ !empty($Category['banner_image']) ? $Category['banner_image'] : '' }}" />
            </div>
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