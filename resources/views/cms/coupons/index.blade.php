@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Coupons</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/coupons/add" class="btn btn-lg btn-secondary">Add Coupons</a></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>Coupon Code</label>
        <input type="text" class="form-control" placeholder="Title of Course" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Start Date</label>
        <input type="date" class="form-control" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Type</label>
        <select class="form-control">
          <option>Select</option>
        </select>
      </div>
      <div class="form-group col-lg-12 text-center">
        <input type="button" class="btn btn-primary" value="Search" >
      </div>
    </div>
  </fieldset>
  <div class="overflow-auto w-100">
    <table class="table table-striped table-bordered">
      <thead>
          <tr>
            <th>CODE</th>
            <th>Type</th>
            <th>Unit</th>
            <th>Coupon Value</th>
            <th>Created Date</th>
            <th>Modified Date</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @if(!empty($coupons))
        @foreach ($coupons as $coupon)
        <tr>
          <td>{{$coupon->code}}</td>
          <td>{{$coupon->type}}</td>
          <td>{{$coupon->unit}}</td>
          <td>{{$coupon->coupon_value}}</td>
          <td>{{$coupon->created_at}}</td>
          <td>{{$coupon->updated_at}}</td>
          <td class="text-nowrap">
            <a href="/cms/coupons/view" class="mx-1" title="View"><span data-feather="eye"></span></a>
            <a href="/cms/coupons/edit/{{$coupon->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/coupons/delete" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      @endif
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>
  </div>
@stop