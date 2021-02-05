@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>Setting - Teams - Edit</h4>
        </div>
    </div>
</div>


@include('general.alerts')

{!! Form::open(array('route' => 'teams.update','method'=>'POST')) !!}
    <input type="hidden" name="id" value="{{$team->id}}">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Team:</label>
                <input type="text" class="form-control" placeholder="Enter a Skill" id="team" name="team" required value="{{$team->team}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-success">Update Team</button>
            <a href="{{ route('teams.index') }}"><button type="button" class="btn btn-warning">Cancel</button></a>
        </div>
    </div>
{!! Form::close() !!}

@endsection