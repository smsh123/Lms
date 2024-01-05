<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subscription;
use App\Models\User;

class SubscriptionController extends Controller
{
    //
    public function index(Request $request){
        if(!User::hasPermissions(["View Subscription"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $subscriptions = Subscription::paginateWithDefault(10);
        return view('cms.subscription.index')->with('subscriptions',$subscriptions);
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Subscription"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $subscription = Subscription::find($id);
        $data=[
            "subscriptions" => !empty($subscription) ? $subscription : [],
        ];
        return view('cms.subscription.edit',$data);
    }
    public function update(Request $request)
    {
        $id = $request->input("id",'');
        $subscription = Subscription::find($id);
        $subscription->user_id = $request->input('user_id');
        $subscription->user_name = $request->input('user_name');
        $subscription->expiry_date = !empty($request->input('new_expiry_date')) ? $request->input('new_expiry_date') :  $request->input('existing_expiry_date');
        $subscription->save();
    
        return redirect()->route('subscriptions.index')->with('success', 'Subscription Updated successfully');
    }
    
}
