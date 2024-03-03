<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Approval;
use App\Models\ApprovalStudent;

use App\Mail\ApprovedStudent;
use App\Mail\RejectedStudent;
use App\Mail\ApprovedTeacher;
use App\Mail\RejectedTeacher;
use Illuminate\Support\Facades\Notification;

use App\Notifications\NewStudent;

use Mail;
use md5;
use Session;

class AssessmentController extends Controller
{
    // User Type Page
    public function usertype()
    {
        return view("welcome");
    }

    //Admin Login Page
    public function admin()
    {
        return view("auth.admin");
    }

    //Admin Registration Page
    public function adminRegister()
    {
        return view("auth.adminregister");
    }

    // Teacher Login Page
    public function teacherlogin()
    {
        return view("auth.teacherlogin");
    }

    //Teacher Registration Page
    public function teacherregister()
    {
        return view("auth.teacherregister");
    }

    //Student Login Page
    public function studentlogin()
    {
        return view("auth.studentlogin");
    }

    //Student Registration Page
    public function studentregister()
    {
        return view("auth.studentregister");
    }

    // Error Page
    public function noAccess()
    {
        return view("errorhere");
    }

// ************************** Admin *********************************

    // Admin Login Functionality
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        $admin = Admin::where('email','=',$request->email)->first();
        if (!$admin) 
        {
            return back()->with('fail', 'Not Registered');
        }
        else 
        {
            if(md5($request->password) === ($admin->password))
            {
                $request->session()->put('admin', $admin);
                return redirect("admin-dashboard");
            }
            
            else
            {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }
    
    // Admin Dashboard
    public function adminDashboard()
    {
            $admin = session('admin');
            $data = compact("admin");
            return view('dashboard.admin_dashboard')->with($data);
    }

    // Admin Logout Functionality
    public function logoutAdmin()
    {
            session()->pull('admin');
            return redirect('admin');
    }
    
    // Buttons - Notifications
    public function adminNotification()
    {
        $admin = session('admin');
        $admindata = compact("admin");
        return view('dashboard.admin_notify')->with($admindata);
    }

    // Buttons - Student Approvals
    public function studentapproval()
    {
            $admin = session('admin');
            $approval = ApprovalStudent::all();
            $teachers = Teacher::all();
            $data = compact('admin','approval','teachers');
            return view('dashboard.studentapproval')->with($data);
    }

    // View - Students Approvals
    public function viewStudent($s_id)
    {
            $admin = session('admin');
            $approvalstudent = ApprovalStudent::where('id',$s_id)->first();
            $approval = Teacher::all();
            $data = compact('admin','approvalstudent','approval');
            return view('dashboard.viewstudent')->with($data);        
    }

    // Approve - Student
    public function approveStudent($id, Request $request)
    {
            $admin = session('admin');
            $request->validate([
            'id' => 'required',
            ]);

            $studentDetails = ApprovalStudent::where('id',$id)->first();
            $teacher = Teacher::where('id',$request->id)->first();
            $newStudent = new Student();
            $newStudent->name = $studentDetails->name;
            $newStudent->email = $studentDetails->email;
            $newStudent->address = $studentDetails->address;
            $newStudent->image = $studentDetails->image;
            $newStudent->cs = $studentDetails->cs;
            $newStudent->ps = $studentDetails->ps;
            $newStudent->parent = $studentDetails->parent;
            $newStudent->parentno = $studentDetails->parentno;
            $newStudent->password = $studentDetails->password;
            $newStudent->teacher = "T{$teacher->id} {$teacher->name}";
            
            try {
                Mail::to($studentDetails->email)->send(new ApprovedStudent());
                $newStudent->save();
                ApprovalStudent::where('id',$id)->delete();
                return redirect("studentapproval")->with('success', 'Mail was sent successfully');
            } catch (\Exception $e) {
                ApprovalStudent::where('id',$id)->delete();
                return redirect("studentapproval")->with('fail', 'Mail was not sent!!');
            }
    }

    // Reject - Student
    public function rejectStudent($id, Request $request)
    {
            $admin = session('admin');
            $studentDetails = ApprovalStudent::where('id',$id)->first();
        
            try {
                Mail::to($studentDetails->email)->send(new RejectedStudent());
                ApprovalStudent::where('id',$id)->delete();
                return redirect("studentapproval")->with('success', 'Mail was sent successfully');
            } catch (\Exception $e) {
                ApprovalStudent::where('id',$id)->delete();
                return redirect("studentapproval")->with('fail', 'Mail was not sent!!');
            }
    }

    // Buttons - Teacher Approvals
    public function teacherapproval()
    {
            $admin = session('admin');
            $approval = Approval::all();
            $data = compact('admin','approval');
            return view('dashboard.teacherapproval')->with($data);
    }

    // View - Teachers Approvals
    public function viewTeacher($t_id)
    {
            $admin = session('admin');
            $approval = Approval::where('id',$t_id)->first();
            $data = compact('admin','approval');
            return view('dashboard.viewteacher')->with($data);  
    }

    // Approve - Teacher
    public function approveTeacher($id, Request $request)
    {
            $teacherDetails = Approval::where('id',$id)->first();
            $newTeacher = new Teacher();
            $newTeacher->name = $teacherDetails->name;
            $newTeacher->email = $teacherDetails->email;
            $newTeacher->address = $teacherDetails->address;
            $newTeacher->image = $teacherDetails->image;
            $newTeacher->cs = $teacherDetails->cs;
            $newTeacher->ps = $teacherDetails->ps;
            $newTeacher->experience = $teacherDetails->experience;
            $newTeacher->expertise = $teacherDetails->expertise;
            $newTeacher->password = $teacherDetails->password;
            
            try {
                Mail::to($teacherDetails->email)->send(new ApprovedTeacher());
                $newTeacher->save();
                Approval::where('id',$id)->delete();
                return redirect("teacherapproval")->with('success', 'Mail was sent successfully');
            } catch (\Exception $e) {
                Approval::where('id',$id)->delete();
                return redirect("teacherapproval")->with('fail', 'Mail was not sent!!');
            }
    }

    // Reject - Teacher
    public function rejectTeacher($id, Request $request)
    {
            $teacherDetails = Approval::where('id',$id)->first();
            try {
                Mail::to($teacherDetails->email)->send(new RejectedTeacher());
                Approval::where('id',$id)->delete();
                return redirect("teacherapproval")->with('success', 'Mail was sent successfully');
            } catch (\Exception $e) {
                Approval::where('id',$id)->delete();
                return redirect("teacherapproval")->with('fail', 'Mail was not sent!!');
            }
    }

    // Admin Registration Functionality
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins|unique:approvals|unique:teachers|unique:approval_students|unique:students',
            'password'=>'required|min:6'
        ]);

        $admin = new Admin();
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password = md5($request['password']);
        $res = $admin->save();

        if($res){
            return back()->with('success', 'You have been registered');
        }
        else{
            return back()->with('fail', 'Something Wrong!!');
        }
    }


