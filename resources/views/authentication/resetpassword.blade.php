
@extends('authentication.layouts.main')
@section('main-container')
<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
                        <form action="{{url('/resetpassword')}}" method="post" onsubmit="return validation();">
                        @csrf
						{{-- <img id="logo" src="{{url('assets/images/indici-updated-logo.png')}}" alt="" class="img-fluid mb-4"> --}}
                        <h3 class="project-heading mb-3">Project Management</h3>
						<h4 class="mb-3 f-w-400">Reset Password</h4>
						<div class="input-group mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-lock"></i></span>
							</div>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" >
							<input type="hidden" name="userId" class="form-control" value="{{$userEmail->id}}" >
						</div>
                        <div class="text-left">
                            <span class="text-danger ">
                                @error('password')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
						<div class="input-group mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-lock"></i></span>
							</div>
							<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" >
						</div>
                        <div class="text-left mt-2">
                            <span class="text-danger ">
                                @error('password_confirmation')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
						<button class="btn btn-block btn-primary mb-4 mt-3">Reset</button>
                    </form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->
@endsection

<script src="{{url('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script>
  function validation(){
    var password = $("#password").val();
    var password_confirmation = $("#password_confirmation").val();
    if(password == "")
    {
        alert('password cannot be empty');
        return false;
    }
    else if(password_confirmation == "")
    {
        alert('confirm assword cannot be empty');
        return false;
    }
    else if(password != password_confirmation){
        alert('confirm password not matched!');
        return false;
    }
    else{
        return true;
    }
  }
</script>
