<?php

namespace App\Http\Controllers;
use Excel;
use DB;
use App\Exports\StudentExport;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //Register student
    public function registerStudent(Request $req){
        $validator = Validator::make($req->all(),[
            'admissionNo' => 'required|unique:students',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'disabled' => 'required',
            'current_class' => 'required',
            'county' => 'required',
            'subcounty' => 'required',
            'file' => 'image'
        ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag() 
                ]);
            } else {
                $student = new Student;
                $student->AdmissionNo = $req->admissionNo; 
                $student->Fname = $req->firstname;
                $student->Sname = $req->secondname;
                $student->Lname = $req->lastname;

                $classinfo = explode(',',$req->current_class);

                $student->current_class = $classinfo[1];
                $student->current_classid = $classinfo[0];
                $student->gender = $req->gender;
                $student->dob = $req->dob;
                $student->county = $req->county;
                $student->subcounty = $req->subcounty;
                $student->disabled = $req->disabled;
                $student->disability = $req->disabilitytype;
                $student->d_description = $req->disabilitydescription;

                if ($req->hasFile('file')) {
                    $file = $req->file('file');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'pro'.'.'.$extension;
                    $file->move('images/', $filename);
                    $student->profile = $filename;
                } 
                $student->save();
                return response()->json([
                    'status' => 200,
                    'messages' => 'New Student Registered Successfully'
                ]);
            }
    }
    //fetch students
    public function fetchStudents(){
        $students = Student::where('deleted',0)
                ->get();
        return response()->json([
            'students' => $students
        ]);
    }

    public function filterStudents(Request $req){
        $filtervalue = $req->filtervalue;
        if ($filtervalue == 'ALL') {
            $students = Student::all();
            return response()->json([
                'students' => $students
            ]);
        } else {
            $students = Student::where('current_class', $filtervalue)
                            ->get();
            return response()->json([
                'students' => $students
            ]);
        }  
    }
    //Students Excel
    public function excelStudents(){
        $students = Student::all();
        return view('adminFiles.excelstudent',['students' => $students]);
    }
    //produce students excel sheet
    public function produceStudentsExcel(){
        return Excel::download(new StudentExport,'students.xlsx');
    }
    //Function to delete student(s)
    public function deleteStudents($ids){
        $idarray = explode(',',$ids);
        for ($i=0; $i < count($idarray) ; $i++) { 
            $student = Student::find($idarray[$i]);
            $student->deleted = '1';
            $student->save(); 
        }
    return response()->json([
        'status' => 200,
        'messages' => 'Student deleted Successfullly'
    ]);
    }

    //Function to promote students
    public function promoteStudents($ids,$nextclass){
        $idarray = explode(',',$ids);
        for ($i=0; $i < count($idarray) ; $i++) { 
            $student = Student::find($idarray[$i]);
            $classinfo = explode(',',$nextclass);
            $student->current_class = $classinfo[1];
            $student->current_classid = $classinfo[0];
            $student->save(); 
        }
        return response()->json([
        'status' => 200,
        'messages' => count($idarray).' Students Promoted to '.$nextclass.' Successfully'
        ]);  
    }
    //Function to deactivate account
    public function deactivateStudents($ids){
        $idarray = explode(',',$ids);
        for ($i=0; $i < count($idarray) ; $i++) { 
            $student = Student::find($idarray[$i]);
            $student->Active = 'No';
            $student->save(); 
        }
        return response()->json([
        'status' => 200,
        'messages' => 'Student account activated Successfullly'
        ]); 
    }
    //Function to activate accoutnt
    public function activateStudents($ids){
        $idarray = explode(',',$ids);
        for ($i=0; $i < count($idarray) ; $i++) { 
            $student = Student::find($idarray[$i]);
            $student->Active = 'Yes';
            $student->save(); 
        }
        return response()->json([
        'status' => 200,
        'messages' => 'Student Account activated Successfullly'
        ]); 
    } 
    //Function to fetch one student
    public function getStudent($id){
        $student = Student::find($id);
        return response()->json([
            'student' => $student
        ]);
    }
    //Function to update student
    public function editStudent(Request $req){
        $validator = Validator::make($req->all(),[
            //'admissionNo' => 'required|unique:students',
            'seditfname' => 'required',
            'seditlname' => 'required',
            'seditgender' => 'required',
            'seditclass' => 'required',
            'seditcounty' => 'required',
            'seditscounty' => 'required',
            'seditprofile' => 'image'
        ],
    [
       'seditprofile' => 'File selected for profile photo must be an image',
       'seditlname' => 'Last name is required',
       'seditfname' => 'First name is required',
       'seditgender' => 'Gender field is required',
       'seditcounty' => 'The county field is required',
       'seditscounty' => 'Sub County field is required' 
    ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag() 
                ]);
            } else {
                $student = Student::find($req->seditid);
                $student->AdmissionNo = $req->seditadmno; 
                $student->Fname = $req->seditfname;
                $student->Sname = $req->seditsname;
                $student->Lname = $req->seditlname;

                $classinfo = explode(',',$req->seditclass);

                $student->current_class = $classinfo[1];
                $student->current_classid = $classinfo[0];
                $student->gender = $req->seditgender;
                $student->dob = $req->seditdob;
                $student->county = $req->seditcounty;
                $student->subcounty = $req->seditscounty;
                $student->disabled = $req->seditdisability;
                if ($req->seditdisability == 'Yes') {
                    $student->disability = $req->editdisabilitytype;
                }
                if ($req->editdisabilitytype == 'Other') {
                    $student->d_description = $req->seditdisabilitydescription;  
                }
                
                if ($req->hasFile('seditprofile')) {
                    $file = $req->file('seditprofile');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'pro'.'.'.$extension;
                    $file->move('images/', $filename);
                    $student->profile = $filename;
                } 
                $student->save();
                return response()->json([
                    'status' => 200,
                    'messages' => 'Student Details updated Successfully'
                ]);
            } 
    }
}
