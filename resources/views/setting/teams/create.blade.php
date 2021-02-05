@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>Setting - Teams - Create</h4>
        </div>
    </div>
</div>


@include('general.alerts')

{!! Form::open(array('route' => 'teams.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Team:</label>
                <input type="text" class="form-control" placeholder="Enter a Team" id="team" name="team" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-success">Add Team</button>
            <a href="{{ route('teams.index') }}"><button type="button" class="btn btn-warning">Cancel</button></a>
        </div>
    </div>
{!! Form::close() !!}

@endsection