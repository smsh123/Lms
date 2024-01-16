@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="min-vh-100">
    @include('layouts.profile_common')
      <div class="bg-white py-1 border-top-0 border border-right-0 border-left-0">
        <div class="container">
          <div class="d-flex flex-nowrap justify-content-between" onclick="history.back()" >
            <div class="align-self-center">
              <div class="icon-48">
                <span class="btn btn-light border-radius-10"><i class="bi bi-chevron-left font-16"></i></span>
              </div>
            </div>
            <div class="align-self-center flex-fill pl-3">
              <h3 class="font-16 font-weight-bold mb-0">My Orders</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container my-2">
        @if(!empty($orders))
          @foreach ($orders as $key => $order)
            <div class="card">
              <div class="card-body px-2">
                <div class="d-flex justify-content-between">
                  <div class="align-self-center flex-fill">
                    <p class="mb-0">@if(!empty($order['product_type']))<span class="badge badge-warning text-white">{{ $order['product_type'] }}</span> @endif</p>
                    <p class="font-14 mb-1">{{ !empty($order['product_name']) ? $order['product_name'] : '' }}</p>
                    <p class="mb-1 font-12">@if(!empty($order['uid']))<span class="text-dark pr-3">Order Id - {{ $order['uid'] }}</span> @endif @if(!empty($order['status']))<span class="badge badge-primary">{{ $order['status'] }}</span> @endif</p>
                    <p class="text-muted mb-0 font-12">{{ !empty($order['updated_at']) ? 'Order Date -'.date_format(date_create($order['updated_at']), 'd/m/Y') : '' }}</p>
                  </div>
                  <div class="align-self-center">
                    <a href="javascript:void(0)" class="card-link stretched-link"><i class="bi bi-chevron-right font-22"></i></a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div class="card mw-768 mx-auto my-3">
            <div class="card-body text-center">
              <div class="card-text text-theme-contrast font-weight-bold font-22 mb-3">{{ !empty(\Auth::user()->name) ? 'Hi, '.\Auth::user()->name : 'Hi, Student' }}</div>
              <p class="text-dark">It seems that you haven't placed any order yet. Don't worry once you place any order will display here.</p>
              <p><a href="/course" class="btn-lg btn-theme-contrast">Explore Courses</a></p>
            </div>
          </div>
        @endif
      </div>
  </div>
@stop

