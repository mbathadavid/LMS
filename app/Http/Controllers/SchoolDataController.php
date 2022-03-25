<?php

namespace App\Http\Controllers;

use App\Models\School_Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolDataController extends Controller
{
    //
    public function index(){
        return view('school.scrform2');
    }

    //Register School
    public function saveSchool(Request $req){
        $validator = Validator::make($req->all(),[
            'schoolname' => 'required',
            'motto' => 'required',
            'semail' => 'required|email',
            'primaryphone' => 'required',
            'altphone' => 'required',
            'pobox' => 'required',
            'town' => 'required',
            'logo'=> 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $school = new School_Data;
            $school->name = $req->schoolname;
            $school->motto = $req->motto;
            $school->email = $req->semail;
            $school->phone = $req->primaryphone;
            $school->alt_phone = $req->altphone;
            $school->pobox = $req->pobox;
            $school->town = $req->town;
            $school->logo = $req->logo;

            if ($req->hasFile('logo')) {
                $file = $req->file('logo');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'logo'.'.'.$extension;
                $file->move('images/', $filename);
                $school->logo = $filename;
            }
            $school->save();
            return response()->json([
                'status' => 200,
                'message' => 'School Details Successfully Updated'
            ]);
        }
        
    }
}
