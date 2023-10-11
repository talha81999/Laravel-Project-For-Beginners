@extends('admin.layouts.main')
@section('main-container')
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

<div class="page-breadcrumb bg-white p-3 mb-2">
    <div class="row">
        <div class="col-lg-12 align-self-center">
            <h5 class="font-medium text-uppercase mb-2 mt-2">Edit Task</h5>
        </div>
    </div>
</div>
<div class="page-content container-fluid">
	<div class="row">
        <div class="col-md-12">

        </div>
        <div class="container-fluid p-3">
            <div class="card">
                <form method="post" action="{{url('/admin/updatetask/'.$task->id)}}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <h4 class="card-title">Details</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    @php
                                        $projects = getAllProjects();
                                    @endphp
                                    <label for="assign_to">Select Project</label>
                                        <select class="form-control" id="project_id" name="project_id" onchange="setValueToTeamLeadInputField(this.value)">
                                            <option >Select Project </option>
                                            @foreach ($projects as $project)
                                            @if ($project->id == $task->project_id)
                                            <option selected value="{{$project->id}}">{{$project->project_name}}</option>
                                            @else
                                            <option value="{{$project->id}}">{{$project->project_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('project_id')
                                            {{$message}}
                                            @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="assign_to">Team Lead</label>
                                    <input type="text"  class="form-control" name="project_task_team_lead" placeholder="Enter team lead" id="project_task_team_lead" value="{{getUserByName($task->task_team_lead)}}">
                                    <input type="hidden"  class="form-control" name="project_task_team_lead_id" id="project_task_team_lead_id" value="{{$task->task_team_lead}}">
                                    <span class="text-danger">
                                        @error('project_task_team_lead')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Task Name</label>
                                    <input type="text"  class="form-control" name="task_name" placeholder="Enter task name" value="{{$task->task_name}}">
                                    <span class="text-danger">
                                        @error('task_name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                            <div class="col-md-3">
                            @php
                                $allUsersOfLeads = getAllUsersOfTeamLead($task->task_team_lead);
                            @endphp
                                <div class="form-group">
                                    <label>Assign to</label>
                                    <select class="form-control" id="task_assign_to" name="task_assign_to">
                                        <option >Select user </option>
                                        @foreach ($allUsersOfLeads as $leadUsers)
                                        @if ($leadUsers->id == $task->task_assign_to)
                                        <option selected value="{{$leadUsers->id}}" >{{getUserByName($task->task_assign_to)}} </option>
                                        @else
                                        <option  value="{{$leadUsers->id}}" >{{getUserByName($leadUsers->id)}} </option>
                                        @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">

                                    <label>Task Due</label>
                                    <input type="date"  class="form-control" name="task_due" placeholder="Enter task due" value="{{$task->task_due}}">
                                    <span class="text-danger">
                                        @error('task_due')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Task Status</label>
                                    <input type="text"  class="form-control" name="task_status"  value="{{getFormattedStatus($task->task_status)}}">
                                    <span class="text-danger">
                                        @error('task_status')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group text-left mt-2">
                            <button class="btn btn-success bg-c-blue">
                                <i class="fa fa-save"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- [ Main Content ] end -->

@endsection
<script src="{{url('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script>

function setValueToTeamLeadInputField(id)
{
    $.ajax({
        type: "GET",
        url: "{{url('/get-teamlead')}}"+"/"+id,
        success: function(data) {
            $("#project_task_team_lead").val(data.name);
            $("#project_task_team_lead_id").val(data.id);
            getAllUsersOfTeamLead();
        },
        error: function(error) {
            console.error("Error while getting information: ", error);
        }
        });

}

function getAllUsersOfTeamLead()
{
    var teamLeadId = $("#project_task_team_lead_id").val();
    $.ajax({
        type: "GET",
        url: "{{url('/get-leadteam')}}"+"/"+teamLeadId,
        success: function(users) {
           console.log(users.length );
           if (users.length === 0)
           {
                var content = "";
                content = "<option>no user found for the selected project</option>";
                $("#task_assign_to").html(content);
           }
           else{
            var content = "";
            content += "<option>Select user</option>";
            for(var i = 0; i < users.length; i++)
            {
                console.log(i );

                content += "<option value = "+ users[i].id +">"+ users[i].user_first_name +"</option>";
            }
            $("#task_assign_to").html(content);
           }
        },
        error: function(error) {
            console.error("Error while getting information: ", error);
        }
        });
}

</script>
