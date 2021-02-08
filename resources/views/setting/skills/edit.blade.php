@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                {!! Form::open(array('route' => 'skills.update','method'=>'POST')) !!}
                <div class="card-header">
                    <h4>Setting - Skills - Edit</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Update Skill</button>
                        <a href="{{ route('skills.index') }}">
                            <button type="button" class="btn btn-warning">Cancel</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$skill->id}}">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Skill</label>
                                <input type="text"
                                       class="form-control"
                                       id="skill"
                                       name="skill"
                                       required value="{{$skill->skill}}">
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
