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


    public function teacherlogin()
    {
        return view("auth.teacherlogin");
    }

    public function teacherregister()
    {
        return view("auth.teacherregister");
    }

    public function studentlogin()
    {
        return view("auth.studentlogin");
    }

    public function studentregister()
    {
        return view("auth.studentregister");
    }


    // Admin Login Process
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:12'
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
                $request->session()->put('id',$admin->id);
                return redirect("admin-dashboard/{$admin->id}");
            }
            
            else
            {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }

    //Admin Registration Process
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:6|max:12'
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

    // Admin Dashboard
    public function adminDashboard($id)
    {
        $admin = Admin::where('id',$id)->first();
        $data = compact("admin");
        return view('dashboard.admin_dashboard')->with($data);
    }

    //Student Login
    public function loginStudent(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:12'
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
                $request->session()->put('id',$student->id);
                return redirect("student-dashboard/{$student->id}");
            }
            else
            {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }

    // Student Dashboard
    public function studentDashboard($id)
    {
        $student = Student::where('id',$id)->first();
        $data = compact("student");
        return view('dashboard.student_dashboard')->with($data);
    }
    


    // Student Registration
    public function registerStudent(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:students|unique:approval_students',
            'address'=>'required',
            'image'=>'required',
            'ps'=>'required',
            'cs'=>'required',
            'parent'=>'required',
            'parentno'=>'required',
            'password'=>'required|min:6|max:12'
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

        if($res){  

            return back()->with('success', 'Sent for Approval, you will soon recieve mail');
        }
        else{
            return back()->with('fail', 'Something Wrong!!');
        }
    }

    //Teacher Login
    public function loginTeacher(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:12'
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
                $request->session()->put('id',$teacher->id);
                // echo "Teacher Logged in Successfully";
                return redirect("teacher-dashboard/{$teacher->id}");
            }
            else
            {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }



    // Teacher Registration
    public function registerTeacher(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:teachers|unique:approvals',
            'address'=>'required',
            'image'=>'required',
            'ps'=>'required',
            'cs'=>'required',
            'experience'=>'required',
            'expertise'=>'required',
            'password'=>'required|min:6|max:12'
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

    // Admin Dashboard Buttons Routing
    
    // Show all Student Approvals
    public function studentapproval($id)
    {
        $admin = Admin::where('id',$id)->first();
        $approval = ApprovalStudent::all();
        $teachers = Teacher::all();
        $data = compact('admin','approval','teachers');
        return view('dashboard.studentapproval')->with($data);
    }

    // View Teachers Approval Profile
    public function viewStudent($id, $s_id)
    {
        $admin = Admin::where('id',$id)->first();
        $approvalstudent = ApprovalStudent::where('id',$s_id)->first();
        $approval = Teacher::all();
        $data = compact('admin','approvalstudent','approval');
        return view('dashboard.viewstudent')->with($data);
    }


    // Approve Student
    public function approveStudent($id, $a_id, Request $request)
    {
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
    $newStudent->save();
    
    //Send Mail of Approval
        try {
            Mail::to($studentDetails->email)->send(new ApprovedStudent());
        } catch (\Exception $e) {
            return "Error sending mail: " . $e->getMessage();
        }

        ApprovalStudent::where('id',$id)->delete();
        return redirect("studentapproval/$a_id");
    }

    // Reject Student Approval
    public function rejectStudent($id, $a_id, Request $request)
    {
        $studentDetails = ApprovalStudent::where('id',$id)->first();
        // Send Mail of Rejection
        try {
            Mail::to($studentDetails->email)->send(new RejectedStudent());
        } catch (\Exception $e) {
            return "Error sending mail: " . $e->getMessage();
        }

        ApprovalStudent::where('id',$id)->delete();
        return redirect("studentapproval/$a_id");
    }

    // Show all Teacher Approvals
    public function teacherapproval($id)
    {
        $admin = Admin::where('id',$id)->first();
        $approval = Approval::all();
        $data = compact('admin','approval');
        return view('dashboard.teacherapproval')->with($data);
    }

    // View Teachers Approval Profile
    public function viewTeacher($id, $t_id)
    {
        $admin = Admin::where('id',$id)->first();
        $approval = Approval::where('id',$t_id)->first();
        $data = compact('admin','approval');
        return view('dashboard.viewteacher')->with($data);
    }

    // Approve Teacher
    public function approveTeacher($id, $a_id, Request $request)
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
        $newTeacher->save();

        //Send Mail of Approval
        try {
            Mail::to($teacherDetails->email)->send(new ApprovedTeacher());
        } catch (\Exception $e) {
            return "Error sending mail: " . $e->getMessage();
        }

        Approval::where('id',$id)->delete();
        return redirect("teacherapproval/$a_id");
    }

    // Reject Teacher Approval 
    public function rejectTeacher($id, $a_id, Request $request)
    {
        $teacherDetails = Approval::where('id',$id)->first();
        //Send Mail of Rejection
        try {
            Mail::to($teacherDetails->email)->send(new RejectedTeacher());
        } catch (\Exception $e) {
            return "Error sending mail: " . $e->getMessage();
        }

        Approval::where('id',$id)->delete();
        return redirect("teacherapproval/$a_id");
    }

    // Teacher List Route
    public function teacherlist($id)
    {
        $admin = Admin::where('id',$id)->first();
        $teachers = Teacher::all();
        $data = compact('admin','teachers');
        return view('dashboard.teacher-list')->with($data);
    }

    // Student List Route
    public function studentlist($id)
    {
        $admin = Admin::where('id',$id)->first();
        $students = Student::all();
        $data = compact('admin','students');
        return view('dashboard.student-list')->with($data);
    }

    //Edit Student
    public function studentEdit($id)
    {
        $student = Student::where('id',$id)->first();
        $data = compact("student");
        return view('updateinfo.studentupdate')->with($data);
    }
    
    // Update Student
    public function studentUpdate($id, Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'ps'=>'required',
            'cs'=>'required',
            'parent'=>'required',
            'parentno'=>'required'
        ]);

        Student::where('id',$id)->update(['name'=> $request['name']]);
        Student::where('id',$id)->update(['address'=> $request['address']]);
        Student::where('id',$id)->update(['cs'=> $request['cs']]);
        Student::where('id',$id)->update(['ps'=> $request['ps']]);
        Student::where('id',$id)->update(['parent'=> $request['parent']]);
        Student::where('id',$id)->update(['parentno'=> $request['parentno']]);

        $student = Student::where('id',$id)->first();
        $data = compact("student");
        return view('dashboard.student_dashboard')->with($data);
    }

    // Teacher Dashboard
    public function teacherDashboard($id)
    {
        $teacher = Teacher::where('id',$id)->first();
        $data = compact("teacher");
        return view('dashboard.teacher_dashboard')->with($data);
    }

    // Teacher Edit
    public function teacherEdit($id)
    {
        $teacher = Teacher::where('id',$id)->first();
        $data = compact("teacher");
        return view('updateinfo.teacherupdate')->with($data);
    }

    // Update Teacher
    public function teacherUpdate($id, Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'ps'=>'required',
            'cs'=>'required',
            'experience'=>'required',
            'expertise'=>'required'
        ]);

        Teacher::where('id',$id)->update(['name'=> $request['name']]);
        Teacher::where('id',$id)->update(['address'=> $request['address']]);
        Teacher::where('id',$id)->update(['cs'=> $request['cs']]);
        Teacher::where('id',$id)->update(['ps'=> $request['ps']]);
        Teacher::where('id',$id)->update(['experience'=> $request['experience']]);
        Teacher::where('id',$id)->update(['expertise'=> $request['expertise']]);
        
        $teacher = Teacher::where('id',$id)->first();
        $data = compact("teacher");
        return view('dashboard.teacher_dashboard')->with($data);
    }

}
