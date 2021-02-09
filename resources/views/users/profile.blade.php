@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card author-box">
                <div class="card-header">
                    <h4 class="card-title"> User Profile</h4>
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                </div>
                <div class="card-body">
                {!! Form::open(array('route' => 'users.updateProfile','method'=>'POST','enctype' => 'multipart/form-data')) !!}
                    <div class="author-box-center">
                        <img alt="image" src="{{($user->avatar) ? ($user->avatar) : asset('assets/img/user.png')}}" class="rounded-circle author-box-picture">
                        <input type="file" class="form-control" name="avatar_file" placeholder="Avatar" accept="image/x-png,image/gif,image/jpeg"/>
                        <div class="clearfix"></div>
                        <div class="author-box-name">
                            <a href="#">{{ $user->name }}</a>
                        </div>
                        <div class="form-group">
                            <label>First Name:<label>
                            <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ $user->first_name }}"/>
                        </div>
                        <div class="form-group">
                            <label>Last Name:<label>
                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{ $user->last_name }}"/>
                        </div>
                        <div class="form-group">
                            <label>Email:<label>
                            <input class="form-control" type="text" name="email" placeholder="Email" value="{{ $user->email }}" readonly/>
                        </div>
                        <div class="form-group">
                            <label>Gender:</label>
                            {!! Form::select('gender_id',['1'=>'Male','2'=>'Female'],[], array('class' => 'form-control','single')) !!}
                        </div>
                        <div class="form-group">
                            <label>Mobile:<label>
                            <input class="form-control" type="number" name="mobile_number" placeholder="Mobile Number" value="{{$user->mobile_number}}"/>
                        </div>
                        <div class="form-group">
                            <label>Date Of Birth:<label>
                            <input class="form-control" type="date" name="DOB" placeholder="Date of Birth" value="{{Carbon\Carbon::parse($user->DOB)->toDateString()}}"/>
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact Name:<label>
                            <input class="form-control" type="text" name="emergency_contact_name" placeholder="Emergency Contact Name" value="{{$user->emergency_contact_name}}"/>
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact Number:<label>
                            <input class="form-control" type="number" name="emergency_contact_number" placeholder="Emergency Contact Number" value="{{$user->emergency_contact_number}}"/>
                        </div>
                        <div class="form-group">
                            <label>Father Name:<label>
                            <input class="form-control" type="text" name="father_name" placeholder="Father Name" value="{{$user->father_name}}"/>
                        </div>
                        <div class="form-group">
                            <label>Sprouse Name:<label>
                            <input class="form-control" type="number" name="spouse_name" placeholder="Sprouse Name" value="{{$user->spouse_name}}"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="submit" name="save" placeholder="Sprouse Name"/>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
