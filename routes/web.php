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

Route::get('/', [AssessmentController::class, 'usertype']);
Route::get('/admin', [AssessmentController::class, 'admin']);
Route::get('/adminregister', [AssessmentController::class, 'adminRegister']);

Route::get('/teacherlogin', [AssessmentController::class, 'teacherlogin']);
Route::get('/teacherregister', [AssessmentController::class, 'teacherregister']);
Route::get('/studentlogin', [AssessmentController::class, 'studentlogin']);
Route::get('/studentregister', [AssessmentController::class, 'studentregister']);

Route::post('/login-admin',[AssessmentController::class, 'loginAdmin'])->name('login-admin');
Route::post('/register-admin',[AssessmentController::class, 'registerAdmin'])->name('register-admin');
Route::get('/admin-dashboard/{id}',[AssessmentController::class, 'adminDashboard']);

Route::post('/register-student',[AssessmentController::class, 'registerStudent'])->name('register-student');
Route::post('/login-student',[AssessmentController::class, 'loginStudent'])->name('login-student');
Route::get('/student-dashboard/{id}',[AssessmentController::class, 'studentDashboard']);

Route::post('/register-teacher',[AssessmentController::class, 'registerTeacher'])->name('register-teacher');
Route::post('/login-teacher',[AssessmentController::class, 'loginTeacher'])->name('login-teacher');
Route::get('/teacher-dashboard/{id}',[AssessmentController::class, 'teacherDashboard']);


//Admin Home Dashboard Buttons
Route::get('/studentapproval/{id}',[AssessmentController::class, 'studentapproval'])->name('studentapproval');
Route::get('/teacherapproval/{id}',[AssessmentController::class, 'teacherapproval'])->name('teacherapproval');

Route::get('/teacherlist/{id}',[AssessmentController::class, 'teacherlist'])->name('teacherlist');
Route::get('/studentlist/{id}',[AssessmentController::class, 'studentlist'])->name('studentlist');


//Route to view
Route::get('/view-student/{id}/{s_id}', [AssessmentController::class, 'viewStudent'])->name('view-student');
Route::get('/view-teacher/{id}/{t_id}', [AssessmentController::class, 'viewTeacher'])->name('view-teacher');

// Route to approve
Route::post('/approve-student/{id}/{a_id}', [AssessmentController::class, 'approveStudent'])->name('approve-student');
Route::post('/approve-teacher/{id}/{a_id}', [AssessmentController::class, 'approveTeacher'])->name('approve-teacher');

// Route to reject
Route::post('/reject-student/{id}/{a_id}', [AssessmentController::class, 'rejectStudent'])->name('reject-student');
Route::post('/reject-teacher/{id}/{a_id}', [AssessmentController::class, 'rejectTeacher'])->name('reject-teacher');

// Route to edit student
Route::get('/student-edit/{id}',[AssessmentController::class, 'studentEdit'])->name('student-edit');
Route::post('/update-student/{id}',[AssessmentController::class, 'studentUpdate'])->name('update-student');

// Route to edit teacher
Route::get('/teacher-edit/{id}',[AssessmentController::class, 'teacherEdit'])->name('teacher-edit');
Route::post('/update-teacher/{id}',[AssessmentController::class, 'teacherUpdate'])->name('update-teacher');