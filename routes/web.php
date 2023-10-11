<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentication\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\email\SendEmail;
use App\Http\Controllers\project\ProjectController;
use App\Http\Controllers\task\TaskController;
use App\Http\Controllers\user\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class,'showLoginForm'])->middleware('alreadyLoggedIn');
Route::get('/login', [AuthController::class,'showLoginForm'])->middleware('alreadyLoggedIn');
Route::post('login-user', [AuthController::class,'loginUser'])->name('login-user');
Route::get('/admin-dashboard', [AuthController::class, 'openAdminDashboard'])->middleware('isLoggedIn');


Route::get('/get-teamlead/{id}',[UserController::class,'getTeamLead'])->name('get-teams');
Route::get('/get-leadteam/{id}',[UserController::class,'getUsersOfTeamLead'])->name('get-leadteam');



Route::group(['prefix' => '/admin'], function(){
    Route::get('/viewuser',[UserController::class,'index']);
    Route::get('/viewtrashuser',[UserController::class,'trashUser']);
    Route::get('/adduser',[UserController::class,'showAddUserForm']);
    Route::post('/adduser',[UserController::class,'registerUser']);
    Route::get('/edituser/{id}',[UserController::class,'showEditUserForm'])->name('admin.user.edit');
    Route::post('/updateuser/{id}',[UserController::class,'updateUser']);
    Route::get('/deleteuser/{id}',[UserController::class,'deleteUser'])->name('admin.user.delete');
    Route::get('/forcedeleteuser/{id}',[UserController::class,'forceDeleteUser'])->name('admin.user.forcedelete');
    Route::get('/restoreuser/{id}',[UserController::class,'restoreUser'])->name('admin.user.restore');
    Route::get('/viewprojects',[ProjectController::class,'index']);
    Route::get('/addproject',[ProjectController::class,'showAddProjectForm']);
    Route::post('/addproject',[ProjectController::class,'addProject']);
    Route::get('/editproject/{id}',[ProjectController::class,'showEditProjectForm'])->name('admin.project.edit');
    Route::post('/updateproject/{id}',[ProjectController::class,'updateProject']);
    Route::get('/deleteproject/{id}',[ProjectController::class,'deleteProject'])->name('admin.project.delete');
    Route::get('/viewtasks',[TaskController::class,'index']);
    Route::get('/addtask',[TaskController::class,'showAddTaskForm']);
    Route::post('/addtask',[TaskController::class,'addTask']);
    Route::get('/edittask/{id}',[TaskController::class,'showEditTaskForm'])->name('admin.task.edit');
    Route::post('/updatetask/{id}',[TaskController::class,'updateTask']);
    Route::get('/taskcomments',[TaskController::class,'getAllTaskComments']);
    Route::get('/updatetaskstatus/{id}',[TaskController::class,'updateTaskStatus'])->name('admin.task.updatestatus');
    Route::get('/deletetask/{id}',[TaskController::class,'deleteTask'])->name('admin.task.delete');

});

Route::get('/user-dashboard', [AuthController::class, 'openUserDashboard'])->middleware('isLoggedIn');
Route::group(['prefix' => '/user'], function(){
    Route::get('/viewusertasks', [User::class, 'index']);
    Route::post('/addtaskcomment', [User::class, 'addTaskComments']);
    Route::get('/updatetaskstatus/{id}',[User::class,'updateTaskStatus'])->name('user.task.updatestatus');
    Route::get('/editpassword',[User::class,'showEditPasswordForm']);
    Route::post('/updatepassword',[User::class,'updatePassword']);
    Route::get('/addusercomment/{id}',[User::class,'showAddUserCommentForm'])->name('user.add.comment');
    Route::post('/addusercomment',[User::class,'addTaskComments']);
});

Route::get('/verifyemail',[AuthController::class,'showVerifyEmailForm']);
Route::post('/verifyemail',[AuthController::class,'verifyEmail']);
Route::post('/resetpassword',[AuthController::class,'resetPassword']);

Route::get('send', [SendEmail::class, 'index']);

Route::get('/logout', [AuthController::class, 'logoutUser']);

Route::get('/barchart', function(){
    return view('admin/barchart');
});
