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
                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="card-header">
                    <h4 class="card-title">Create New Role</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a class="btn btn-outline-secondary" href="{{ route('roles.index') }}">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <strong>Name</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <label class="control-label">Permission</label>
                            <div class="roles">
                                @foreach($permission as $value)
                                    <div class="pretty p-default checkbox">
                                        {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                        <div class="state p-primary-o">
                                            <label> {{ $value->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
