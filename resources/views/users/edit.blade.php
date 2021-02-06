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
                        <button type="submit"
                                class="btn btn-success">
                            Save
                        </button>

                        <a class="btn btn-primary"
                           href="{{ route('users.index') }}">
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
                                       <strong>Name:</strong>
                                       {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
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
                                       {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
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
