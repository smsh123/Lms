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
            <h3 class="font-16 font-weight-bold mb-0">Settings</h3>
          </div>
        </div>
      </div>
    </div>
    @if(!empty($product_details))
      <div class="card mw-768 mx-auto mb-3 mt-3">
          <div class="card-body">
            <div class="d-flex align-items-stretch justify-content-between">
              <div class="align-self-center">
                <div class="icon-80">
                  <div class="ratio-image image_16-9">
                    <img src="{{ !empty($product_details['thumbnail_image']) ? $product_details['thumbnail_image'] : '' }}" alt="product_thumb" />
                  </div>
                </div>
              </div>
              <div class="align-self-center flex-fill pl-3">
                <h3 class="font-14 font-weight-bold mb-0">{{ !empty($product_details['name']) ? $product_details['name'] : '' }}</h3>
              </div>
            </div>
          </div>
      </div>
    @endif
    @if(!empty($profile_details))
      <div class="card mw-768 mx-auto my-3">
        <div class="card-body p-0">
          <form method="post" action="/settings/set">
            @csrf
            <input type="hidden" value="{{ !empty($profile_details['_id']) ? $profile_details['_id'] : ''}}" name="id" />
            <ul class="list-group mb-3">
              <li class="list-group-item">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" {{ !empty($profile_details['notification']) && $profile_details['notification'] == 'on' ? 'checked'  : ''}} name="notification" id="switch1">
                  <label class="custom-control-label" for="switch1">Push Notifications</label>
                </div>
              </li>
              <li class="list-group-item">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" {{ !empty($profile_details['emailers']) && $profile_details['emailers'] == 'on' ? 'checked'  : ''}}  name="emailers" id="switch2">
                  <label class="custom-control-label" for="switch2">Promotional Emailers</label>
                </div>
              </li>
              <li class="list-group-item">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" {{ !empty($profile_details['sms']) && $profile_details['sms'] == 'on' ? 'checked'  : ''}}  name="sms" id="switch3">
                  <label class="custom-control-label" for="switch3">Receive Massages</label>
                </div>
              </li>
              <li class="list-group-item">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" {{ !empty($profile_details['promotional_call']) && $profile_details['promotional_call'] == 'on' ? 'checked'  : ''}} name="promotional_call" id="switch4">
                  <label class="custom-control-label" for="switch4">Receive Promotional Call</label>
                </div>
              </li>
              <li class="list-group-item">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" {{ !empty($profile_details['transactional_call']) && $profile_details['transactional_call'] == 'on' ? 'checked'  : ''}} name="transactional_call" id="switch5">
                  <label class="custom-control-label" for="switch5">Receive Transactional Call</label>
                </div>
              </li>
              <li class="list-group-item">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" {{ !empty($profile_details['offers']) && $profile_details['offers'] == 'on' ? 'checked'  : ''}} name="offers" id="switch6">
                  <label class="custom-control-label" for="switch6">Receive Offers</label>
                </div>
              </li>
            </ul>
            <div class="form-group text-center">
              <input type="submit" class="btn btn-theme-contrast" value="Save Settings" />
            </div>
          </form>
          <ul class="list-group">
            <li class="list-group-item">
              <a href="/profile/delete/{{ !empty($profile_details['_id']) ? $profile_details['_id'] : ''}}" class="card-link text-primary d-block w-100 profile_option_link"><i class="bi bi-person-x-fill font-22 align-middle mr-2 text-primary"></i>Delete Profile</a>
            </li>
          </ul>
        </div>
      </div>
    @endif
  </div>
@stop

