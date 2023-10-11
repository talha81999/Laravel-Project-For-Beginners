@extends('admin.layouts.main')


@section('main-container')



    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">

            @if (Session::has('success_message'))
                <script>
                    Swal.fire(
                        '{{ Session::get('success_message') }}',
                        '',
                        'success'
                    )
                </script>
            @endif
            @if (Session::has('error_message'))
                <script>
                    Swal.fire(
                        '{{ Session::get('error_message') }}',
                        '',
                        'error'
                    )
                </script>
            @endif

            <div class="page-breadcrumb bg-white p-3">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-2 mt-2 ">Manage Tasks</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 text-right">
                        <a href="{{ url('/admin/addtask') }}" class="btn btn-success bg-c-blue">+ Add Task</a>
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
                                @if (!empty($tasks->toArray()))
                                    <table class="table no-wrap table-striped user-table mb-0" id="usersTable">
                                        <thead>
                                            <tr>
                                                <th class="pl-4" scope="col">Task Name</th>
                                                <th scope="col">Assign To</th>
                                                <th scope="col">Assign By</th>
                                                <th scope="col">Team Lead</th>

                                                <th scope="col">Task Due</th>
                                                <th scope="col">Task Status</th>
                                                <th scope="col">Completed At</th>
                                                <th class="text-center">Mark as Complete</th>
                                                <th class="text-center">user comments</th>

                                                <th scope="col">Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($tasks as $task)
                                                <tr>
                                                    <td class="pl-4">
                                                        <div class="channel-icon"></div>
                                                        <div class="chn-info">
                                                            <span class="ch-name"></span>
                                                            <p>{{ $task->task_name }}</p>
                                                        </div>
                                                    </td>
                                                    <td>{{ getUserByName($task->task_assign_to) }}</td>
                                                    <td>{{ getUserByName($task->task_assign_by) }}</td>
                                                    <td>{{ getUserByName($task->task_team_lead) }}</td>

                                                    <td>{{ get_formatted_date($task->task_due, 'd-M-Y') }}</td>

                                                    @if ($task->task_status == 0)
                                                        @if (checkTaskCompletedStatus($task->task_completed_status) == 0)
                                                            <td><span class="badge badge-success">completed</span></td>
                                                        @elseif (checkTaskCompletedStatus($task->task_completed_status) == 1)
                                                            <td><span class="badge badge-danger">late completed</span></td>
                                                        @else
                                                        @endif
                                                    @elseif ($task->task_status == 1)
                                                        @if (assignProgressOrPendingToTaskStatus($task->task_due) == 'progress')
                                                            <td><span
                                                                    class="badge badge-warning">{{ assignProgressOrPendingToTaskStatus($task->task_due) }}</span>
                                                            </td>
                                                        @elseif (assignProgressOrPendingToTaskStatus($task->task_due) == 'pending')
                                                            <td><span
                                                                    class="badge badge-danger">{{ assignProgressOrPendingToTaskStatus($task->task_due) }}</span>
                                                            </td>
                                                        @else
                                                        @endif
                                                    @elseif ($task->task_status == 2)
                                                        <td><span
                                                                class="badge badge-danger">{{ getFormattedStatus($task->task_status) }}</span>
                                                        </td>
                                                    @else
                                                        <td>no</td>
                                                    @endif

                                                    {{-- {{ getFormattedStatus($task->task_status) }} --}}
                                                    <td>{{ get_formatted_date($task->task_completed_at, 'd-M-Y') }}</td>
                                                    <td class="text-center">
                                                        <a
                                                            href="{{ route('admin.task.updatestatus', ['id' => $task->id]) }}"><span
                                                                class="badge badge-primary">mark complete</i></span></a>
                                                    </td>

                                                    <td class="text-center"><a href="#popup1"  onclick="getAllComments({{$task->id}})"><i class="fa fa-eye text-primary"></a></td>

                                                    <td>
                                                        <div class="btn-group-sm">
                                                            <a href="{{ route('admin.task.edit', ['id' => $task->id]) }}"
                                                                class="btn btn-info bg-c-blue">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('admin.task.delete', ['id' => $task->id]) }}"
                                                                class="btn btn-danger">
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
                                        No Task Found
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="popup1" class="overlay">
        <div class="popup">
            <h5>User Comments</h5>
            <a class="close" href="#">&times;</a>
            <div class="content" id="comment-content">
                {{-- {{$task->task_comment}} --}}
                <p  name="messsagebox" id="messsagebox"></p>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

@endsection
<script src="{{url('assets/libs/jquery/dist/jquery.min.js')}}"></script>


<script>

    $(document).ready(function() {
        $('#getAllComments').click(getAllComments);
    });

    function getAllComments(id)
    {
        var date = "";
        if(id != ''){
        $.ajax({
            type: "GET",
            url: "{{url('/admin/taskcomments')}}",
            data: {
                "task_id": id,
            },
            success: function(data) {
                var comment_content = "";
                if(data.length != 0)
                {
                for(var i = 0; i < data.length; i++)
                {
                    comment_content += "<div class = 'comment-content-box'>";
                    console.log(data[i].comment);
                    comment_content += "<p>"+data[i].comment+"</p>";
                    let parts = data[i].created_at.split(" ");
                    let partDate = parts[0].split("-");
                    comment_content += "<p>"+partDate[2] +'-'+ partDate[1] +'-'+ partDate[0]+"</p>";
                    comment_content += "</div>";

                }
                $("#comment-content").html(comment_content);
            }
            else{
                $("#comment-content").html('no comments found');
            }
            },
            error: function(error) {
                console.error("Error: ", error);
            }
            });
       }
    }


</script>
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
