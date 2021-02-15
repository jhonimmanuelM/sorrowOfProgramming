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
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}

                <div class="card-header">
                    <h4 class="card-title">Edit New User</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success mr-2">
                            Save
                        </button>

                        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        {!! Form::text('first_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        {!! Form::text('last_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Role</label>
                                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'custom-select','multiple')) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Gender</label>
                                        {!! Form::select('gender_id',['1'=>'Male','2'=>'Female'],[], array('class' => 'custom-select','single')) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label form-text">Status</label>
                                        <div class="pretty p-default p-round">
                                            <input type="radio" id="active" name='status'
                                                   {{ $user->status == 1 ? 'checked' : '' }} value="1" required>
                                            <div class="state">
                                                <label class="control-label" for="active">Active</label>
                                            </div>
                                        </div>

                                        <div class="pretty p-default p-round">
                                            <input type="radio" id="in_active" name="status"
                                                   {{ $user->status == 0 ? 'checked' : '' }} value="0" required>
                                            <div class="state">
                                                <label class="control-label" for="in_active">In Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <strong>DOB:</strong>
                                        <input type="date" class="form-control" id="DOB" name="DOB"
                                               value="{{Carbon\Carbon::parse($user->DOB)->toDateString()}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <strong>Date of Joining:</strong>
                                        <input type="date" class="form-control" id="date_of_joining"
                                               name="date_of_joining"
                                               value="{{Carbon\Carbon::parse($user->date_of_joining)->toDateString()}}"
                                               required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label form-text">Probation Period</label>

                                        <div class="pretty p-default p-round">
                                            <input type="radio" id="yes"
                                                   {{ $user->status == 1 ? 'checked' : '' }} name="employee_type"
                                                   value="1"
                                                   required>
                                            <div class="state">
                                                <label  class="control-label" for="yes">Yes</label>
                                            </div>
                                        </div>

                                        <div class="pretty p-default p-round">
                                            <input type="radio" id="No"
                                                   {{ $user->status == 0 ? 'checked' : '' }} name="employee_type"
                                                   value="0"
                                                   required>
                                            <div class="state">
                                                <label  class="control-label" for="No">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Mobile</label>
                                        {!! Form::number('mobile_number', null, array('placeholder' => 'mobile Number','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Emergency Contact Name</label>
                                        {!! Form::text('emergency_contact_name', null, array('placeholder' => 'Emergency Contact name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Emergency Contact Number</label>
                                        {!! Form::number('emergency_contact_number', null, array('placeholder' => 'Emergency Contact Number','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Father Name</label>
                                        {!! Form::text('father_name', null, array('placeholder' => 'Father Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Spouse Name</label>
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
    </div>
@endsection
