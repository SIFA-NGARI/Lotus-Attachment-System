<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Country,City,State}; 

class DropDownController extends Controller
{
    public function index()
    {
        $counteries = Country::get(['name','id']);
 
        return view('attachment_initialisation/student_application_form',compact('counteries'));
    }
 
    public function fatchState(Request $request)
    {
        $data['states'] = State::where('country_id',$request->country_id)->get(['name','id']);
 
        return response()->json($data);
    }
 
    public function fatchCity(Request $request)
    {
        $data['cities'] = City::where('state_id',$request->state_id)->get(['name','id']);
 
        return response()->json($data);
    }
}
