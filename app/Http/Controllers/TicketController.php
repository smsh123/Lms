<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    //
    public function index(Request $request) 
    {    
        
        if(!User::hasPermissions(["View Ticket"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
       
        $tickets = Ticket::paginateWithDefault(10);
        
        return view('cms.ticket.index')->with('tickets',$tickets);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Ticket"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $users = User::all();
        $subscriptions = Subscription::all();
        $subscriptions = !empty($subscriptions) && is_object($subscriptions) ? $subscriptions->toArray() : [];
        if(!empty($subscriptions)){
            foreach ($subscriptions as $key => $subscription){
                if(!empty($subscription['product_type']) && $subscription['product_type'] == 'course'){
                    $course_id = !empty($subscription['product_id']) ? $subscription['product_id'] : ''; 
                    $course_details = Course::find($course_id);
                    $course_details = !empty($course_details) && is_object($course_details) ? $course_details->toArray() : $course_details; 
                    $subscriptions[$key]['product_details'] = $course_details;
                }
            }
        }
        $data = [
            "subscriptions" => !empty($subscriptions) ? $subscriptions : [],
            'users' => !empty($users) ? $users : [],
            'page_group' => 'ticket'
        ];
        return view('cms.ticket.add',$data);
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Ticket"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $replies = [];
        $tickets = Ticket::find($id);
        $replies = Reply::getRepliesByTicketId($tickets->_id);

        $data=[
            'tickets' => !empty($tickets) && is_object($tickets) ? $tickets->toArray() : [],
            'replies' => !empty($replies) ? $replies : [],
            'page_group' => 'ticket'
        ];
        return view('cms.ticket.edit', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'product' => 'required',
            'comment' => 'required',
            'email' => 'required|email'
        ]);

        $ticket = new Ticket;
        $ticket->ticket_id = date('Y-m-d-h-s').generateRandomString();
        $ticket->user_id = $request->user_id;
        $ticket->name = $request->name;
        $ticket->mobile = $request->mobile;
        $ticket->email = $request->email;
        $ticket->product = $request->product;
        $ticket->comment = $request->comment;
        $ticket->image = $request->image;
        $ticket->status = !empty($request->status) ? $request->status : 'created';
        $ticket->save();
    
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully');
    }

    public function update(Request $request)
    {
        $id = $request->input("id");
        $ticket = Ticket::find($id);
        $ticket->status = !empty($request->status) ? $request->status : 'created';
        $ticket->save();
    
        return redirect()->route('tickets.index')->with('success', 'Ticket Updated successfully');
    }

    public function createReply(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',
        ]);
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user(); 
        if($isUserLoggedin){
            $user_id = Auth::user()->id;
            $user_name =  Auth::user()->name;
        }
        $reply = new Reply;
        $reply->ticket_id = $request->ticket_id;
        $reply->user_id = !empty($user_id) ? $user_id : '';
        $reply->name = !empty($user_name) ? $user_name : 'Expert';
        $reply->comment = $request->comment;
        $reply->reply_type = !empty($request->reply_type) ? $request->reply_type : 'expert_reply';
        $reply->save();
        return redirect()->back()->with('msg', 'Ticket Reply Sent Successfully!');
    }


    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Ticket"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $ticket= Ticket::find($id);
        $ticket->delete();
        return redirect()->back()->with('msg', 'Ticket Deleted Successfully!');
    }

    
}
