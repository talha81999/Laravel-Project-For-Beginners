@extends('user.layouts.main')
@section('main-container')
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

<div class="page-breadcrumb bg-white p-3 mb-2">
    <div class="row">
        <div class="col-lg-12 align-self-center">
            <h5 class="font-medium text-uppercase mb-2 mt-2">Add Task</h5>
        </div>
    </div>
</div>
<div class="page-content container-fluid">
	<div class="row">
        <div class="col-md-12">

        </div>
        <div class="container-fluid p-3">
            <div class="card">

                <form method="post" action="{{url('/user/updatepassword')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <h4 class="card-title">Details</h4>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password"  class="form-control" name="password" placeholder="Enter password">
                                    <span class="text-danger">
                                        @error('password')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password"  class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                    <span class="text-danger">
                                        @error('password_confirmation')
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

