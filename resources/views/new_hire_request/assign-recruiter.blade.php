@extends('layouts.app')
@section('content')
    @include('general.alerts')
    {!! Form::open(array('route' => 'nhr.assigned-recruiter','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
    <input type="hidden" name="id" value="{{$new_hire_request->id}}">
    <div class="row">
        @include('new_hire_request.nhr-details-in-card')
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Assign Recruiter</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-primary">Assign Recruiter</button>
                        <a href="{{ route('nhr.index') }}">
                            <button type="button" class="btn btn-outline-secondary">Back</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="control-label">Recruiter</label>
                            <select class="custom-select" name="recruiter" required>
                                <option value=""></option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
