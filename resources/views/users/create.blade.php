@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-12">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card">
            {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
            <div class="card-header">
                <h4 class="card-title">Create New User</h4>
                <div class="card-btn">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div> -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>First Name:</strong>
                                    {!! Form::text('first_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Last Name:</strong>
                                    {!! Form::text('last_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Password:</strong>
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Confirm Password:</strong>
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Role:</strong>
                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Gender:</strong>
                                    {!! Form::select('gender_id',['1'=>'Male','2'=>'Female'],[], array('class' => 'form-control','single')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>status</strong>
                                    <input type="radio" id="active" name='status' value="1" required>
                                    <label for="active">Active</label>
                                    <input type="radio" id="in_active" name="status" value="0" required>
                                    <label for="in_active">In Active</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>DOB:</strong>
                                    <input type="date" class="form-control" id="DOB" name="DOB" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Date of Joining:</strong>
                                    <input type="date" class="form-control" id="date_of_joining" name="date_of_joining" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Probation Period</strong>
                                    <input type="radio" id="yes" name="employee_type" value="1" required>
                                    <label for="yes">Yes</label>
                                    <input type="radio" id="No" name="employee_type" value="0" required>
                                    <label for="No">No</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Mobile:</strong>
                                        {!! Form::number('mobile_number', null, array('placeholder' => 'mobile Number','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Emergency Contact Name:</strong>
                                    {!! Form::text('emergency_contact_name', null, array('placeholder' => 'Emergency Contact name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Emergency Contact Number:</strong>
                                    {!! Form::number('emergency_contact_number', null, array('placeholder' => 'Emergency Contact Number','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Father Name:</strong>
                                    {!! Form::text('father_name', null, array('placeholder' => 'Father Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Spouse Name:</strong>
                                    {!! Form::text('spouse_name', null, array('placeholder' => 'Spouse Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endsection