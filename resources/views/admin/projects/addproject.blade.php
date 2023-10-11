@extends('admin.layouts.main')
@section('main-container')
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

<div class="page-breadcrumb bg-white p-3 mb-2">
    <div class="row">
        <div class="col-lg-12 align-self-center">
            <h5 class="font-medium text-uppercase mb-2 mt-2">Add Project</h5>
        </div>
    </div>
</div>
<div class="page-content container-fluid">
	<div class="row">
        <div class="col-md-12">

        </div>
        <div class="container-fluid p-3">
            <div class="card">

                <form method="post" action="{{url('/admin/addproject')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <h4 class="card-title">Details</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input type="text"  class="form-control" name="project_name" placeholder="Project Name">
                                    <span class="text-danger">
                                        @error('project_name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <label>Client Name</label>
                                    <input type="text" class="form-control" name="assign_to" > -->
                                    @php
                                        $teamLeads = getAllTeamLeads();
                                    @endphp
                                    <label for="assign_to">Team Lead</label>
                                        <select class="form-control" id="assign_to" name="project_assign_to">
                                            <option >Select Team Lead </option>

                                            @foreach ($teamLeads as $teamLead)
                                            <option value="{{$teamLead->id}}">{{$teamLead->user_first_name}} {{$teamLead->user_last_name}}</option>
                                            @endforeach


                                        </select>
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
