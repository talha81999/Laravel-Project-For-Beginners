<?php
use App\Http\Controllers\email\SendEmail;
use App\Models\tbl_UserModel;
use Illuminate\Support\Facades\DB;
use App\Models\TeamsModel;
use Illuminate\Support\Facades\Date;


// get date format
if(!function_exists('get_formatted_date'))
{
    function get_formatted_date($date, $formate)
    {
        if($date)
        {
            $formattedData = date($formate, strtotime($date));
            return $formattedData;
        }
        else{
            return "--";
        }

    }
}

// get team name
if(!function_exists('getTeamName'))
{
    function getTeamName($team_id)
    {
        $users = DB::table('tbl_teams')
        ->select('team_name')
        ->where('id', '=', $team_id)
        ->get()
        ->all();
        return $users[0]->team_name;
    }
}

// get all users except admin
if(!function_exists('getTotalUsersExceptAdmin'))
{
    function getTotalUsersExceptAdmin()
    {
        $users = DB::table('tbl_user')
                    ->where('user_type', '!=', '0')
                    ->get();

        return $users->count();
    }
}

// send email
if(!function_exists('sendMail')){
    function sendEmail($recipient, array $data)
    {
        $controller = app(SendEmail::class);
        return $controller->index($recipient,$data);
    }
}

// set session
if(!function_exists('setSession'))
{
    function setSession($userData)
    {
        // Start the session
        session()->start();

        // store data in an array
        $data = [
            'userId'            =>      $userData->id,
            'userName'          =>      $userData->user_name,
            'userEmail'         =>      $userData->user_email,
            'userPhone'         =>      $userData->user_phone,
            'userGender'        =>      $userData->user_gender,
            'userAddress'       =>      $userData->user_address,
            'userDob'           =>      $userData->user_dob,
            'userType'          =>      $userData->user_type,
            'userRole'          =>      $userData->user_role,
            'userTeam'          =>      $userData->user_team,
            'userStatus'        =>      $userData->user_status,
            'userTeamLead'      =>      $userData->user_team_lead,
            'userJoiningDate'   =>      $userData->user_joining_date,
            'userCreatedBy'     =>      $userData->user_created_by,
            'userUpdatedBy'     =>      $userData->user_updated_by,
            'userCreatedAt'     =>      $userData->user_created_at,
            'userUpdatedAt'     =>      $userData->user_updated_at,
        ];

        // Store an array in the session
        session(['data' => $data]);

    }
}

// get all teams
if(!function_exists('getAllTeams'))
{
    function getAllTeams()
    {
        $user = TeamsModel::all();
        return $user->toArray();
    }
}

// get all team leads
if(!function_exists('getAllTeamLeads'))
{
    function getAllTeamLeads()
    {
        $teamLeads = DB::table('tbl_user')
        ->where('user_type', '=' , '1')
        ->get();
        return $teamLeads->toArray();
    }
}

// get user by name
if(!function_exists('getUserByName'))
{
    function getUserByName($userId)
    {
        $user = DB::table('tbl_user')
        ->where('id', '=' , $userId)
        ->get()->all();
        return $user[0]->user_first_name.' '.$user[0]->user_last_name;
    }
}

// get user by team
if(!function_exists('getTeamLeadIdByUserTeam'))
{
    function getTeamLeadIdByUserTeam($userTeam)
    {
        $teamLeadId = DB::table('tbl_user')
        ->where('user_team', '=' , $userTeam)
        ->get()->all();
        return $teamLeadId[0]->id;
        // return 0;
    }
}

// get all projects
if(!function_exists('getAllProjects'))
{
    function getAllProjects()
    {
        $projects = DB::table('tbl_project')
        ->get();
        return $projects->toArray();
    }
}
// get all projects for count
if(!function_exists('getProjectsCount'))
{
    function getProjectsCount()
    {
        $projects = DB::table('tbl_project')
        ->get();
        return $projects->count();
    }
}
// get all tasks for count
if(!function_exists('getTasksCount'))
{
    function getTasksCount()
    {
        $tasks = DB::table('tbl_task')
        ->get();
        return $tasks->count();
    }
}

// get teamLeadIdFromTableProject
if(!function_exists('teamLeadIdFromTableProject'))
{
    function teamLeadIdFromTableProject($project_id)
    {
        $teamLeadId = DB::table('tbl_project')
        ->where('id', '=' , $project_id)
        ->get()->all();

        $teamLead['id']   = $teamLeadId[0]->project_assign_to;
        $teamLead['name'] = getUserByName($teamLeadId[0]->project_assign_to);
        return $teamLead;
    }
}

// get all team users of Team Lead
if(!function_exists('getAllUsersOfTeamLead'))
{
    function getAllUsersOfTeamLead($lead_id)
    {
        $users = DB::table('tbl_user')
        ->where('user_team_lead', '=' , $lead_id)
        ->get()->all();
        return $users;
    }
}

