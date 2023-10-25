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
            'name_hn' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255',
        ]);
    
        $lead = new Leads;
        $lead->name = $request->input('name');
        $lead->name_hindi = $request->input('name_hindi');
        $lead->slug = $request->input('slug');
        $lead->batch_start_date = $request->input('batch_start_date');
        $lead->duration = $request->input('duration');
        $lead->class_mode = $request->input('class_mode');
        $lead->description = $request->input('description');
        $lead->synopsis = $request->input('synopsis');
        $lead->original_price = $request->input('original_price');
        $lead->selling_price = $request->input('selling_price');
        $lead->offer_type = $request->input('offer_type');
        $lead->offer_unit = $request->input('offer_unit');
        $lead->offer_value = $request->input('offer_value');
        $lead->coupon_code = $request->input('coupon_code');
        $lead->offer_details = $request->input('offer_details');
    
        $lead->save();
    
        return redirect()->route('cms.lead.index')->with('success', 'Lead created successfully');
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
            'name_hn' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255',
        ]);
        $id = $request->input("id",'');
        $lead = Leads::find($id);
        $lead->name = $request->input('name');
        $lead->name_hindi = $request->input('name_hindi');
        $lead->slug = $request->input('slug');
        $lead->batch_start_date = $request->input('batch_start_date');
        $lead->duration = $request->input('duration');
        $lead->class_mode = $request->input('class_mode');
        $lead->description = $request->input('description');
        $lead->synopsis = $request->input('synopsis');
    
        $lead->save();
    
        return redirect()->route('cms.lead.index')->with('success', 'Lead updated successfully');
    }
    
}
