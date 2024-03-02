<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Basic Routes
Route::get('/', [AssessmentController::class, 'usertype']);
Route::get('/admin', [AssessmentController::class, 'admin']);
Route::get('/adminregister', [AssessmentController::class, 'adminRegister']);
Route::get('/teacherlogin', [AssessmentController::class, 'teacherlogin']);
Route::get('/teacherregister', [AssessmentController::class, 'teacherregister']);
Route::get('/studentlogin', [AssessmentController::class, 'studentlogin']);
Route::get('/studentregister', [AssessmentController::class, 'studentregister']);

// *********************** Admin Access *********************

// Admin Login/Logout
Route::post('/login-admin',[AssessmentController::class, 'loginAdmin'])->name('login-admin');
Route::get('/admin-dashboard',[AssessmentController::class, 'adminDashboard']);
Route::get('/logout-admin', [AssessmentController::class, 'logoutAdmin'])->name('logout-admin');;

//Admin Home Dashboard Buttons
Route::get('/studentapproval',[AssessmentController::class, 'studentapproval'])->name('studentapproval');
Route::get('/teacherapproval',[AssessmentController::class, 'teacherapproval'])->name('teacherapproval');
Route::get('/teacherlist/{id}',[AssessmentController::class, 'teacherlist'])->name('teacherlist');
Route::get('/studentlist/{id}',[AssessmentController::class, 'studentlist'])->name('studentlist');

//Route to view
Route::get('/view-student/{s_id}', [AssessmentController::class, 'viewStudent'])->name('view-student');
Route::get('/view-teacher/{t_id}', [AssessmentController::class, 'viewTeacher'])->name('view-teacher');

// Route to approve
Route::post('/approve-student/{id}', [AssessmentController::class, 'approveStudent'])->name('approve-student');
Route::post('/approve-teacher/{id}', [AssessmentController::class, 'approveTeacher'])->name('approve-teacher');

// Route to reject
Route::post('/reject-student/{id}', [AssessmentController::class, 'rejectStudent'])->name('reject-student');
Route::post('/reject-teacher/{id}', [AssessmentController::class, 'rejectTeacher'])->name('reject-teacher');

// Admin Registration
Route::post('/register-admin',[AssessmentController::class, 'registerAdmin'])->name('register-admin');

//********************** Admin Access End *******************


// ******************* Teacher Access End **********************

// Teacher Login/Logout
Route::post('/login-teacher',[AssessmentController::class, 'loginTeacher'])->name('login-teacher');
Route::get('/teacher-dashboard',[AssessmentController::class, 'teacherDashboard']);
Route::get('/logout-teacher', [AssessmentController::class, 'logoutTeacher'])->name('logout-teacher');

// Teacher Registration
Route::post('/register-teacher',[AssessmentController::class, 'registerTeacher'])->name('register-teacher');

// Route to edit teacher
Route::get('/teacher-edit',[AssessmentController::class, 'teacherEdit'])->name('teacher-edit');
Route::post('/update-teacher',[AssessmentController::class, 'teacherUpdate'])->name('update-teacher');

// ******************* Teacher Access End **********************


// **************** Student Access ***************************

// Student Login/Logout
Route::post('/register-student',[AssessmentController::class, 'registerStudent'])->name('register-student');
Route::post('/login-student',[AssessmentController::class, 'loginStudent'])->name('login-student');
Route::get('/student-dashboard',[AssessmentController::class, 'studentDashboard']);

// Student Registration
Route::get('/logout-student', [AssessmentController::class, 'logoutStudent'])->name('logout-student');

// Route to edit student
Route::get('/student-edit',[AssessmentController::class, 'studentEdit'])->name('student-edit');
Route::post('/update-student',[AssessmentController::class, 'studentUpdate'])->name('update-student');

// ******************** Student Access End ******************************