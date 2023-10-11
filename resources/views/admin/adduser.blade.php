@extends('admin.layouts.main')
@section('main-container')

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="page-breadcrumb bg-white">
            <div class="row">
                <div class="col-lg-12 align-self-center">
                    <h5 class="font-medium text-uppercase mb-2 mt-2 p-3">{{$title}}</h5>
                </div>
            </div>
        </div>
        @if (isset($user))
        <div class="page-content container-fluid mt-2">
            <div class="row">
                <div class="col-md-12">

                </div>
                <div class="container-fluid">
                <form method="post" action="{{url('/admin/updateuser/'.$user->id)}}" enctype="multipart/form-data">
                @csrf
                        <div class="row container-fluid m-1">
                            <div class="col-md-3 profile ">

                            <div class="profile-image">
                                    <div class="inner-pic">
                                        <i class="mdi mdi-account"></i>
                                        @if ($user->user_profile_image)
                                        <img src="{{asset('storage/images/'.$user->user_profile_image)}}" id="upload">
                                        {{-- <img src="{{ asset('img/' . $post->image) }}" /> --}}
                                        @else
                                        <img src="{{url('assets/images/profile.png')}}" id="upload">
                                        @endif

                                    </div>
                                    <!-- <h4 class="p-username">@username</h4> -->
                                    <div class="form-group text-center">
                                        <label class="btn btn-info bg-c-blue">
                                            <input type="file" class="d-none " name="user_image" id="fileupload"> Upload Profile Image
                                        </label>

                                    </div>
                                    <div>
                                        <span class="text-danger">
                                            @error('user_image')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-9 ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" name="user_first_name" value="{{$user->user_first_name}}" placeholder="Enter First Name" >
                                                    <input type="hidden" class="form-control" name="user_name" value="{{$user->user_name}}"  >
                                                    <input type="hidden" class="form-control" name="user_role" value="{{$user->user_role}}"  >
                                                    <input type="hidden" class="form-control" name="user_team_lead" value="{{$user->user_team_lead}}"  >
                                                    <span class="text-danger">
                                                        @error('user_first_name')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" name="user_last_name"
                                                    value="{{$user->user_last_name}}"
                                                        placeholder="Enter Last Name" >
                                                        <span class="text-danger">
                                                            @error('user_last_name')
                                                            {{$message}}
                                                            @enderror
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="full_name" placeholder="Enter Full Name">
                                    </div> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control"  name="user_email"  value="{{$user->user_email}}"  placeholder="Enter Email"
                                                     >
                                                     <span class="text-danger">
                                                        @error('user_email')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                        <input type="text" class="form-control" name="user_phone"
                                                        placeholder="Enter Phone Number"  value="{{$user->user_phone}}" >
                                                        <span class="text-danger">
                                                            @error('user_phone')
                                                            {{$message}}
                                                            @enderror
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control"
                                                        name="user_address"  placeholder="Enter Address" >{{$user->user_address}}</textarea>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User Type</label>
                                                    <select class="form-control" name="user_type" >

                                                        @if ($user->user_type == 1)
                                                        <option value="1" selected = "selected">Team Lead</option>
                                                        <option VALUE="2">Client</option>
                                                        @elseif ($user->user_type == 2)
                                                        <option value="1" >Team Lead</option>
                                                        <option VALUE="2" selected = "selected">Client</option>
                                                        @else
                                                        @endif

                                                    </select>
                                                    <span class="text-danger">
                                                        @error('user_type')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Joining Date</label>
                                                    <input type="date" class="form-control" value="{{$user->user_joining_date}}"  name="user_joining_date"  placeholder="Enter Joining date">
                                                    <span class="text-danger">
                                                        @error('user_joining_date')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            @php
                                                $teams =  getAllTeams();
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User Team</label>
                                                    <select class="form-control" name="user_team" >
                                                        @foreach ( $teams as $team)
                                                            @if ($user->user_team == $team['id'])
                                                                <option selected  value="{{$team['id']}}">{{$team['team_name']}}</option>
                                                            @else
                                                                <option  value="{{$team['id']}}">{{$team['team_name']}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">
                                                        @error('user_team')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" required name="password">
                                        </div> -->
                                        <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <input type="date" class="form-control"  name="user_dob" value="{{$user->user_dob}}"  placeholder="Enter date-of-birth">
                                                    <span class="text-danger">
                                                        @error('user_dob')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                                    </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    Select gender
                                                    <div class="form-check">
                                                        @if ($user->user_gender == 'M')
                                                        <input class="form-check-input" type="radio" name="user_gender" id="" value="M" checked>
                                                        <label class="form-check-label" for="">Male</label>
                                                        @else
                                                        <input class="form-check-input" type="radio" name="user_gender" id="" value="M" >
                                                        <label class="form-check-label" for="">Male</label>
                                                        @endif

                                                    </div>
                                                     <div class="form-check">
                                                        @if ($user->user_gender == 'F')
                                                        <input class="form-check-input" type="radio" name="user_gender" id="" value="F" checked>
                                                        <label class="form-check-label" for="">Female</label>
                                                       @else
                                                        <input class="form-check-input" type="radio" name="user_gender" id="" value="F" >
                                                        <label class="form-check-label" for="">Female</label>
                                                        @endif
                                                    </div>
                                                    <div class="form-check">
                                                        @if ($user->user_gender == 'O')
                                                        <input class="form-check-input" type="radio" name="user_gender" id="" value="O" checked >
                                                        <label class="form-check-label" for="">Other</label>
                                                       @else
                                                        <input class="form-check-input" type="radio" name="user_gender" id="" value="O" >
                                                        <label class="form-check-label" for="">Other</label>
                                                        @endif
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('user_gender')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                                </div>


                                        </div>

                                        <div class="form-group text-center mt-2">
                                            <button type="submit" class="btn btn-success bg-c-blue">
                                                <i class="fa fa-save"></i> Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
            </div>
        </div>

        @else
        <div class="page-content container-fluid mt-2">
            <div class="row">
                <div class="col-md-12"></div>
                <div class="container-fluid">
                <form method="post" action="{{url('/admin/adduser')}}" enctype="multipart/form-data">
                @csrf
                        <div class="row container-fluid m-1">
                            <div class="col-md-3 profile ">

                            <div class="profile-image">
                                    <div class="inner-pic">
                                        <i class="mdi mdi-account"></i>
                                        <img src="{{url('assets/images/profile.png')}}" id="upload">
                                    </div>
                                    <!-- <h4 class="p-username">@username</h4> -->
                                    <div class="form-group text-center">
                                        <label class="btn btn-info bg-c-blue">
                                            <input type="file" class="d-none " name="user_image" id="fileupload"> Upload Profile Image
                                        </label>

                                    </div>
                                    <div>
                                        <span class="text-danger">
                                            @error('user_image')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-9 ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" name="user_first_name" value="{{old('user_first_name')}}" placeholder="Enter First Name" >
                                                    <span class="text-danger">
                                                        @error('user_first_name')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" name="user_last_name"
                                                    value="{{old('user_last_name')}}"
                                                        placeholder="Enter Last Name" >
                                                        <span class="text-danger">
                                                            @error('user_last_name')
                                                            {{$message}}
                                                            @enderror
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="full_name" placeholder="Enter Full Name">
                                    </div> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control"  name="user_email"  value="{{old('user_email')}}"  placeholder="Enter Email"
                                                     >
                                                     <span class="text-danger">
                                                        @error('user_email')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                        <input type="text" class="form-control" name="user_phone"
                                                        placeholder="Enter Phone Number"  value="{{old('user_phone')}}" >
                                                        <span class="text-danger">
                                                            @error('user_phone')
                                                            {{$message}}
                                                            @enderror
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control"
                                                        name="user_address"  placeholder="Enter Address" value="{{old('user_address')}}" ></textarea>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User Type</label>
                                                    <select class="form-control" name="user_type" >
                                                        <option value="1">Team Lead</option>
                                                        <option VALUE="2">Client</option>
                                                    </select>
                                                    <span class="text-danger">
                                                        @error('user_type')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Joining Date</label>
                                                    <input type="date" class="form-control" value="{{old('user_joining_date')}}"  name="user_joining_date"  placeholder="Enter Joining date">
                                                    <span class="text-danger">
                                                        @error('user_joining_date')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User Team</label>
                                                    @php
                                                       $teams =  getAllTeams();
                                                    @endphp
                                                    <select class="form-control" name="user_team" >
                                                        @foreach ( $teams as $team )
                                                        <option value="{{$team['id']}}">{{$team['team_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">
                                                        @error('user_team')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" required name="password">
                                        </div> -->
                                        <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <input type="date" class="form-control"  name="user_dob"  placeholder="Enter date-of-birth">
                                                    <span class="text-danger">
                                                        @error('user_dob')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                                    </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    {{-- <label>Confirm Password</label>
                                                    <input type="password" class="form-control"  name="password_confirmation"  placeholder="Enter Password Again">
                                                    <span class="text-danger">
                                                        @error('password_confirmation')
                                                        {{$message}}
                                                        @enderror
                                                    </span> --}}
                                                    Select gender
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="user_gender" id="" value="M" checked>
                                                        <label class="form-check-label" for="">Male</label>

                                                    </div>
                                                     <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="user_gender" id="" value="F" >
                                                        <label class="form-check-label" for="">Female</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="user_gender" id="" value="O" >
                                                        <label class="form-check-label" for="">Other</label>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('user_gender')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                                </div>


                                        </div>

                                        <div class="form-group text-center mt-2">
                                            <button type="submit" class="btn btn-success bg-c-blue">
                                                <i class="fa fa-save"></i> Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
            </div>
        </div>

        </form>

        </form>
        @endif
    </div>
</div>
</div>
<!-- [ Main Content ] end -->
</div>
</div>
<!-- [ Main Content ] end -->

@endsection


<script src="{{url('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script>
    $(document).ready(function(){

        $(function(){
                $("#fileupload").change(function(event){
                    var x = URL.createObjectURL(event.target.files[0]);
                    $("#upload").attr("src",x);

                });
            });

      });
</script>

{{-- <script>
   $(document).ready(function(){

    $.ajax({
      url: '{{ route("get-teams") }}',
      type: 'GET',
      success: function(response) {
        console.log(response.length);
        var content = "";
        content += "<select class='form-control' name='user_team' >";
        for(var i =0; i<response.length; i++)
        {

            content += "<option value='"+response[i].id+"'>"+response[i].team_name+"</option>";
        }
        content += "</select>";

        $('#dev-teams').html(content);
      },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
   });

</script> --}}
















