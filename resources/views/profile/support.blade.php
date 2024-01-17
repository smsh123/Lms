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
            <h3 class="font-16 font-weight-bold mb-0">My Tickets</h3>
          </div>
        </div>
      </div>
    </div>
    @if(!empty($tickets))
    <div class="container mw-768 mx-auto my-3">
      @foreach ($tickets as $key => $ticket)
        <div class="card mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-stretch flex-nowrap">
              <div class="flex-fill align-self-center">
                <p class="mb-0"><span class="badge @if(!empty($ticket['status']) && $ticket['status'] == 'created') badge-primary @elseif (!empty($ticket['status']) && $ticket['status'] == 'in_process') badge-warning @elseif (!empty($ticket['status']) && $ticket['status'] == 'solved') badge-success @elseif (!empty($ticket['status']) && $ticket['status'] == 'closed') badge-dark @else badge-info @endif text-uppercase">{{ !empty($ticket['status']) ? $ticket['status'] : 'Created'}}</span></p>
                <p class="mb-2 font-16 font-weight-bold">{{ !empty($ticket['ticket_id']) ? 'Ticket Id -'.$ticket['ticket_id'] : ''}}</p>
                <p class="mb-0 font-14">{{ !empty($ticket['created_at']) ? 'Ticket Date -'.date_format(date_create($ticket['created_at']),"d/m/Y H:i:s") : ''}}</p>
              </div>
              <div class="align-self-center">
                <a href="/support/view-ticket/{{ !empty($ticket['_id']) ? $ticket['_id'] : ''}}/{{ !empty($ticket['user_id']) ? $ticket['user_id'] : ''}}" class="card-link stretched-link"><i class="bi bi-chevron-right font-22"></i></a>
              </div>
            </div>
            
          </div>
        </div>
      @endforeach
    </div>
    @else
      <div class="card mw-768 mx-auto my-3">
        <div class="card-body text-center">
          <div class="card-text text-theme-contrast font-weight-bold font-22 mb-3">{{ !empty(\Auth::user()->name) ? 'Hi, '.\Auth::user()->name : 'Hi, Student' }}</div>
          <p class="text-dark">It seems that you haven't created any ticket. Hope you are enjoying your learning experience.</p>
          <p><a href="/my-courses/{{ !empty($profile_details['_id']) ? $profile_details['_id'] : '' }}" class="btn-lg btn-theme-contrast">Start Learning</a></p>
        </div>
      </div>
    @endif
    @if(!empty($profile_details))
      <div class="card mw-768 mx-auto mb-3">
        <div class="card-header"><h3 class="font-22 font-weight-bold mb-0">Create Ticket</h3></div>
        <div class="card-body">
          <form method="post" action="/ticket/store">
            @csrf
            <input type="hidden" value="{{ !empty($profile_details['_id']) ? $profile_details['_id'] : ''}}" name="user_id" />
            <div class="form-group">
              <input type="text" class="form-control" name="name" value="{{ !empty($profile_details['name']) ? $profile_details['name'] : 'NA'}}" />
              @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
              @endif
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="mobile" value="{{ !empty($profile_details['mobile']) ? $profile_details['mobile'] : 'NA'}}" />
              @if ($errors->has('mobile'))
                <p class="text-danger">{{ $errors->first('mobile') }}</p>
              @endif
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="email" value="{{ !empty($profile_details['email']) ? $profile_details['email'] : 'NA'}}" />
              @if ($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label>Select Product</label>
              <select class="form-control" name='product'>
                @if(!empty($subscriptions))
                  @foreach ($subscriptions as $key => $subscription )
                    <option value="{{ !empty($subscription['_id']) ? 'subscription_id-'.$subscription['_id'].',' : ''  }}{{ !empty($subscription['uid']) ? 'order_id-'.$subscription['uid'].',' : '' }}{{ !empty($subscription['product_name']) ? 'product -'.$subscription['product_name'].',' : '' }}{{ !empty($subscription['expiry_date']) ? 'expiry_date -'.$subscription['expiry_date'] : '' }}">{{ !empty($subscription['product_name']) ? $subscription['product_name'] : '' }}</option>
                  @endforeach
                  <option value="Other">Other</option>
                @endif
              </select>
            </div>
            <div class="form-group">
              <label>Problem Description</label>
              <textarea class="form-control" name="comment" placeholder="Describe Porblem here"></textarea>
              @if ($errors->has('comment'))
                <p class="text-danger">{{ $errors->first('comment') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label>Problem Screenshot</label>
              <div class="input-group upload-image mb-3">
                <input id="inputImage" type="file" class="form-control"  placeholder="ScreenShot Image" />
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage','form-image-input','image-preview');" type="button" id="button-addon2">Upload</button>
                </div>
              </div>
              <input id="form-image-input" type="hidden" class="form-control" name="image" value="" />
              <div class="icon-200 mx-auto">
                <div class="ratio-image image_16-9 my-3">
                  <img id="image-preview" src="" />
                </div>
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" class="btn btn-theme-contrast" value="Submit" />
            </div>
          </form>
        </div>
      </div>
    @endif
  </div>
@stop

