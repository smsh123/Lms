<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function index(Request $request) 
    {    
        
        if(!User::hasPermissions(["View Review"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
       
        $reviews = Review::paginateWithDefault(10);
        
        return view('cms.review.index')->with('reviews',$reviews);
    }

    public function changeStatus(Request $request, $id) {
        if(!empty($id)){
            $review = Review::find($id);
            $status = !empty($review->is_public) ? $review->is_public : 0 ;
            if($status == 1){
                $review->is_public = 0;
                $review->save();
                return redirect()->back()->with('success', 'Review unpublished successfully');
            } elseif($status == 0){
                $review->is_public = 1;
                $review->save();
                return redirect()->back()->with('success', 'Review published successfully');
            }
        }else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Review"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $review= Review::find($id);
        $review->delete();
        return redirect()->back()->with('msg', 'Review Deleted Successfully!');
    }

    
}
