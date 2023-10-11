@extends('admin.layouts.main')


@section('main-container')



<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        @if (Session::has('success_message'))
        <script>
            Swal.fire(
                '{{Session::get("success_message")}}',
                '',
                'success'
            )
        </script>
        @endif
        @if (Session::has('error_message'))
        <script>
            Swal.fire(
                '{{Session::get("error_message")}}',
                '',
                'error'
            )
        </script>
        @endif
<div class="page-breadcrumb bg-white p-3">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
            <h5 class="font-medium text-uppercase mb-2 mt-2 ">Manage Projects</h5>
        </div>
        <div class="col-lg-9 col-md-8 col-xs-12 text-right">
            <a href="{{url('/admin/addproject')}}" class="btn btn-success bg-c-blue">+ Add Project</a>
        </div>
    </div>
</div>

<div class="page-content container-fluid">
	<div class="row">
        <div id="msg">
        </div>
		<div class="container-fluid">
			<div class="form-group">
			</div>
		</div>
        <div class="container-fluid p-3">
            <div class="card">
                <div class="table-responsive p-3">

                    @if (!empty($projects->toArray()))
                        <table class="table no-wrap table-striped user-table mb-0" id="usersTable">
                            <thead>
                                <tr>
                                    <th class="pl-4" scope="col">Project Name</th>
                                    <th scope="col">Created on</th>
                                    <th scope="col">Team Lead</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($projects as $project)
                                <tr>
                                    <td class="pl-4">
                                        <div class="channel-icon"></div>
                                        <div class="chn-info">
                                            <span class="ch-name"></span>
                                            <p>{{$project->project_name}}</p>
                                        </div>
                                    </td>
                                    <td>{{get_formatted_date($project->created_at, "d-M-Y")}}</td>
                                    <td>{{getUserByName($project->project_assign_to)}}</td>
                                    <td>
                                        <div class="btn-group-sm">
                                            <a href="{{route('admin.project.edit', ['id' => $project->id ])}}" class="btn btn-info bg-c-blue">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{route('admin.project.delete', ['id' => $project->id ])}}" class="btn btn-danger" >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        @else
                        <div>
                           No Project Found
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- [ Main Content ] end -->

@endsection
<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
    $('#usersTable').DataTable({
        "paging": true, // enable pagination
        "searching": true, // enable search box
        "ordering": true, // enable sorting
        "info": true // show information about the table
    });
});
</script>