// get status format
if(!function_exists('getFormattedStatus'))
{
    function getFormattedStatus($status)
    {
        if($status == 0)
        {
            $status = "completed";
            return $status;
        }
        elseif ($status == 1) {
            $status = "progress";
            return $status;
        }
        elseif ($status == 2) {
            $status = "pending";
            return $status;
        }
        else{
            $status = "error occured!";
        return $status;        }
    }
}

// convert status into integer value
if(!function_exists('convertStatusIntoIntegerValue'))
{
    function convertStatusIntoIntegerValue($status)
    {
        if($status == "completed")
        {
            $status = 0;
            return $status;
        }
        elseif ($status == "progress") {
            $status = 1;
            return $status;
        }
        elseif ($status == "pending") {
            $status = 2;
            return $status;
        }
        else{}
    }
}

// get all projects of One user
if(!function_exists('getAllProjectsOfOneUser'))
{
    function getAllProjectsOfOneUser($task_assign_to_id)
    {
        $task_assign_to = DB::table('tbl_task')
        ->where('task_assign_to', '=' , $task_assign_to_id)
        ->get()->all();
        // return $task_assign_to;
        $projects = array();
        // echo "<pre>";
        // print_r(($task_assign_to));
        for($i = 0; $i<count($task_assign_to); $i++)
        {
            $project = DB::table('tbl_project')
            ->where('id', '=' , $task_assign_to[$i]->project_id)
            ->get()->all();
            if($project){
                $projects[$i] = $project[0]->id;
            }

        }
        $noOfProjects = array_unique($projects);
        return count($noOfProjects);
    }
}


// get all tasks of One user
if(!function_exists('getAllTasksOfOneUser'))
{
    function getAllTasksOfOneUser($task_assign_to_id)
    {
        $noOfTasks = DB::table('tbl_task')
        ->where('task_assign_to', '=' , $task_assign_to_id)
        ->get()->all();
        // return $task_assign_to;


        return count($noOfTasks);
    }
}

// check task completed status
if(!function_exists('checkTaskCompletedStatus'))
{
    function checkTaskCompletedStatus($task_completed_status)
    {
        if($task_completed_status == "on time")
        {
            $status = 0;
            return $status;
        }
        elseif ($task_completed_status == "late complete") {
            $status = 1;
            return $status;
        }

        else{}
    }
}

// assign progress or pending to task status
if(!function_exists('assignProgressOrPendingToTaskStatus'))
{
    function assignProgressOrPendingToTaskStatus($task_due)
    {
        if($task_due <= Date::now())
        {
            $status = "pending";
            return $status;
        }
        elseif ($task_due >= Date::now()) {
            $status = "progress";
            return $status;
        }

        else{}
    }
}

// get project name
if(!function_exists('getProjectByName'))
{
    function getProjectByName($project_id)
    {
        $projectName = DB::table('tbl_project')
        ->where('id', '=' , $project_id)
        ->get();
        return $projectName[0]->project_name;
    }
}


// convert gender bit into proper name
if(!function_exists('convertGenderBitToProperName'))
{
    function convertGenderBitToProperName($genderBit)
    {
        if($genderBit == "M")
        {
            return "Male";
        }
        elseif ($genderBit == "F") {
            return "Female";
        }
        elseif ($genderBit == "O") {
            return "Other";
        }
        else{}
    }
}

// get teamLeads projects
if(!function_exists('getTeamLeadProjects'))
{
    function getTeamLeadProjects()
    {

        $users = tbl_UserModel::leftJoin('tbl_project', 'tbl_user.id', '=', 'tbl_project.project_assign_to')
            ->select('tbl_user.*', 'tbl_project.project_name as project_name')
            ->where('tbl_user.user_type', '=', '1')
            ->get();
           return $users->toArray();
    }
}


// get employee tasks
if(!function_exists('getEmployeeTasks'))
{
    function getEmployeeTasks()
    {
        $users = tbl_UserModel::leftJoin('tbl_task', 'tbl_user.id', '=', 'tbl_task.task_assign_to')
            ->select('tbl_user.*', 'tbl_task.task_name as task_name')
            ->where('tbl_user.user_type', '=', '2')
            ->get();
        $getCountProjects = array();
        $employeeId = getEmployeeId();
        for ($i=0; $i < count($employeeId); $i++) {
            $count = 0;
            for ($j=0; $j < count($users); $j++) {
                if($users[$j]['id'] == $employeeId[$i]->id   ){
                    if (!empty($users[$j]['task_name'])) {
                        $count++;
                        $getCountProjects[$users[$j]['user_first_name']] = $count;
                    }
                    else{
                        $getCountProjects[$users[$j]['user_first_name']] = 0;
                    }

                }
            }
        }
            return $getCountProjects;
        }
    }

// get employee id
if(!function_exists('getEmployeeId'))
{
    function getEmployeeId()
    {
        $userid = DB::table('tbl_user')->select('id')
        ->where('user_type', '=', '2')
        ->get();
        return $userid;
    }
}


?>
