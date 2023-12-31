<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use App\Models\User;
  
class ImageUploadController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('imageUpload');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        if(!User::hasPermissions(["Upload Image"])){
            return response()->json([
                'error' => 'Permission Denied'
            ], 200);
        }
       // dd($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
      
        $filename = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images/uploaded'), $filename);

        // save uploaded image filename here to your database

        //return redirect()->back()->with('msg', 'Image Uploaded Successfully!');

        return response()->json([
            'message' => 'Image uploaded successfully.',
           'image' => '/images/uploaded/' . $filename
        ], 200);
    }
}