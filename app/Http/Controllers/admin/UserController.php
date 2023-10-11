<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\tbl_UserModel;
use App\Models\TeamsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //show users to admin
    public function index()
    {
        $users = DB::table('tbl_user')
        ->where('user_type', '!=', '0')
        ->whereNull('deleted_at')
        ->get();

        $data = compact('users');
        return view('admin.viewuser')->with($data);
    }

    // show trash users
    public function trashUser()
    {
        $trashedUsers = tbl_UserModel::onlyTrashed()->get();
        $data = compact('trashedUsers');
        return view('admin.usertrash')->with($data);
    }
    // show add user form to admin
    public function showAddUserForm()
    {
        $url = url('/admin/adduser');
        $title = "Add User";
        $data = compact('url','title');
        return view('admin.adduser')->with($data);
    }

    // register new user by admin
    public function registerUser(Request $request)
    {
        // server form validation
        $request->validate(
            [
                'user_first_name'        =>     'required',
                'user_last_name'         =>     'required',
                'user_email'             =>     'required|email|unique:tbl_user,user_email',
                'user_phone'             =>     'required',
                'user_gender'            =>     'required',
                'user_address'           =>     'required',
                'user_dob'               =>     'required',
                'user_type'              =>     'required',
                'user_team'              =>     'required',
                'user_joining_date'      =>     'required',
                'user_image'             =>     'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]
        );

        // generate username
        $randomNumber = random_int(1, 9999);
        $userName = 'user'.$randomNumber;

        if($request['user_type'] == '0')
        {
            $userRole = "Admin";
        }
        else if($request['user_type'] == '1')
        {
            $userRole = "Team Lead";
        }
        elseif ($request['user_type'] == '2') {
            $userRole = "Developer";
        }
        else {
            # code...
        }

        // getting server values
        $user                               =       new tbl_UserModel();
        $user->user_name                    =       $userName;
        $user->user_first_name              =       $request['user_first_name'];
        $user->user_last_name               =       $request['user_last_name'];
        $user->user_email                   =       $request['user_email'];
        $user->user_phone                   =       $request['user_phone'];
        $user->user_gender                  =       $request['user_gender'];
        $user->user_dob                     =       $request['user_dob'];
        $user->user_address                 =       $request['user_address'];
        $user->user_last_login              =       Date::now();
        $user->user_type                    =       $request['user_type'];
        $user->user_role                    =       $userRole;
        $user->user_team                    =       $request['user_team'];
        if($request['user_type'] == '2')
        {
            $user->user_team_lead           =       getTeamLeadIdByUserTeam($request['user_team']);
        }
        $user->user_joining_date            =       $request['user_joining_date'];
        $user->user_created_by              =       session('data')['userId'];
        $user->user_updated_by              =       session('data')['userId'];
        $user->created_at                   =       Date::now();
        $user->updated_at                   =       Date::now();

        // get user profile image
        if(!empty($request->file('user_image')) ){

            $fileName = time()."la.".$request->file('user_image')->getClientOriginalExtension();
            $request->file('user_image')->storeAs('public/images',$fileName);
            $user->user_profile_image  = $fileName;

        }
        else{
            $user->user_profile_image   =   "profile.png";
        }

        // send email to user
        sendEmail($user->user_email, [
            'name'      =>  'user registered',
            'message'   =>  'your account has been created!',
            'password'  =>  '1234',
        ]);

        // save user
        $user->save();

        // update tbl_teams
        if($user->id)
        {
            $teamLeadId = DB::table('tbl_teams')
              ->where('id', $request['user_team'])
              ->update(['teamlead_id' => $user->id]);
        }
        else{}
        return redirect('/admin/viewuser')->with('success_message','User added!');
    }

    public function showEditUserForm($id)
    {
        $user = tbl_UserModel::find($id);
        if(!is_null($user))
        {
            $url = url('/admin/updateuser').'/'.$id;
            $title = "Edit User";
            $data = compact('user','url','title');
            return view('admin.adduser')->with($data);
        }
        else{
            return redirect('/admin/viewuser');
        }
    }
    public function updateUser(Request $request, $id)
    {
        $user = tbl_UserModel::find($id);

        // server form validation
        $request->validate(
            [
                'user_first_name'           =>     'required',
                'user_last_name'            =>     'required',
                // 'user_email'                =>     'required|email',
                'user_email'                =>     'required|email|unique:tbl_user,user_email,'.$id.',id',
                'user_phone'                =>     'required',
                'user_gender'               =>     'required',
                'user_address'              =>     'required',
                'user_dob'                  =>     'required',
                'user_type'                 =>     'required',
                'user_team'                 =>     'required',
                'user_joining_date'         =>     'required',
                'user_image'                =>     'required|image',

            ]
        );

        if($request['user_type'] == '0')
        {
            $userRole = "Admin";
        }
        else if($request['user_type'] == '1')
        {
            $userRole = "Team Lead";
        }
        elseif ($request['user_type'] == '2') {
            $userRole = "Developer";
        }
        else {
            # code...
        }

        // getting server values
        $user->user_name                    =       $request['user_name'];;
        $user->user_first_name              =       $request['user_first_name'];
        $user->user_last_name               =       $request['user_last_name'];
        $user->user_email                   =       $request['user_email'];
        $user->user_phone                   =       $request['user_phone'];
        $user->user_gender                  =       $request['user_gender'];
        $user->user_dob                     =       $request['user_dob'];
        $user->user_address                 =       $request['user_address'];
        $user->user_type                    =       $request['user_type'];
        $user->user_role                    =       $userRole;
        $user->user_team                    =       $request['user_team'];
        if($request['user_type'] == '2')
        {
            $user->user_team_lead           =       getTeamLeadIdByUserTeam($request['user_team']);
        }
        $user->user_joining_date            =       $request['user_joining_date'];
        $user->user_created_by              =       session('data')['userId'];
        $user->user_updated_by              =       session('data')['userId'];
        $user->updated_at                   =       Date::now();

        if(!empty($request->file('user_image')) ){

            $fileName = time()."la.".$request->file('user_image')->getClientOriginalExtension();
            $request->file('user_image')->storeAs('public/images',$fileName);
            $user->user_profile_image  = $fileName;

        }
        else{
            $user->user_profile_image   =   "profile.png";
        }

        // save updated changes to user
        $user->save();

        // update tbl_teams
        $teamLeadId = DB::table('tbl_teams')
        ->where('id', $request['user_team'])
        ->update(['teamlead_id' => $id]);
        return redirect('/admin/viewuser')->with('success_message','User updated!');
    }


    public function deleteUser($id)
    {
        $user = tbl_UserModel::find($id);
        if(!is_null($user))
        {
            $user->delete();
        }

        return redirect('/admin/viewuser')->with('success_message','User moved to trash!');
    }
    public function restoreUser($id)
    {
        $user = tbl_UserModel::withTrashed()->find($id);
        if(!is_null($user))
        {
            $user->restore();
        }

        return redirect('/admin/viewuser')->with('success_message','User restored!');
    }
    public function forceDeleteUser($id)
    {
        $user = tbl_UserModel::withTrashed()->find($id);
        if(!is_null($user))
        {
            $user->forceDelete();
        }

        return redirect('/admin/viewuser')->with('success_message','User deleted!');
    }

    public function getTeamLead($project_id)
    {
       $teamLead =  teamLeadIdFromTableProject($project_id);
        return response()->json($teamLead);
    }
    public function getUsersOfTeamLead($lead_id)
    {
        $users = getAllUsersOfTeamLead($lead_id);
        return response()->json($users);
    }


    public function getUsers()
    {
        $users = DB::table('tbl_user')
        ->where('user_type', '!=', '0')
        ->whereNull('deleted_at')
        ->get();

        print_r($users->all());

    }

}


