<?php

namespace App\Http\Controllers;
use App\Models\classes;
use App\Models\exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    //
    public function saveclass(Request $req){
        $validator = Validator::make($req->all(),[
            'class' => 'required',
            'teacher' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $class = new classes;
            $class->class = $req->class;
            $class->stream = $req->stream;
            $class->snumber = $req->nostudents;
            $class->classteacher = $req->teacher;
            $class->save();
            return response()->json([
                'status' => 200,
                'messages' => 'New Class registered successfully'
            ]);
        }

    }
    //function to fetch classes
    public function fetchclasses(){
        $classes = classes::where('deleted',0)
                        ->get();
        $exams = DB::select('select classnames FROM exams where deleted = ?',[0]);
        //$exams = exam::where('deleted',0)
                        //->get();
        return response()->json([
            'exams' => $exams,
            'classes' => $classes
        ]);
    }
    //Function to delete class
    public function deleteClasses($ids){
        $idarray = explode(',',$ids);
        for ($i=0; $i < count($idarray) ; $i++) { 
            $classdel = classes::find($idarray[$i]);
            $classdel->deleted = '1';
            $classdel->save(); 
        }
    return response()->json([
        'status' => 200,
        'messages' => 'Class deleted Successfullly'
    ]);
    }
    //Function to fetch details of one class
    public function getClass($id){
        $class = classes::find($id);
        return response()->json([
            'class' => $class
        ]);
    }
    //Function to edit class
    public function editClass(Request $req){
        $validator = Validator::make($req->all(),[
            'editclass' => 'required',
            'editteacher' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $class = classes::find($req->editclassid);
            $class->class = $req->editclass;
            $class->stream = $req->editstream;
            $class->snumber = $req->editnostudents;
            $class->classteacher = $req->editteacher;
            $class->save();

            return response()->json([
                'status' => 200,
                'messages' => 'Class Edited Successfully'
            ]);
        }
    }
}
