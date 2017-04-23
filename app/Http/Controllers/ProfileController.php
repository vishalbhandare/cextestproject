<?php
namespace App\Http\Controllers;

use \App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProfileController extends Controller{
 
   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = \App\Profile::orderBy('id','DESC')->paginate(2);
        return view('profile.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 2);
    }
    
    public function create()
    {
        return view('profile.create');
    }
    
     public function store(Request $request)
    {
     
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phonenumber' => 'required|digits:10',
            'profilepics'=>'required|image:jpeg,png,gif'
        ]);
      $path = $request->profilepics->store('images');
      $data = $request->all();
      $data['profilepic'] = $path;
      \App\Profile::create($data);
      
      if($request->ajax()){
          
          return response()->json([
                'status' => '1',
                'message' => 'Profile created successfully',
                
            ]);
      
          
      }else{
        return redirect()->route('profile.index')->with('success','Item created successfully');
      }
      
    }
    
    public function show($id)
    {
       
        $item = \App\Profile::find($id);
        return view('profile.show',compact('item'));
    }
    
     public function edit($id)
    {
        $item = \App\Profile::find($id);
        return view('profile.edit',compact('item'));
    }
    
    
    public function update(Request $request, $id)
    {
       
         $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phonenumber' => 'required|digits:10',
            'profilepics'=>'image:jpeg,png,gif'
        ]);
       $data = $request->all();  
      if($request->hasFile('profilepics')){   
        $path = $request->profilepics->store('images');      
        $data['profilepic'] = $path;
      }

        \App\Profile::find($id)->update($data);
        if($request->ajax()){
          
          return response()->json([
                'status' => '1',
                'message' => 'Profile updated successfully',
                
            ]);
      
          
      }else{
         return redirect()->route('profile.index')
                        ->with('success','Item updated successfully');
      }
       
    }
    
    public function destroy($id)
    {
        \App\Profile::find($id)->delete();
        return redirect()->route('profile.index')
                        ->with('success','Item deleted successfully');
    }
    
    public function getProfile($ids){
        $idsArray = explode(",",$ids);
        if(count($idsArray)>0){
            $items = \App\Profile::findMany($idsArray);
           
            return response()->json([
                'status' => '1',
                'message' => 'Record Found',
                'data'=>$items->toArray()
            ]);
        }else{
            return response()->json([
                'status' => '1',
                'message' => 'Nothing to Search',
                
            ]);
        }
    }
}