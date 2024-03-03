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
Route::get('/no-access', [AssessmentController::class, 'noAccess']);

// *********************** Admin Access *********************

// Admin Login/Logout
Route::post('/login-admin',[AssessmentController::class, 'loginAdmin'])->name('login-admin');
Route::get('/admin-dashboard',[AssessmentController::class, 'adminDashboard'])->middleware('adminkey');
Route::get('/logout-admin', [AssessmentController::class, 'logoutAdmin'])->name('logout-admin')->middleware('adminkey');

//Admin Home Dashboard Buttons
Route::get('/studentapproval',[AssessmentController::class, 'studentapproval'])->name('studentapproval')->middleware('adminkey');
Route::get('/teacherapproval',[AssessmentController::class, 'teacherapproval'])->name('teacherapproval')->middleware('adminkey');
Route::get('/teacherlist/{id}',[AssessmentController::class, 'teacherlist'])->name('teacherlist')->middleware('adminkey');
Route::get('/studentlist/{id}',[AssessmentController::class, 'studentlist'])->name('studentlist')->middleware('adminkey');

//Route to view
Route::get('/view-student/{s_id}', [AssessmentController::class, 'viewStudent'])->name('view-student')->middleware('adminkey');
Route::get('/view-teacher/{t_id}', [AssessmentController::class, 'viewTeacher'])->name('view-teacher')->middleware('adminkey');

// Route to approve
Route::post('/approve-student/{id}', [AssessmentController::class, 'approveStudent'])->name('approve-student')->middleware('adminkey');
Route::post('/approve-teacher/{id}', [AssessmentController::class, 'approveTeacher'])->name('approve-teacher')->middleware('adminkey');

// Route to reject
Route::post('/reject-student/{id}', [AssessmentController::class, 'rejectStudent'])->name('reject-student')->middleware('adminkey');
Route::post('/reject-teacher/{id}', [AssessmentController::class, 'rejectTeacher'])->name('reject-teacher')->middleware('adminkey');

// Admin Registration
Route::post('/register-admin',[AssessmentController::class, 'registerAdmin'])->name('register-admin');

//********************** Admin Access End *******************


// ******************* Teacher Access End **********************

// Teacher Login/Logout
Route::post('/login-teacher',[AssessmentController::class, 'loginTeacher'])->name('login-teacher');
Route::get('/teacher-dashboard',[AssessmentController::class, 'teacherDashboard'])->middleware('teacherkey');
Route::get('/logout-teacher', [AssessmentController::class, 'logoutTeacher'])->name('logout-teacher')->middleware('teacherkey');

// Teacher Registration
Route::post('/register-teacher',[AssessmentController::class, 'registerTeacher'])->name('register-teacher');

// Route to edit teacher
Route::get('/teacher-edit',[AssessmentController::class, 'teacherEdit'])->name('teacher-edit')->middleware('teacherkey');
Route::post('/update-teacher',[AssessmentController::class, 'teacherUpdate'])->name('update-teacher')->middleware('teacherkey');

// ******************* Teacher Access End **********************


// **************** Student Access ***************************

// Student Login/Logout
Route::post('/login-student',[AssessmentController::class, 'loginStudent'])->name('login-student');
Route::get('/student-dashboard',[AssessmentController::class, 'studentDashboard'])->middleware('studentkey');
Route::get('/logout-student', [AssessmentController::class, 'logoutStudent'])->name('logout-student')->middleware('studentkey');

// Student Registration
Route::post('/register-student',[AssessmentController::class, 'registerStudent'])->name('register-student');

// Route to edit student
Route::get('/student-edit',[AssessmentController::class, 'studentEdit'])->name('student-edit')->middleware('studentkey');
Route::post('/update-student',[AssessmentController::class, 'studentUpdate'])->name('update-student')->middleware('studentkey');

// ******************** Student Access End ******************************