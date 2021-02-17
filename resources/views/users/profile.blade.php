@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                {!! Form::open(array('route' => 'users.updateProfile','method'=>'POST','enctype' => 'multipart/form-data')) !!}
                <div class="card-header">
                    <h4 class="card-title"> User Profile</h4>
                    <div class="card-btn">
                        <button class="btn btn-success" type="submit" name="save">
                            Save
                        </button>
                        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input class="form-control"
                                       type="text"
                                       name="first_name"
                                       placeholder="First Name"
                                       value="{{ $user->first_name }}"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <input class="form-control" type="text" name="last_name"
                                       placeholder="Last Name"
                                       value="{{ $user->last_name }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Upload Profile Picture</label>
                        <input type="file"
                               class="form-control"
                               name="avatar_file"
                               placeholder="Avatar"
                               accept="image/x-png,image/gif,image/jpeg"/>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" type="text" name="email" placeholder="Email"
                                       value="{{ $user->email }}" readonly/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label>Gender</label>
                                {!! Form::select('gender_id',['1'=>'Male','2'=>'Female'],[], array('class' => 'custom-select','single')) !!}
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label">Mobile</label>
                                <input class="form-control" type="number" name="mobile_number"
                                       placeholder="Mobile Number" value="{{$user->mobile_number}}"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <input class="form-control" type="date" name="DOB" placeholder="Date of Birth"
                                       value="{{Carbon\Carbon::parse($user->DOB)->toDateString()}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label">Emergency Contact Name</label>
                                <input class="form-control" type="text" name="emergency_contact_name"
                                       placeholder="Emergency Contact Name"
                                       value="{{$user->emergency_contact_name}}"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label>Emergency Contact Number:</label>
                                <input class="form-control" type="number" name="emergency_contact_number"
                                       placeholder="Emergency Contact Number"
                                       value="{{$user->emergency_contact_number}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label>Father Name:</label>
                                <input class="form-control" type="text" name="father_name"
                                       placeholder="Father Name"
                                       value="{{$user->father_name}}"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label">Spouse Name</label>
                                <input class="form-control" type="text" name="spouse_name"
                                       placeholder="Sprouse Name" value="{{$user->spouse_name}}"/>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card author-box">
                <div class="card-banner">
                    <div class="profile-bg" id="bg-color-generate"></div>
                </div>
                <div class="card-body">
                    <div class="author-box-center">
                        <img alt="image"
                             src="{{($user->avatar) ? ($user->avatar) : asset('assets/img/user.png')}}"
                             class="rounded-circle author-box-picture">
                        <div class="clearfix"></div>
                        <div class="author-box-name mt-5 mb-3 text-black-50">
                            <span class="author-box-name-text">{{ $user->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    setTimeout(function () {
        const colorThief = new ColorThief();
        const img = document.querySelector('img');
        var color;
// Make sure image is finished loading
        if (img.complete) {
            color = colorThief.getColor(img);

        } else {
            image.addEventListener('load', function () {
                color = colorThief.getColor(img);
            });
        }
        var finalColor = "rgb(" + color.join() + ")";
        console.log(finalColor);
        $('#bg-color-generate').css('background-color',finalColor)
    }, 500);
</script>


