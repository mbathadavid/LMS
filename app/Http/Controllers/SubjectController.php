<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    //
    public function saveSubject(Request $req){
        $validator = Validator::make($req->all(),[
            'subject' => 'required|unique:subjects',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
        $subject = new Subject;
        $subject->subject = $req->subject;
        $subject->category = $req->category;
        $subject->save();
        
        return response()->json([
            'status' => 200,
            'messages' => 'Subject Registered successfully'
        ]);
        }   
    }
    //fetch subjects
    public function fetchSubjects(){
        $subjects = Subject::all();
        $classes = classes::all();

        return response()->json([
            'subjects' => $subjects,
            'classes' => $classes
        ]);
    }
    //Delete Subject 
    public function deleteSubject($sid){
        $delaction = Subject::where('id',$sid)
                        ->delete();
        
        if ($delaction == TRUE) {
            return response()->json([
                'messages' => 'Subject Successfully Deleted'
            ]);
        } else {
            return response()->json([
                'messages' => 'Error occurred while deleting the Subject. Please try again later'
            ]);
        }  
    }
    //Get Subject Details
    public function subDetails($sid){
        $subjectdetails = Subject::where('id',$sid)
                                ->first();
        return response()->json([
            'subjectdetails' => $subjectdetails
        ]);
    }
    //Update Subject
    public function updateSubject(Request $req){
        $validator = Validator::make($req->all(),[
            'subject' => 'required',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
        $subject = Subject::find($req->subid);
        $subject->subject = $req->subject;
        $subject->category = $req->category;
        $subject->save();
        
        return response()->json([
            'status' => 200,
            'messages' => 'Subject Updated successfully'
        ]);
        }  
    }
}
