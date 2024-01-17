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
    @if(!empty($ticketDetails))
    <div class="container mw-768 mx-auto my-3">
      <div class="card mb-3">
        <div class="card-body px-2">
          <p class="mb-0"><span class="badge @if(!empty($ticketDetails['status']) && $ticketDetails['status'] == 'created') badge-primary @elseif (!empty($ticketDetails['status']) && $ticketDetails['status'] == 'in_process') badge-warning @elseif (!empty($ticketDetails['status']) && $ticketDetails['status'] == 'solved') badge-success @elseif (!empty($ticketDetails['status']) && $ticketDetails['status'] == 'closed') badge-dark @else badge-info @endif text-uppercase">{{ !empty($ticketDetails['status']) ? $ticketDetails['status'] : 'Created'}}</span></p>
          <p class="mb-2 font-16 font-weight-bold">{{ !empty($ticketDetails['ticket_id']) ? 'Ticket Id -'.$ticketDetails['ticket_id'] : ''}}</p>
          <p class="mb-0 font-14">{{ !empty($ticketDetails['created_at']) ? 'Ticket Date -'.date_format(date_create($ticketDetails['created_at']),"d/m/Y H:i:s") : ''}}</p>
        </div>
        @if(!empty($ticketReplies))
        <div class="card-footer">
          <h3 class="font-16 font-weight-bold mb-3">Replies <span class="badge badge-primary">{{ !empty($ticketReplies) ? count($ticketReplies) : 0 }}</span></h3>
          @foreach ($ticketReplies as $key => $reply)
            <div class="d-flex py-2 @if(!empty($reply['reply_type']) && $reply['reply_type'] == 'expert_reply') justify-content-end @elseif(!empty($reply['reply_type']) && $reply['reply_type'] == 'user_reply') justify-content-start @endif">
              <div class="align-self-center shadow-sm p-3 w-75 mw-320 border-radius-25 position-relative @if(!empty($reply['reply_type']) && $reply['reply_type'] == 'expert_reply') bg-light-yellow chatbox-right @elseif(!empty($reply['reply_type']) && $reply['reply_type'] == 'user_reply') bg-light-blue chatbox-left @endif">
                <p class="mb-2 font-weight-bold font-14 @if(!empty($reply['reply_type']) && $reply['reply_type'] == 'expert_reply') text-warning text-right @elseif(!empty($reply['reply_type']) && $reply['reply_type'] == 'user_reply') text-info text-left @endif">{{ !empty($reply['name']) ? $reply['name'] : 'Expert'}}</p>
                <p>{{ !empty($reply['comment']) ? $reply['comment'] : '...'}}</p>
              </div>
            </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>
    @else
      <div class="card mw-768 mx-auto my-3">
        <div class="card-body text-center">
          <div class="alert alert-danger text-center">Something Went Wrong</div>
        </div>
      </div>
    @endif
    @if(!empty($profile_details) && !empty($ticketDetails))
      <div class="container mw-768 mx-auto my-3">
        <div class="card mw-768 mx-auto mb-3">
          <div class="card-header"><h3 class="font-22 font-weight-bold mb-0">Reply</h3></div>
          <div class="card-body">
            <form method="post" action="/reply/store">
              @csrf
              <input type="hidden" value="user_reply" name="reply_type" />
              <input type="hidden" value="{{ !empty($ticketDetails['_id']) ? $ticketDetails['_id'] : ''}}" name="ticket_id" />
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
  </div>
@stop

