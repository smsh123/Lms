@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Orders</h1></div>
  </div>
  <fieldset class="border mb-3 p-3">
    <legend class="d-inline-block font-weight-bold w-auto">Search</legend>
    <div class="row">
      <div class="form-group col-lg-4 col-md-6">
        <label>Order UID</label>
        <input type="text" class="form-control" placeholder="UID" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Name</label>
        <input type="text" class="form-control" placeholder="Name of User" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Email</label>
        <input type="text" class="form-control" placeholder="Email" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Email</label>
        <input type="number" class="form-control" placeholder="Phone" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Order Date</label>
        <input type="date" class="form-control" />
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Payment Status</label>
        <select class="form-control">
          <option>Select</option>
        </select>
      </div>
      <div class="form-group col-lg-4 col-md-6">
        <label>Product Type</label>
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
            <th>Order UID</th>
            <th>Product Name</th>
            <th>Product Type</th>
            <th>User</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Amount</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
        <tr>
          <td>{{!empty($order->uid) ? $order->uid : ''}}</td>
          <td>{{!empty($order->product_name) ? $order->product_name : ''}}</td>
          <td>{{!empty($order->product_type) ? $order->product_type : ''}}</td>
          <td>{{!empty($order->user_details['full_name']) ? $order->user_details['full_name'] : ''}}<br />{{!empty($order->user_details['mobile']) ? $order->user_details['mobile'] : ''}}<br />{{!empty($order->user_details['email']) ? $order->user_details['email'] : ''}}</td>
          <td>{{!empty($order->price) ? $order->price : 0}}</td>
          <td>{{!empty($order->discount) ? $order->discount : 0}}</td>
          <td>{{!empty($order->amount) ? $order->amount : 0}}</td>
          <td>{{!empty($order->created_at) ? $order->created_at : ''}}</td>
          <td>{{!empty($order->status) ? $order->status : ''}}</td>
          <td class="text-nowrap">
            <a href="/cms/orders/edit/{{$order->id}}" class="mx-1" title="Edit"><span data-feather="edit"></span></a>
            <a href="/cms/orders/delete/{{$order->id}}" class="mx-1" title="Delete"><span data-feather="trash"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-3">
    <nav aria-label="Page navigation" class="my-3">
      <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="{{$orders->previousPageUrl()}}">Previous</a></li>
        @for($i=1;$i<=$orders->lastPage();$i++)
          <li class="page-item"><a class="page-link" href="{{$orders->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$orders->nextPageUrl()}}">Next</a></li>
      </ul>
    </nav>
  </div>
@stop