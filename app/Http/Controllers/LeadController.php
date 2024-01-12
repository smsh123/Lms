<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Leads;

class LeadController extends Controller
{
    public function index(Request $request){
        if(!User::hasPermissions(["View Lead"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
            $Leads = Leads::searchByFields(['name' => $request->name]);
        } elseif (!empty($request->email)) {
            $Leads = Leads::searchByFields(['email' => $request->email]);
        }elseif (!empty($request->mobile)) {
            $Leads = Leads::searchByFields(['mobile' => $request->mobile]);
        }elseif (!empty($request->course_interested)) {
            $Leads = Leads::searchByFields(['course_interested' => $request->course_interested]);
        }else {
            $Leads = Leads::paginateWithDefault(10);
        }
        
        return view('cms.lead.index')->with('leads',$Leads);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Lead"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $data = [
            'page_group' => 'lead'
        ];
        
        return view('cms.lead.add',$data);
    }
    public function store(Request $request)
    {
        
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|max:255',
             'mobile' => 'required|numeric',
             'course_interested' => 'required|string',
         ]);
      
        $lead = new Leads;
        $lead->name = $request->input('name');
        $lead->email = $request->input('email');
        $lead->mobile = $request->input('mobile');
        $lead->course_interested = $request->input('course_interested');
        $lead->synopsis = $request->input('synopsis');
        $lead->status = !empty($request->input('status')) ? $request->input('status') : 'Active';
       
        $lead->save();
    
        return redirect()->back()->with('msg', 'Form Submitted successfully');
    }

    public function leadEdit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Lead"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $leads = Leads::find($id);
        $data = [
            'page_group' => 'lead',
            'Lead' => !empty($leads) ? $leads : []
        ];
        // dd($course);
        return view('cms.lead.edit',$data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'mobile' => 'required|numeric',
            'course_interested' => 'required|string',
        ]);
        $id = $request->input("id",'');
        $lead = Leads::find($id);
        $lead->name = $request->input('name');
        $lead->email = $request->input('email');
        $lead->mobile = $request->input('mobile');
        $lead->course_interested = $request->input('course_interested');
        $lead->synopsis = $request->input('synopsis');
        $lead->status = !empty($request->input('status')) ? $request->input('status') : 'Active';
    
        $lead->save();
    
        return redirect()->back()->with('msg', 'Lead updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Lead"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $leads = Leads::find($id);
        $leads->delete();
        return redirect()->back()->with('msg', 'Leads Deleted Successfully!');
    }

    
    
}
