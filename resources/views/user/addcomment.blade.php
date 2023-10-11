@extends('user.layouts.main')
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
            <div class="page-breadcrumb bg-white p-3 mb-2">
                <div class="row">
                    <div class="col-lg-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-2 mt-2">Comments</h5>
                    </div>
                </div>
            </div>
            <div class="page-content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    </div>
                    <div class="container-fluid p-3">
                        <div class="card">
                            <form method="post" action="{{ url('/user/addusercomment') }}" enctype="multipart/form-data">
                                <input type="hidden" name="task_id" id="task_id" value="{{ $userTasks[0]->id }}">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Details</h4>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                @php
                                                    // print_r($userTasks);
                                                @endphp
                                                <label for="assign_to"><b>Project name: </b></label><br>
                                                <label
                                                    for="">{{ getProjectByName($userTasks[0]->project_id) }}</label>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for=""><b>Task name: </b></label><br>
                                                <label for="">{{ $userTasks[0]->task_name }}</label>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for=""><b>Task Status: </b></label><br>
                                                <label for="">{{ getFormattedStatus($userTasks[0]->task_status) }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for=""><b>Task Completed At: </b></label><br>
                                                <label for="">{{ $userTasks[0]->task_completed_at }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Add Comment</label><br>
                                        <textarea class="w-100" name="usercomment" id="usercomment" cols="10" rows="5"></textarea>


                                    </div>
                                    <div class="form-group text-left mt-2">
                                        <button class="btn btn-success bg-c-blue">
                                            <i class="fa fa-save"></i> Add Comment
                                        </button>
                                    </div>
                                </div>


                        </div>
                        </form>
                    </div>


                </div>
            </div>


            <div class="row">
                <div class="container-fluid p-3">
                    <div class="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        @foreach ( $userComments as $comments)
                                <div class="comment-content d-flex justify-content-between">
                                <label for=""><b>comment:</b><span>{{ $comments->comment }}</span></label>
                                <br>
                                <label for=""><b>time:</b> <span>{{ $comments->created_at }}</span></label><br>
                                </div>
                                @endforeach
                                    </div>
                                    <div class="col-md-6"></div>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>


            </div>
        </div>

    </div>
    </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
