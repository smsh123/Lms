@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="min-vh-100">
    @include('layouts.profile_common')
    @if(!empty($subscriptions))
      <div class="bg-white py-1 border-top-0 border border-right-0 border-left-0">
        <div class="container">
          <div class="d-flex flex-nowrap justify-content-between" onclick="history.back()" >
            <div class="align-self-center">
              <div class="icon-48">
                <span class="btn btn-light border-radius-10"><i class="bi bi-chevron-left font-16"></i></span>
              </div>
            </div>
            <div class="align-self-center flex-fill pl-3">
              <h3 class="font-16 font-weight-bold mb-0">My Courses</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        @foreach ($subscriptions as $key => $subscription)
          <div class="card">
            <div class="card-body px-2">
              <div class="d-flex justify-content-between">
                <div class="align-self-center">
                  <div class="icon-80">
                    <div class="ratio-image image_16-9">
                      <img src="{{ !empty($subscription['product_details']['thumbnail_image']) ? $subscription['product_details']['thumbnail_image'] : '' }}" alt="course thumb" />
                    </div>
                  </div>
                </div>
                <div class="align-self-center pl-2 flex-fill">
                  <p class="font-14 mb-1">{{ !empty($subscription['product_details']['name']) ? $subscription['product_details']['name'] : '' }}</p>
                  @if(!empty($subscription['expiry_date']) && $subscription['expiry_date'] > date("Y-m-d"))
                    <p class="font-12 text-muted mb-0">{{ !empty($subscription['expiry_date']) ? 'Valid Till - '.date_format(date_create($subscription['expiry_date']),'d M Y') : '' }}</p>
                  @elseif(!empty($subscription['expiry_date']) && $subscription['expiry_date'] == date("Y-m-d"))
                    <p class="font-12 text-warning mb-0">{{ !empty($subscription['expiry_date']) ? 'Expires on - '.date_format(date_create($subscription['expiry_date']),'d M Y') : '' }}</p>
                  @else
                    <p class="font-12 text-danger mb-0">{{ !empty($subscription['expiry_date']) ? 'Expired on - '.date_format(date_create($subscription['expiry_date']),'d M Y') : '' }}</p>
                  @endif
                </div>
                <div class="align-self-center">
                @if(!empty($subscription['expiry_date']) && $subscription['expiry_date'] >= date("Y-m-d"))
                  <a href="{{ !empty($subscription['product_details']['slug']) ? '/course/'.$subscription['product_details']['slug'] : '' }}" class="card-link stretched-link"><i class="bi bi-chevron-right font-22"></i></a>
                @else
                  <a href="javascript:void(0)" class="card-link stretched-link"><i class="bi bi-chevron-right font-22"></i></a>
                @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else

    @endif
  </div>
@stop

