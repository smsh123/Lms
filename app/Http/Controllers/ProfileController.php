<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Subscription;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    //
    public function profile(Request $request, $id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
            if(!empty($user_details) && $user_details['is_public'] ==0){
                return redirect()->back()->with('error', 'Profile Deleted!');
            }
        }else{
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : []
        ];
        return view ('profile.index',$data);
    }
    public function courses(Request $request,$id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
            if(!empty($user_details) && $user_details['is_public'] ==0){
                return redirect()->back()->with('error', 'Profile Deleted!');
            }
            $userId = !empty($user_details['_id']) ? $user_details['_id'] : '';
            $subscriptions = Subscription::getSubscriptionsByUserId($userId);
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
        }else{
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : [],
            "subscriptions" => !empty($subscriptions) ? $subscriptions : []
        ];
        return view ('profile.courses',$data);
    }
    public function orders(Request $request, $id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
            if(!empty($user_details) && $user_details['is_public'] ==0){
                return redirect()->back()->with('error', 'Profile Deleted!');
            }
            $user_id = !empty($user_details['_id']) ? $user_details['_id'] : '';
            $orders = Order::getOrderByUserId($user_id);
        }else{
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : [],
            "orders" => !empty($orders) ?  $orders : []
        ];
        return view ('profile.orders',$data);
    }
    public function reports(Request $request, $id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
            $user_id = !empty($user_details['_id']) ? $user_details['_id'] : '';
            if(!empty($user_details) && $user_details['is_public'] ==0){
                return redirect()->back()->with('error', 'Profile Deleted!');
            }
            //$reports = Order::getOrderByUserId($user_id);
        }else{
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : [],
            "reports" => !empty($reports) ?  $reports : []
        ];
        return view ('profile.reports');
    }
    public function editProfile(Request $request, $id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
            if(!empty($user_details) && $user_details['is_public'] ==0){
                return redirect()->back()->with('error', 'Profile Deleted!');
            }
        }else{
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : []
        ];
        return view ('profile.edit',$data);
    }
    public function getSupport(Request $request,$id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
            if(!empty($user_details) && $user_details['is_public'] ==0){
                return redirect()->back()->with('error', 'Profile Deleted!');
            }
            $userId = !empty($user_details['_id']) ? $user_details['_id'] : '';
            $subscriptions = Subscription::getSubscriptionsByUserId($userId);
            $tickets = Ticket::getTicketsByUserId($userId);
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
        }else{
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : [],
            "tickets" => !empty($tickets) ? $tickets : [],
            "subscriptions" => !empty($subscriptions) ? $subscriptions : []
        ];
        return view ('profile.support',$data);
    }

    public function viewTicket(Request $request,$ticket_id,$user_id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $user_id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
            if(!empty($user_details) && $user_details['is_public'] ==0){
                return redirect()->back()->with('error', 'Profile Deleted!');
            }
            $ticketDetails= Ticket::find($ticket_id);
            $ticketReplies= Reply::getRepliesByTicketId($ticket_id);
        }else{
            
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : [],
            "ticketDetails" => !empty($ticketDetails) && is_object($ticketDetails) ? $ticketDetails->toArray() : [],
            "ticketReplies" => !empty($ticketReplies) ? $ticketReplies : []
        ];
        return view ('profile.ticket_details',$data);
    }

    public function createReply(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'comment' => 'required',
            'email' => 'required|email'
        ]);

        $reply = new Reply;
        $reply->ticket_id = $request->ticket_id;
        $reply->user_id = $request->user_id;
        $reply->name = $request->name;
        $reply->mobile = $request->mobile;
        $reply->email = $request->email;
        $reply->comment = $request->comment;
        $reply->reply_type = $request->reply_type;
        $reply->save();
        return redirect()->back()->with('msg', 'Ticket Reply Sent Successfully!');
    }

    public function writeReview(Request $request,$user_id,$product_id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $user_id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
            if(!empty($user_details) && $user_details['is_public'] ==0){
                return redirect()->back()->with('error', 'Profile Deleted!');
            }
            $product_details = Course::find($product_id);
            
        }else{
            
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : [],
            "product_details" => !empty($product_details) && is_object($product_details) ? $product_details->toArray() : []
           
        ];
        return view ('profile.review',$data);
    }

    public function createReview(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'comment' => 'required',
            'rating' => 'required',
            'email' => 'required|email'
        ]);

        $review = new Review;
        $review->user_id = $request->user_id;
        $review->name = $request->name;
        $review->mobile = $request->mobile;
        $review->email = $request->email;
        $review->comment = $request->comment;
        $review->product = $request->product;
        $review->rating = $request->rating;
        $review->image = $request->image;
        $review->is_public = 0;
        
        $review->save();
        return redirect()->back()->with('msg', 'Review Submit Successfully!');
    }

    public function settings(Request $request,$user_id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $user_id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
            if(!empty($user_details) && $user_details['is_public'] ==0){
                return redirect()->back()->with('error', 'Profile Deleted!');
            }
        }else{
            
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : []
        ];
        return view ('profile.settings',$data);
    }

    public function changeSettings(Request $request)
    {

        $id = $request->id;
        $user = User::find($id);
        $user->notification = $request->notification;
        $user->emailers = $request->emailers;
        $user->sms = $request->sms;
        $user->promotional_call = $request->promotional_call;
        $user->transactional_call = $request->transactional_call;
        $user->offers = $request->offers;
        
        $user->save();
        return redirect()->back()->with('msg', 'Settings Updated Successfully!');
    }

    
    
    public function createTicket(Request $request)
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
        return redirect()->back()->with('msg', 'Ticket Created Successfully!');
    }
    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $id = $request->input("id", '');
        $userAvatar = $request->avatar_image;
        if (empty($userAvatar)) {
            $userAvatar = $this->createAvatar($request->name);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->avatar_image = $userAvatar;
        if (!empty($request->pwd)) {
            $user->password = bcrypt($request->pwd);
        }
        $user->cover_image = $request->cover_image;
        $user->save();
        return redirect()->back()->with('msg', 'Profile Details Updated Successfully!');
    }

    public function createAvatar($name)
    {
        $words = explode(' ', $name);
        $initials = strtoupper(substr($words[0], 0, 1));


        // Define a background color and text color for the avatar
        $bgColor = '#' . substr(md5($name), 0, 6); // Use a unique color based on the name
        $textColor = '#ffffff'; // White text color

        // Create an image with the initials and colors
        $image = imagecreate(200, 200);
        $bg = imagecolorallocate($image, hexdec(substr($bgColor, 1, 2)), hexdec(substr($bgColor, 3, 2)), hexdec(substr($bgColor, 5, 2)));
        $text = imagecolorallocate($image, hexdec(substr($textColor, 1, 2)), hexdec(substr($textColor, 3, 2)), hexdec(substr($textColor, 5, 2)));
        imagefill($image, 0, 0, $bg);
        imagettftext($image, 75, 0, 70, 130, $text, public_path('/assets/fonts/arial.ttf'), $initials);

        // Save the image to a file
        $name = str_replace(' ', '_', $name);
        $avatarPath = '/assets/avatars/' . $name . '_avatar.png';
        imagepng($image, public_path($avatarPath));
        imagedestroy($image);

        return asset($avatarPath);
    }
    
    public function delete($id)
    {
        $user = User::find($id);
        if(!empty($user) && $user['is_public'] ==0){
            return redirect()->back()->with('error', 'Profile Already Deleted!');
        }
        $user->is_public = 0;
        $user->save();
        return Redirect::to('/logout');
        return redirect()->back()->with('msg', 'Profile Deleted Successfully!');
    }
}
