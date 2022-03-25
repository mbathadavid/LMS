<?php

namespace App\Http\Controllers;
use Excel;
use App\Exports\TeacherExport;
use App\Exports\TeachertemplateExport;
use App\Imports\TeacherImport;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    //
    public function saveTeacher(Request $request){
       $validator = Validator::make($request->all(),[
        'salutation' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'phone' => 'required|unique:teachers',
        'email' => 'email|unique:teachers',
        'position' => 'required',
        'gender' => 'required',
        'file' => 'image'
       ]); 

       if ($validator->fails()) {
           return response()->json([
               'status' => 400,
               'messages' => $validator->getMessageBag()
           ]);
       } else {
           $teacher = new Teacher;
           $teacher->salutation = $request->salutation;
           $teacher->Fname = $request->firstname;
           $teacher->Sname = $request->secondname;
           $teacher->Lname = $request->lastname;
           $teacher->Gender = $request->gender;
           $teacher->Position = $request->position;
           $teacher->Email = $request->email;
           $teacher->Phone = $request->phone;
           $teacher->password = 'password123';
                       
           if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'pro'.'.'.$extension;
            $file->move('images/', $filename);
            $teacher->Profile = $filename;
           } else {
               $teacher->Profile = 'avatar.png';
           }
           $teacher->save();
           return response()->json([
               'status' => 200,
               'messages' => "Teacher's records registered successfully" 
           ]);
       }
       
    }
    //fetch teachers
    public function fetchteachers(){
      $teachers = Teacher::where('deleted',0)
                        ->get();
      return response()->json([
          'teachers' => $teachers
      ]);  
    }
    //Export Teachers
    public function exportTeachers(){
        return Excel::download(new TeacherExport,'teachers.xlsx');
    }
    //Show teacherr export Excel view
    public function excelimportview(){
        return view('General.teachersexcelview');
    }
    //Import Teachers to the database
    public function importTeachers(Request $req){
        $validator = Validator::make($req->all(),[
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            Excel::import(new TeacherImport,$req->file);
            return response()->json([
                'status' => 200,
                'messages' => 'Teachers Imported Successfully'
            ]);
        }
    }
    //make the teacher import excel sheet
    public function teachersImportTemplate(){
        return Excel::download(new TeachertemplateExport,'teacherstemplate.xlsx');
    }
    //Function to fetch one teacher
    public function getTeacher($id){
        $teacher = Teacher::find($id);
        return response()->json([
            'teacher' => $teacher
        ]);
    }
    //Function to edit Teachers
    public function editTeacher(Request $request){
        $validator = Validator::make($request->all(),[
            'editsalutation' => 'required',
            'editfname' => 'required',
            'editlname' => 'required',
            //'phone' => 'required|unique:teachers',
            //'email' => 'email|unique:teachers',
            'editposition' => 'required',
            'editgender' => 'required',
            'editprofile' => 'image'
           ],
        [
            'editsalutation.required' => 'Salutation is required',
            'editfname.required' => 'First Name is required',
            'editlname.required' => 'Last Name is required',
            'editposition.required' => 'Position for the teacher is required',
            'editgender.required' => 'Gender of the teacher is required',
            'editprofile.image' => 'The file you are using for profile must be an image'
        ]); 
    
           if ($validator->fails()) {
               return response()->json([
                   'status' => 400,
                   'messages' => $validator->getMessageBag()
               ]);
           } else {
               $teacher = Teacher::find($request->editid);
               $teacher->salutation = $request->editsalutation;
               $teacher->Fname = $request->editfname;
               $teacher->Sname = $request->editsname;
               $teacher->Lname = $request->editlname;
               $teacher->Gender = $request->editgender;
               $teacher->Position = $request->editposition;
               $teacher->Email = $request->editemail;
               $teacher->Phone = $request->editpno;
               $teacher->password = 'password123';
                           
               if ($request->hasFile('editprofile')) {
                $file = $request->file('editprofile');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'pro'.'.'.$extension;
                $file->move('images/', $filename);
                $teacher->Profile = $filename;
               } 
               $teacher->save();
               return response()->json([
                   'status' => 200,
                   'messages' => "Teacher's records Updated successfully" 
               ]);
           }  
    }
    //Function to delete teacher
    public function deleteTeacher($ids){
        $idarray = explode(',',$ids);
        for ($i=0; $i < count($idarray) ; $i++) { 
            $teacher = Teacher::find($idarray[$i]);
            $teacher->deleted = '1';
            $teacher->save(); 
        }
    return response()->json([
        'status' => 200,
        'messages' => count($idarray).' Teacher deleted Successfullly'
    ]);
    }
    //Function to deactivate teacher
    public function deactivateTeacher($ids){
        $idarray = explode(',',$ids);
        for ($i=0; $i < count($idarray) ; $i++) { 
            $teacher = Teacher::find($idarray[$i]);
            $teacher->Active = 'No';
            $teacher->save(); 
        }
        return response()->json([
        'status' => 200,
        'messages' => "Teacher's account activated Successfullly"
        ]); 
    }
    //Function to activate Teacher account
    public function activateTeacher($ids){
        $idarray = explode(',',$ids);
        for ($i=0; $i < count($idarray) ; $i++) { 
            $teacher = Teacher::find($idarray[$i]);
            $teacher->Active = 'Yes';
            $teacher->save(); 
        }
        return response()->json([
        'status' => 200,
        'messages' => "Teacher's Account activated Successfullly"
        ]);
    }
}
