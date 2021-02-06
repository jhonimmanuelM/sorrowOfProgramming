@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>Setting - Skills - Edit</h4>
        </div>
    </div>
</div>


@include('general.alerts')

{!! Form::open(array('route' => 'skills.update','method'=>'POST')) !!}
    <input type="hidden" name="id" value="{{$skill->id}}">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Skill:</label>
                <input type="text" class="form-control" placeholder="Enter a Skill" id="skill" name="skill" required value="{{$skill->skill}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-success">Update Skill</button>
            <a href="{{ route('skills.index') }}"><button type="button" class="btn btn-warning">Cancel</button></a>
        </div>
    </div>
{!! Form::close() !!}

@endsection