<?php

namespace App\Http\Controllers\task;

use App\Http\Controllers\Controller;
use App\Models\TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = DB::table('tbl_task')
        ->get();
        // $userstask = DB::table('tbl_comments')
        // ->join('tbl_task', 'tbl_comments.task_id', '=', 'tbl_task.id')
        // ->select('tbl_comments.*', 'tbl_task.*')
        // ->get();
        $data = compact('tasks');
        return view('admin.tasks.viewtask')->with($data);
    }

    public function showAddTaskForm()
    {
        return view('admin.tasks.addtask');
    }
    public function addTask(Request $request)
    {
        // server form validation
        $request->validate(
            [
                'project_id'             =>     'required',
                'task_name'              =>     'required',
                'task_assign_to'         =>     'required',
                'task_due'               =>     'required',
                'project_task_team_lead' =>     'required',
            ]
        );

        // getting server values
        $task                           =       new TaskModel();

        $task->task_name                =       $request['task_name'];
        $task->project_id               =       $request['project_id'];
        $task->task_assign_to           =       $request['task_assign_to'];
        $task->task_assign_by           =       session('data')['userId'];
        $task->task_team_lead           =       $request['project_task_team_lead_id'];
        $task->task_due                 =       $request['task_due'];
        $task->task_status              =       1;


        // save user
        $task->save();
        return redirect('/admin/viewtasks')->with('success_message','Task assigned successfully!');
    }

    public function showEditTaskForm($taskId)
    {
        $task = TaskModel::find($taskId);
        if(!is_null($task))
        {
            $data = compact('task');
            return view('admin.tasks.edittask')->with($data);
        }
        else{
            return redirect('/admin/viewtasks');
        }
    }

    public function updateTask(Request $request, $taskId)
    {

        //get project for making changes
        $task = TaskModel::find($taskId);

        // server form validation
        $request->validate(
            [
                'project_id'             =>     'required',
                'task_name'              =>     'required',
                'task_assign_to'         =>     'required',
                'task_due'               =>     'required',
                'project_task_team_lead' =>     'required',
            ]
        );

        // getting server values
        $task->task_name                =       $request['task_name'];
        $task->project_id               =       $request['project_id'];
        $task->task_assign_to           =       $request['task_assign_to'];
        $task->task_team_lead           =       $request['project_task_team_lead_id'];
        $task->task_due                 =       $request['task_due'];
        $task->task_status              =       convertStatusIntoIntegerValue($request['task_status']);


        // save task
        $task->save();
        return redirect('/admin/viewtasks')->with('success_message','Task updated!');
    }

    public function updateTaskStatus($taskId)
    {
        $task = TaskModel::find($taskId);
        if(!is_null($task))
        {
            $task->task_status   =  0;
            $task->task_completed_at   =  Date::now();
            if(Date::now() > $task->task_due  )
            {
                $task->task_completed_status = "late complete";
            }
            elseif (Date::now() <= $task->task_due) {
                $task->task_completed_status = "on time";
            }

            $task->save();
        }
        return redirect('/admin/viewtasks')->with('success_message','Task completed!');
    }

    public function getAllTaskComments(Request $request)
    {
        $userComments = DB::table('tbl_comments')
        ->where('task_id', '=' , $request->task_id)
        ->get()->toArray();
        // return echo json_encode($userComments);
        return response()->json($userComments);
    }

    public function deleteTask($taskId)
    {
        $task = TaskModel::find($taskId);
        if(!is_null($task))
        {
            $task->delete();
        }
        return redirect('/admin/viewtasks')->with('success_message', 'Task deleted!');
    }
}
