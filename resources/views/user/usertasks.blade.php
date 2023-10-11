@extends('user.layouts.main')


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
            <h5 class="font-medium text-uppercase mb-2 mt-2 ">Manage Tasks</h5>
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
                    @if (!empty($userTasks))

                        <table class="table no-wrap table-striped user-table mb-0" id="usersTable">
                            <thead>
                                <tr>
                                    <th class="pl-4" scope="col">Task Name</th>
                                    <th scope="col">Assign By</th>
                                    <th scope="col">Team Lead</th>

                                    <th scope="col">Task Due</th>
                                    <th scope="col">Task Status</th>
                                    <th class="text-center">Mark as Complete</th>

                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($userTasks as $task)
                                <tr>
                                    <td class="pl-4">
                                        <div class="channel-icon"></div>
                                        <div class="chn-info">
                                            <span class="ch-name"></span>
                                            <p>{{$task->task_name}}</p>
                                        </div>
                                    </td>

                                    <td>{{getUserByName($task->task_assign_by)}}</td>
                                    <td>{{getUserByName($task->task_team_lead)}}</td>

                                    <td>{{get_formatted_date($task->task_due,"d-M-Y")}}</td>
                                    @if ($task->task_status == 0)
                                        @if (checkTaskCompletedStatus($task->task_completed_status) == 0)
                                            <td><span class="badge badge-success">completed</span></td>
                                        @elseif (checkTaskCompletedStatus($task->task_completed_status) == 1)
                                            <td><span class="badge badge-danger">late completed</span></td>
                                        @else
                                        @endif
                                    @elseif ($task->task_status == 1)
                                        @if (assignProgressOrPendingToTaskStatus($task->task_due) == 'progress')
                                            <td><span class="badge badge-warning">{{ assignProgressOrPendingToTaskStatus($task->task_due) }}</span></td>
                                        @elseif (assignProgressOrPendingToTaskStatus($task->task_due) == 'pending')
                                            <td><span class="badge badge-danger">{{ assignProgressOrPendingToTaskStatus($task->task_due) }}</span></td>
                                        @else
                                        @endif
                                    @elseif ($task->task_status == 2)
                                        <td><span class="badge badge-danger">{{ getFormattedStatus($task->task_status) }}</span></td>
                                    @else
                                    <td>no</td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{route('user.task.updatestatus', ['id' => $task->id ])}}"><span class="badge badge-primary">change status</i></span></a>
                                    </td>


                                    <td>
                                        <div class="btn-group-sm">
                                            <a href="{{route('user.add.comment', ['id' => $task->id ])}}"  class=" badge badge-secondary" onclick="getTaskId({{$task->id}})" >
                                                Add comments
                                            </a>


                                        </div>
                                    </td>

                                </tr>

                                @endforeach

                            </tbody>
                        </table>

                        <input type="hidden" id="taskid" >
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
<!-- [ Main Content ] end -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
          <button type="button" class="close" id="closemodall" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="modelstyle">

            <label>Add Comment</label>
            <textarea name="user_comments" required id="user_comments" ></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="closemodal" data-dismiss="modal">Close</button>
          <button type="button" id="mybutton" class="btn btn-primary" >Save changes</button>
        </div>

      </div>
    </div>
  </div>

  <div id="popup1" class="overlay">
    <div class="popup">
        <h5>User Comments</h5>
        <a class="close" href="#">&times;</a>
        <div class="content">
            {{-- {{$task->task_comment}} --}}
            <p  name="messsagebox" id="messsagebox"></p>
        </div>
    </div>
</div>
@endsection
<script src="{{url('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script>

$(document).ready(function() {
    $('#mybutton').click(addComments);
    $('#closemodall').click(clearSpan);
    $('#closemodal').click(clearSpan);


  });

</script>
<script>
    function addComments() {
        // clearSpan();

       var user_comments =  $("#user_comments").val();
       var task_id =  $("#taskid").val();
       console.log(task_id);
       if(user_comments != ''){
        $("#user_comments").val('');
        $.ajax({
            type: "POST",
            url: "{{url('/user/addtaskcomment')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "user_comment":user_comments,
                "user_id": {{session('data')['userId']}},
                "task_id": task_id,
            },
            success: function(data) {
                $('#exampleModal').modal('hide');
                if(data == 1){
                    Swal.fire(
                    'Comment added!',
                    '',
                    'success'
                    ).then(() => {
                    // Reload the page
                    location.reload();
                    });
                }
            },
            error: function(error) {
                console.error("Error: ", error);
            }
            });
       }
       else{
        // alert('comments cannot be empty');
        $("#modelstyle").append("<span class='text-danger' id='errorspan'>comments cannot be empty</span>");

       }


    }
  </script>
<script>
   function clearSpan()
    {
        var modelstyle = "";
         modelstyle += " <label>Add Comment</label> ";
         modelstyle += " <textarea name = 'user_comments' id='user_comments'></textarea> ";
        $("#modelstyle").html(modelstyle);
    }
</script>
<script>
    function getTaskId(taskid)
     {
        $("#taskid").val(taskid);
        // console.log('this '+taskid);
     }
 </script>
<script>

    function showComments(comment){
        $("#messsagebox").text(comment);
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
