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
          <div class="card mb-2">
            @if(!empty($subscription['expiry_date']) && $subscription['expiry_date'] >= date("Y-m-d"))
              <a href="{{ !empty($subscription['product_details']['slug']) ? '/course/'.$subscription['product_details']['slug'] : '' }}" class="card-link">
            @else
              <a href="javascript:void(0)" class="card-link">
            @endif
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
                    <p class="font-14 mb-1 text-dark">{{ !empty($subscription['product_details']['name']) ? $subscription['product_details']['name'] : '' }}</p>
                    @if(!empty($subscription['expiry_date']) && $subscription['expiry_date'] > date("Y-m-d"))
                      <p class="font-12 text-muted mb-0">{{ !empty($subscription['expiry_date']) ? 'Valid Till - '.date_format(date_create($subscription['expiry_date']),'d M Y') : '' }}</p>
                    @else
                      <p class="font-12 text-danger mb-0">{{ !empty($subscription['expiry_date']) ? 'Expired on - '.date_format(date_create($subscription['expiry_date']),'d M Y') : '' }}</p>
                    @endif
                  </div>
                  <div class="align-self-center">
                    <i class="bi bi-chevron-right font-22"></i>
                  </div>
                </div>
              </div>
            </a>
            <div class="card-footer bg-light-blue text-align-center py-1 text-center">
              <a href="/write-review/{{ !empty(\Auth::user()->_id) ? \Auth::user()->_id : '' }}/{{ !empty($subscription['product_id']) ? $subscription['product_id'] : ''}}" class="card-link d-block w-100 text-primary font-12"><i class="bi bi-star-half align-middle"></i><span class="align-middle px-2">Write Review</span></a>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="card mw-768 mx-auto my-3">
        <div class="card-body text-center">
          <div class="card-text text-theme-contrast font-weight-bold font-22 mb-3">{{ !empty(\Auth::user()->name) ? 'Hi, '.\Auth::user()->name : 'Hi, Student' }}</div>
          <p class="text-dark">It seems that you haven't suscribed any courses yet. You can lift up your skills with our featue courses.</p>
          <p><a href="/course" class="btn-lg btn-theme-contrast">Explore Courses</a></p>
        </div>
      </div>
    @endif
  </div>
@stop

