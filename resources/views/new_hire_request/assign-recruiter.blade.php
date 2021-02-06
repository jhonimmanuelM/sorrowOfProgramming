@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>NHR - Assign Recruiter</h4>
        </div>
    </div>
</div>


@include('general.alerts')

{!! Form::open(array('route' => 'nhr.assigned-recruiter','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
    <input type="hidden" name="id" value="{{$new_hire_request->id}}">
    <div class="row">
        @include('new_hire_request.nhr-details-in-card')
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Assign Recruiter</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Recruiter</label>
                  <select class="form-control" name="recruiter" required>
                    <option value=""></option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Assign Recruiter</button>
                <a href="{{ route('nhr.index') }}"><button type="button" class="btn btn-warning">Cancel</button></a>
              </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}

@endsection