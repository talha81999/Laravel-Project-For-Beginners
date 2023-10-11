<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectModel;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = DB::table('tbl_project')
        ->whereNull('deleted_at')
        ->get();
        $data = compact('projects');
        return view('admin.projects.viewproject')->with($data);
    }

    public function showAddProjectForm()
    {
        return view('admin.projects.addproject');
    }

    public function addProject(Request $request)
    {
        // server form validation
        $request->validate(
            [
                'project_name'           =>     'required',
                'project_assign_to'      =>     'required',
            ]
        );

        // getting server values
        $project                               =       new ProjectModel();
        $project->project_name                 =       $request['project_name'];
        $project->project_assign_to            =       $request['project_assign_to'];
        $project->project_assign_by            =       session('data')['userId'];
        $project->created_at                   =       Date::now();
        $project->updated_at                   =       Date::now();

        // save user
        $project->save();
        return redirect('/admin/viewprojects')->with('success_message','Project added!');
    }

    public function showEditProjectForm($projectId)
    {
        $project = ProjectModel::find($projectId);
        if(!is_null($project))
        {
            $data = compact('project');
            return view('admin.projects.editproject')->with($data);
        }
        else{
            return redirect('/admin/viewuser');
        }
    }

    public function updateProject(Request $request, $projectId)
    {
        //get project for making changes
        $project = ProjectModel::find($projectId);

        // server form validation
        $request->validate(
            [
                'project_name'           =>     'required',
                'project_assign_to'      =>     'required',
            ]
        );

         // getting server values
         $project->project_name                 =       $request['project_name'];
         $project->project_assign_to            =       $request['project_assign_to'];
         $project->updated_at                   =       Date::now();

         // save user
         $project->save();
         return redirect('/admin/viewprojects')->with('success_message','Project updated!');
    }

    public function deleteProject($projectId)
    {
        $project = ProjectModel::find($projectId);
        if(!is_null($project))
        {
            $project->delete();
        }

        return redirect('/admin/viewprojects')->with('success_message','Project deleted!');
    }
}
