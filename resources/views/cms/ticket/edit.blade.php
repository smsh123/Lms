@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Edit Ticket</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/tickets" class="btn btn-lg btn-secondary">View Tickets</a></div>
  </div>

  <form class="card" method="post" action="/cms/tickets/update">
    @csrf
    <input type="hidden" value="{{ !empty($tickets['_id']) ? $tickets['_id'] : '' }}" name="id" />
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>Ticket Id</label>
            <input type="text" class="form-control" value="{{ !empty($tickets['ticket_id']) ? $tickets['ticket_id'] : '' }}" readonly />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>User</label>
            <input type="text" class="form-control" value="{{ !empty($tickets['name']) ? $tickets['name'] : '' }}" readonly />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>Mobile</label>
            <input type="text" class="form-control" value="{{ !empty($tickets['mobile']) ? $tickets['mobile'] : '' }}" readonly />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" value="{{ !empty($tickets['email']) ? $tickets['email'] : '' }}" readonly />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            @php
              $requested_product = !empty($tickets['product']) ? $tickets['product'] : '';
              $product = explode(',',$requested_product);
            @endphp
            <label>Product Details</label>
            @if(!empty($product))
              @foreach ($product as $key => $item)
                <div class="alert alert-info p-1 mb-1">{{ $item }}</div>
              @endforeach
            @endif
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Comment</label>
            <textarea class="form-control" readonly>{{ !empty($tickets['comment']) ? $tickets['comment'] : '' }}</textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>Screenshot</label>
            <a href="{{ !empty($tickets['image']) ? $tickets['image'] : '' }}" target="_blank" class="card-link">
              <div class="icon-200">
                <div class="ratio-image image_16-9">
                  <img src="{{ !empty($tickets['image']) ? $tickets['image'] : '' }}" alt="screenshot" />
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status">
              <option @if(!empty($tickets['status']) && $tickets['status'] == 'created') selected @endif value="created">Created</option>
              <option @if(!empty($tickets['status']) && $tickets['status'] == 'in_process') selected @endif value="in_process">In Process</option>
              <option @if(!empty($tickets['status']) && $tickets['status'] == 'solved') selected @endif value="solved">Solved</option>
              <option @if(!empty($tickets['status']) && $tickets['status'] == 'closed') selected @endif value="closed">Closed</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 text-center">
          <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
        </div>
      </div>
      
    </div>
  </form>

    @if(!empty($replies))
      <div class="card-body mw-768 mx-auto">
        <h3 class="font-16 font-weight-bold mb-3">Replies <span class="badge badge-primary">{{ !empty($replies) ? count($replies) : 0 }}</span></h3>
        @foreach ($replies as $key => $reply)
          <div class="d-flex py-2 @if(!empty($reply['reply_type']) && $reply['reply_type'] == 'expert_reply') justify-content-end @elseif(!empty($reply['reply_type']) && $reply['reply_type'] == 'user_reply') justify-content-start @endif">
            <div class="align-self-center shadow-sm p-3 w-75 mw-320 border-radius-25 position-relative @if(!empty($reply['reply_type']) && $reply['reply_type'] == 'expert_reply') bg-light-yellow chatbox-right @elseif(!empty($reply['reply_type']) && $reply['reply_type'] == 'user_reply') bg-light-blue chatbox-left @endif">
              <p class="mb-2 font-weight-bold font-14 @if(!empty($reply['reply_type']) && $reply['reply_type'] == 'expert_reply') text-warning text-right @elseif(!empty($reply['reply_type']) && $reply['reply_type'] == 'user_reply') text-info text-left @endif">{{ !empty($reply['name']) ? $reply['name'] : 'Expert'}}</p>
              <p>{{ !empty($reply['comment']) ? $reply['comment'] : '...'}}</p>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    @if(!empty($tickets))
      <div class="container mw-768 mx-auto my-3">
        <div class="card mw-768 mx-auto mb-3">
          <div class="card-header"><h3 class="font-22 font-weight-bold mb-0">Reply</h3></div>
          <div class="card-body">
            <form method="post" action="/cms/reply/store">
              @csrf
              <input type="hidden" value="expert_reply" name="reply_type" />
              <input type="hidden" value="{{ !empty($tickets['_id']) ? $tickets['_id'] : ''}}" name="ticket_id" />
              <div class="form-group">
                <label>Your Reply</label>
                <textarea class="form-control" name="comment" placeholder="Your Reply"></textarea>
                @if ($errors->has('comment'))
                  <p class="text-danger">{{ $errors->first('comment') }}</p>
                @endif
              </div>
              <div class="form-group text-center">
                <input type="submit" class="btn btn-theme-contrast" value="Send Reply" />
              </div>
            </form>
          </div>
        </div>
      </div>
    @endif

@stop