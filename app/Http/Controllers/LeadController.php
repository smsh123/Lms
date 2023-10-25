<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Leads;

class LeadController extends Controller
{
    public function index(Request $request){
        $Leads = Leads::all();
        return view('cms.lead.index')->with('leads',$Leads);
    }
    public function add(Request $request){
        return view('cms.lead.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'mobile' => 'required|numeric|max:10',
            'course_interested' => 'required|string',
        ]);
    
        $lead = new Leads;
        $lead->name = $request->input('name');
        $lead->email = $request->input('email');
        $lead->mobile = $request->input('mobile');
        $lead->course_interested = $request->input('course_interested');
        $lead->synopsis = $request->input('synopsis');
        $lead->status = $request->input('status');
       
        $lead->save();
    
        return redirect()->back()->with('success', 'Lead created successfully');
    }

    public function leadEdit(Request $request, $id) {
        $course = Leads::find($id);
        // dd($course);
        return view('cms.lead.edit')->with('blogs',$course);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'mobile' => 'required|numeric|max:10',
            'course_interested' => 'required|string',
        ]);
        $id = $request->input("id",'');
        $lead = Leads::find($id);
        $lead->name = $request->input('name');
        $lead->email = $request->input('email');
        $lead->mobile = $request->input('mobile');
        $lead->course_interested = $request->input('course_interested');
        $lead->synopsis = $request->input('synopsis');
        $lead->status = $request->input('status');
    
        $lead->save();
    
        return redirect()->route('cms.lead.index')->with('success', 'Lead updated successfully');
    }
    
}
