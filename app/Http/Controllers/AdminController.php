<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Librarian;
use App\Models\Book;
use App\Models\Term;
use App\Models\classes;
use App\Models\exam;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Mark;
use App\Models\School;
use App\Models\School_Data;
use App\Models\ResultThread;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function landingpage(){
        //$schools = School::all();
        $data = [
            'schools' => School::all()
        ];
        return view('General.landingpage',$data);
    }
    public function index(){
        return view('admin.adminlogin');
    }

    public function register(){
        return view('admin.adminregister');
    }

    public function resetpass(){
        return view('admin.adminforgotpass');
    }

    public function newpassreset(){
        return view('admin.resetpass');
    }
    //hande user registration ajax request
    public function saveAdmin(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'email' => 'required|email|unique:admins|max:100',
            'phone' => 'required|unique:admins',
            'password' => 'required|min:6|max:50',
            'cpassword' => 'required|min:6|same:password',
        ],
    [
        'cpassword.same' => 'Passwords did not match',
        'cpassword.required' => 'Confirm Password is required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 400,
            'messages' => $validator->getMessageBag()
        ]);
    } else {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return response()->json([
            'status' => 200,
            'messages' => 'Registered Successfully'
        ]);
    }
    
    }

    //admin login
    public function loginAdmin(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $admin = Admin::where('email',$request->email)->first();
            if ($admin) {
                if (Hash::check($request->password, $admin->password)) {
                    $request->session()->put('LoggedInUser',$admin->id);
                    return response()->json([
                        'status' => 200,
                        'messages' => 'success'
                    ]);
                } else{
                    return response()->json([
                        'status' => 401,
                        'messages' => 'Email or password is wrong'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 401,
                    'messages' => 'No user with such Email found'
                ]);
            } 
        } 
        
    }

    public function dashboard(){
        $maxid = DB::table('school__data')->max('id');
        $data = [
            'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
            'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
        ];

        return view('adminFiles.dashboard', $data);
    }
    //Admin Profile Page
    public function profile(){
        $maxid = DB::table('school__data')->max('id');
        $data = [
            'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
            'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
        ];

        return view('adminFiles.profile',$data);
    }
//function for returning students
public function students(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.students',$data);
}
//Function for returning Examination Thread
public function resultThread(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.resultthread',$data);
}
//function for returning teachers
public function teachers(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.teachers',$data);
}
//function for returning parents
public function parents(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.parents',$data);
}
//function for returning staff
public function staff(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.staff',$data);
}
//function for returning subjects
public function subjects(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.subjects',$data);
}
//function for returning clubs
public function clubs(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.clubs',$data);
}
//function for returning classes
public function classes(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.classes',$data);
}
//function for returning departments
public function departments(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.departments',$data);
}
//function for returning expenses
public function expenses(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.expenses',$data);
}
//Function to return autoresults
public function autoresults(){
    //$exam = exam::all();
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first(),
        'exams' => exam::all(),
        'subjects' => Subject::all(),
        'classes' => classes::all()
    ];

    return view('adminFiles.autoresults',$data);
}
//function for returning procurements
public function procurements(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.procurements',$data);
}
//function for returning procurements
public function gradingsystem(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first(),
        'subjects' => Subject::all(),
        'classes' => classes::all()
    ];

    return view('adminFiles.gradingsystem',$data);
}
//function for returning suppliers
public function suppliers(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first()
    ];

    return view('adminFiles.suppliers',$data);
}
//Function for returning final Results view 
public function finalresults(){
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first(),
        'classes' => classes::all(),
        'threads' => ResultThread::all()
    ];

    return view('adminFiles.finalresults',$data);
}
//function for returning libary info
public function library(){
    $librarians = Librarian::all();
    $books = Book::all();
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first(),
        'librarians' => $librarians,
        'books' => $books
    ];
    return view('adminFiles.library',$data);
}
//function for returning books view to the admin
public function books(){
    $librarians = Librarian::all();
    $books = Book::where('deleted',0)
                    ->get();
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first(),
        'librarians' => $librarians,
        'books' => $books
    ];
    return view('adminFiles.books',$data);
}
//function for returning terms view
public function terms(){
    $classes = classes::all();
    $librarians = Librarian::all();
    $terms = Term::all();
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first(),
        'librarians' => $librarians,
        'terms' => $terms,
        'classes' => $classes
    ];
    return view('adminFiles.terms',$data);
}
    //Set Current Term
public function currentTerm(){
    $classes = classes::all();
    $librarians = Librarian::all();
    $terms = Term::all();
    $maxid = DB::table('school__data')->max('id');
    $data = [
        'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
        'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first(),
        'librarians' => $librarians,
        'terms' => $terms,
        'classes' => $classes
    ];
    return view('adminFiles.currentterm',$data);
}
    //return Exam view
public function examinations(){
        $classes = classes::all();
        $librarians = Librarian::all();
        $terms = Term::all();
        $exams = exam::where('deleted',0)
                            ->get();
        $maxid = DB::table('school__data')->max('id');
        $data = [
            'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
            'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first(),
            'librarians' => $librarians,
            'terms' => $terms,
            'exams' => $exams
        ];
        return view('adminFiles.exams',$data);
    }   
    //Function to return view for result computation
    public function getClassCompResults($examid,$classid){
        $classes = classes::all();
        $currentclass = classes::find($classid);
        $currentexam = exam::find($examid);
        $students = Student::where('current_classid',$classid)
                        ->get();
        $adms = [];
        $terms = Term::all();
        $exams = exam::where('deleted',0)
                            ->get();
        $subjects = Subject::all();
        $marks = Mark::where('classid',$classid)
                        ->where('examid',$examid)
                       ->get();
        $maxid = DB::table('school__data')->max('id');

        foreach ($marks as $mark) {
            array_push($adms,$mark->AdmissionNo);
        }

        $data = [
            'adminInfo' => DB::table('admins')->where('id', session('LoggedInUser'))->first(),
            'schoolinfo' => DB::table('school__data')->where('id',$maxid)->first(),
            'terms' => $terms,
            'exams' => $exams,
            'classes' => $classes,
            'currentclass' => $currentclass,
            'students' => $students,
            'subjects' => $subjects,
            'currentexam' => $currentexam,
            'marks' => $marks,
            'adms' => $adms
        ];
        return view('adminFiles.computeresults',$data);
    }

    //function to logout
    public function logoutAdmin(){
        if (session()->has('LoggedInUser')) {
            session()->pull('LoggedInUser');
            return redirect('/adminlogin');
        }
    }
}
