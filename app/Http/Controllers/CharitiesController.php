<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charity;
use App\Event;
use App\Http\Requests;


class CharitiesController extends Controller
{
    public function store(Request $request, Event $event)
    {
        // return $request->all();
        $charity = new Charity($request->all());
        $charity->user_id = \Auth::User()->id;
        
       
            if ($request->hasFile('thumbnail')) 
            {
                $file = $charity->thumbnail;
                $name = time() . '-' .$file->getCLientOriginaLName();
                $file = $file->move(public_path().'/images/', $name);
               
                  $charity->thumbnail = 'images/' . $name;
                // return 'Done';
            }
   
        $event->addCharity($charity);

    	return back();
}
    public function editCharity(Charity $charity)
    { 
    	return view('charities.edit', compact('charity'));
    }
    public function update(Request $request, Charity $charity)
    {
        $charity->update($request->all()); 
        return back();
    }
    public function delete(Charity $charity)
    {
        $charity->delete();
        return back();
    }

     public function payment(Request $request)
    {
       
        return $request;
    }




}
