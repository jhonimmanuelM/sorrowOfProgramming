@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>Setting - Positions - Create</h4>
        </div>
    </div>
</div>


@include('general.alerts')

{!! Form::open(array('route' => 'positions.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Position:</label>
                <input type="text" class="form-control" placeholder="Enter a Skill" id="position" name="position" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-success">Add Position</button>
            <a href="{{ route('positions.index') }}"><button type="button" class="btn btn-warning">Cancel</button></a>
        </div>
    </div>
{!! Form::close() !!}

@endsection