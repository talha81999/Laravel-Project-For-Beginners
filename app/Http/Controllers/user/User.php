<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TaskModel;
use Illuminate\Support\Facades\Date;
use App\Models\tbl_UserModel;
use App\Models\Comments;

class User extends Controller
{
    public function index()
    {
        $userId = session('data')['userId'];
        $userTasks = DB::table('tbl_task')
        ->where('task_assign_to', '=' , $userId)
        ->get()->all();
        $data = compact('userTasks');
        return view('user.usertasks')->with($data);
    }

    public function addTaskComments(Request $request)
    {

        $request->validate(
            [
                'usercomment'          =>     'required',

            ]
        );
        $comment                       =       new Comments();
        $comment->task_id              =       $request['task_id'];
        $comment->comment              =       $request['usercomment'];
        $comment->save();

        return redirect('/user/addusercomment'.'/'.$request['task_id'])->with('success_message','comment added!');


    }
    public function showAddUserCommentForm($id)
    {
        $userId = session('data')['userId'];
        $userTasks = DB::table('tbl_task')
        ->where('id', '=' , $id)
        ->get()->toArray();
        $userComments = DB::table('tbl_comments')
        ->where('task_id', '=' , $userTasks[0]->id)
        ->get()->toArray();
        $data = compact('userTasks','userComments');

        return view('user.addcomment')->with($data);
    }

    public function updateTaskStatus($taskId)
    {
        $task = TaskModel::find($taskId);
        if(!is_null($task))
        {
            $task->task_status   =  0;
            $task->task_completed_at   =  Date::now();
            $task->save();
        }
        return redirect('/user/viewusertasks')->with('success_message','Task completed!');
    }
    public function showEditPasswordForm()
    {
        return view('user.editpassword');
    }
    public function updatePassword(Request $request)
    {
        $user = tbl_UserModel::find(session('data')['userId']);

        $request->validate(
            [
                'password'               =>     'required|confirmed',
                'password_confirmation'  =>     'required',
            ]
        );

         // getting server values
         $user->user_password                    =       $request['password'];

         // save changes
         $user->save();
         return redirect('/user-dashboard')->with('success_message','Password updated!');
    }
}
