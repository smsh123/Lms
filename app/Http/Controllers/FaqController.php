<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\User;

class FaqController extends Controller
{
    //
    public function index(Request $request) 
    {
        if(!User::hasPermissions(["View FAQ"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $faqs = Faq::paginateWithDefault(10);
        return view('cms.faq.index')->with('faqs',$faqs);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Faq"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        return view('cms.faq.add');
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Faq"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $faqs = Faq::find($id);
        $data=[
            'faqs' => !empty($faqs) ? $faqs : []
        ];
        // dd($course);
        return view('cms.faq.edit', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);
        $question = $request->input('question');
        $answer =  $request->input('answer');
        $objects = [];
        if (!empty($question) && !empty($answer))  {
            $count = count($question);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->question = $question[$i];
                $object->answer = $answer[$i];
                $objects[] = $object;
            }
        }
        $faq = new Faq;
        $faq->name = $request->input('name');
        $faq->status = $request->input('status');
        $faq->items = $objects;
    
        $faq->save();
    
        return redirect()->route('faq.index')->with('msg', 'Faq created successfully');
    }

    public function update(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);
        $question = $request->input('question');
        $answer =  $request->input('answer');
        $objects = [];
        if (!empty($question) && !empty($answer)) {
            $count = count($question);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->question = $question[$i];
                $object->answer = $answer[$i];
                $objects[] = $object;
            }
        }
        $id = $request->input("id");
        $faq = Faq::find($id);
        $faq->name = $request->input('name');
        $faq->status = $request->input('status');
        $faq->items = $objects;
    
        $faq->save();
    
        return redirect()->route('faq.index')->with('msg', 'Faq Updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Faq"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $faq = Faq::find($id);
        $faq->delete();
        return redirect()->back()->with('msg', 'Faq Deleted Successfully!');
    }

    
}