// ******************** Admin End ***********************************



// ***************************** Teacher *******************************

    //Teacher Login Functionality
    public function loginTeacher(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        $teacher = Teacher::where('email','=',$request->email)->first();
        if (!$teacher) 
        {
            return back()->with('fail', 'Not Registered Teacher');
        }
        else 
        {
            if(md5($request->password) === ($teacher->password))
            {
                $request->session()->put('teacher',$teacher);
                return redirect("teacher-dashboard");
            }
            else
            {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }

    // Teacher Dashboard
    public function teacherDashboard()
    {
            $teacher = session('teacher');
            $data = compact("teacher");
            return view('dashboard.teacher_dashboard')->with($data);
    }

    // Teacher Logout Functionality
    public function logoutTeacher()
    {
        session()->pull('teacher');
        return redirect('teacherlogin');
    }

    // Teacher Edit
    public function teacherEdit()
    {
            $teacher = session('teacher');
            $data = compact("teacher");
            return view('updateinfo.teacherupdate')->with($data);
     }

    // Update Teacher
    public function teacherUpdate(Request $request)
    {
           $request->validate([
            'name'=>'required',
            'address'=>'required',
            'ps'=>'required',
            'cs'=>'required',
            'experience'=>'required',
            'expertise'=>'required'
        ]);

        $teacher = session('teacher');
        
        $teacher->name = $request['name'];
        $teacher->address = $request['address'];
        $teacher->ps = $request['ps'];
        $teacher->cs = $request['cs'];
        $teacher->experience = $request['experience'];
        $teacher->expertise = $request['expertise'];
        $teacher->save();

        $data = compact("teacher");
        return view('dashboard.teacher_dashboard')->with($data);
    }

    // Teacher Registration Functionality
    public function registerTeacher(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins|unique:approvals|unique:teachers|unique:approval_students|unique:students',
            'address'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg,webp',
            'ps'=>'required',
            'cs'=>'required',
            'experience'=>'required',
            'expertise'=>'required',
            'password'=>'required|min:6'
        ]);

        $teacher = new Approval();
        $teacher->name = $request['name'];
        $teacher->email = $request['email'];
        $teacher->address = $request['address'];

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path = 'uploads/category/';
        $file->move($path,$filename);
        $teacher->image = $path.$filename;
        
        $teacher->ps = $request['ps'];
        $teacher->cs = $request['cs'];
        $teacher->experience = $request['experience'];
        $teacher->expertise = $request['expertise'];
        $teacher->password = md5($request['password']);
        $res = $teacher->save();

        if($res){
            return back()->with('success', 'Sent for Approval, you will soon recieve mail');
        }
        else{
            return back()->with('fail', 'Something Wrong!!');
        }
    }

