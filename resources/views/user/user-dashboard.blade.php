@extends('user.layouts.main')


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
            '{{Session::get("error_message")}}',
            '',
            'error'
        )
    </script>
    @endif
    <div class="pcoded-main-container">
        <div class="pcoded-content">


            <!-- [ breadcrumb ] start -->
            <!-- <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard Analytics</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('warning'))
                <div class="alert alert-warning">{{ Session::get('warning') }}</div>
            @endif
            <div class="row">

                <div class="col-md-6 col-xl-6">
                    <div class="card bg-c-blue order-card">
                        <div class="card-body">
                            <h5 class="text-white">Total Projects</h5>
                            <h2 class="text-right text-white"><i class="feather icon-sidebar float-left"></i><span>{{getAllProjectsOfOneUser(session('data')['userId'])}}</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6">
                    <div class="card bg-c-green order-card">
                        <div class="card-body">
                            <h5 class="text-white">Total Tasks</h5>
                            <h2 class="text-right text-white"><i class="feather icon-sidebar float-left"></i><span>{{getAllTasksOfOneUser(session('data')['userId'])}}</span>
                            </h2>

                        </div>
                    </div>
                </div>
                <!-- order-card end -->

            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
