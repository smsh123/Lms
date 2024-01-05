<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Block;
use App\Models\User;

class BlockController extends Controller
{
    //
    public function index(Request $request) 
    {    
        
        if(!User::hasPermissions(["View Content Block"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }

        $blocks = Block::paginateWithDefault(10);
        return view('cms.block.index')->with('blocks',$blocks);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Block"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $data = [
            'page_group' => 'block'
        ];
        return view('cms.block.add',$data);
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Block"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $blocks = Block::find($id);

        $data=[
            'blocks' => !empty($blocks) ? $blocks : [],
            'page_group' => 'block'
        ];
        // dd($course);
        return view('cms.block.edit', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus',
            'status' => 'required',
        ]);
        $title = $request->input('title');
        $link =  $request->input('link');
        $icon = $request->input('icon');
        $short_description = $request->input('short_description');
        $long_description = $request->input('long_description');
        $extra_info = $request->input('extra_info');
        $image = $request->input('image');
        $objects = [];
        if (count($title) == count($link) && count($link) == count($icon)) {
            $count = count($title);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->title = $title[$i];
                $object->link = $link[$i];
                $object->icon = $icon[$i];
                $object->short_description = $short_description[$i];
                $object->long_description = $long_description[$i];
                $object->extra_info = $extra_info[$i];
                $object->image = $image[$i];
                $objects[] = $object;
            }
        }
        $block= new Block;
        $block->name = $request->input('name');
        $block->slug = $request->input('slug');
        $block->status = $request->input('status');
        $block->items = $objects;
    
        $block->save();
    
        return redirect()->route('blocks.index')->with('success', 'Block created successfully');
    }

    public function update(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);
        $title = $request->input('title');
        $link =  $request->input('link');
        $icon = $request->input('icon');
        $short_description = $request->input('short_description');
        $long_description = $request->input('long_description');
        $extra_info = $request->input('extra_info');
        $image = $request->input('image');
        $objects = [];
        if (count($title) == count($link) && count($link) == count($icon)) {
            $count = count($title);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->title = $title[$i];
                $object->link = $link[$i];
                $object->icon = $icon[$i];
                $object->short_description = $short_description[$i];
                $object->long_description = $long_description[$i];
                $object->extra_info = $extra_info[$i];
                $object->image = $image[$i];
                $objects[] = $object;
            }
        }
        $id = $request->input("id");
        $block= Block::find($id);
        $block->name = $request->input('name');
        $block->status = $request->input('status');
        $block->items = $objects;
    
        $block->save();
    
        return redirect()->route('blocks.index')->with('success', 'Block Updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Block"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $block= Block::find($id);
        $block->delete();
        return redirect()->back()->with('msg', 'Block Deleted Successfully!');
    }

    
}
