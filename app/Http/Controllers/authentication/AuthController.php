<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use App\Models\tbl_UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('authentication.signin');
    }

    public function loginUser(Request $request)
    {
        $request->validate(
            [
                'email'        =>     'required|email|unique:users',
                'password'     =>     'required',
            ]
        );

        $user = tbl_UserModel::where('user_email', '=', $request->email)->first();
        if($user)
        {
           if($user->user_password)
           {
                if($user->user_password == $request->password)
                {
                    if($user->user_type == 0)
                    {
                        setSession($user);
                        return redirect('admin-dashboard');
                    }
                    elseif ($user->user_type == 1) {
                        # code...
                    }
                    elseif ($user->user_type == 2) {
                        setSession($user);
                        return redirect('user-dashboard');
                    }
                    else{
                        return  'This user does not belong to any user role!';
                    }

                }
                else{
                    return back()->with('fail', 'Password not matches!');
                }
           }
           else{
            if($user->user_temporary_password == $request->password)
                {
                    if($user->user_type == 0)
                    {
                        setSession($user);
                        return redirect('admin-dashboard');
                    }
                    elseif ($user->user_type == 1) {
                        # code...
                    }
                    elseif ($user->user_type == 2) {
                        setSession($user);
                        return redirect('user-dashboard')->with('warning','Please Update Your Password to Verify Your Account!');;
                    }
                    else{
                        return  'This user does not belong to any user role!';
                    }

                }
                else{
                    return back()->with('fail', 'Password not matches!');
                }
           }

        } else{
            return back()->with('fail', 'This email is not registered!');
        }
    }


    public function showVerifyEmailForm(){
        return view('authentication.verify-email');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate(
            [
                'email'  =>   'required|email',
            ]
        );

        $userEmail = tbl_UserModel::where('user_email', '=', $request->email)->first();
        if(!is_null($userEmail))
        {
            $data = compact('userEmail');
            return view('authentication.resetpassword')->with($data);
        }
        else{
            return redirect('/verifyemail')->with('fail','email not exist!');
        }

    }


    public function resetPassword(Request $request)
    {

        // $request->validate(
        //     [
        //         'password'               =>     'required|confirmed',
        //         'password_confirmation'  =>     'required',
        //     ]
        // );
        $user = tbl_UserModel::find($request->userId);
        if(!is_null($user))
        {
            $user->user_password   =  $request->password;
            $user->save();
        }
        return redirect('/login')->with('success','Password changed!');

    }

    public function openAdminDashboard()
    {
        return view('admin.admin-dashboard');
    }
    public function openUserDashboard()
    {
        return view('user.user-dashboard');
    }


    public function logoutUser()
    {
        session()->invalidate();
        return redirect('login');
    }
}
