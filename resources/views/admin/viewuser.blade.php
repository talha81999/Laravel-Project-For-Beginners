@extends('admin.layouts.main')


@section('main-container')
    <!-- [ Main Content ] start -->
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
                    '{{Session::get("success_message")}}',
                    '',
                    'error'
                )
            </script>
    @endif


    <div class="pcoded-main-container">
        <div class="pcoded-content">

            <!-- [ Main Content ] start -->

            <div class="page-breadcrumb bg-white p-3">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-2 mt-2">Manage Users</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 text-right">
                        <a href="{{ url('/admin/adduser') }}" class="btn btn-success bg-c-blue">+ Add User</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div id="msg">
                </div>
                <div class="container-fluid p-3">
                    <div class="text-right ">
                        <a href="{{url('/admin/viewtrashuser')}}" class=" btn btn-danger ">go to trashed users</a>
                    </div>
                    <div class="card">

                        <div class="table-responsive p-3">
                            @if (!empty($users->toArray()))
                                <table class="table no-wrap table-striped user-table mb-0" id="usersTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col" class="pl-4">Full Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Date-of-Birth</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Team</th>
                                            <th scope="col">Joining date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        @foreach ($users as $user)
                                            <tr>

                                                <td class="pl-4">
                                                    <div class="user-img">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <span class="user-name">{{ $user->user_name }}</span>
                                                </td>
                                                <td>{{ $user->user_first_name }} {{ $user->user_last_name }}</td>
                                                <td>{{ $user->user_phone }}</td>
                                                <td>{{ $user->user_email }}</td>
                                                <td>{{ convertGenderBitToProperName($user->user_gender) }}</td>
                                                <td>{{ $user->user_address }}</td>
                                                <td>{{ get_formatted_date($user->user_dob, 'd-M-Y') }}</td>
                                                <td>
                                                    @if ($user->user_type == '0')
                                                        Admin
                                                    @elseif ($user->user_type == '1')
                                                        Team Lead
                                                    @elseif ($user->user_type == '2')
                                                        {{ $user->user_role }}
                                                    @endif

                                                <td>{{ getTeamName($user->user_team) }}</td>
                                                <td>{{ get_formatted_date($user->user_joining_date, 'd-M-Y') }}</td>
                                                <td>
                                                    <div class="btn-group-sm">
                                                        <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}"
                                                            class="btn btn-info bg-c-blue">
                                                            <i class="fa fa-edit"></i></a>
                                                        <a href="{{ route('admin.user.delete', ['id' => $user->id]) }}"
                                                            class="btn btn-danger" alt = "add to trash">
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
                                    No User Found
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
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
