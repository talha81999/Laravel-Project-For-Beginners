@extends('authentication.layouts.main')
@section('main-container')


    <!-- [ auth-signin ] start -->
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <form action="{{ url('/verifyemail') }}" method="post">
                                @if (Session::has('fail'))
                                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                                @endif
                                @csrf
                                {{-- <img id="logo" src="{{url('assets/images/indici-updated-logo.png')}}" alt="" class="img-fluid mb-4"> --}}
                                <h3 class="project-heading mb-3">Project Management</h3>
                                <h5 class="mb-3 f-w-400">Verify Email</h5>
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        placeholder="Email address">
                                </div>
                                <div class="text-left mt-2">
                                    <span class="text-danger ">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary mb-4 mt-2">Verify</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ auth-signin ] end -->
@endsection
