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

use App\Notifications\NewApproval;

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
        if(session()->has('admin')){
            $admin = session('admin');
            $data = compact("admin");
            return view('dashboard.admin_dashboard')->with($data);
        }
        else
        {
            return view('errorhere');
        }
    }

    // Admin Logout Functionality
    public function logoutAdmin()
    {
        if(session()->has('admin'))
        {
            session()->pull('admin');
            return redirect('admin');
        }
        else
        {
            return view('errorhere');
        }
    }
    
    // Buttons - Student Approvals
    public function studentapproval()
    {
        if(session()->has('admin'))
        {
            $admin = session('admin');
            $approval = ApprovalStudent::all();
            $teachers = Teacher::all();
            $data = compact('admin','approval','teachers');
            return view('dashboard.studentapproval')->with($data);
        }
        else
        {
            return view('errorhere');
        }
    }

    // View - Students Approvals
    public function viewStudent($s_id)
    {
        if(session()->has('admin'))
        {
            $admin = session('admin');
            $approvalstudent = ApprovalStudent::where('id',$s_id)->first();
            $approval = Teacher::all();
            $data = compact('admin','approvalstudent','approval');
            return view('dashboard.viewstudent')->with($data);
        }
        else
        {
            return view('errorhere');
        }        
    }

    // Approve - Student
    public function approveStudent($id, Request $request)
    {
        if(session()->has('admin'))
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
            $newStudent->cs = $studentDetails->cs;
            $newStudent->ps = $studentDetails->ps;
            $newStudent->parent = $studentDetails->parent;
            $newStudent->parentno = $studentDetails->parentno;
            $newStudent->password = $studentDetails->password;
            $newStudent->teacher = "({$teacher->id})T {$teacher->name}";
            
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
        else
        {
            return view('errorhere');
        }
    }

    // Reject - Student
    public function rejectStudent($id, Request $request)
    {
        if(session()->has('admin'))
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
        else
        {
            return view('errorhere');
        }
    }

    // Buttons - Teacher Approvals
    public function teacherapproval()
    {
        if(session()->has('admin'))
        {
            $admin = session('admin');
            $approval = Approval::all();
            $data = compact('admin','approval');
            return view('dashboard.teacherapproval')->with($data);
        }
        else
        {
            return view('errorhere');
        }
    }

    // View - Teachers Approvals
    public function viewTeacher($t_id)
    {
        if(session()->has('admin'))
        {
            $admin = session('admin');
            $approval = Approval::where('id',$t_id)->first();
            $data = compact('admin','approval');
            return view('dashboard.viewteacher')->with($data);
        }
        else
        {
            return view('errorhere');
        }        
    }

    // Approve - Teacher
    public function approveTeacher($id, Request $request)
    {
        if(session()->has('admin'))
            {
            $teacherDetails = Approval::where('id',$id)->first();
            $newTeacher = new Teacher();
            $newTeacher->name = $teacherDetails->name;
            $newTeacher->email = $teacherDetails->email;
            $newTeacher->address = $teacherDetails->address;
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
        else
        {
            return view('errorhere');
        }
    }

    // Reject - Teacher
    public function rejectTeacher($id, Request $request)
    {
        if(session()->has('admin'))
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
        else
        {
            return view('errorhere');
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
        if(session()->has('teacher')){
            $teacher = session('teacher');
            $data = compact("teacher");
            return view('dashboard.teacher_dashboard')->with($data);
            }
            else
            {
                return view('errorhere');
            }
    }

    // Teacher Logout Functionality
    public function logoutTeacher()
    {
        if(session()->has('teacher'))
        {
            session()->pull('teacher');
        }
        return redirect('teacherlogin');
    }

    // Teacher Edit
    public function teacherEdit()
    {
        if(session()->has('teacher'))
        {
            $teacher = session('teacher');
            $data = compact("teacher");
            return view('updateinfo.teacherupdate')->with($data);
        }
        else
        {
            return view('errorhere');
        }
    }

    // Update Teacher
    public function teacherUpdate(Request $request)
    {
        if(session()->has('teacher')){

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
        else
        {
            return view('errorhere');
        }
    }

    // Teacher Registration Functionality
    public function registerTeacher(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins|unique:approvals|unique:teachers|unique:approval_students|unique:students',
            'address'=>'required',
            'image'=>'required',
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
        $teacher->image = $request['image'];
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
        if(session()->has('student')){
            $student = session('student');
            $data = compact("student");
            return view('dashboard.student_dashboard')->with($data);
            }
            else
            {
                return view('errorhere');
            }
    }
    
    // Student Logout Functionality
    public function logoutStudent()
    {
        if(session()->has('student'))
        {
            session()->pull('student');
        }
        return redirect('studentlogin');
    }

    //Edit Student
    public function studentEdit()
    {
        if(session()->has('student'))
        {
            $student = session('student');
            $data = compact("student");
            return view('updateinfo.studentupdate')->with($data);
        }
        else
        {
            return view('errorhere');
        }
    }
    
    // Update Student
    public function studentUpdate(Request $request)
    {            
    if(session()->has('student')){
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
        else
        {
            return view('errorhere');
        }
    }

    // Student Registration Functionality
    public function registerStudent(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins|unique:approvals|unique:teachers|unique:approval_students|unique:students',
            'address'=>'required',
            'image'=>'required',
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
        $student->image = $request['image'];
        $student->cs = $request['cs'];
        $student->ps = $request['ps'];
        $student->parent = $request['parent'];
        $student->parentno = $request['parentno'];
        $student->password = md5($request['password']);
        $res = $student->save();

        // Notification------------------------
        // $admins = Admin::all();

        // foreach ($admins as $admin) {
        //     $admin->notify(new NewApproval($student));
        // }
        //-------------------------------------

        if($res){  
            return back()->with('success', 'Sent for Approval, you will soon recieve mail');
        }
        else{
            return back()->with('fail', 'Something Wrong!!');
        }
    }
    
    

    // Student List Route
    public function studentlist($id)
    {
        $admin = Admin::where('id',$id)->first();
        $students = Student::all();
        $data = compact('admin','students');
        return view('dashboard.student-list')->with($data);
    }

    
    // Teacher List Route
    public function teacherlist($id)
    {
        $admin = Admin::where('id',$id)->first();
        $teachers = Teacher::all();
        $data = compact('admin','teachers');
        return view('dashboard.teacher-list')->with($data);
    }

}
