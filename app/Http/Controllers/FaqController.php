<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    //
    public function index(Request $request) 
    {
        $faqs = Faq::all();
        return view('cms.faq.index')->with('faqs',$faqs);
    }

    public function add(Request $request){
        return view('cms.faq.add');
    }

    public function edit(Request $request, $id) {
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

    
}