// ******************* Teacher End *********************


// ******************* Student ***********************

    //Student Login Functionality
    public function loginStudent(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        $student = Student::where('email','=',$request->email)->first();
        if (!$student) 
        {
            return back()->with('fail', 'Not Registered Student');
        }
        else 
        {
            if(md5($request->password) === ($student->password))
            {
                $request->session()->put('student',$student);
                return redirect("student-dashboard");
            }
            else
            {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }

    // Student Dashboard
    public function studentDashboard()
    {
            $student = session('student');
            $data = compact("student");
            return view('dashboard.student_dashboard')->with($data);
    }
    
    // Student Logout Functionality
    public function logoutStudent()
    {
            session()->pull('student');
            return redirect('studentlogin');
    }

    //Edit Student
    public function studentEdit()
    {
            $student = session('student');
            $data = compact("student");
            return view('updateinfo.studentupdate')->with($data);
    }
    
    // Update Student
    public function studentUpdate(Request $request)
    {            
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'ps'=>'required',
            'cs'=>'required',
            'parent'=>'required',
            'parentno'=>'required'
        ]);

        $student = session('student');
        $student->name = $request['name'];
        $student->address = $request['address'];
        $student->cs = $request['cs'];
        $student->ps = $request['ps'];
        $student->parent = $request['parent'];
        $student->parentno = $request['parentno'];
        $student->save();
        $data = compact("student");
        return view('dashboard.student_dashboard')->with($data);
    }

    // Student Registration Functionality
    public function registerStudent(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins|unique:approvals|unique:teachers|unique:approval_students|unique:students',
            'address'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg,webp',
            'ps'=>'required',
            'cs'=>'required',
            'parent'=>'required',
            'parentno'=>'required',
            'password'=>'required|min:6'
        ]);

        $student = new ApprovalStudent();
        $student->name = $request['name'];
        $student->email = $request['email'];
        $student->address = $request['address'];

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path = 'uploads/category/';
        $file->move($path,$filename);
        $student->image = $path.$filename;

        $student->cs = $request['cs'];
        $student->ps = $request['ps'];
        $student->parent = $request['parent'];
        $student->parentno = $request['parentno'];
        $student->password = md5($request['password']);
        $res = $student->save();


        $admin = Admin::all();
        Notification::send($admin, new NewStudent($student));

        if($res){  
            return back()->with('success', 'Sent for Approval, you will soon recieve mail');
        }
        else{
            return back()->with('fail', 'Something Wrong!!');
        }
    }
}
