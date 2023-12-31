@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Subscription</h1></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>Order UID</label>
        <input type="text" class="form-control" placeholder="UID" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Subscription ID</label>
        <input type="text" class="form-control" placeholder="Subscription Id" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>User ID</label>
        <input type="text" class="form-control" placeholder="User Id" />
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
            <th>Order UID</th>
            <th>Product Name</th>
            <th>Product Type</th>
            <th>User</th>
            <th>Expiry Date</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @if(!empty($subscriptions))
        @foreach ($subscriptions as $subscription)
        <tr>
          <td>{{!empty($subscription->uid) ? $subscription->uid : ''}}</td>
          <td>{{!empty($subscription->product_name) ? $subscription->product_name : ''}}</td>
          <td>{{!empty($subscription->product_type) ? $subscription->product_type : ''}}</td>
          <td>{{!empty($subscription->user_name) ? $subscription->user_name : ''}}<br />{{!empty($subscription->user_id) ? '('.$subscription->user_id.')' : ''}}</td>
          <td>{{!empty($subscription->expiry_date) ? $subscription->expiry_date : ''}}</td>
          <td class="text-nowrap">
            <a href="/cms/subscriptions/edit/{{$subscription->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/subscriptions/delete/{{$subscription->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
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
        <li class="page-item"><a class="page-link" href="{{$subscriptions->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$subscriptions->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$subscriptions->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$subscriptions->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop