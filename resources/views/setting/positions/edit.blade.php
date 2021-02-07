@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                {!! Form::open(array('route' => 'positions.update','method'=>'POST')) !!}
                <div class="card-header">
                    <h4>Setting - Positions - Edit</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Update Position</button>
                        <a href="{{ route('positions.index') }}">
                            <button type="button" class="btn btn-warning">Cancel</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$position->id}}">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="email">Position:</label>
                                <input type="text" class="form-control" placeholder="Enter a Skill" id="position"
                                       name="position" required value="{{$position->position}}">
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
